@extends('layouts.master')

@section('title')
<title>Profile</title>
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
        },
        methods: {
            activeSearch: function () {
                this.activesearch = true;
            }
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
                <span>Namename</span>
                <span>email</span>
                <span>phone number</span>
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
        <div class="card">
            <div class="left">
                <img src="" alt="">
            </div>
            <div class="middle">
                <h4>Grig</h4>
                <h6>Breed</h6>
                <h6>Descrtiption</h6>
                <h5>Price</h5>
            </div>
            <div class="right">
                <span class="gender female">Female</span>
                <span class="age">20 years</span>
            </div>
        </div>
        <div class="card">
            <div class="left">
                <img src="" alt="">
            </div>
            <div class="middle">
                <h4>Grig</h4>
                <h6>Breed</h6>
                <h6>Descrtiption</h6>
                <h5>Price</h5>
            </div>
            <div class="right">
                <span class="gender female">Female</span>
                <span class="age">20 years</span>
            </div>
        </div>
    </div>

</main>
@endsection