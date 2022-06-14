
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
        <form class="formHeader" action="{{ route('pet.search') }}" method="POST">
            @csrf
            <input hidden name="resultNeeded" value="view">
            <input type="text" placeholder="Search" v-model="keyword" @keyup="activeSearch">
            <button type="submit">
                <img src="../images/search.svg" alt="">
            </button>
        </form>
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
        <form class="formHeader" action="{{ route('pet.search') }}" method="POST">
            @csrf
            <input hidden name="resultNeeded" value="view">
            <input name="keyword" type="text" placeholder="Search" v-model="keyword" @keyup="activeSearch">
            <button type="submit" >
                <img src="../images/search.svg" alt="">
            </button>
        </form>
    </div>
</header>
@endif

<!-- end Header -->

<!-- Lines -->
<div class="dotted-line"></div>
<!-- end Lines -->

