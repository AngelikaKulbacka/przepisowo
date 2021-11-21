<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\RecipeIngredient;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'skladniki';

    protected $fillable = [
        'skladnik',
    ];

    public function recipies()
    {
        return $this->hasManyThrough(Recipe::class, RecipeIngredient::class);
    }

    public function recipeIngredient() {
        return $this->hasMany(RecipeIngredient::class, 'id_skladnika');
    } 
}
