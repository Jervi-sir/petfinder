<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pet.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <title>Pet details</title>
</head>
<body >
<div id="app">
    <div class="body">
        <!-- Header -->
        <header class="active">
            <div class="logo">
                <img src="../images/logo.svg" alt="">
            </div>
            <div class="title active">
                <h1>Find your favorite pet</h1>
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
            <div class="image">
                <div class="back">
                    <img src="../images/back.svg" alt="">
                </div>
                <img class="pic" src="../images/cat.png" alt="">
            </div>
            <div class="details">
                <h2>pet name</h2>
                <h3>race</h3>
                <h4><img src="../images/location.svg" alt=""> location</h4>
                <div class="bubbles">
                    <span class="age">2Years</span>
                    <span class="gender">male</span>
                    <span class="weight">2kg</span>
                    <span class="color">black</span>
                </div>
                <div class="bio">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta autem provident nisi ipsa natus odit minus quos accusamus excepturi. Quod explicabo amet quam tenetur consequatur, suscipit nostrum architecto eius sit.
                </div>
                <div class="contact">
                    <span>Owner number</span>
                </div>
                <div class="actions">
                    <div class="like">
                        <img src="../images/heart_empty.svg" alt="">
                    </div>
                    <div class="message">
                        <button>Send message</button>
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
