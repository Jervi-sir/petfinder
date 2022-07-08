@extends('layouts.master')

@section('title')
<title>Register</title>
@endsection

@section('style-head')
@vite('resources/scss/register.scss')
@endsection

@section('header')
<x-_header/>
@endsection

@section('main')
<main>
    <div class="top">
        <h1>Register</h1>
        <img src="../images/cat.png" alt="">
    </div>
    <!-- pets -->
    <form class="main" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
            <input name="name" type="text" placeholder="Name" value="{{ old('name') }}">
        </div>
        <div class="row">
            <input class="@error('email') error @enderror" name="email" type="text" placeholder="Email" value="{{ old('email') }}">
        </div>
        <div class="row">
            <input class="@error('password') error @enderror"  @keyup="takeOfError" name="password" type="password" placeholder="Password">
        </div>
        @error('password')
        <ul>
            <li>{{ $message }}</li>
        </ul>
        @enderror
        @error('email')
        <ul>
            <li>{{ $message }}</li>
        </ul>
        @enderror
        <div class="actions">
            <button class="login" type="submit">create</button>
        </div>
    </form>
    <a class="dont-have" href="{{ route('login') }}">I have an account</a>
</main>

@endsection

