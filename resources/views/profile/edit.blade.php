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

    <button class="reset">reset password</button>
    <button class="delete" @click="showModal=true">delete account</button>

    <div class="modal" v-if="showModal">
        <div class="layer"  @click="showModal=false"></div>
        <div class="container">
            <h1> Are u sure u want to delete</h1>
            <p>Please type <span>{{$user->email}}</span>  to confirm.</p>
            <input type="text" v-model="confirmDelete" @keyup="verifyDelete">
            <form action="{{ route('pet.delete') }}" method="POST">
                @csrf
                <input type="text" name="id" value="{{ $user->email }}" hidden>
                <button type="button" @click="showModal=false">Cancel</button>
                <button type="submit" :disabled="!deleteBtn">Delete</button>
            </form>
        </div>
    </div>

</main>
@endsection

@section('script')
<script>
    var app = new Vue({
    el: '#app',
        data: {
            activesearch: false,
            imageUrl: '',
            confirmDelete: '',
            deleteBtn: false,
            showModal: false,
        },
        methods: {
            activeSearch: function () {
                this.activesearch = true;
            },
            setImage: function(event) {
                this.imageUrl = URL.createObjectURL(event.files[0]);
            },
            verifyDelete: function() {
                if(this.confirmDelete == this.pet.name) {
                    this.deleteBtn = true;
                } else {
                    this.deleteBtn = false;
                }
            },
        }
    })
</script>
@endsection
