@extends('layouts.master')

@section('title')
<title>Find Pet</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/home.css">
@endsection

@section('script-head')
    
@endsection

@section('script')
<script>
    var app = new Vue({
        el: '#app',
        data: {
            activesearch: false,
            result: [{
                id: '1',
                image: '',
                name: '',
                breed: '',
                gender: '',
                location: '',
                price: '',
                link: '',
            }, ]
        },
        methods: {
            activeSearch: function() {
                this.activesearch = true;
            }
        }
    })
</script>
@endsection

@section('main')
<main>
    <div class="top">
        <h5>New Pets</h5>
        <div class="filter">...</div>
    </div>
    <!-- pets -->
    <div class="card dog">
        <div class="card-top">
            <div class="save">
                <img src="../images/heart_empty.svg" alt="">
            </div>
            <div class="images">
                <img src="../images/dog.png" alt="">
            </div>
            <div class="name">
                <span>foxy</span>
            </div>
        </div>
        <div class="details">
            <div class="breed">Breed</div>
            <div class="gender male">male</div>
            <div class="location">
                <img src="../images/location.svg" alt="">
                <span>Location location</span>
            </div>
            <div class="age">20 years</div>
            <div class="price">adoption</div>
        </div>
    </div>
    <div class="card cat">
        <div class="card-top">
            <div class="save">
                <img src="../images/heart_fill.svg" alt="">
            </div>
            <div class="images">
                <img src="../images/cat.png" alt="">
            </div>
            <div class="name">
                <span>Loxy</span>
            </div>
        </div>
        <div class="details">
            <div class="breed">Breed</div>
            <div class="gender male">male</div>
            <div class="location">
                <img src="../images/location.svg" alt="">
                <span>Location location</span>
            </div>
            <div class="age">20 years</div>
            <div class="price">adoption</div>
        </div>
    </div>
    <div class="card dog">
        <div class="card-top">
            <div class="save">
                <img src="../images/heart_empty.svg" alt="">
            </div>
            <div class="images">
                <img src="../images/dog.png" alt="">
            </div>
            <div class="name">
                <span>foxy</span>
            </div>
        </div>
        <div class="details">
            <div class="breed">Breed</div>
            <div class="gender male">male</div>
            <div class="location">
                <img src="../images/location.svg" alt="">
                <span>Location location</span>
            </div>
            <div class="age">20 years</div>
            <div class="price">adoption</div>
        </div>
    </div>
</main>
@endsection