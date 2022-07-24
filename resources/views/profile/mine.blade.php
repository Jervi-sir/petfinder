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
    function app() {
        return {
            pets: [],
            confirmDelete: '',
            deleteBtn: false,
            showModal: false,
            modal:{
                petId: '',
                petName: '',
            },
            keyword: '',

            deletePet(event) {
                var target = event.target;
                var pet_id = target.getAttribute('data-pet-id');
                var pet_name = target.getAttribute('data-pet-name');

                this.showModal = true;
                this.modal.petId = pet_id;
                this.modal.petName = pet_name;
                console.log(pet_id);
                console.log(pet_name);
            },
            verifyDelete() {
                if(this.confirmDelete == this.modal.petName) {
                    this.deleteBtn = true;
                } else {
                    this.deleteBtn = false;
                }
            },
        }
    }
</script>
@endsection

@section('main')
<main x-data="app">
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
        <div class="card-container">
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
            <div class="actions">
                <a href="{{ route('pet.edit', ['id' => $pet['id']]) }}">edit</a>
                <button data-pet-id="{{ $pet['id'] }}" data-pet-name="{{ $pet['name'] }}" @click="deletePet($event)">delete</button>
            </div>
        </div>
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

    <div class="modal" x-show="showModal">
        <div class="layer"  @click="showModal=false"></div>
        <div class="container">
            <h1> Are u sure u want to delete</h1>
            <p>Please type <span x-text="modal.petName"></span>  to confirm.</p>
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
