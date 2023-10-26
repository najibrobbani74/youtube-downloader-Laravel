<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(title="YoutubeDownloader", version="0.1")
 * @OA\PathItem(path="/")
 * @OA\Get(
 *   path="/video",
 *   @OA\Response(
 *   response=200,
 *   description="ok"
 * )
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
