<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
@extends('layouts.main')

@section('title')
Moje
@stop

@section('content')
<div class="container" style="width: 100%; height: fit-content;">
    <div class="row title">
        <h2>Moje przepisy</h2>
    </div>
    <div class="row my-3">
        <div class="col">
            <a href="{{route('przepis.create')}}" class="btn btn-primary">Dodaj przepis <i class="fas fa-plus mx-2"></i></a>
        </div>
    </div>
    @include('przepis.lista', ['dzial' => 'Moje', 'przepisy' => $przepisy])
</div>
@stop
