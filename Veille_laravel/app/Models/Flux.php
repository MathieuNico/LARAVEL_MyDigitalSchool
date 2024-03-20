<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Flux extends Model
{
    use HasFactory;
    
    protected $table = 'flux_rss';

    protected $fillable = [
        'name',
        'category_id',
    ];

    public function rss()
    {
        return $this->hasMany(Flux::class, 'category_id');
    }
}