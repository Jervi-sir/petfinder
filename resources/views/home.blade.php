@extends('layouts.master')

@section('title')
<title>Find Pet</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/home.css">
@endsection

@section('header')
@include('components._headerJson')
@endsection

@section('script')
<script>
    var app = new Vue({
        el: '#app',
        data: {
            activesearch: false,
        },
        methods: {
            activeSearch: function() {
                this.activesearch = true;
            },
        },
    })
</script>
@endsection

@section('main')
@include('components._selector')

<main>
    <div class="top">
        <h5>New Pets</h5>
        <div class="filter">...</div>
    </div>
    <!-- pets -->
    <div class="results">
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
                <div class="gender" class="gender.{{ $pet['gender'] }}">{{ $pet['gender'] }}</div>
                <div class="location">
                    <img src="../images/location.svg" alt="">
                    <span>{{ $pet['wilaya'] }}</span>
                </div>
                <div class="age">20 years</div>
                <div class="price">{{ $pet['status'] }}</div>
            </div>
        </div>
        @endforeach

    </div>
</main>

@endsection
