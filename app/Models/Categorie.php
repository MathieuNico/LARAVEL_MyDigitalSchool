<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Categorie extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'parent_id',
        'user_id',
    ];

    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function flux()
    {
        return $this->hasMany(Flux::class, 'category_id');
    }

}
