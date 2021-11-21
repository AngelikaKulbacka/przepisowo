<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class UserIsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->url();
        $exploded = explode('/', $url);
        $recipeId = end($exploded);
        $recipe = Recipe::findOrFail($recipeId);
        if (! Auth::user()->is($recipe->user)) {
            abort(404);
        }
        return $next($request);
    }
}
