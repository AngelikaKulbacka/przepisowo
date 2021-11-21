@extends('layouts.main')

@section('title')
Przepis
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 m-0 p-0" style="max-height=500px;">
            <img src="{{ $recipe->getPhotoUrl() }}" alt="Zdjęcie przepisu" class="img-fluid">
        </div>
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="h3">{{ $recipe->nazwa }}</div>
                        </div>
                        <div class="row h4">
                            <div>
                                {{ $recipe->user->getPrintableName() }}
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <i class="fas fa-calendar-alt mr-2" style="color: #ff5757"></i> {{ $recipe->getPrintableDate() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        @if(Auth::user())
                            @if(false)
                                <button class="btn btn-primary my-1 removeFromFavourite likeOrNot"><i class="fas fa-heart"></i></button>                           
                            @else
                                <button class="btn btn-light my-1 addToFavourite likeOrNot"><i class="far fa-heart"></i></button>   
                            @endif
                        @endif
                    </div>
                    <div class="col-3">
                        <div class="row">
                            @include('przepis.stars', ['ocena' => 5])
                        </div>
                    </div>
                </div>
            </div>
            <div class="container row col my-3">
                <div>
                    {{ $recipe->opis_przygotowania }}
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="h3">Potrzebne składniki:</div>
        <ul>
            @foreach ($ingredients as $ingredient)
                <li>{{ $ingredient->skladnik }}</li>
            @endforeach
        </ul>
    </div>
    <div class="row mb-2">
        @foreach($recipe->steps as $step)
            <div class="row my-3">
                <div class="row h4">
                    Krok {{ $step->nr_kroku + 1 }}.
                </div>

                <div class="row">
                    {{ $step->opis }}
                </div>
            </div>
        @endforeach
    </div>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-md-6 col-12 mb-4">
                    @foreach ($comments as $comment)
                        <div class="mt-4 text-justify float-left p-3" style="background: #010A26">
                            <div class="row mb-3">
                                <div class="col-auto">
                                    <img src="{{ $comment->user->getPhotoUrl() }}" alt="" class="rounded-circle" width="40" height="40">
                                </div>
                                <div class="col h4">{{ $comment->user->getPrintableName() }}</div> 
                            </div>
                            <div>
                                {{ $comment->tresc }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

        
        });
    </script>
@stop
