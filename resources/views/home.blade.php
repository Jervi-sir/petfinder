<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <title>Find Pet</title>
</head>
<body >
<div id="app">
    <div class="body">
        <!-- Header -->
        <header :class="activesearch == true ? 'active' : ''">
            <div class="logo">
                <img src="../images/logo.svg" alt="">
            </div>
            <div :class="activesearch == true ? 'title active' : 'title'">
                <h1>Find your favorite pet</h1>
            </div>
            <div :class="activesearch == true ? 'search active' : 'search'">
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

        <!-- Selector -->
        <div class="selector">
            <div class=""></div>
            <div class="item">
                All
            </div>
            <div class="item">
                <img src="../images/cat.svg" alt="">
                <span>Cat</span>
            </div>
            <div class="item">
                <img src="../images/cat.svg" alt="">
                <span>Cat</span>
            </div>
            <div class="item">
                <img src="../images/cat.svg" alt="">
                <span>Cat</span>
            </div>
            <div class="item">
                <img src="../images/cat.svg" alt="">
                <span>Cat</span>
            </div>
            <div class="item">
                <img src="../images/cat.svg" alt="">
                <span>Cat</span>
            </div>

        </div>
        <!-- end Selector -->

        <!-- main -->
        <main>
            <div class="top">
                <h5>New Pets</h5>
                <div class="filter">...</div>
            </div>
            <!-- pets -->
            <div class="card dog">
                <div class="card-top">
                    <div class="save">
                        <img src="../images/heart_empty.svg" alt="">
                    </div>
                    <div class="images">
                        <img src="../images/dog.png" alt="">
                    </div>
                    <div class="name">
                        <span>foxy</span>
                    </div>
                </div>
                <div class="details">
                    <div class="breed">Breed</div>
                    <div class="gender male">male</div>
                    <div class="location">
                        <img src="../images/location.svg" alt="">
                        <span>Location location</span>
                    </div>
                    <div class="age">20 years</div>
                    <div class="price">adoption</div>
                </div>
            </div>
            <div class="card cat">
                <div class="card-top">
                    <div class="save">
                        <img src="../images/heart_fill.svg" alt="">
                    </div>
                    <div class="images">
                        <img src="../images/cat.png" alt="">
                    </div>
                    <div class="name">
                        <span>Loxy</span>
                    </div>
                </div>
                <div class="details">
                    <div class="breed">Breed</div>
                    <div class="gender male">male</div>
                    <div class="location">
                        <img src="../images/location.svg" alt="">
                        <span>Location location</span>
                    </div>
                    <div class="age">20 years</div>
                    <div class="price">adoption</div>
                </div>
            </div>
            <div class="card dog">
                <div class="card-top">
                    <div class="save">
                        <img src="../images/heart_empty.svg" alt="">
                    </div>
                    <div class="images">
                        <img src="../images/dog.png" alt="">
                    </div>
                    <div class="name">
                        <span>foxy</span>
                    </div>
                </div>
                <div class="details">
                    <div class="breed">Breed</div>
                    <div class="gender male">male</div>
                    <div class="location">
                        <img src="../images/location.svg" alt="">
                        <span>Location location</span>
                    </div>
                    <div class="age">20 years</div>
                    <div class="price">adoption</div>
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
            result: [
                {
                    id: '1',
                    image: '',
                    name: '',
                    breed: '',
                    gender: '',
                    location: '',
                    price: '',
                    link: '',
                },
            ]
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
