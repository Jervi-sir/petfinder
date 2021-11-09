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
    <!-- pets -->
    <div class="image">
        <div class="back">
            <img src="../images/back.svg" alt="">
        </div>
        <img class="pic" src="../images/cat.png" alt="">
    </div>
    <div class="details">
        <h2>pet name</h2>
        <h3>race</h3>
        <h4><img src="../images/location.svg" alt=""> location</h4>
        <div class="bubbles">
            <span class="age">2Years</span>
            <span class="gender">male</span>
            <span class="weight">2kg</span>
            <span class="color">black</span>
        </div>
        <div class="bio">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta autem provident nisi ipsa natus odit minus quos accusamus excepturi. Quod explicabo amet quam tenetur consequatur, suscipit nostrum architecto eius sit.
        </div>
        <div class="contact">
            <span>Owner number</span>
        </div>
        <div class="actions">
            <div class="like">
                <img src="../images/heart_empty.svg" alt="">
            </div>
            <div class="message">
                <button>Send message</button>
            </div>
        </div>
    </div>
</main>
@endsection