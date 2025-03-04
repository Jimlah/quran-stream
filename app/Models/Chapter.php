<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasUuids;


    protected $fillable = [
        'reciter_id',
        'title',
        'slug',
        'pathname',
    ];


    public function reciter()
    {
        return $this->belongsTo(Reciter::class);
    }
}
