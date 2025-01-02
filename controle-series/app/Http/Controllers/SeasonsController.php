<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;

class SeasonsController extends Controller
{
    public function index(int $serie)
    {
        $series = Series::find($serie);

        $seasons = Season::query()
        ->with('episodes')
        ->where('series_id', $serie)
        ->get();
        return view('seasons.index')
            ->with('seasons', $seasons)->with('series', $series);
    }
}
