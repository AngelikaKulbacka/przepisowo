<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;
use App\Models\RecipeIngredient;
use App\Models\Step;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Shared;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'przepisy';
    protected $fillable = [
        'nazwa',
        'opis_przygotowania',
        'id_uzytkownika',
        'czy_prywatne',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_uzytkownika');
    }


    public function steps()
    {
        return $this->hasMany(Step::class, 'id_przepisu');
    }

    public function recipeIngredient()
    {
        return $this->hasMany(RecipeIngredient::class, 'id_przepisu');
    }

    public function photo()
    {
        return $this->hasOne(Photo::class, 'id', 'id_zdjecia');
    }

    public function ingredients()
    {
        return $this->hasManyThrough(Ingredient::class, RecipeIngredient::class, "id_przepisu", "id", "id", "id_skladnika");
    }

    public function addIngredientByName(string $ingredientName) {
        $ingredient = Ingredient::where('skladnik', mb_strtolower($ingredientName))->first();
        if(is_null($ingredient)) {
            $ingredient = new Ingredient(['skladnik' => mb_strtolower($ingredientName)]);
            $ingredient->save();
        }

        $recipeIngredient = new RecipeIngredient([
            'id_przepisu' => $this->id,
            'id_skladnika' => $ingredient->id
        ]);

        $recipeIngredient->save();
    }

    public function addIngredients(array $ingredients) {
        foreach($ingredients as $ingredient) {
            $this->addIngredientByName($ingredient);
        }
    }

    public function addStep(int $nb, string $desription) {
        $step = new Step([
            'opis' => $desription,
            'nr_kroku' => $nb,
            'id_przepisu' => $this->id,
        ]);

        $step->save();
    }

    public function addSteps(array $steps) {
        foreach ($steps as $i => $step) {
            $this->addStep($i, $step);
        }
    }

    public function getPhotoUrl() {
        return $this->photo?->getUrl() ?? Photo::getDefaultRecipePhoto();
    }

    public function setPhoto(UploadedFile|null $file) {
        if($file) {
            $photo = Photo::createPhoto($file);
            $this->id_zdjecia = $photo->id;
        } else {
            $photo = $this->photo;
            $this->id_zdjecia = null;
            $photo?->delete();
        }
    }

    public function removeIngredient(string $ingredient) {
        $ingredient = $this->ingredients()->where('skladnik', mb_strtolower($ingredient))->first();

        $recipeIngredient = $ingredient->recipeIngredient()->where('id_przepisu', $this->id)->first();
        $recipeIngredient->delete();

        $recipeIngredientsExists = $ingredient->recipeIngredient()->exists();
        if (! $recipeIngredientsExists) {
            $ingredient->delete();
        }
    }

    public function updateIngredients(array $newIngredients) {
        $existingIngredients = $this->ingredients;

        $removedIngredients = $existingIngredients->whereNotIn('skladnik', $newIngredients);
        foreach ($removedIngredients as $ingredient) {
            $this->removeIngredient($ingredient->skladnik);
        }

        foreach($newIngredients as $ingredient) {
            if (! $existingIngredients->contains(fn($ingred) => $ingred->skladnik == $ingredient)) {
                $this->addIngredientByName($ingredient);
            }
        }
    }

    public function updateSteps(array $newSteps) {
        $steps = $this->steps;
        foreach($steps as $step) {
            $step->delete();
        }

        $this->addSteps($newSteps);
    }

    public function getPrintableDate() {
        return $this->created_at->format('d.m.Y');
    }

    public function deleteRecipe() {
        $this->steps->each->delete();
        $this->recipeIngredient->each->delete();
        Recipe::destroy($this->id);
    }
}
