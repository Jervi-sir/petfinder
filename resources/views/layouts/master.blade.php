<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">-->
    <!-- Chrome, Edge, Firefox -->
    <link rel="icon" href="images/logo.svg">
    <!-- Safari -->
    <link rel="mask-icon" href="images/logo.svg" color="#000000">
    <script src="//unpkg.com/alpinejs" defer></script>
    
    @vite('resources/scss/styles.scss')
    @yield('style-head')
    @yield('script-head')
    @yield('title')
</head>
<body >
<div class="body-container">
    <div class="body">
        <!-- Header -->
        @yield('header')
        <!-- end Header -->

        <!-- main -->
        @yield('main')
        <!-- end main -->
    </div>
    <div class="empty-space">
    </div>
    <!-- menu -->
    @include('components._menu')
</div>

<div id="animationOpener" class="animation-opener">
  <div class="layer"></div>
  <div class="logo">
      <img src="../images/logo.svg" alt="">
  </div>
</div>


<script>
  var isNewHere = window.sessionStorage.getItem("newHere");
  var opener = document.getElementById('animationOpener');

  if(isNewHere == null) {
    window.sessionStorage.setItem("newHere", true);
  } else {
    opener.style.display = 'none';
  }



</script>

@yield('script')

@vite('resources/scss/mediaQueries.scss')
<script>
window.addEventListener('touchmove', function (event) {
  event.preventDefault()
}, false)

document.querySelector('.body').addEventListener('touchmove', function (event) {
  event.stopPropagation()
}, false)
</script>
</body>
</html>
