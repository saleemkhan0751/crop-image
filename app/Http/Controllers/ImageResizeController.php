<?php

namespace App\Http\Controllers;

use App\Models\ImageResize;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageResizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;

            $imgFile = Image::make($image->getRealPath());

            $imgFile->resize(80, 80);
            $destinationPath = public_path('/images/resize');
            $img = Image::make($image->path());
            $img->resize(80, 80, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $fileName);


            $image->move('images/orginal/', $fileName);
            $data['image'] = $fileName;
            ImageResize::create($data);
            return  back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ImageResize $imageResize
     * @return \Illuminate\Http\Response
     */
    public function show(ImageResize $imageResize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ImageResize $imageResize
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageResize $imageResize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ImageResize $imageResize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageResize $imageResize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ImageResize $imageResize
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageResize $imageResize)
    {
        //
    }
}
