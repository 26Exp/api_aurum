<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImagesRequest;
use App\Http\Requests\UpdateImagesRequest;
use App\Models\Images;
use Illuminate\Support\Facades\Auth;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Images::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreImagesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImagesRequest $request)
    {
        $image = $request->file('image');
        $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        $fileName = time() . '.' . $extension;
        $image->move(public_path('images/uploads'), $fileName);
        $image = new Images();
        $image->path = $fileName;
        $image->user_id = Auth::user()->id;
        $image->save();
        return $image;
    }
}
