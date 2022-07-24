@extends('layouts.master')

@section('title')
<title>Profile</title>
@endsection

@section('style-head')
@vite('resources/scss/editProfile.scss')
@endsection

@section('header')
@include('components._header')
@endsection

@section('main')
<main x-data="app">
    <h3>my profile</h3>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="top">
            <div class="image">
                <label for="image">Choose image</label>
                <input name="image" hidden type="file" accept="image/png, image/jpeg" id="image" @change='setImage($event.target)'>
                <div class="img">
                    <img id="preview" src="{{ $user['image'] }}" alt="">
                </div>
            </div>
            <div class="input">
                <input name="name" type="text" placeholder="name" value="{{ $user['name'] }}">
                <input name="phone" type="text" minlength="5" maxlength="10" placeholder="phone number" value="{{ $user['phone_number'] }}" @keypress="validateNumber">
            </div>
        </div>
        <div id="output"></div>
        <button type="submit">save</button>
    </form>

    <button class="reset">reset password</button>
    <button class="delete" @click="showModal=true">delete account</button>

    <div class="modal" x-show="showModal">
        <div class="layer"  @click="showModal=false"></div>
        <div class="container">
            <h1> Are u sure u want to delete</h1>
            <p>Please type <span>{{ $user['email'] }}</span>  to confirm.</p>
            <input type="text" x-model="confirmDelete"  >
            <form action="{{ route('pet.delete') }}" method="POST">
                @csrf
                <input type="text" name="id" value="{{ $user['email'] }}" x-model="email" hidden>
                <button type="button" @click="showModal=false">Cancel</button>
                <button type="submit" :disabled="confirmDelete != email">Delete</button>
            </form>
        </div>
    </div>

</main>
@endsection

@section('script')
<script>
    var email = {!! json_encode($user['email']) !!};
    console.log(email);

    function app() {
        return {
            imageUrl: '',
            confirmDelete: '',
            deleteBtn: false,
            showModal: false,
            email: email,

            setImage(event) {
                document.getElementById('preview').src = URL.createObjectURL(event.files[0]);
                this.comporessImage(event.files[0]);
            },
            validateNumber(event) {
                let keyCode = event.keyCode;
                if (keyCode < 46 || keyCode > 57) {
                    event.preventDefault();
                }
            },
            comporessImage(file) {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function (event) {
                    const imgElement = document.createElement("img");
                    imgElement.src = event.target.result;
                    imgElement.onload = function (e) {
                        const canvas = document.createElement("canvas");
                        const MAX_WIDTH = 200;
                        const scaleSize = MAX_WIDTH / e.target.width;
                        canvas.width = MAX_WIDTH;
                        canvas.height = e.target.height * scaleSize;
                        const ctx = canvas.getContext("2d");
                        ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);
                        // you can send srcEncoded to the server
                        const srcEncoded = ctx.canvas.toDataURL("image/png", 0.9);
                        //push into HTML
                        const output = document.querySelector("#output");
                        const imageOutput = document.createElement('input');
                        imageOutput.name = "imageCompressed";
                        imageOutput.type = "text";
                        imageOutput.hidden = true;
                        imageOutput.value = srcEncoded;
                        console.log(srcEncoded);
                        output.appendChild(imageOutput);
                    };
                };
            }
        }
    }
</script>
@endsection
