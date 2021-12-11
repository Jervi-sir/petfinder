
<!-- Header -->
@if(request()->is('pets-latest'))
<header :class="activesearch == true ? 'active' : ''">
    <div class="logo">
        <a href="{{ route('pet.all') }}">
            <img src="../images/logo.svg" alt="">
        </a>
    </div>
    <div :class="activesearch == true ? 'title active' : 'title'">
        <h1>Find your favorite pet</h1>
    </div>
    <div :class="activesearch == true ? 'search active' : 'search'">
        <div class="formHeader">
            <input type="text" placeholder="Search" v-model="keyword" @keyup.enter="search" @keyup="activeSearch">
            <button type="submit" @click.prevent="search">
                <img src="../images/search.svg" alt="">
            </button>
        </div>
    </div>
</header>
@else
<header class="active">
    <div class="logo">
        <a href="{{ route('pet.all') }}">
            <img src="../images/logo.svg" alt="">
        </a>
    </div>
    <div class="search active">
        <div class="formHeader">
            <input name="keyword" type="text" placeholder="Search" v-model="keyword" @keyup.enter="search" @keyup="activeSearch">
            <button type="submit" @click.prevent="search">
                <img src="../images/search.svg" alt="">
            </button>
        </div>
    </div>
</header>
@endif

<!-- end Header -->

<!-- Lines -->
<div class="dotted-line"></div>
<!-- end Lines -->

