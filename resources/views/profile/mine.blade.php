@extends('layouts.master')

@section('title')
<title>my Profile</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/profile.css">
@endsection

@section('script-head')
    
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
        created() {
            var pets = {!! json_encode($pets) !!};
            this.pets = pets;
        }
    })
</script>
@endsection

@section('main')
<main>
    <h3>my profile</h3>
    <div class="profile-card">
        <div class="details">
            <div class="left">
                <span>{{ $user->name }}</span>
                <span>{{ $user->email }}</span>
                <span>{{ $user->phone_number }}</span>
            </div>
            <div class="right">
                <img src="" alt="">
            </div>
        </div>
        <div class="edit">
            <a href="{{ route('profile.edit') }}">edit</a>
        </div>
    </div>
    <div></div>
    <h3>my pets</h3>
    <div class="posts">
        <div class="card"  v-for="(pet, index) in pets">
            <div class="left">
                <img src="" alt="">
            </div>
            <div class="middle">
                <h4>@{{ pet.name }}</h4>
                <h6>@{{ pet.race }}, @{{ pet.subRace }}</h6>
                <h6>@{{ pet.race }}</h6>
                <h5>@{{ pet.status }}</h5>
            </div>
            <div class="right">
                <span class="gender" :class="pet.gender">@{{ pet.gender }}</span>
                <span class="age">20 years</span>
            </div>
        </div>
        
    </div>

</main>
@endsection