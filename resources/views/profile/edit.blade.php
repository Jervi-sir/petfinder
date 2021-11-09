@extends('layouts.master')

@section('title')
<title>Profile</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/editProfile.css">
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
    <form action="">
        <div class="top">
            <div class="image">
                <label for="image">Choose image</label>
                <input hidden type="file" name="" id="image">
                <div class="img">
                    <img src="" alt="">
                </div>
            </div>
            <div class="input">
                <input type="text" placeholder="name">
                <input type="text" placeholder="Locatiom">
                <input type="text" placeholder="phone number">
            </div>
        </div>
        <button type="submit">save</button>
    </form>

    <a href="" class="reset">reset password</a>
    <a href="" class="delete">delete account</a>

</main>
@endsection