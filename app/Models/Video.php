<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;

class Video extends Model
{
    use HasFactory;
    public static function searchVideo($query)
    {
        $url = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyCkzcwSJNguHaybXQyYwZmfcpPEo4fVYQ8&type=video&part=snippet&maxResults=10&q=' . $query;
        try {
            $response = Http::get($url);
            return $response->body();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function detailVideo($id)
    {
        $url = 'https://www.googleapis.com/youtube/v3/videos?key=AIzaSyCkzcwSJNguHaybXQyYwZmfcpPEo4fVYQ8&id=' . $id . '&part=snippet';
        try {
            $response = Http::get($url);
            return $response->body();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getBestVideoDownloadDetail($id)
    {
        $youtube = new YouTubeDownloader();

        try {
            $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=".$id);

            if ($downloadOptions->getAllFormats()) {
                return $downloadOptions->getFirstCombinedFormat();
            } else {
                return false;
            }

        } catch (YouTubeException $e) {
            throw $e;
        }
    }
    public static function getAlltVideoDownloadDetail($id)
    {
        $youtube = new YouTubeDownloader();

        try {
            $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=".$id);

            if ($downloadOptions->getAllFormats()) {
                return $downloadOptions->getAllFormats();
            } else {
                return false;
            }

        } catch (YouTubeException $e) {
            throw $e;
        }
    }
}
