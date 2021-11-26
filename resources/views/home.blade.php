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
            results: [],
        },
        methods: {
            activeSearch: function() {
                this.activesearch = true;
            }
        },
        created() {
            var pets = {!! json_encode($pets) !!};
            this.results = pets;
        }
    })
</script>
@endsection

@section('main')
@include('components.selector')

<main>
    <div class="top">
        <h5>New Pets</h5>
        <div class="filter">...</div>
    </div>
    <!-- pets -->
    <div class="results">

        <div :class='result.race' class="card" v-for="(result, index) in results">
            <div class="card-top">
                <div class="save">
                    <img src="../images/heart_empty.svg" alt="">
                </div>
                <a :href='result.url' class="images">
                    <img src="../images/cat.png" alt="">
                </a>
                <div class="name">
                    <span>@{{ result.name }}</span>
                </div>
            </div>
            <div class="details">
                <div class="breed">@{{ result.race }}</div>
                <div class="gender" :class="result.gender">@{{ result.gender }}</div>
                <div class="location">
                    <img src="../images/location.svg" alt="">
                    <span>@{{ result.wilaya }}</span>
                </div>
                <div class="age">20 years</div>
                <div class="price">@{{ result.status }}</div>
            </div>
        </div>
    </div>
</main>

@endsection
