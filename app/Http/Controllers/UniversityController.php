<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\University;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class UniversityController extends Controller
{
    public function index()
    {
        // $universities = University::paginate(10);
        $universities = University::with('country')->paginate(10);
        return view('backend.university.index', ['universities' => $universities, 'page_title' => 'University']);


    }
    public function create()
    {
        $countries = Country::all();
        return view('backend.university.create', ['countries' => $countries, 'page_title' => 'Create University']);
    }
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'phone_no' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'nullable|email',
            'website' => 'nullable|url',

        ]);
        try {
            if ($request->hasFile('logo')) {
                $newLogo = time() . '.' . $request->logo->getClientOriginalName();
                $request->logo->move('uploads/university/', $newLogo);
            } else {
                $newLogo = "NoImage";
            }

            $university = new University;
            $university->logo = $newLogo;
            $university->title = $request->title;
            $university->address = $request->address;
            $university->country_id = $request->country_id;
            $university->slug = SlugService::createSlug(University::class, 'slug', $request->title);
            $university->phone_no = $request->phone_no;
            $university->email = $request->email;
            $university->website = $request->website;

            if ($university->save()) {
                return redirect()->route('admin.universities.index')->with('success', 'Success! University created.');
            } else {
                return redirect()->back()->with('error', 'Error! University  not created.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong.');
        }
    }
    public function edit($id)
    {
        $countries = Country::all();
        $universities = University::with('country')->find($id);

        if (!$universities) {
            return redirect()->route('admin.universities.index')->with('error', 'University not found.');
        }

        return view('backend.university.update', ['universities' => $universities, 'countries' => $countries, 'page_title' => 'Update University']);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'phone_no' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
        ]);

        try {
            $university = University::find($id);
            if (!$university) {
                return redirect()->back()->with('error', 'University not found.');
            }

            if ($request->hasFile('logo')) {
                // Assuming you want to replace the old logo
                $newLogo = time() . '.' . $request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('uploads/university/'), $newLogo);
                $university->logo = $newLogo;
            }
            $university->title = $request->title;
            $university->address = $request->address;
            $university->country_id = $request->country_id;
            $university->phone_no = $request->phone_no;
            $university->email = $request->email;
            $university->website = $request->website;

            if ($university->save()) {
                return redirect()->route('admin.universities.index')->with('success', 'University updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Error! University not updated.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $universities = University::find($id);

        if ($universities) {
            $universities->delete();
            return redirect()->route('admin.universities.index')->with('success', 'Success !! University Deleted');
        } else {
            return redirect()->route('admin.universities.index')->with('error', 'University not found.');
        }
    }
}