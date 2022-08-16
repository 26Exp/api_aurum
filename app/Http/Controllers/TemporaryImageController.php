<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemporaryImageRequest;
use App\Http\Requests\UpdateTemporaryImageRequest;
use App\Models\Image;
use App\Models\TemporaryImage;

class TemporaryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(TemporaryImage::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTemporaryImageRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTemporaryImageRequest $request)
    {
        $image = $request->file('file');
        $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        $fileName = time() . '.' . $extension;
        $image->move(public_path('images/uploads'), $fileName);
        $image = TemporaryImage::create([
            'path' => $fileName,
        ]);

        return response()->json($image);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TemporaryImage  $temporaryImage
     * @return \Illuminate\Http\Response
     */
    public function show(TemporaryImage $temporaryImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TemporaryImage  $temporaryImage
     * @return \Illuminate\Http\Response
     */
    public function edit(TemporaryImage $temporaryImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTemporaryImageRequest  $request
     * @param  \App\Models\TemporaryImage  $temporaryImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTemporaryImageRequest $request, TemporaryImage $temporaryImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TemporaryImage  $temporaryImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemporaryImage $temporaryImage)
    {
        //
    }
}
