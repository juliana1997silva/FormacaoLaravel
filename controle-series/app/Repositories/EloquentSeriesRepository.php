<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository{
    public function add(SeriesFormRequest $request): Series {
        return DB::transaction(function () use ($request) {
            $serie = Series::create($request->all());
            $seasons = [];
            $episodes = [];
            for ($i = 1; $i <= $request->seasonQtd; $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i
                ];
            }
            Season::insert($seasons);

            foreach ($serie->seasons as $season) {

                for ($j = 1; $j < $request->episodeQtd; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes);
            return $serie;
        });
    }
}