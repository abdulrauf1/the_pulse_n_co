<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingController extends Controller
{
    /**
     * Display the settings index page.
     */
    public function index()
    {
        $carouselItems = Carousel::orderBy('position')->get();
        return view('admin.settings.index', compact('carouselItems'));
    }

    /**
     * Update carousel settings.
     */
    public function updateCarousel(Request $request)
    {
        $request->validate([
            'carousel.*.id' => 'required|exists:carousels,id',
            'carousel.*.title' => 'nullable|string|max:255',
            'carousel.*.description' => 'nullable|string',
            'carousel.*.position' => 'required|integer',
            'carousel.*.is_active' => 'boolean'
        ]);

        foreach ($request->carousel as $itemData) {
            $carousel = Carousel::find($itemData['id']);
            
            if ($carousel) {
                $carousel->update([
                    'title' => $itemData['title'] ?? null,
                    'description' => $itemData['description'] ?? null,
                    'position' => $itemData['position'],
                    'is_active' => isset($itemData['is_active']) ? (bool)$itemData['is_active'] : false
                ]);
            }
        }

        return redirect()->route('admin.settings')
            ->with('success', 'Carousel settings updated successfully.');
    }

    /**
     * Add a new carousel item.
     */
    public function addCarouselItem(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Get the next position
        $nextPosition = Carousel::max('position') + 1;

        // Handle image upload
        $imagePath = $request->file('image')->store('carousel', 'public');

        Carousel::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'position' => $nextPosition,
            'is_active' => true
        ]);

        return redirect()->route('admin.settings')
            ->with('success', 'Carousel item added successfully.');
    }

    /**
     * Delete a carousel item.
     */
    public function deleteCarouselItem(Carousel $carousel)
    {
        // Delete the image file
        if ($carousel->image_path && Storage::disk('public')->exists($carousel->image_path)) {
            Storage::disk('public')->delete($carousel->image_path);
        }

        $carousel->delete();

        return redirect()->route('admin.settings')
            ->with('success', 'Carousel item deleted successfully.');
    }
}