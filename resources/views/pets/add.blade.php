@extends('layouts.master')

@section('title')
<title>add Pet</title>
@endsection

@section('style-head')
<link rel="stylesheet" href="../css/add.css">
@endsection

@section('script-head')
    
@endsection


@section('main')
<main>
    <!-- pets -->
    <form class="form" action="{{ route('pet.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="image">
            <div class="show">
                <img src="" alt="">
            </div>
            <label class="add-img" for="add-image"><span>+</span></label>
            <input hidden type="file" name="images[]" id="add-image">
        </div>
        <div class="row">
            <label for="">name</label>
            <input name="name" type="text">
        </div>
        <div class="row double">
            <div class="sub">
                <select name="race" id="">
                    @foreach ($races as $race)
                    <option value="{{ $race->id }}">{{ $race->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sub">
                <select name="sub" id="">
                    @foreach ($subRaces as $subRace)
                    <option value="{{ $subRace->id }}">{{ $subRace->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <select name="gender" id="">
                <option value="male">male</option>
                <option value="female">female</option>
                <option value="non">I dont know</option>
            </select>
        </div>
        <div class="row double">
            <div class="sub">
                <select name="location" id="">
                    <option value="">location</option>
                </select>
            </div>
            <div class="sub">
                <select name="wilaya" id="">
                    @foreach ($wilayas as $wilaya)
                    <option value="{{ $wilaya->id }}">{{ $wilaya->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row double">
            <div class="sub">
                <select name="birthday" id="">
                    <option value="">birthday</option>
                </select>
            </div>
            <div class="sub">
                <span class="age">age:</span>
            </div>
        </div>
        <div class="row">
            <label for="">price</label>
            <input name="price" type="text">
        </div>
        <div class="row">
            <select name="color" id="">
                @foreach ($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <label for="">weight</label>
            <input name="weight" type="text">
        </div>
        <div class="row">
            <label for="">description</label>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="row phone" v-for="(item, index) in items">
            <input name="phone[]" class="phone" type="text" value="" placeholder="phone number" required>
            <button type="button"  v-on:click="addItem" v-if="items.length - 1 <= index" v-bind:class="{ disabled: item.phone.length == 0 }"><img src="../images/plus.svg" alt=""></button>
            <button type="button" v-on:click="removeItem(index);" v-if="(items.length - 1 >= index) && (items.length -1 != index)"><img src="../images/minus.svg" alt=""></a>
        </div>
        <div class="actions">
            <button class="publish" type="submit">publish</button>
            <button class="preview" type="button">preview</button>
        </div>
    </form>
</main>
@endsection

@section('script')
<script>
    var app = new Vue({
    el: '#app',
        data: {
            activesearch: false,
            items: [
                {
                    phone: '',
                },
                
            ]
        },
        methods: {
            activeSearch: function () {
                this.activesearch = true;
            },
            addItem: function() {
                console.log('aa');
                this.items.push({
                    phone: '',
                });
            },
            removeItem: function(index) {
                this.items.splice(index, 1);
            }
        }
    })

</script>
@endsection

