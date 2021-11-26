@extends('layouts.master')

@section('title')
<title>Profile</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/editProfile.css">
@endsection

@section('script-head')

@endsection


@section('main')
<main>
    <h3>my profile</h3>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="top">
            <div class="image">
                <label for="image">Choose image</label>
                <input name="image" hidden type="file" accept="image/png, image/jpeg" id="image" @change='setImage($event.target)'>
                <div class="img">
                    @if($user->image== NULL)
                    <img :src='imageUrl'  alt="">
                    @else
                    <img src="{{ $user->image }}" :src='imageUrl' alt="">
                    @endif
                </div>
            </div>
            <div class="input">
                <input name="name" type="text" placeholder="name" value="{{ $user->name }}">
                <input name="phone" type="text" placeholder="phone number" value="{{ $user->phone_number }}">
            </div>
        </div>
        <button type="submit">save</button>
    </form>

    <a href="" class="reset">reset password</a>
    <a href="" class="delete">delete account</a>

</main>
@endsection

@section('script')
<script>
    var app = new Vue({
    el: '#app',
        data: {
            activesearch: false,
            imageUrl: '',
        },
        methods: {
            activeSearch: function () {
                this.activesearch = true;
            },
            setImage: function(event) {
                this.imageUrl = URL.createObjectURL(event.files[0]);
            }
        }
    })
</script>
@endsection
