@extends('layouts.main')

@section('title')
Veryfikacja
@stop

@section('content')
<div class="container">
    Link veryfikacyjny został wysłany! Sprawdź swoją skrzynkę pocztową
    <br><br>
    <form method="POST" action="{{route('verification.send')}}">
        @csrf
        <button type="submit" class="btn btn-primary">Wyślij link ponownie</button>
    </form>
</div>
@stop