@props(['title' => ''])

<div x-data="filterInit" style="width: 100%">
    <div class="top">
        <h5>{{ $title }}</h5>
        <div class="open-filter" x-on:click="filterIsOpen = !filterIsOpen">
            <img src="../images/filter.svg" alt="">
        </div>
    </div>

    <div class="filter" :class="filterIsOpen ? 'active' :''" x-show="filterIsOpen">
        <div class="filter-top">
            <span></span>
            <h3>Filter</h3>
            <button class="cancel-filter" x-on:click="filterIsOpen = !filterIsOpen">X</button>
        </div>
        <form action="">
            @csrf
            <div class="filter-selectors">
                <div class="row">
                    <select name="pet">
                        <option value="0" selected>Cat</option>
                    </select>
                </div>
                <div class="row">
                    <select name="breed">
                        <option value="0" selected>Breed</option>
                    </select>
                </div>
                <div class="row">
                    <select name="wilaya">
                        <option value="0" selected>Wilaya</option>
                    </select>
                </div>
                <div class="row">
                    <select name="status">
                        <option value="0" selected>Adoption</option>
                    </select>
                </div>
                <div class="row">
                    <select name="color">
                        <option value="0" selected>Color</option>
                    </select>
                </div>
            </div>

            <button type="submit">FILTER RESULTS</button>
        </form>
    </div>
</div>
<script>
    function filterInit() {
        return {
            filterIsOpen: false,
        }
    }
</script>
