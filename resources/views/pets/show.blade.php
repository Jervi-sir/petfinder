@extends('layouts.master')

@section('title')
<title>Pet details</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/pet.css">
@endsection

@section('header')
@include('components._header')
@endsection


@section('script')
<script>
    var app = new Vue({
    el: '#app',
        data: {
            activesearch: false,
        },
        methods: {
            activeSearch: function () {
                this.activesearch = true;
            }
        },

    })
</script>
@endsection

@section('main')
<main>
    <!-- pets -->
    <div class="pet-container">
        <div class="image">
            <div class="back" onclick="window.history.back();">
                <img src="../images/back.svg" alt="">
            </div>
            <div class="carousel">
                <div class="carousel-inner">
                    @foreach ($pet['images'] as $image)
                    <input class="carousel-open" type="radio" id="carousel-{{ $loop->index + 1 }}" name="carousel" aria-hidden="true" hidden=""
                    @if ($loop->index == 0)
                    checked="checked"
                    @endif
                    >
                    <div class="carousel-item">
                        <img src="{{ $image }}">
                    </div>
                    @endforeach

                    <label for="carousel-4" class=" prev control-1"></label>
                    <label for="carousel-3" class=" prev control-4"></label>
                    <label for="carousel-2" class=" next control-1"></label>
                    <label for="carousel-1" class=" prev control-2"></label>

                    <label for="carousel-4" class=" prev control-1"></label>
                    <label for="carousel-3" class=" next control-2"></label>
                    <label for="carousel-2" class=" prev control-3"></label>
                    <label for="carousel-1" class=" next control-3"></label>

                    <ol class="carousel-indicators">
                        @foreach ($pet['images'] as $image)
                        <li>
                            <label for="carousel-{{ $loop->index + 1 }}" class="carousel-bullet"></label>
                        </li>
                        @endforeach
                    </ol>

                </div>
            </div>
        </div>
        <div class="details">
            <h2>{{ $pet['name'] }}</h2>
            <h3>{{ $pet['race'] }}</h3>
            <h4><img src="../images/location_empty.svg" alt=""> {{ $pet['wilaya'] }}</h4>
            <div class="bubbles">
                <span class="age">{{ $pet['date_birth'] }}</span>
                <span class="gender">{{ $pet['gender'] }}</span>
                <span class="weight">{{ $pet['weight'] }}</span>
                <span class="color">{{ $pet['color'] }}</span>
            </div>
            <div class="bio">
                {{ $pet['description'] }}
            </div>
            <div class="contact">
                <img src="../images/phone.svg" alt="">
                @foreach ($pet['phone_number'] as $phone_number)
                <span >
                    {{ $phone_number }}
                </span>
                @endforeach
            </div>
            <div class="actions">
                <div class="like">
                    <img src="../images/heart_empty.svg" alt="">
                </div>
                <div class="message">
                    <button><img src="../images/phone.svg" alt=""></button>
                    <button>Send message</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
