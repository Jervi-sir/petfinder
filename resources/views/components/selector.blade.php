<div class="selector">
    <div class=""></div>
    <div class="item">
        <a href="{{ route('pet.all') }}">
            All
        </a>
    </div>

    @foreach ($races as $race)
    <div class="item {{ request()->is('race/' . $race->name) ? 'active' : '' }}" >
        <a href="{{ route('pet.race', ['race' => $race->name]) }}">
            <img src="../images/cat.svg" alt="">
            <span>{{ $race->name }}</span>
        </a>
    </div>
    @endforeach

</div>

