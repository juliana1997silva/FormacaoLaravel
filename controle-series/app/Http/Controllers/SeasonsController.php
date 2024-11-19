<?php

namespace App\Http\Controllers;

use App\Models\Season;

class SeasonsController extends Controller
{
    public function index(int $serie)
    {

        $seasons = Season::query()
        ->with('episodes')
        ->where('series_id', $serie)
        ->get();
        return view('seasons.index')
            ->with('seasons', $seasons);
    }
}
