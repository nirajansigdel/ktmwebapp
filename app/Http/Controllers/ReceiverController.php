<?php

namespace App\Http\Controllers;

use App\Models\Receiver;
use Illuminate\Http\Request;

class ReceiverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receivers = Receiver::latest()->paginate(10);
        return view('backend.receivers.index', compact('receivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.receivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:12',
            'country' => 'nullable|string|max:255',
        ]);

        Receiver::create($request->all());

        // If this is an AJAX request (from modal), return JSON
        if ($request->ajax()) {
            $receivers = Receiver::latest()->get();
            return response()->json([
                'success' => true,
                'message' => 'Receiver created successfully',
                'receivers' => $receivers,
            ]);
        }

        return redirect()->route('admin.receivers.index')->with('success', 'Receiver created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $receiver = Receiver::findOrFail($id);
        return view('backend.receivers.show', compact('receiver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receiver = Receiver::findOrFail($id);
        return view('backend.receivers.update', compact('receiver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:12',
            'country' => 'nullable|string|max:255',
        ]);

        $receiver = Receiver::findOrFail($id);
        $receiver->update($request->all());

        return redirect()->route('admin.receivers.index')->with('success', 'Receiver updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $receiver = Receiver::findOrFail($id);
        $receiver->delete();

        return redirect()->route('admin.receivers.index')->with('success', 'Receiver deleted successfully');
    }
}
