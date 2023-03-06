

<!-- Header -->
@if(!request()->is('pets-latest'))
<header class="active">
    <div class="logo">
        <a href="{{ route('pet.all') }}">
            <img src="../images/logo.svg" alt="">
        </a>
    </div>
    <div class="search active">
        <form class="formHeader" action="{{ route('pet.search') }}" method="GET">
            <input hidden name="response" value="view">
            <input name="keywords" type="text" placeholder="Search" v-model="keyword">
            <button type="submit" >
                <img src="../images/search.svg" alt="">
            </button>
        </form>
    </div>
</header>
@else
<header x-data="searchInput" :class="activesearch == true ? 'active' : ''">
    <div class="logo">
        <a href="{{ route('pet.all') }}">
            <img src="../images/logo.svg" alt="">
        </a>
    </div>
    <div :class="activesearch == true ? 'title active' : 'title'">
        <h1>Find your favorite pet</h1>
    </div>
    <div :class="activesearch == true ? 'search active' : 'search'">
        <form class="formHeader" action="{{ route('pet.search') }}" method="GET">
            <input name="keywords" type="text" placeholder="Search" x-model="keywordInput" @keyup="activeSearch">
            <input hidden name="response" value="view">
            <button type="submit">
                <img src="../images/search.svg" alt="">
            </button>
        </form>
    </div>
</header>
<script>
    function searchInput() {
        return {
            activesearch: false,
            keywordInput: '',

            activeSearch() {
                this.activesearch = true
            }
        }
    }
</script>

@endif

<!-- end Header -->

<!-- Lines -->
<div class="dotted-line"></div>
<!-- end Lines -->

