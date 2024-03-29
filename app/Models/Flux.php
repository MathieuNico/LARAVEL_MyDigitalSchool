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

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }
}