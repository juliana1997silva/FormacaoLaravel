<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;

class SeriesController extends Controller
{

   public function __construct(
      private SeriesRepository $seriesRepository
   ) {}

   public function index()
   {
      $series = Series::with('seasons.episodes')->get();
      return response()->json($series);
   }

   public function store(SeriesFormRequest $request)
   {
      $series = $this->seriesRepository->add($request);
      return response()->json($series, 201);
   }

   public function show(int $series)
   {
      $series = Series::with('seasons.episodes')->find($series);
      if(is_null($series)){
         return response()->json("Série não encontrada",404);
      }
      return response()->json($series);
   }

   public function update(Series $series, SeriesFormRequest $request){
      $series->update($request->all());
      return response()->json($series, 200);

   }
   public function destroy(Series $series){
      $series->delete();
      return response()->json("Série deletada com sucesso",203);
   }
}
