<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;

class SeasonsController extends Controller
{
        public function index(int $series){
            $series = Series::find($series);
            return response()->json($series->seasons);
        }

}