<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(int $series)
    {
        $series = Series::find($series);
        return response()->json($series->episodes);
    }

    public function watched(int $episode, Request $request)
    {
        $episodes = Episode::find($episode);
        $episodes->watched = $request->watched;
        $episodes->save();
        return response()->json($episodes);
    }
}
