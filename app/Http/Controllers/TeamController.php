<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamMembers = Team::all();
        
        // Return the teams to a view for display
        return view('backend.team.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the view for creating a new team
        return view('backend.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'phone_no' => 'required',
            'role' => 'nullable',
            'email' => 'nullable|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Added image validation
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/team'), $imageName); // Store image in public/uploads/team directory
        } else {
            $imageName = null; // If no image is uploaded
        }

        // Create a new team instance
        $team = new Team();

        // Fill the team instance with request data
        $team->name = $request->input('name');
        $team->position = $request->input('position');
        $team->phone_no = $request->input('phone_no');
        $team->role = $request->input('role');
        $team->email = $request->input('email');
        $team->image = $imageName; // Set the image name

        // Save the team to the database
        $team->save();

        // Redirect to the team index page with a success message
        return redirect()->route('admin.teams.index')->with('success', 'Team member created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'phone_no' => 'required',
            'role' => 'nullable',
            'email' => 'nullable|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Added image validation
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/team'), $imageName); // Store image in public/uploads/team directory
        } else {
            $imageName = $team->image; // Maintain the existing image if no new image is uploaded
        }

        // Update the team member with the new data
        $team->update([
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'phone_no' => $request->input('phone_no'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'image' => $imageName, // Set the image name
        ]);

        // Redirect to the team index page with a success message
        return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        // Delete the team member
        $team->delete();

        // Redirect to the team index page with a success message
        return redirect()->route('admin.teams.index')->with('success', 'Team member deleted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
{
    // Find the team member by ID
    $teamMember = Team::find($team->id);
    
    // Return the view for editing the team member with the team member data
    return view('backend.team.update', compact('teamMember'));
}
}

