<style>

/*---------
    Header
    ----------*/
header {
    display: flex;
    flex-direction: column;
    gap: var(--gap);
    padding: var(--padding-layout);
}

header h1 {
    font-style: normal;
    font-weight: 500;
    font-size: 3rem;
    line-height: 35px;
    width: 20rem;

    color: var(--color-primary);
}

header .search form {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    background: var(--bg-third);
    border-radius: 11px;
}

header .search form input {
    border: none;
    flex: auto;
    font-family: var(--ff-secondary);
    font-style: normal;
    font-weight: normal;
    font-size: 1.5rem;

    color: #8F8989;

}

header .search form input:focus {
    outline: none;
}

header .search form button {
    cursor: pointer;
    background-color: transparent;
    border: none;
}

header.active {
    display: flex;
    flex-direction: row;
    transform: 0.5s;
}

header .title.active {
    display: none;
}

header .search.active {
    width: 100%;
}
/*---- end header ---*/


/*-------
    Dots
    -------*/
    .dotted-line {
    display: inline-block;
    width: 100%;
    border-bottom: 2px dashed var(--bg-primary);
}

/*---- end dots ---*/


</style>

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
