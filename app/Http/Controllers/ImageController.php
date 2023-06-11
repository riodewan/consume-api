<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = (new BaseApi)->index('/api/images');
        $images = $data->json('data');

        for ($i=0; $i < count($images); $i++) {
            $images[$i]['image_path'] = env('API_HOST') . 'storage/' . $images[$i]['image'];
        }

        return view('images.index')->with('images' , $images);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newName = null;
            if($request->image){
                $extension = $request->file('image')->getClientOriginalExtension();
                $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
                $request->file('image')->move(public_path('/storage/'), $newName);
            }

        $payload = [
            'title' => $request->title,
            'image' => $newName,
           ];

            $baseApi = new BaseApi;
            $response = $baseApi->create('/api/images/store', $payload);
            return redirect('/images')->with('success', 'Success add new Students to API!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
