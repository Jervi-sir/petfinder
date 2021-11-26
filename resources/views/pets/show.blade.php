@extends('layouts.master')

@section('title')
<title>Pet details</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/pet.css">
@endsection

@section('script-head')

@endsection

@section('script')
<script>
    var app = new Vue({
    el: '#app',
        data: {
            activesearch: false,
            result: [],

        },
        methods: {
            activeSearch: function () {
                this.activesearch = true;
            }
        },
        created() {
            var pets = {!! json_encode($pet) !!};
            this.result = pets;
        }
    })
</script>
@endsection

@section('main')
<main>
    <!-- pets -->
    <div class="image">
        <div class="back" onclick="window.history.back();">
            <img src="../images/back.svg" alt="">
        </div>
        <img class="pic" src="../images/cat.png" alt="">
    </div>
    <div class="details">
        <h2>@{{ result.name }}</h2>
        <h3>@{{ result.race }}</h3>
        <h4><img src="../images/location_empty.svg" alt=""> @{{ result.location }}</h4>
        <div class="bubbles">
            <span class="age">@{{ result.date_birth }}</span>
            <span class="gender">@{{ result.gender }}</span>
            <span class="weight">@{{ result.weight }}</span>
            <span class="color">@{{ result.color }}</span>
        </div>
        <div class="bio">
            @{{ result.description }}
        </div>
        <div class="contact">
            <img src="../images/phone.svg" alt="">
            <span>@{{ result.phone_number }}</span>
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
</main>
@endsection
