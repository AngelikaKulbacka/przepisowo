<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use App\Models\Shared;
use App\Models\User;

class RecipeController extends Controller
{
    public function index(Recipe $recipe) {
        return view('przepis.index', [
            'recipe' => $recipe,
            'ingredients' => $recipe->ingredients()->orderBy('skladnik')->get(),
            'comments' => [],
        ]);
    }

    public function add(Request $request) {
        $data = $request->validate([
            'recipePhoto' => 'nullable|mimes:jpg,png,jpeg',
            'recipeName' => 'required',
            'ingredient.*' => 'required',
            'shortDescription' => 'required',
            'steps.*' => 'required',
            'is_private' => 'boolean',
        ]);

        if (!array_key_exists('is_private', $data)) {
            $data['is_private'] = false;
        }

        $recipe = new Recipe([
            'nazwa' => $data['recipeName'],
            'opis_przygotowania' => $data['shortDescription'],
            'id_uzytkownika' => Auth::id(),
            'czy_prywatne' => $data['is_private']
        ]);

        $recipe->setPhoto($request->file('recipePhoto'));

        $recipe->save();

        $recipe->addIngredients($data['ingredient']);
        $recipe->addSteps($data['steps']);

        return redirect()->route('recipe.details', ['recipe' => $recipe->id]);
    }

    public function create() {
        return view('przepis.create');
    }

    public function edit(Recipe $recipe) {
        return view('przepis.edit', [
            'recipe' => $recipe,
        ]);
    }

    public function update(Request $request, Recipe $recipe) {
        $data = $request->validate([
            'recipePhoto' => 'nullable',
            'recipeName' => 'required',
            'ingredient.*' => 'required',
            'shortDescription' => 'required',
            'steps.*' => 'required',
            'is_private' => 'boolean',
        ]);

        if (!array_key_exists('is_private', $data)) {
            $data['is_private'] = false;
        }

        $recipe = $recipe->fill([
            'nazwa' => $data['recipeName'],
            'opis_przygotowania' => $data['shortDescription'],
            'czy_prywatne' => $data['is_private']
        ]);
        if($request->file('recipePhoto')) {
            $recipe->setPhoto($request->file('recipePhoto'));
        }
        
        $recipe->save();

        $recipe->updateIngredients($data['ingredient']);
        $recipe->updateSteps($data['steps']);

        return redirect()->route('recipe.details', ['recipe' => $recipe->id]);
    }

    public function delete(Request $request, Recipe $recipe) {
        $recipe->deleteRecipe();
        return redirect()->route('przepis.moje');
    }
}
