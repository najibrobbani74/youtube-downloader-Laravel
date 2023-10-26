<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class VideoController extends Controller
{
    function searchVideo(Request $request)
    {
        $videos = Video::searchVideo($request->search);
        return response()->json(json_decode($videos));
    }
    function videoDetail(Request $request)
    {
        if(Auth::check()){
            $downloadDetails = Video::getAlltVideoDownloadDetail($request->id);
        } else {
            $downloadDetails = [Video::getBestVideoDownloadDetail($request->id)];
        }
        $video = Video::detailVideo($request->id);
        return view("video.video-detail", ['video'=>json_decode( $video)->items[0],'downloadDetails'=>$downloadDetails]);
    }
    function videoDownloadDetail(Request $request)
    {
        if(Auth::check()){
            $video = Video::getAlltVideoDownloadDetail($request->id);
        } else {
            $video = [Video::getBestVideoDownloadDetail($request->id)];
        }
        return view('video.download',['video'=>$video,'video_id'=>$request->id] );
    }
}
