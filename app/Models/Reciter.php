<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Reciter extends Model
{

    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'pathname',
    ];


    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
