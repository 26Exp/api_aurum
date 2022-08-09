<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Image::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request)
    {
        $image = $request->file('file');
        $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        $fileName = 'IMG-'. $request->product_id . '-' . time() . '.' . $extension;
        $image->move(public_path('images/uploads'), $fileName);
        $image = Image::create([
            'path' => $fileName,
            'product_id' => $request->product_id,
            'is_main' => $request->is_main,
        ]);

        return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImageRequest  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        // Delete the image from the filesystem
        $imagePath = public_path('images/uploads/' . $image->path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        // Delete the image from the database
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully'], 200);
    }
}
