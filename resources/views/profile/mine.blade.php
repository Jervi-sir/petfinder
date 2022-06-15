@extends('layouts.master')

@section('title')
<title>My Profile</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/profile.css">
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
            pets: [],
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
    <h3>my profile</h3>
    <div class="profile-card">
        <div class="details">
            <div class="left">
                <span>{{ $user['name'] }}</span>
                <span>{{ $user['email'] }}</span>
                <span>{{ $user['phone_number'] }}</span>
            </div>
            <div class="right">
                <img src="{{ $user['image'] }}" alt="">
            </div>
        </div>
        <div class="edit">
            <a href="{{ route('profile.edit') }}">edit</a>
        </div>
    </div>
    <div></div>

    <div class="head-posts">
        <h3>my pets</h3>
        <span> {{ $count }} / 7 <small>pets</small></span>
    </div>
    <div class="posts">
        @if($count)
        @foreach ($pets as $pet)
        <a class="card" href='{{ $pet['url'] }}'>
            <div class="left">
                <img src="{{ $pet['image'] }}" alt="">
            </div>
            <div class="middle">
                <h4>{{ $pet['name'] }}</h4>
                <h6>{{ $pet['race'] }}, {{ $pet['subRace'] }}</h6>
                <h6>{{ $pet['race'] }}</h6>
                <h5>{{ $pet['status'] }}</h5>
            </div>
            <div class="right">
                <span class="gender {{ $pet['gender'] }}" >{{ $pet['gender'] }}</span>
                <span class="age">{{ $pet['age'] }}</span>
            </div>
        </a>
        @endforeach
        @endif
        <div class="add-pets">
            @if($count > 7)
            <a href="#" disabled>add pets</a>
            @else
            <a href="{{ route('pet.create') }}">add pets</a>
            @endif
        </div>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="action">
                    <button type="submit">Logout</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
