@foreach ($przepisy as $przepis)
        <div class="recipe py-5 row @if(!$loop->last) not-last @endif" id="{{$przepis->id}}">
                <div class="col-md-4 recipe-image position-relative">
                    <img src="@if($przepis->photo) {{$przepis->photo->getUrl()}} @else {{App\Models\Photo::getDefaultRecipePhoto()}} @endif" alt="Zdjęcie przepisu" class="img-fluid">
                    <a href="{{route('recipe.details', ['recipe' => $przepis])}}" class="stretched-link recipe-link"></a>
                </div>
                <div class="col-md-6 position-relative">
                    <div class="row recipe-title h4 mx-1">
                        <div class="col">
                            {{ $przepis->nazwa }}
                        </div>
                        <div class="col-md-1">
                            @if($dzial == 'Moje')                       
                                @if($przepis->czy_prywatne)
                                <i class="fas fa-lock" style="color: #ff5757"></i>
                                @else
                                <i class="fas fa-book-open" style="color: #ff5757"></i>
                                @endif
                            @endif 
                        </div>
                    </div>
                    <div class="row recipe-author mb-3 h6 mx-1">
                        <div class="col">
                            {{ $przepis->user->imie }} {{ $przepis->user->nazwisko }}
                        </div>
                    </div>
                    <div class="row recipe-description mx-1">
                        <div class="col">
                            {{ $przepis->opis_przygotowania }}
                        </div>
                    </div>
                    <a href="{{route('recipe.details', ['recipe' => $przepis])}}" class="stretched-link recipe-link"></a>
                </div>
            <div class="col-md-2 mb-3">
                <div class="row">
                    @include('przepis.stars', ['ocena' => 5])
                </div>
                @if($dzial == 'Moje' && true)
                <div class="row my-3">
                    <div class="col p-0">
                        <form method="POST" action="{{route('recipe.delete', ['recipe' => $przepis])}}">
                            @csrf
                            <a href="{{route('recipe.edit', ['recipe' => $przepis])}}" class="btn btn-outline-light m-2"><i class="fas fa-pencil-alt"></i></a>
                            <button type="submit" class="btn btn-outline-danger m-2"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
                <div class="row my-3">
                
                </div>
                @endif
            </div>
        </div>
    @endforeach
