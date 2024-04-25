<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Mitra;
use App\Models\Provinsi;

class PageController extends Controller
{
    public function index(){
        $data = Page::find(1);
        return view('home', ['data' => $data]);
    }
    public function pages(){
        $data = Page::whereSlug(request()->route('slug'))->first();
        $mitra = ($data) ? Mitra::where('status', 1)->orderBy('id')->get() : NULL;
        $provinsi = [];
        if($data && $data->type == 'mitra'){
            $provinsi = Provinsi::orderBy('id')->get();
        }
        return view('home', ['data' => $data, 'mitra' => $mitra, 'provinsi' => $provinsi]);
    }
    public function list_data(){
        $data = Page::orderBy(request()->sortby, request()->sortbydesc)
        ->when(request()->q, function($query) {
            $query->where('title', 'like', '%'.request()->q.'%');
        })
        ->paginate(request()->per_page);
        return response()->json(['status' => 'success', 'data' => $data]);
    }
    public function store(){
        $insert = NULL;
        $response = NULL;
        request()->validate([
            'title' => 'string|required',
            'type' => 'string|required',
        ]);
        if(request()->id){
            $find = Page::find(request()->id);
            $find->title = request()->title;
            $find->type = request()->type;
            $find->content = request()->content;
            $insert = $find->save();
        } else {
            $insert = Page::create([
                'title' => request()->title,
                'type' => request()->type,
                'content' => request()->content,
            ]);
        }
        if($insert){
            $data = [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Page saved!',
            ];
        } else {
            $data = [
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Page failed to save. Please try again later!',
            ];
        }
        return response()->json($data);
    }
    public function destroy(){
        $find = Page::find(request()->id);
        if($find->delete()){
            $data = [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Page deleted!',
            ];
        } else {
            $data = [
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Page failed to delete. Please try again later!',
            ];
        }
        return response()->json($data);
    }
}
