<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;

use App\Models\ImageConverter;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        //
        $gallery = PhotoGallery::paginate(50);
        return view('backend.photogallery.index', ['gallery' => $gallery, 'page_title' => 'Photo Gallery',]);
    }
    public function create()
    {
        //
        return view('backend.photogallery.create', ['page_title' => 'Create Photo Gallery']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'img_desc' => 'nullable|string',
            'img' => 'required|array',
            'img.*' => 'required|image|mimes:jpeg,png,jpg,gif,avif,webp,avi|max:2048' // maximum file size of 2 MB
        ]);
        try {
            $images = $request->file('img');
            $path = 'uploads/photogallery/';
            $convertedImages = [];
            foreach ($images as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($path), $imageName);
                $convertedImages[] = $path . $imageName;
            }

            $gallery = new PhotoGallery;
            $gallery->title = $request->title;
            $gallery->img_desc = $request->img_desc;
            $gallery->slug = SlugService::createSlug(PhotoGallery::class, 'slug', $request->title);
            $gallery->img = $convertedImages;

            $gallery->save();
            return redirect()->route('admin.photo-galleries.index')->with(['success' => 'Success!! Gallery Created']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error creating gallery. Please try again.']);
        }
    }


    public function edit($id)
    {
        //
        $gallery = PhotoGallery::find($id);
        return view('backend.photogallery.update', ['gallery' => $gallery, 'page_title' => 'Update Photo Gallery']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'img_desc' => 'nullable|string',
            'img' => 'nullable|array',
            'img.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // maximum file size of 2 MB
        ]);

        try {
            $gallery = PhotoGallery::findOrFail($id);

            $gallery->title = $request->title;
            $gallery->img_desc = $request->img_desc;
            $gallery->slug = SlugService::createSlug(PhotoGallery::class, 'slug', $request->title);

            // Check if new images are uploaded
            if ($request->hasFile('img')) {
                $images = $request->file('img');
                $path = 'uploads/photogallery/';
                $convertedImages = ImageConverter::convertImages($images, $path);
                $gallery->img = $convertedImages;
            }

            $gallery->save();
            return redirect()->route('admin.photo-galleries.index')->with(['success' => 'Success!! Gallery Updated']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error updating gallery. Please try again.']);
        }
    }

    public function destroy($id)
    {
        //
        $gallery = PhotoGallery::find($id);
        if ($gallery) {
            $gallery->delete();
            return redirect()->route('admin.photo-galleries.index')->with('success', 'Success !! Photo Gallery Deleted');
        } else {
            return redirect()->route('admin.photo-galleries.index')->with('error', 'Photo Gallery not found.');
        }

    }
}