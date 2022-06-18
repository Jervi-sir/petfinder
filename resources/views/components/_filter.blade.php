<div class="filter"  :class='{active: filterIsOpen}' v-show="filterIsOpen">
    <div class="filter-top">
        <span></span>
        <h3>Filter</h3>
        <button class="cancel-filter" @click="filterIsOpen = !filterIsOpen">X</button>
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
