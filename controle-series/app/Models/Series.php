<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

}
