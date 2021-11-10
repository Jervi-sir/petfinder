
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
        <form action="">
            <input type="text" placeholder="Search" @keyup="activeSearch">
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
        <form action="{{ route('pet.search') }}" method="GET">
            @csrf
            <input name="keyword" type="text" placeholder="Search" @keyup="activeSearch">
            <button type="submit">
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

@include('components.selector')
