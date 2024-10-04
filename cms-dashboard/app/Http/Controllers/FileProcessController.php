<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image; // For image manipulation

class FileProcessController extends Controller
{
    public static function upload_photo($file){
        // Step 4: Create thumbnail from the original file
        $new_filename = time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $originalExtension = $file->getClientOriginalExtension(); // Get the original file extension

        // Define thumbnail path with the same base name and original extension
        $thumbnailPath = 'thumbnails/' . $new_filename . '.' . $originalExtension;

        // Create and save the thumbnail with the original file type
        $image = Image::make($file)->resize(150, 150); // Resize to thumbnail dimensions
        $image->save(storage_path('app/public/' . $thumbnailPath), 100); // Save with quality, if needed

        // Step 5: Save the original file with the same base name and extension
        $file->storeAs('images', $new_filename . '.' . $originalExtension, 'public'); // Save original with same base name
        return $new_filename;
    }

    public static function delete_photo($filename) {
        // Define the paths for the original image and thumbnail
        $originalPath = storage_path('app/public/images/' . $filename . '.' . pathinfo($filename, PATHINFO_EXTENSION));
        $thumbnailPath = storage_path('app/public/thumbnails/' . $filename . '.' . pathinfo($filename, PATHINFO_EXTENSION));
        $is_success = true;
        $message = [];
    
        // Check if the original image exists and delete it
        if (file_exists($originalPath)) {
            if (unlink($originalPath)) {
                $message[] = 'Success to delete the original image.';
            } else {
                $message[] = 'Failed to delete the original image.';
                $is_success = false;
            }
        }
    
        // Check if the thumbnail image exists and delete it
        if (file_exists($thumbnailPath)) {
            if (unlink($thumbnailPath)) {
                $message[] = 'Success to delete the thumbnail image.';
            } else {
                $message[] ='Failed to delete the thumbnail image.';
                $is_success = false;
            }
        }
    
        if (empty($message)) {
           $message[]='No files to delete.';
           $is_success = false;
        }
    
        return ['success' => $is_success, 'message' => $message];
    }
    
    
}
