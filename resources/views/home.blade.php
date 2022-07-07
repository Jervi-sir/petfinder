@extends('layouts.master')

@section('title')
<title>Find Pet</title>
@endsection

@section('style-head')
@vite('resources/scss/home.scss')
@vite('resources/scss/card.scss')
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
            filterIsOpen: false,
            keyword: '',
        },
        methods: {

        },
    })
</script>
@endsection

@section('main')
@include('components._selector')

<main>
    <div class="top">
        <h5>New Pets</h5>
        <div class="open-filter" @click="filterIsOpen = !filterIsOpen">
            <img src="../images/filter.svg" alt="">
        </div>
    </div>
    @include('components._filter')

    <!-- pets -->
    <div class="results">
        @if ($count == 0)
        <h2>
           No offer currently
        </h2>
        @endif
        @foreach ($pets as $pet)
        <div class='card {{ $pet['race'] }}' class="card">
            <div class="card-top">
                <div class="save">
                    <img src="../images/heart_empty.svg" alt="">
                </div>
                <a href='{{ $pet['url'] }}' class="images">
                    <img src="{{ $pet['image'] }}" alt="">
                </a>
                <div class="name">
                    <span>{{ $pet['name'] }}</span>
                </div>
            </div>
            <div class="details">
                <div class="breed">{{ $pet['race'] }}</div>
                <div class="gender {{ $pet['gender'] }}">{{ $pet['gender'] }}</div>
                <div class="location">
                    <img src="../images/location.svg" alt="">
                    <span>{{ $pet['wilaya'] }}</span>
                </div>
                <div class="age">{{ $pet['age'] }}</div>
                <div class="price">{{ $pet['status'] }}</div>
            </div>
        </div>
        @endforeach

    </div>
</main>

@endsection
