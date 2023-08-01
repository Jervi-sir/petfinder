@extends('layouts.master')

@section('title')
<title>Find Pet</title>
@endsection

@section('style-head')
@vite('resources/scss/home.scss')
@vite('resources/scss/card.scss')
@endsection

@section('header')
<x-_header />
@endsection

@section('script')
<script>

</script>
@endsection

@section('main')
<x-_selector :races='$races' />

<main>
    @php
        $title = 'New Pets'
    @endphp
    <x-_filter :title='$title' />
    <!-- pets -->
    <div class="results">
        @if ($count == 0)
        <h2>
           No offer currently
        </h2>
        @endif
        @foreach ($pets as $pet)
        <div class='card {{ $pet['race_name'] }}' class="card">
            <div class="card-top">
                @auth
                <div class="save">
                    <img src="../images/heart_empty.svg" alt="">
                </div>
                @endauth
                <a href='{{ route('pet.show', $pet['id'] ) }}' class="images">
                    <img src="{{ $pet['image_preview'] }}" alt="">
                </a>
                <div class="name">
                    <span>{{ $pet['name'] }}</span>
                </div>
            </div>
            <div class="details">
                <div class="breed">{{ $pet['race_name'] }}</div>
                <div class="gender {{ $pet['gender_name'] }}">{{ $pet['gender_name'] }}</div>
                <div class="location">
                    <img src="../images/location.svg" alt="">
                    <span>{{ $pet['wilaya_name'] }}</span>
                </div>
                <div class="age">{{ $pet['birthday'] }}</div>
                <div class="price">{{ $pet['offer_type_name'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</main>

@endsection
