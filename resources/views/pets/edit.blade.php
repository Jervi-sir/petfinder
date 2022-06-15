@extends('layouts.master')

@section('title')
<title>add Pet</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/add.css">
@endsection

@section('header')
@include('components._header')
@endsection



@section('main')
<main>
    <!-- pets -->
    <form class="form" action="{{ route('pet.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="id" :value='pet.id' hidden>
        <div class="image">
            <div class="show"  v-for="(image, index) in images">
                <img :src='image' alt="">
            </div>
            <label class="add-img" for="add-image"><span>+</span></label>
            <input hidden name="images[]" type="file" id="add-image"  accept="image/png, image/jpeg"  multiple @change='addImage($event.target)'>
        </div>
        <div class="row">
            <label for="">name</label>
            <input name="name" type="text" :value='pet.name'>
        </div>
        <div class="row double">
            <div class="sub">
                <label for="">race</label>
                <select name="race" id="" :value='pet.race'>
                    @foreach ($races as $race)
                    <option value="{{ $race->id }}">{{ $race->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sub">
                <label for="">sub</label>
                <select name="sub" id="" :value='pet.subRace'>
                    @foreach ($subRaces as $subRace)
                    <option value="{{ $subRace->id }}">{{ $subRace->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <label for="">gender</label>
            <select name="gender" id="" :value='pet.gender'>
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
                    <select name="wilaya" id="" :value='pet.wilaya'>
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
            <select name="color" id="" :value='pet.color'>
                @foreach ($colors as $color)
                <option value="{{ $color->name }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <label for="">weight</label>
            <input name="weight" type="text" :value='pet.weight' @keypress="validateNumber">
        </div>
        <div class="row">
            <label for="">status</label>
            <select name="status" id="" :value='pet.status'>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <label for="">price</label>
            <input name="price" type="text" :value='pet.price' :disabled="statusValue == 2" @keypress="validateNumber">
        </div>

        <div class="row">
            <label for="">description</label>
            <textarea name="description" id="" cols="30" rows="10" maxlength="300" v-model="description"></textarea>
            <span class="count">@{{ description.length }} / 300</span>
        </div>
        <div class="row phone" v-for="(item, index) in items">
            <input name="phone[]" class="phone" type="text" :value='pet.phone_number' placeholder="phone number" @keypress="validateNumber" required>
            <button type="button"  v-on:click="addItem" v-if="items.length - 1 <= index" v-bind:class="{ disabled: item.phone.length == 0 }"><img src="../images/plus.svg" alt=""></button>
            <button type="button" v-on:click="removeItem(index);" v-if="(items.length - 1 >= index) && (items.length -1 != index)"><img src="../images/minus.svg" alt=""></a>
        </div>
        <div class="actions">
            <button class="publish" type="submit">publish</button>
            <button class="preview" type="button">preview</button>
        </div>
    </form>
    <div class="delete btn">
        <button type="submit" @click="showModal=true">Delete announcement</button>
    </div>
    @{{pet.phone_number[0]}}
    <div class="modal" v-if="showModal">
        <div class="layer" @click="showModal=false"></div>
        <div class="container">
            <h1> Are u sure u want to delete</h1>
            <p>Please type <span>@{{ pet.name }}</span>  to confirm.</p>
            <input type="text" v-model="confirmDelete" @keyup="verifyDelete">
            <form action="{{ route('pet.delete') }}" method="POST">
                @csrf
                <input type="text" name="id" :value="pet.id" hidden>
                <button type="button" @click="showModal=false">Cancel</button>
                <button type="submit" :disabled="!deleteBtn">Delete</button>
            </form>
        </div>
    </div>
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
            activesearch: false,
            images: [],
            age: '',
            status: 'adoption',
            items: [
                {
                    phone: '',
                },
            ],
            pet: [],
            birthdate: '',
            description: '',
            uuid: '',
            confirmDelete: '',
            statusValue: '',
            keyword: '',
            deleteBtn: false,
            showModal: false,
        },
        created() {
            var pet = {!! json_encode($pet) !!};
            this.pet = pet;
            this.birthdate = this.pet.date_birth;
            this.setAge();
            this.description = this.pet.description;
            console.log(typeof(Object.keys(this.pet.phone_number)))
        },
        methods: {
            verifyDelete: function() {
                if(this.confirmDelete == this.pet.name) {
                    this.deleteBtn = true;
                } else {
                    this.deleteBtn = false;
                }
            },
            activeSearch: function () {
                this.activesearch = true;
            },
            addItem: function() {
                this.items.push({
                    phone: '',
                });
            },
            removeItem: function(index) {
                this.items.splice(index, 1);
            },
            addImage: function(event) {
                let max = 4;
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
            }
        }
    })

</script>
@endsection

