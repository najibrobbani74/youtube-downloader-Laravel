<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class History extends Model
{
    protected $table = "history";
    use HasFactory;
    public static function getHistoryByUserId($userId)
    {
        try {
            return History::where("user_id", $userId)->orderBy('created_at', 'DESC')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function storeHistory($video_id,$thumbnail,$title,$channel,$link_download)
    {
        try {
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->video_id = $video_id;
            $history->thumbnail = $thumbnail;
            $history->title = $title;
            $history->channel = $channel;
            $history->link_download = $link_download;
            $history->save();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function deleteHistoryById($id)
    {
        try {
            History::destroy($id);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
