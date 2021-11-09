<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editProfile.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <title>Profile</title>
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
                        <img src="../images/search.svg" al="">
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
            <h3>my profile</h3>
            <form action="">
                <div class="top">
                    <div class="image">
                        <label for="image">Choose image</label>
                        <input hidden type="file" name="" id="image">
                        <div class="img">
                            <img src="" alt="">
                        </div>
                    </div>
                    <div class="input">
                        <input type="text" placeholder="name">
                        <input type="text" placeholder="Locatiom">
                        <input type="text" placeholder="phone number">
                    </div>
                </div>
                <button type="submit">save</button>
            </form>

            <a href="" class="reset">reset password</a>
            <a href="" class="delete">delete account</a>

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
