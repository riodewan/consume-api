<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class AlbumController extends Controller
{
    public function index()
    {
        // $data = (new BaseApi)->index('/api/albums');
        // $albums = $data->json();

        // // for ($i=0; $i < count($albums); $i++) {
        // //     $albums[$i]['path'] = env('API_HOST') . 'storage/' . $albums[$i]['image'];
        // // }
        // for ($i=0; $i < count($albums); $i++) {
        //     $albums[$i]['image_path'] = env('API_HOST') . 'storage/' . $albums[$i]['image'];
        // }

        // return view('albums.index')->with('albums' , $albums);
        $data = (new BaseApi)->index('/api/albums');
        $albums = $data->json('data');

        for ($i=0; $i < count($albums); $i++) {
            $albums[$i]['image_path'] = env('API_HOST') . 'storage/' . $albums[$i]['image'];
        }

        return view('albums.index')->with('albums' , $albums);
    }
}
