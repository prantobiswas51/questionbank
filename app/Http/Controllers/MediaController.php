<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function deleteImage(Request $request)
    {
        $imagePath = $request->input('imagePath');

        if (!$imagePath) {
            return response()->json([
                'success' => false,
                'message' => 'Image path is required'
            ], 400);
        }

        try {
            // Extract the file path from the URL
            $urlPath = str_replace(asset('storage/'), '', $imagePath);
            $filePath = 'media/' . basename($urlPath);

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Image deleted successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Image file not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function uploadMedia(Request $request)
    {
        $request->validate([
            'files.*' => 'required|image|max:5120'
        ]);

        try {
            $uploadedFiles = [];
            $mediaPath = 'media';

            // Ensure media directory exists
            if (!Storage::disk('public')->exists($mediaPath)) {
                Storage::disk('public')->makeDirectory($mediaPath);
            }

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = Storage::disk('public')->putFileAs($mediaPath, $file, $filename);
                    $uploadedFiles[] = $path;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Images uploaded successfully',
                'uploadedFiles' => $uploadedFiles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading images: ' . $e->getMessage()
            ], 500);
        }
    }
}

