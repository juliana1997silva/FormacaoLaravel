<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Series extends Model
{
    use HasFactory;

    //protected $with = ['temporadas'];

    protected $fillable = [
        'nome',
        'cover'
    ];
    protected $appends = ['links'] ;

    public function seasons() 
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    public static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome', 'asc');
        });

        // Event for deleting cover image
        static::deleting(function (Series $series) {
            if ($series->cover) {
                $path = 'public/' . $series->cover;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
            }
        });
    }

    public function links() : Attribute{
        return new Attribute(
            get: fn () => [
                [
                    'rel' => 'self',
                    'url' => "/api/series/{$this->id}"
                ],
                [
                    'rel' => 'seasons',
                    'url' => "/api/series/{$this->id}/seasons"
                ],
                [
                    'rel' => 'episodes',
                    'url' => "/api/series/{$this->id}/episodes"
                ],
            ],
        );
    }

}
