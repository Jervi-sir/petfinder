<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
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
                <div class="actions">
                    <a href="#">Forgot my password</a>
                    <button class="login" type="submit">Login</button>
                </div>
            </form>
            <a class="dont-have" href="{{ route('register') }}">I don't have an account</a>
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
            },
            takeOfError: function(event) {
                event.target.classList.remove("error");
            }
        }
    })

</script>

</body>
</html>
