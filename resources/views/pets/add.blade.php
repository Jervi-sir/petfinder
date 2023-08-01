@extends('layouts.master')

@section('title')
<title>add Pet</title>
@endsection

@section('style-head')
@vite('resources/scss/add.scss')
@endsection

@section('header')
<x-_header />
@endsection

@section('main')

<main x-data="submitForm" >
    <!-- pets -->
    <form class="form" action="{{ route('pet.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="image">
            <template x-for="(image, index) in images">
                <div class="show">
                    <img :src='image' @click="previewImages(this.src)" alt="">
                    <button class="remove" @click="removeImage(index)" type="button">del</button>
                </div>
            </template>
            <label class="add-img" for="add-image"><span>+</span></label>
            <input hidden type="file" id="add-image"  accept="image/png, image/jpeg"  multiple @change='addImage($event.target)'>
        </div>

        <div class="row">
            <label for="">name</label>
            <input name="name" type="text">
        </div>
        <div class="row double">
            <div class="sub">
                <label for="">race</label>
                <select name="race" x-model="selectedRace" @change="filterBeed">
                    <option value="" selected disabled hidden>Race?</option>
                    <template x-for="(race, index) in races">
                        <option :value="race['id']" x-text="race['name']"></option>
                    </template>
                </select>
            </div>
            <div class="sub">
                <label for="">breed</label>
                <select name="breed">
                    <option selected disabled hidden>Breed?</option>
                    <template x-for="(breed, index) in breeds">
                        <option :value="breed" x-text="breed"></option>
                    </template>
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
                    <select name="wilaya" id="">
                        <option value="" selected disabled hidden>wailaya</option>
                        @foreach ($wilayas as $wilaya)
                        <option value="{{ $wilaya->id }}">{{ $wilaya->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sub">
                    <input id="location" name="location" type="text" placeholder="....">
                </div>
            </div>
        </div>
        <div class="row">
            <label for="">birthday</label>
            <div class="double">

                <div class="sub">
                    <input id="birthday" name="birthday" type="date"  min="1900/01/01" max="2100/01/01"  x-model="birthdate" @change='setAge()' placeholder="birthday">
                </div>
                <div class="sub">
                    <span class="age" >
                        age:
                        <span x-text="age"></span>
                    </span>

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
            <select name="status" id="" x-model="statusValue" class="bg-green">
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <label for="">price</label>
            <template x-if="statusValue > 1">
                <input name="price" type="text" @keypress="validateNumber">
            </template>
            <template x-if="statusValue <= 1" >
                <input disabled type="text" placeholder="please select sell or rent">
            </template>
        </div>

        <div class="row">
            <label for="">description</label>
            <textarea name="description" id="" cols="30" rows="10" maxlength="300" x-model="description"></textarea>
            <span class="count" >
                <span x-text="description.length"></span>
                /300
            </span>
        </div>
        <div class="row">
            <label for="">phone number</label>
            <input name="phone" class="phone" type="text" value="{{ $user_phone }}" placeholder="" @keypress="validateNumber" required>
        </div>
        <div class="output">
            <template x-for="comp in compresseds">
                <input name="imageCompressed[]" type="text" :value='comp' hidden>
            </template>
        </div>
        <div class="actions">
            <button class="publish" type="submit">publish</button>
            <button class="preview" type="button" hidden>preview</button>
        </div>
    </form>

</main>
<script>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    document.getElementById('birthday').setAttribute("max", today);

    var races = {!! ($races) !!};


    function submitForm() {
        return {
            pet: [],
            images: [],
            compresseds: [],
            description: '',
            birthdate: '',
            age: '',
            status: 'adoption',
            statusValue: '',
            keyword: '',
            races: [],
            selectedRace: '',
            breeds: [],
            maxDate: '',
            phone_number: '',

            init() {
                this.races = races;
            },

            filterBeed() {
                for(var i = 0; i < this.races.length; i++) {
                    if(this.races[i].name == this.selectedRace) {
                        this.breeds = JSON.parse(this.races[i].breeds);
                        break;
                    }
                }
            },

            validateNumber(event) {
                let keyCode = event.keyCode;
                if (keyCode < 46 || keyCode > 57) {
                    event.preventDefault();
                }
            },

            setAge() {
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
                        this.age = leftDays + ' days';
                    } else {
                        this.age =  leftMonths + ' months, ' + leftDays + ' days';
                    }
                } else {
                    this.age = totalYears + ' y, ' + leftMonths + ' m, ' + leftDays + ' d';
                }
            },

            /*-
            |------------
            |   Image processing
            |------------
            */

            addImage(event) {
                let max = 4;

                if(this.images.length >= max) {
                    console.log('only max are allowed');
                    return;
                }

                //preview images
                this.previewImages(event, max);
                //compress images
                this.compressAllImages();

            },

            previewImages(event, max) {

                for (let i = 0; i < event.files.length; i++) {
                    this.images.push(URL.createObjectURL(event.files[i]));
                }

            },

            removeImage(index) {
                this.images.splice(index, 1);
                this.compressAllImages();
            },

            compressAllImages(max = 4) {
                this.compresseds = [];
                const countImage = this.images.length;
                for(var i = 0; i < countImage; i++) {
                    if(i > max) {
                        return;
                    }
                    var result = this.compressOneImage(this.images[i]);
                    this.compresseds.push(result);
                }
            },
            compressOneImage(blobURL) {
                //input is blobURL
                var imgEle = new Image();
                imgEle.src = blobURL;

                /*--- Create Canva ---*/
                var canvas = document.createElement('canvas');
                const ctx = canvas.getContext("2d");

                ctx.drawImage(imgEle, 0, 0, imgEle.width, imgEle.height);
                const srcEncoded = ctx.canvas.toDataURL("image/png", 0.9);

                return srcEncoded;
            }
        }
    }
</script>
@endsection

@section('script')

@endsection

