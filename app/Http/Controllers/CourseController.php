<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\SummernoteContent;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);
        $summernoteContent = new SummernoteContent();
        return view('backend.course.index', ['courses' => $courses,'summernoteContent' => $summernoteContent, 'page_title' => 'Course']);


    }
    public function create()
    {
        return view('backend.course.create', ['page_title' => 'Create Course']);

    }
    public function store(Request $request)
    {
        
        try {
            $this->validate($request, [
                'title' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
                'description' => 'required|string',

            ]);
            // Process Summernote content using the SummernoteContent model
            $summernoteContent = new SummernoteContent();
            $processedDescription = $summernoteContent->processContent($request->description);


            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/course'), $newImageName);

            $about = new Course;
            $about->title = $request->title;
            $about->description = $processedDescription;
            $about->slug = SlugService::createSlug(Course::class, 'slug', $request->title);
            $about->image = $newImageName;

            if ($about->save()) {
                return redirect()->route('admin.courses.index')->with('success', 'Success! Course created.');
            } else {
                return redirect()->back()->with('error', 'Error! Course  not created.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong.');
        }
    }
    public function edit($id)
    {
        $courses = Course::find($id);
        return view('backend.course.update', ['courses' => $courses, 'page_title' => 'Update Course']);

    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'title' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
                'description' => 'required|string',
            ]);

            $course = Course::find($id);
            if (!$course) {
                return redirect()->back()->with('error', 'Error! Course not found.');
            }

            if ($request->hasFile('image')) {
                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/course'), $newImageName);
                $course->image = $newImageName;
            }

            // Process Summernote content using the SummernoteContent model
            $summernoteContent = new SummernoteContent();
            $processedDescription = $summernoteContent->processContent($request->description);
            $course->description = $processedDescription; 

            $course->title = $request->title;
            $course->description = $request->description;

            if ($course->save()) {
                return redirect()->route('admin.courses.index')->with('success', 'Success! Course updated.');
            } else {
                return redirect()->back()->with('error', 'Error! Course not updated.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $courses = Course::find($id);

        if ($courses) {
            $courses->delete();
            return redirect()->route('admin.courses.index')->with('success', 'Success !! Course Deleted');
        } else {
            return redirect()->route('admin.courses.index')->with('error', 'Course  not found.');
        }
    }
}