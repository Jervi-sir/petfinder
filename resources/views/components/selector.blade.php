<div class="selector">
    <div class=""></div>
    <div class="item">
        <a href="#">
            All
        </a>
    </div>
    @foreach ($races as $race)
    <div class="item">
        <a href="#">
            <img src="../images/cat.svg" alt="">
            <span>{{ $race->name }}</span>
        </a>
    </div>
    @endforeach

</div>

