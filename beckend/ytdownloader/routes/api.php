<?php

use Illuminate\Http\Request;
use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/youtube/download/{type?}/{id?}', function (Request $request) {
    $youtube = new YouTubeDownloader();

    try {
        $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=".$request->id);
        // dd($downloadOptions->getAudioFormats());
        if ($downloadOptions->getAllFormats()) {
            if($request->type == 'mp3'){
                return response()->json($downloadOptions->getAudioFormats());
            } else {
                return response()->json($downloadOptions->getVideoFormats());
            }
        } else {
            return response()->json(['data'=>'No Link Found'],404);
        }
    
    } catch (YouTubeException $e) {
        return response()->json(['data'=>'Something went wrong: ' . $e->getMessage()],500);
    }
})->middleware('cors');