<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <title>add Pet</title>
</head>
<body >
<div id="app">
    <div class="body">
         <!-- Header -->
         <header class="active">
            <div class="logo">
                <img src="../images/logo.svg" alt="">
            </div>
            <div class="search active">
                <form action="">
                    <input type="text" placeholder="Search" @keyup="activeSearch">
                    <button type="submit">
                        <img src="../images/search.svg" alt="">
                    </button>
                </form>
            </div>
        </header>
        <!-- end Header -->

        <!-- Lines -->
        <div class="dotted-line"></div>
        <!-- end Lines -->

        <!-- main -->
        <main>
            <!-- pets -->
            <form action="{{ route('pet.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="image">
                    <div class="show">
                        a
                    </div>
                    <input type="file" name="images[]" id="">
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
                <div class="row phone">
                    <input class="phone" type="text" value="0558054300">
                    <button type="button"><img src="../images/add.svg" alt=""></button>
                </div>
                <div class="actions">
                    <button class="publish" type="submit">publish</button>
                    <button class="preview" type="button">preview</button>
                </div>
            </form>
        </main>
        <!-- end main -->
    </div>
    <!-- menu -->
    <div class="menu">
        <div class="container">
            <div class="item">
                <img src="../images/home.svg" alt="">
            </div>
            <div class="item">
                <img src="../images/comment.svg" alt="">
            </div>
            <div class="item">
                <img src="../images/bookmark.svg" alt="">
            </div>
            <div class="item">
                <img src="../images/add.svg" alt="">
            </div>
            <div class="item">
                <img src="../images/user.svg" alt="">
            </div>
        </div>
    </div>
</div>

<script>
    var app = new Vue({
    el: '#app',
        data: {
            activesearch: false,
        },
        methods: {
            activeSearch: function () {
                this.activesearch = true;
            }
        }
    })

</script>

</body>
</html>
