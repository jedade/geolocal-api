<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'description',
        'audio',
        'image',
        'users',
        'anonymes',
        'status',
        'longitude',
        'latitude',
        'commune_id',
        'arrondissement_id',
        'category_id'
    ];

    public function category()
    {
         return $this->hasMany('App\Models\Category');
    }
    public function commune()
    {
         return $this->hasMany('App\Models\Commune');
    }
    public function arrondissement()
    {
         return $this->hasMany('App\Models\Arrondissement');
    }
}
