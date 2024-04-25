<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;
use App\Models\Team;
use Validator;
use Storage;

class AuthController extends Controller
{
    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';        
        request()->merge([$field => $login]);
        return $field;
        //return 'username';
    }
    public function register(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'email'=>'required|string|unique:users',
                'password'=>'required|string',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'email.unique' => 'Email telah terdaftar',
                'password.required' => 'Password tidak boleh kosong'
            ]
        );
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $role = Role::where('name', 'user')->first();
        $user->attachRole($role);
        return response()->json([
            'error'=> FALSE,
            'message' => 'Register berhasil'
        ]);
    }
    public function login(Request $request)
    {
        $login = request()->input('email');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $namaField = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'Email' : 'NPSN';
        request()->merge([$field => $login]);
        $request->validate(
            [
                $field => 'required|string|exists:users,'.$field ,
                'password' => 'required|string',
                'remember_me' => 'boolean'
            ],
            [
                $field.'.required' => $namaField.' tidak boleh kosong',
                $field.'.exists' => $namaField.' tidak terdaftar',
                'password.required' => 'Password tidak boleh kosong'
            ]
        );
        $credentials = request([$field,'password']);
        //return response()->json($credentials);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'user' => NULL,
                'message' => [
                    'password' => 'Password salah!',
                ]
            ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
        $user->role = $user->roles->unique()->implode('display_name', ', ');
        $user->roles = $user->roles->unique()->pluck('name')->toArray();
        $user->ability = [
            [
                'action' => 'read',
                'subject' => 'Web'
            ],
            [
                'action' => 'read',
                'subject' => 'Administrator'
            ],
        ];
        return response()->json([
            'accessToken' =>$token,
            'user' => $user,
            'token_type' => 'Bearer',
        ]);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
        'message' => 'Successfully logged out'
        ]);

    }
    public function profil(){
        return response()->json(auth()->user());
    }
    public function update_profile(){
        $user = auth()->user();
        if(request()->has('name')){
            request()->validate(
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->user_id, 'user_id')],
                    'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
                ],
                [
                    'name.required' => 'Nama Lengkap tidak boleh kosong!',
                    'email.required' => 'Email tidak boleh kosong!',
                    'email.email' => 'Email tidak valid!',
                    'email.unique' => 'Email sudah terdaftar di Database!',
                    'photo.mimes' => 'Foto harus berekstensi jpg/jpeg/png',
                    'photo.max' => 'Ukuran foto tidak boleh lebih dari 1 MB!',
                ],
            );
            $user->name = request()->name;
            //$user->email = request()->email;
            $user->email = request()->email;
            //profile-photos
            if(request()->photo){
                $photo = request()->photo->store('public/profile-photos');
                $user->profile_photo_path = 'profile-photos/'.basename($photo);
            }
            if($user->save()){
                $data = [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'Profil Pengguna berhasil diperbaharui',
                ];
            } else {
                $data = [
                    'icon' => 'danger',
                    'title' => 'Gagal!',
                    'text' => 'Profil Pengguna gagal diperbaharui. Silahkan coba beberapa saat lagi!',
                ];
            }
        } else {
            $message = [
                //'current_password.required' => 'Kata sandi saat ini tidak boleh kosong',
                //'current_password.current_password' => 'Kata sandi salah',
                'password.required' => 'Kata sandi baru tidak boleh kosong',
                'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai dengan Kata sandi baru',
                'password_confirmation.required' => 'Konfirmasi kata sandi tidak boleh kosong',
            ];
            $rules = [
                //'current_password' => ['required', 'current_password'],
                'password' => [
                    'required',
                    'confirmed',
                ],
                'password_confirmation' => ['required'],
            ];
            $validator = Validator::make(request()->all(), $rules, $message)->validated();
            $user->password = Hash::make(request()->password);
            if($user->save()){
                $user->ability = [
                    [
                        'action' => 'read',
                        'subject' => 'Web'
                    ],
                    [
                        'action' => 'read',
                        'subject' => 'Administrator'
                    ],
                    [
                        'action' => 'read',
                        'subject' => 'Akses'
                    ]
                ];
                $data = [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'Password Pengguna berhasil diperbaharui',
                    'ability' => $ability,
                ];
            } else {
                $data = [
                    'icon' => 'danger',
                    'title' => 'Gagal!',
                    'text' => 'Password Pengguna gagal diperbaharui. Silahkan coba beberapa saat lagi!',
                ];
            }
        }
        return response()->json($data);
        $data = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Profil Pengguna berhasil diperbaharui',
        ];
        return response()->json($data);
    }
}
