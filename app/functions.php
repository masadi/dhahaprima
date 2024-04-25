<?php
use App\Models\Page;
use Carbon\Carbon;
function menu(){
    $data = Page::orderBy('id')->where('slug', '<>', 'home')->get();
    return $data;
}
function tgl_indo(){
    return Carbon::now()->translatedFormat('d F Y');
}