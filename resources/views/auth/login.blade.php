@extends('layouts.master')

@section('title')
<title>Login</title>
@endsection

@section('style-head')
@vite('resources/scss/login.scss')
@endsection

@section('header')
<x-_header/>
@endsection

@section('main')
<main>
    <div class="top">
        <h1>Login</h1>
        <img src="../images/cat.png" alt="">
    </div>
    <!-- pets -->


    <form class="main" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="row ">
            <input class="{{ $errors->any() ? 'error' : '' }}"  @keyup="takeOfError" name="email" type="text" placeholder="Email" value="{{ old('email') }}">
        </div>
        <div class="row ">
            <input class="{{ $errors->any() ? 'error' : '' }}"  @keyup="takeOfError" name="password" type="password" placeholder="Password">
        </div>
        @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <input type="checkbox" name="remember" hidden checked>
        <div class="actions">
            <a href="#">Forgot my password</a>
            <button class="login" type="submit">Login</button>
        </div>
    </form>
    <a class="dont-have" href="{{ route('register') }}">I don't have an account</a>
</main>

@endsection
