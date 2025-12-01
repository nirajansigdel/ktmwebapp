<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Store a newly created item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'receiver_id' => 'nullable|exists:receivers,id',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'street_address' => 'nullable|string',
            'postal_code' => 'nullable|string|max:20',
            'box_number' => 'nullable|string|max:255',
            'sending_date' => 'nullable|date',
            'weight' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'estimated_delivery_date' => 'nullable|date',
            'dimensions' => 'nullable|string|max:255',
            'package_type' => 'nullable|in:Box,Envelope,Fragile,Heavy,Liquid',
            'declared_value_rate' => 'nullable|numeric|min:0',
            'shipping_charge' => 'nullable|numeric|min:0',
            'extra_charge' => 'nullable|numeric|min:0',
            'documents' => 'nullable|array',
            'documents.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'tracking_number' => 'nullable|string|max:255',
            'status' => 'nullable|in:In Transit,Delivered,Pending',
            'notes' => 'nullable|string',
        ]);

        try {
            $itemData = $request->except(['documents', '_token']);
            
            // Handle file uploads
            $documentPaths = [];
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $fileName = time() . '_' . Str::random(10) . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/items/documents'), $fileName);
                    $documentPaths[] = 'uploads/items/documents/' . $fileName;
                }
            }
            $itemData['documents'] = !empty($documentPaths) ? $documentPaths : null;

            // Generate tracking number if not provided
            if (empty($itemData['tracking_number'])) {
                // Generate unique tracking number
                do {
                    $itemData['tracking_number'] = 'TRK' . strtoupper(Str::random(8));
                } while (Item::where('tracking_number', $itemData['tracking_number'])->exists());
            } else {
                // Check if tracking number already exists
                if (Item::where('tracking_number', $itemData['tracking_number'])->exists()) {
                    return redirect()->back()->withInput()->with('error', 'Tracking number already exists. Please use a different one.');
                }
            }

            // Set default status if not provided
            if (empty($itemData['status'])) {
                $itemData['status'] = 'Pending';
            }

            // Set default package type if not provided
            if (empty($itemData['package_type'])) {
                $itemData['package_type'] = 'Box';
            }

            $item = Item::create($itemData);

            return redirect()->route('admin.items.entry')->with('success', 'Item created successfully! Tracking Number: ' . $item->tracking_number);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error creating item: ' . $e->getMessage());
        }
    }
}
