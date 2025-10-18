<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the announcements.
     */
    public function index()
    {
        $announcements = Announcement::with('user')
            ->latest()
            ->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new announcement.
     */
    public function create()
    {
        return view('announcements.create');
    }

    /**
     * Store a newly created announcement in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048',
            'expired_date' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'expired_date']);
        $data['user_id'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        Announcement::create($data);

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified announcement.
     */
    public function show($announcement_id)
    {
        $announcement = Announcement::with('user')->where('announcement_id', $announcement_id)->firstOrFail();
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified announcement.
     */
    public function edit($announcement_id)
    {
        $announcement = Announcement::where('announcement_id', $announcement_id)->firstOrFail();
        return view('announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified announcement in storage.
     */
    public function update(Request $request, $announcement_id)
    {
        $announcement = Announcement::where('announcement_id', $announcement_id)->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'expired_date' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'expired_date']);

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($announcement->image && Storage::disk('public')->exists($announcement->image)) {
                Storage::disk('public')->delete($announcement->image);
            }

            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified announcement from storage.
     */
    public function destroy($announcement_id)
    {
        $announcement = Announcement::where('announcement_id', $announcement_id)->firstOrFail();

        // Delete image if exists
        if ($announcement->image && Storage::disk('public')->exists($announcement->image)) {
            Storage::disk('public')->delete($announcement->image);
        }

        $announcement->delete();

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}
