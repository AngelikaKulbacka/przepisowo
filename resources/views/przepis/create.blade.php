@extends('layouts.main')

@section('title')
    Nowy przepis
@stop

@section('content')
    <div class="container">
        <form enctype="multipart/form-data" action="{{ route('przepis.add') }}" method="POST">
            @csrf
            <div class="row">
                <div class="">
                    <a href="{{url()->previous()}}" class="float-end btn btn-secondary">Anuluj</a>
                    <button type="submit" class="mx-2 float-end btn btn-primary">Dodaj</button>
                </div>
            </div>


            <div class="form-group">
                <label for="is_private">Czy przepis jest prywatny?</label>
                <input @if (old('is_private')) checked @endif type="checkbox" name="is_private" id="is_private" value="1">
            </div>
            <div class="row">
                <div class="form-group my-2">
                    <label for="recipePhoto">Zdjęcie przepisu</label>
                    <div>
                        <input value="{{ old('recipePhoto') }}" type="file"class="form-control-file" name="recipePhoto">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group my-2">
                        <label for="recipeName">Nazwa przepisu</label>
                        <input value="{{ old('recipeName') }}" type="text" class="form-control @if($errors->any()) @if($errors->has('recipeName')) is-invalid @else is-valid @endif @endif" name="recipeName">
                        <div class="invalid-feedback">
                            {{ $errors->first('recipeName') }}
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="shortDescription">Krótki opis</label>
                        <textarea class="form-control @if($errors->any()) @if($errors->has('shortDescription')) is-invalid @else is-valid @endif @endif" name="shortDescription" style="resize: none;" rows="4">{{ old('recipeName') }}</textarea>
                        <div class="invalid-feedback">
                            {{ $errors->first('shortDescription') }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label for="ingredient">Dodaj składniki</label>
                    @forelse (old('ingredient') ?? [] as $i => $ingredient)
                        <div class="form-group my-2">
                            <div class="input-group">
                                <span class="input-group-text"><span id="number">{{ $i+1 }}</span>.</span>
                                <input value="{{ $ingredient }}" type="text" class="form-control @if($errors->any()) @if($errors->has('ingredient.' . $i)) is-invalid @else is-valid @endif @endif" name="ingredient[]">
                                <div class="invalid-feedback">
                                    {{ $errors->first('ingredient.' . $i) }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="form-group my-2">
                            <div class="input-group">
                                <span class="input-group-text"><span id="number">1</span>.</span>
                                <input type="text" class="form-control @if($errors->any()) @if($errors->has('ingredient.0')) is-invalid @else is-valid @endif @endif" name="ingredient[]">
                                <div class="invalid-feedback">
                                    {{ $errors->first('ingredient.0') }}
                                </div>
                            </div>
                        </div>
                    @endforelse

                    <div class="form-group my-2 d-none" id="ingredientClone">
                        <div class="input-group">
                            <span class="input-group-text"><span id="number"></span>.</span>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    
                    <div style="text-align: right"> 
                        <a class="btn btn-primary px-3 py-2" id="addIngredient"><i class="fas fa-plus"></i></a>
                        <a class="btn btn-secondary px-3 py-2" id="removeIngredient"><i class="fas fa-minus"></i></a> 
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group my-2">
                        <label for="steps">Kroki przygotowania</label>
                        <textarea class="form-control @if($errors->any()) @if($errors->has('steps.0')) is-invalid @else is-valid @endif @endif" name="steps[]" style="resize: none;" rows="4">{{ old('steps.0') }}</textarea>
                        <div class="invalid-feedback">
                            {{ $errors->first('steps.0') }}
                        </div>
                    </div>
                </div>
            </div> 
            @foreach (array_slice(old('steps') ?? [], 1) as $i=>$step)
                <div class="row">
                    <div class="col">
                        <div class="form-group my-2">
                            <textarea class="form-control @if($errors->any()) @if($errors->has('steps.' . $i + 1)) is-invalid @else is-valid @endif @endif" name="steps[]" style="resize: none;" rows="4">{{ $step }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('steps.' . $i + 1) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row stepClone" style="display:none">
                <div class="col">
                    <div class="form-group my-2">
                        <textarea class="form-control" style="resize: none;" rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col" style="text-align: right">
                    <a class="btn btn-primary px-3 py-2" id="addStep"><i class="fas fa-plus"></i></a>
                    <a class="btn btn-secondary px-3 py-2" id="removeStep"><i class="fas fa-minus"></i></a>
                </div>
            </div>
        </form>
    </div>
@stop
