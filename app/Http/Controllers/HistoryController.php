<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    function historyPage(Request $request)  
    {
        $histories = History::getHistoryByUserId(Auth::user()->id);
        return view("video.history",['histories'=>$histories]);
    }

    function storeHistory(Request $request)
    {
        $history = History::storeHistory($request->video_id,$request->thumbnail,$request->title,$request->channel,$request->link_download);
        if ($history) {
            return response()->json([
                'status'=> 'success',
                'message'=> 'History berhasil ditambahkan'
            ]);
        }
    }
    function deleteHistory(Request $request){
        $history = History::deleteHistoryById($request->id);
        if ($history) {
            return response()->json([
                'status'=> 'success',
                'message'=> 'History berhasil dihapus'
            ]);
        }
    }
    
}
