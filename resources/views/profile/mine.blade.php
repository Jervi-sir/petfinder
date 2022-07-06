@extends('layouts.master')

@section('title')
<title>My Profile</title>
@endsection

@section('style-head')
@vite('resources/scss/profile.scss')
@endsection

@section('header')
@include('components._header')
@endsection


@section('script')
<script>
    var app = new Vue({
    el: '#app',
        data: {
            activesearch: false,
            pets: [],
            confirmDelete: '',
            deleteBtn: false,
            showModal: false,
            modal:{
                petId: '',
                petName: '',
            },
            keyword: ''
        },
        methods: {
            activeSearch: function () {
                this.activesearch = true;
            },
            deletePet: function (event) {
                var target = event.target;
                var pet_id = target.getAttribute('data-pet-id');
                var pet_name = target.getAttribute('data-pet-name');

                this.showModal = true;
                this.modal.petId = pet_id;
                this.modal.petName = pet_name;
                console.log(pet_id);
                console.log(pet_name);
            },
            verifyDelete: function() {
                if(this.confirmDelete == this.modal.petName) {
                    this.deleteBtn = true;
                } else {
                    this.deleteBtn = false;
                }
            },
        },
    })
</script>
@endsection

@section('main')
<main>
    <h3>my profile</h3>
    <div class="profile-card">
        <div class="details">
            <div class="left">
                <span>{{ $user['name'] }}</span>
                <span>{{ $user['email'] }}</span>
                <span>{{ $user['phone_number'] }}</span>
            </div>
            <div class="right">
                <img src="{{ $user['image'] }}" alt="">
            </div>
        </div>
        <div class="edit">
            <a href="{{ route('profile.edit') }}">edit</a>
        </div>
    </div>
    <div></div>

    <div class="head-posts">
        <h3>my pets</h3>
        <span> {{ $count }} / 7 <small>pets</small></span>
    </div>
    <div class="posts">
        @if($count)
        @foreach ($pets as $pet)
        <a class="card" href='{{ $pet['url'] }}'>
            <div class="left">
                <img src="{{ $pet['image'] }}" alt="">
            </div>
            <div class="middle">
                <h4>{{ $pet['name'] }}</h4>
                <h6>{{ $pet['race'] }}</h6>
                <h5>{{ $pet['status'] }}</h5>
            </div>
            <div class="right">
                <span class="gender {{ $pet['gender'] }}" >{{ $pet['gender'] }}</span>
                <span class="age">{{ $pet['age'] }}</span>
            </div>
        </a>
        <a href="{{ route('pet.edit', ['id' => $pet['id']]) }}">edit</a>
        <button data-pet-id="{{ $pet['id'] }}" data-pet-name="{{ $pet['name'] }}" @click="deletePet($event)">delete</button>
        @endforeach
        @endif
        <div class="add-pets">
            @if($count > 7)
            <a href="#" disabled>add pets</a>
            @else
            <a href="{{ route('pet.create') }}">add pets</a>
            @endif
        </div>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="action">
                    <button type="submit">Logout</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" v-if="showModal">
        <div class="layer"  @click="showModal=false"></div>
        <div class="container">
            <h1> Are u sure u want to delete</h1>
            <p>Please type <span>@{{ modal.petName }}</span>  to confirm.</p>
            <input type="text" v-model="confirmDelete" @keyup="verifyDelete">
            <form action="{{ route('pet.delete') }}" method="POST">
                @csrf
                <input type="text" name="id" :value='modal.petId' hidden>
                <button type="button" @click="showModal=false">Cancel</button>
                <button type="submit" :disabled="!deleteBtn">Delete</button>
            </form>
        </div>
    </div>
</main>
@endsection
