<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Chrome, Edge, Firefox -->
    <link rel="icon" href="images/logo.svg">
    <!-- Safari -->
    <link rel="mask-icon" href="images/logo.svg" color="#000000">

    @vite('resources/scss/styles.scss')
    @yield('style-head')
    @yield('script-head')
    @yield('title')
</head>
<body >
<div id="app">
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

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

@yield('script')


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
