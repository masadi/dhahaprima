<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use File;

class MitraController extends Controller
{
    public function list_data(){
        $data = Mitra::with(['provinsi', 'kabupaten', 'kecamatan', 'desa'])->orderBy(request()->sortby, request()->sortbydesc)
        ->when(request()->q, function($query) {
            $query->where('nama_perusahaan', 'like', '%'.request()->q.'%');
        })
        ->paginate(request()->per_page);
        return response()->json(['status' => 'success', 'data' => $data]);
    }
    public function store(){
        $insert = NULL;
        $response = NULL;
        request()->validate(
            [
                'nomor_registrasi' => 'required',
                'nib' => 'required',
                'npwp' => 'required',
                'nama_perusahaan' => 'string|required',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            ],
            [
                'nomor_registrasi.required' => 'Nomor Registrasi tidak boleh kosong!',
                'nib.required' => 'NIB tidak boleh kosong!',
                'npwp.required' => 'NPWP tidak boleh kosong!',
                'nama_perusahaan.required' => 'Nama Perusahaan tidak boleh kosong!',
                'photo.image' => 'File Logo harus berubah gambar!',
                'photo.mimes' => 'File Logo harus berekstensi JPG/JPEG/PNG!',
                'photo.max' => 'Maksimal file Logo 1MB!',
            ]
        );
        $logo = NULL;
        if(request()->photo){
            if (!File::isDirectory(storage_path('app/public/images'))) {
                File::makeDirectory(storage_path('app/public/images'));
            }
            $photo = request()->photo->store('public/images');
            $logo = basename($photo);
        }
        if(request()->id){
            $find = Mitra::find(request()->id);
            $find->nomor_registrasi = request()->nomor_registrasi;
            $find->nib = request()->nib;
            $find->npwp = request()->npwp;
            $find->nama_perusahaan = request()->nama_perusahaan;
            $find->brand = request()->brand;
            $find->alamat = request()->alamat;
            $find->provinsi_id = request()->provinsi_id;
            $find->kabupaten_id = request()->kabupaten_id;
            $find->kecamatan_id = request()->kecamatan_id;
            $find->desa_id = request()->desa_id;
            $find->telepon = request()->telepon;
            $find->email = request()->email;
            $find->website = request()->website;
            if($logo){
                $find->logo = $logo;
            }
            $insert = $find->save();
        } else {
            $insert = Mitra::create([
                'nomor_registrasi' => request()->nomor_registrasi,
                'nib' => request()->nib,
                'npwp' => request()->npwp,
                'nama_perusahaan' => request()->nama_perusahaan,
                'brand' => request()->brand,
                'alamat' => request()->alamat,
                'provinsi_id' => request()->provinsi_id,
                'kabupaten_id' => request()->kabupaten_id,
                'kecamatan_id' => request()->kecamatan_id,
                'desa_id' => request()->desa_id,
                'telepon' => request()->telepon,
                'email' => request()->email,
                'website' => request()->website,
                'logo' => $logo,
            ]);
        }
        if($insert){
            $data = [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Mitra saved!',
            ];
        } else {
            $data = [
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Mitra failed to save. Please try again later!',
            ];
        }
        return response()->json($data);
    }
    public function destroy(){
        $find = Mitra::find(request()->id);
        if($find->delete()){
            $data = [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Mitra deleted!',
            ];
        } else {
            $data = [
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Mitra failed to delete. Please try again later!',
            ];
        }
        return response()->json($data);
    }
    public function provinsi(){
        $data = Provinsi::orderBy('id')->get();
        return response()->json($data);
    }
    public function kabupaten(){
        $data = Kabupaten::where('province_code', request()->provinsi_id)->orderBy('id')->get();
        return response()->json($data);
    }
    public function kecamatan(){
        $data = Kecamatan::where('city_code', request()->kabupaten_id)->orderBy('id')->get();
        return response()->json($data);
    }
    public function desa(){
        $data = Desa::where('district_code', request()->kecamatan_id)->orderBy('id')->get();
        return response()->json($data);
    }
    public function detil($id){
        $data = Mitra::find($id);
        return view('mitra', ['data' => $data]);        
    }
    public function filter(){
        $data = Mitra::find($id);
        return view('filter', ['data' => $data]);   
    }
    public function register(){
        request()->validate(
            [
                'nomor_registrasi' => 'required',
                'nib' => 'required',
                'npwp' => 'required',
                'nama_perusahaan' => 'required',
                'photo' => 'required|image|mimes:jpg,jpeg,png|max:1024',
            ],
            [
                'nomor_registrasi.required' => 'Nomor Registrasi tidak boleh kosong!',
                'nib.required' => 'NIB tidak boleh kosong!',
                'npwp.required' => 'NPWP tidak boleh kosong!',
                'nama_perusahaan.required' => 'Nama Perusahaan tidak boleh kosong!',
                'photo.required' => 'File Logo tidak boleh kosong!',
                'photo.image' => 'File Logo harus berubah gambar!',
                'photo.mimes' => 'File Logo harus berekstensi JPG/JPEG/PNG!',
                'photo.max' => 'Maksimal file Logo 1MB!',
            ]
        );
        $logo = NULL;
        if(request()->photo){
            if (!File::isDirectory(storage_path('app/public/images'))) {
                File::makeDirectory(storage_path('app/public/images'));
            }
            $photo = request()->photo->store('public/images');
            $logo = basename($photo);
        }
        Mitra::create([
            'nomor_registrasi' => request()->nomor_registrasi,
            'nib' => request()->nib,
            'npwp' => request()->npwp,
            'nama_perusahaan' => request()->nama_perusahaan,
            'brand' => request()->brand,
            'alamat' => request()->alamat,
            'provinsi_id' => request()->provinsi_id,
            'kabupaten_id' => request()->kabupaten_id,
            'kecamatan_id' => request()->kecamatan_id,
            'desa_id' => request()->desa_id,
            'telepon' => request()->telepon,
            'email' => request()->email,
            'website' => request()->website,
            'logo' => $logo,
        ]);
        return back()->with('status', 'Registrasi Kemitraan berhasil! Data Mitra akan ditampilkan setelah di approve oleh Administrator'); 
    }
    public function approve(){
        $find = Mitra::find(request()->mitra_id);
        $find->status = 1;
        if($find->save()){
            $data = [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Mitra approved!',
            ];
        } else {
            $data = [
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Mitra failed to approved. Please try again later!',
            ];
        }
        return response()->json($data);        
    }
    public function decline(){
        $find = Mitra::find(request()->mitra_id);
        $find->status = 2;
        if($find->save()){
            $data = [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Mitra declined!',
            ];
        } else {
            $data = [
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Mitra failed to declined. Please try again later!',
            ];
        }
        return response()->json($data);        
    }
}
