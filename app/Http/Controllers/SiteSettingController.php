<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $sitesetting = SiteSetting::all();
        return view('backend.sitesetting.index', ['sitesettings' => $sitesetting, 'page_title' => 'Site Settings']);
    }
    public function create()
    {
        return view('backend.sitesetting.create', ['page_title' => 'Create SiteSetting']);

    }
    public function store(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string',
            'office_address' => 'required|string',
            'office_contact' => 'required|string',
            'office_email' => 'required|string',
            'whatsapp_number' => 'required|string',
            'main_logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'side_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'company_registered_date' => 'required|date_format:Y-m-d',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'google_maps_link' => 'nullable|url'
        ]);
        try {
            if ($request->hasFile('main_logo')) {
                $newMainLogo = time() . '.' . $request->main_logo->getClientOriginalName();
                $request->main_logo->move('uploads/sitesetting/', $newMainLogo);
            } else {
                $newMainLogo = "NoImage";
            }
            if ($request->hasFile('side_logo')) {
                $newSideLogo = time() . '.' . $request->side_logo->getClientOriginalName();
                $request->side_logo->move('uploads/sitesetting/', $newSideLogo);
            } else {
                $newSideLogo = "NoImage";
            }


            $sitesetting = new SiteSetting;
            $sitesetting->office_name = $request->office_name;
            $sitesetting->office_address = $request->office_address;
            $sitesetting->office_contact = $request->office_contact;
            $sitesetting->office_email = $request->office_email;
            $sitesetting->whatsapp_number = $request->whatsapp_number;
            $sitesetting->main_logo = $newMainLogo;
            $sitesetting->side_logo = $newSideLogo ?? '';
            $sitesetting->company_registered_date = $request->company_registered_date;
            $sitesetting->facebook_link = $request->facebook_link ?? '';
            $sitesetting->instagram_link = $request->instagram_link ?? '';
            $sitesetting->linkedin_link = $request->linkedin_link ?? '';
            $sitesetting->google_maps_link = $request->google_maps_link ?? '';
            if ($sitesetting->save()) {
                return redirect()->route('admin.site-settings.index')->with('success', 'Success !! SiteSetting Created');
            } else {
                return redirect()->back()->with('error', 'Error !! SiteSetting not created');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error !! Something went wrong');
        }
    }

    public function edit($id)
    {
        $sitesetting = SiteSetting::find($id);
        return view('backend.sitesetting.update', ['sitesetting' => $sitesetting, 'page_title' => 'Update SiteSettings']);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'office_name' => 'required|string',
            'office_address' => 'required|string',
            'office_contact' => 'required|string',
            'office_email' => 'required|string',
            'whatsapp_number' => 'required|string',
            'main_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'side_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'company_registered_date' => 'required|date_format:Y-m-d',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'google_maps_link' => 'nullable|url'

        ]);
        try {
            // $sitesetting = SiteSetting::find($request->id);
            $sitesetting = SiteSetting::findOrFail($id);
            if ($request->hasFile('main_logo')) {
                if ($sitesetting->main_logo && file_exists(public_path('uploads/sitesetting/' . $sitesetting->main_logo))) {
                    unlink(public_path('uploads/sitesetting/' . $sitesetting->main_logo));
                }
                $newMainName = time() . '-' . $request->main_logo->getClientOriginalName();
                $request->main_logo->move(public_path('uploads/sitesetting'), $newMainName);
                $sitesetting->main_logo = $newMainName;
            }
            if ($request->hasFile('side_logo')) {
                if ($sitesetting->side_logo && file_exists(public_path('uploads/sitesetting/' . $sitesetting->side_logo))) {
                    unlink(public_path('uploads/sitesetting/' . $sitesetting->side_logo));
                }
                $newSideName = time() . '-' . $request->side_logo->getClientOriginalName();
                $request->side_logo->move(public_path('uploads/sitesetting'), $newSideName);
                $sitesetting->side_logo = $newSideName;
            }

            $sitesetting->office_name = $request->office_name;
            $sitesetting->office_address = $request->office_address;
            $sitesetting->office_contact = $request->office_contact;
            $sitesetting->office_email = $request->office_email;
            $sitesetting->whatsapp_number = $request->whatsapp_number;
            $sitesetting->company_registered_date = $request->company_registered_date;
            $sitesetting->facebook_link = $request->facebook_link ?? '';
            $sitesetting->instagram_link = $request->instagram_link ?? '';
            $sitesetting->linkedin_link = $request->linkedin_link ?? '';
            $sitesetting->google_maps_link = $request->google_maps_link ?? '';

            if ($sitesetting->save()) {
                return redirect()->route('admin.site-settings.index')->with('success', 'Success !! SiteSetting Updated');
            } else {
                return redirect()->back()->with('error', 'Error !! SiteSetting not updated');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error !! Something went wrong');
        }
    }
    public function destroy($id)
    {
        $sitesetting = SiteSetting::find($id);
        if ($sitesetting) {
            $sitesetting->delete();
            return redirect()->route('admin.site-settings.index')->with('success', 'Success !! Site Settings Deleted');
        } else {
            return redirect()->route('admin.site-settings.index')->with('error', 'Site Settings not found.');
        }
    }
}