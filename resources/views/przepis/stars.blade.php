@php
    $fullStars = 5;
    $halfStar = 0;
    $emptyStars = 5 - $fullStars - $halfStar;
    $editable = false;
@endphp
@if ($editable)
    @for($i = 1; $i <=5; $i++)
        <div class="col p-0 star-editable" id="star-{{$i}}">
            <i class="far fa-star fa-2x"></i>
        </div>
    @endfor
@else
    @if($fullStars != 0)
        @foreach (range(1, $fullStars) as $item)
            <div class="col p-0">
                <i class="fas fa-star fa-2x"></i>
            </div>
        @endforeach
    @endif

    @if($halfStar == 1)
        <div class="col p-0">
            <i class="fas fa-star-half-alt fa-2x"></i>
        </div>
    @endif

    @if($emptyStars != 0)
        @foreach (range(1, $emptyStars) as $item)
            <div class="col p-0">
                <i class="far fa-star fa-2x"></i>
            </div>
        @endforeach
    @endif
@endif