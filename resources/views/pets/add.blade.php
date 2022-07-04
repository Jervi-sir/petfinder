@extends('layouts.master')

@section('title')
<title>add Pet</title>
@endsection

@section('style-head')
@vite('resources/scss/add.scss')
@endsection

@section('header')
@include('components._header')
@endsection


@section('main')
<main>
    <!-- pets -->
    <form class="form" action="{{ route('pet.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="image">
            <div class="show"  v-for="(image, index) in images">
                <img :src='image' alt="">
            </div>
            <label class="add-img" for="add-image"><span>+</span></label>
            <input hidden name="images[]" type="file" id="add-image"  accept="image/png, image/jpeg"  multiple @change='addImage($event.target)'>
        </div>

        <div class="row">
            <label for="">name</label>
            <input name="name" type="text">
        </div>
        <div class="row double">
            <div class="sub">
                <label for="">race</label>
                <select name="race" id="">
                    @foreach ($races as $race)
                    <option value="{{ $race->id }}">{{ $race->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sub">
                <label for="">sub</label>
                <select name="sub" id="">
                    @foreach ($subRaces as $subRace)
                    <option value="{{ $subRace->id }}">{{ $subRace->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <label for="">gender</label>
            <select name="gender" id="">
                <option value="male">male</option>
                <option value="female">female</option>
                <option value="non">I dont know</option>
            </select>
        </div>
        <div class="row ">
            <label for="">location</label>
            <div class="double">

                <div class="sub">
                    <input id="location" name="location" type="text" placeholder="....">
                </div>
                <div class="sub">
                    <select name="wilaya" id="">
                        <option value="" selected disabled hidden>wailaya</option>
                        @foreach ($wilayas as $wilaya)
                        <option value="{{ $wilaya->id }}">{{ $wilaya->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="">birthday</label>
            <div class="double">

                <div class="sub">
                    <input id="birthday" name="birthday" type="date"  min="1900/01/01"  v-model="birthdate" @change='setAge()' placeholder="birthday">
                </div>
                <div class="sub">
                    <span class="age">age: @{{ age }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="">color</label>
            <select name="color" id="">
                @foreach ($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <label for="">weight</label>
            <input name="weight" type="text" @keypress="validateNumber">
        </div>
        <div class="row">
            <label for="">status</label>
            <select name="status" id="" v-model="statusValue">
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <label for="">price</label>
            <input name="price" type="text" :disabled="statusValue == 2" @keypress="validateNumber">
        </div>

        <div class="row">
            <label for="">description</label>
            <textarea name="description" id="" cols="30" rows="10" maxlength="300" v-model="description"></textarea>
            <span class="count">@{{ description.length }} / 300</span>
        </div>
        <div class="row">
            <label for="">phone number</label>
            <input name="phone" class="phone" type="text" value="" placeholder="" @keypress="validateNumber" required>
        </div>
        <div id="output"></div>
        <div class="actions">
            <button class="publish" type="submit">publish</button>
            <button class="preview" type="button">preview</button>
        </div>
    </form>

</main>
@endsection

@section('script')
<script>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    document.getElementById('birthday').max = today;

    var app = new Vue({

    el: '#app',
        data: {
            activeSearch: false,
            images: [],
            compressed: [],
            description: '',
            birthdate: '',
            age: '',
            status: 'adoption',
            statusValue: '',
            keyword: '',

        },
        methods: {
            addImage: function(event) {
                let max = 4;

                //preview images
                this.previewImages(event, max);

                //compress images
                document.querySelector("#output").innerHTML = "";
                const countImage = event.files.length;
                for(var i = 0; i < countImage; i++) {
                    if(i > max) {
                        return;
                    }
                    this.comporessImage(event.files[i]);
                }
            },
            validateNumber: function(event) {
                let keyCode = event.keyCode;
                if (keyCode < 46 || keyCode > 57) {
                    event.preventDefault();
                }
            },
            setAge: function() {
                var birthDate = new Date(this.birthdate);
                var todayObj = new Date(today);
                var total = birthDate - todayObj;
                var totalDays = Math.abs(total / (1000 * 60 * 60 * 24))
                var totalMonths = Math.floor(totalDays / 30);
                var leftDays = totalDays % 30;
                var totalYears = Math.floor(totalMonths / 12);
                var leftMonths = totalMonths % 12;
                if(totalYears == 0) {
                    if(leftMonths == 0) {
                        this.age = leftDays + 'days';
                    } else {
                        this.age =  leftMonths + 'months ' + leftDays + 'days';
                    }
                } else {
                    this.age = totalYears + 'y ' + leftMonths + 'm ' + leftDays + 'd';
                }
            },

            // helpers
            previewImages: function(event, max) {
                this.images = [];
                for (let i = 0; i < event.files.length; i++) {
                    this.images.push(URL.createObjectURL(event.files[i]));
                }
                if(event.files.length > max) {
                    console.log('only max are allowed');
                    this.images = this.images.slice(0, max);
                    console.log(this.images);
                }
            },

            comporessImage: function(file) {
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
                        imageOutput.name = "imageCompressed[]";
                        imageOutput.type = "text";
                        imageOutput.hidden = true;
                        imageOutput.value = srcEncoded;
                        //console.log(srcEncoded);
                        output.appendChild(imageOutput);
                    };
                };
            }

        }
    })

</script>
@endsection

