@extends('layouts.master')

@section('title')
<title>Pet details</title>
@endsection

@section('style-head')
@vite('resources/scss/pet.scss')
@endsection

@section('header')
<x-_header />
@endsection


@section('script')
@endsection

@section('main')
<main x-data="app">
    <!-- pets -->
    <div class="pet-container" >
        <div class="image">
            <div class="back" onclick="window.history.back();">
                <img src="../images/back.svg" alt="">
            </div>
            <div class="carousel">
                <div class="carousel-inner">
                    @foreach ($pet['images'] as $image)
                    <input class="carousel-open" type="radio" id="carousel-{{ $loop->index + 1 }}" name="carousel" aria-hidden="true" hidden=""
                    @if ($loop->index == 0)
                    checked="checked"
                    @endif
                    >
                    <div class="carousel-item">
                        <img src="{{ $image }}">
                    </div>
                    @endforeach

                    <label for="carousel-4" class=" prev control-1"></label>
                    <label for="carousel-3" class=" prev control-4"></label>
                    <label for="carousel-2" class=" next control-1"></label>
                    <label for="carousel-1" class=" prev control-2"></label>

                    <label for="carousel-4" class=" prev control-1"></label>
                    <label for="carousel-3" class=" next control-2"></label>
                    <label for="carousel-2" class=" prev control-3"></label>
                    <label for="carousel-1" class=" next control-3"></label>

                    <ol class="carousel-indicators">
                        @foreach ($pet['images'] as $image)
                        <li>
                            <label for="carousel-{{ $loop->index + 1 }}" class="carousel-bullet"></label>
                        </li>
                        @endforeach
                    </ol>

                </div>
            </div>
        </div>
        <div class="details">
            <h2>{{ $pet['name'] }}</h2>
            <h3>{{ $pet['race'] }}</h3>
            <h4><img src="../images/location_empty.svg" alt=""> <span>{{ $pet['wilaya'] }}</span></h4>
            <div class="bubbles">
                @if ($pet['date_birth'])
                <span class="age">{{ $pet['date_birth'] }}</span>
                @endif
                @if ($pet['gender'])
                <span class="gender">{{ $pet['gender'] }}</span>
                @endif
                @if ($pet['weight'])
                <span class="weight">{{ $pet['weight'] }}</span>
                @endif
                @if ($pet['color'])
                <span class="color">{{ $pet['color'] }}</span>
                @endif
            </div>
            <div class="bio">
                {{ $pet['description'] }}
            </div>
            <div class="actions">
                <div class="contact">
                    <img src="../images/phone.svg" alt="">
                    <span >
                        {{ $pet['phone_number'] }}
                    </span>
                </div>
                <div class="message" >
                    <a href="tel:{{ $pet['phone_number'] }}"><img src="../images/phone.svg" alt=""></a>
                    <a @click="openModal">Send message</a>
                </div>
            </div>
        </div>
    </div>

    <!--  Modal -->
    <div id="myModal" x-show="show_modal"  class="modal">
        <div class="layer" @click="closeModal"></div>
        <div class="modal-content">
            <p>Coming soon..</p>
            <span class="close" @click="closeModal">&times;</span>
        </div>
    </div>
</main>

<script>
    function app() {
        return {
            show_modal: false,

            openModal() {
                this.show_modal = true
            },
            closeModal() {
                this.show_modal = false
            }
        }
    }
</script>
@endsection
