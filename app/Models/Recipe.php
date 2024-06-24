<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'recipes';
    
    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'type_id',
        'ingredients_default',
        'mode_preparation',
    ];

    public function types()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
    
}
