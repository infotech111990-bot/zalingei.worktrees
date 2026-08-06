<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MTCPanelDropzoneController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'folder' => 'required|string|max:255',
            'prefix' => 'nullable|string|max:80',
            'new_file_name' => 'nullable|string|max:120',
        ]);

        $relativeFolder = trim(str_replace('\\', '/', $request->input('folder')), '/');
        $relativeFolder = preg_replace('#^public/#', '', $relativeFolder);

        if (str_contains($relativeFolder, '..') || ! str_starts_with($relativeFolder, 'includes/')) {
            abort(422, 'Invalid upload folder.');
        }

        $folder = public_path($relativeFolder);
        if (! is_dir($folder) && ! mkdir($folder, 0755, true) && ! is_dir($folder)) {
            abort(500, 'Unable to create the upload folder.');
        }

        $baseName = $request->filled('new_file_name')
            ? $request->input('new_file_name')
            : pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
        $prefix = $request->filled('prefix') ? \Illuminate\Support\Str::slug($request->input('prefix')).'-' : '';
        $file = $prefix . \Illuminate\Support\Str::slug($baseName) . '-' . \Illuminate\Support\Str::random(12) . '.' . $request->file('file')->extension();

		// if ($service->pictures->count() >= $service->picturesLimit)
		// {
        //     $errorMsg = 'عفوا، عدد الصور المرفوعة للخدمة تجاوز الحد المسموح به وهو '.$service->picturesLimit.' صور';
		// 	return response()->json($errorMsg, 400);
		// }

        // function seoUrl($string) {
        //     //Lower case everything
        //     $string = strtolower($string);
        //     //Make alphanumeric (removes all other characters)
        //     $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //     //Clean up multiple dashes or whitespaces
        //     $string = preg_replace("/[\s-]+/", " ", $string);
        //     //Convert whitespaces and underscore to dash
        //     $string = preg_replace("/[\s_]/", "-", $string);
        //     return $string;
        // }

        // $attachmentName = $service->user->id.'_'.date('Ymd_His').'_'.rand(111,999).'.'.$request->file->getClientOriginalExtension();
        // if (!file_exists($folder)) {
        //     mkdir($folder, 0755, true);
        //  }

        $upload_success = $request->file('file')->move($folder, $file);

        $success_message = array( 
                            'success' => 200,
                            'filename' => $file,
                        );

        if ($upload_success) {
            return response()->json($success_message);
        } else {
        	return response()->json('error', 400);
        }
    }
}
