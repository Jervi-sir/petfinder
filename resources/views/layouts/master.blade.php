<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    @yield('style-head')
    @yield('script-head')
    <link rel="stylesheet" href="../css/styles.css">
    @yield('title')
</head>
<body >
<div id="app">
    <div class="body">
        <!-- Header -->
        @include('components.header')
        <!-- end Header -->

        <!-- main -->
        @yield('main')
        <!-- end main -->
    </div>
    <!-- menu -->
    @include('components.menu')
</div>

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
