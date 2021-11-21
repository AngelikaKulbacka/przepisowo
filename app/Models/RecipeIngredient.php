<?php

namespace App\Models;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    use HasFactory;

    protected $table = 'przepis_skladnik';


    protected $fillable = [
        'id_przepisu',
        'id_skladnika',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'id_przepisu');
    }


    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'id_skladnika');
    }
}
