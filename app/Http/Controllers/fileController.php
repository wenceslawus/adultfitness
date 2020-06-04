<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class fileController extends Controller
{
    private function _uploadImage ($image_data, $size = null) {
        try {
            $img = Image::make(file_get_contents($image_data));
            if ($size) {
                $img->fit($size['width'], $size['height'], function($constraint){
                    $constraint->upsize();
                });
            }

            $filename = uniqid().'.jpg';


            Storage::put(
                $filename,
                (string)$img->encode()
            );

            return [ 'path' => Storage::url($filename) ];
        }
        catch(\Exception $ex){
            return ['error' => [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTrace()
            ]];
        }
    }

    public function uploadImage(Request $request) {
		
        $result = $this->_uploadImage( $request->data );

        if (isset($result['path'])) {
            return response()->json(['path' => asset($result['path'])], 200);
        }
        return response()->json($result, (isset($result['error']))?500:200);
    }

    public function uploadFile(Request $request) {
        try {
            $file = file_get_contents($request->data);
            $filename = uniqid().'.pdf';


            Storage::put(
                $filename,
                (string)$file
            );

            return [
                'path' => asset(Storage::url($filename)),
            ];
        }
        catch(\Exception $ex){
            return response()->json(['error' => [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTrace()
            ], 500]);
        }
    }

    public function uploadAvatar(Request $request) {
        $result = $this->_uploadImage(
            $request->data,
            [
                'width' => 300,
                'height' => 300
            ]);

        if (isset($result['path'])) {
            $user = Auth::user();
            if ($user->avatar){
                Storage::delete(substr($user->avatar, 8));
            }

            $user->update([
                'avatar' => $result['path']
            ]);
            return response()->json(['path' => asset($result['path'])], 200);
        }
        return response()->json($result, (isset($result['error']))?500:200);
    }

    public function uploadwallpaper(Request $request) {
        $result = $this->_uploadImage(
            $request->data,
            [
                'width' => 1286,
                'height' => 220
            ]);

        if (isset($result['path'])) {
            $user = Auth::user();
            if ($user->wallpaper){
                Storage::delete(substr($user->wallpaper, 8));
            }

            $user->update([
                'wallpaper' => $result['path']
            ]);
            return response()->json(['path' => asset($result['path'])], 200);
        }
        return response()->json($result, (isset($result['error']))?500:200);
    }

    public function test(Request $request) {
		/*
        $user = User::where('id', 1)
            ->first();//*/
    }
}
