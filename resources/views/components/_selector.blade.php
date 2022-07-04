<div class="selector">
    <div class=""></div>
    <a href="{{ route('pet.all') }}" class="item">
        <span>All </span>
    </a>

    @foreach ($races as $race)
    <a href="{{ route('pet.race', ['race' => $race->name]) }}" class="item {{ request()->is('race/' . $race->name) ? 'active' : '' }}" >
       <span>{{ $race->name }}</span>
    </a>
    @endforeach

</div>

