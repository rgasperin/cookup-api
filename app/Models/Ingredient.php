<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ingredients';
    
    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'date'
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
