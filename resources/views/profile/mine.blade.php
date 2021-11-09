<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
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
            <div class="profile-card">
                <div class="details">
                    <div class="left">
                        <span>Namename</span>
                        <span>email</span>
                        <span>phone number</span>
                    </div>
                    <div class="right">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="edit">
                    <a href="#">edit</a>
                </div>
            </div>
            <div></div>
            <h3>my pets</h3>
            <div class="posts">
                <div class="card">
                    <div class="left">
                        <img src="" alt="">
                    </div>
                    <div class="middle">
                        <h4>Grig</h4>
                        <h6>Breed</h6>
                        <h6>Descrtiption</h6>
                        <h5>Price</h5>
                    </div>
                    <div class="right">
                        <span class="gender female">Female</span>
                        <span class="age">20 years</span>
                    </div>
                </div>
                <div class="card">
                    <div class="left">
                        <img src="" alt="">
                    </div>
                    <div class="middle">
                        <h4>Grig</h4>
                        <h6>Breed</h6>
                        <h6>Descrtiption</h6>
                        <h5>Price</h5>
                    </div>
                    <div class="right">
                        <span class="gender female">Female</span>
                        <span class="age">20 years</span>
                    </div>
                </div>
            </div>

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
