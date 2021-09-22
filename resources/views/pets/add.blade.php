<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>add pet!</title>
  </head>
  <body>
    <h1>add pet!</h1>
    <form action="{{ route('pet.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="pet's name">
        </div>
        <!--race -->
        <select name="race" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option selected disabled hidden>Race</option>
            @foreach ($races as $race)
            <option value="{{ $race->id }}">{{ $race->name }}</option>
            @endforeach
        </select>
        <!-- sub race -->
        <select name="sub_race" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option selected disabled hidden>subrace</option>
            @foreach ($subRaces as $subRace)
            <option value="{{ $subRace->id }}">{{ $subRace->name }}</option>
            @endforeach
        </select>
        <!-- wilaya -->
        <select name="wilaya" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option selected disabled hidden>wilaya</option>
            @foreach ($wilayas as $wilaya)
            <option value="{{ $wilaya->number }}">{{ $wilaya->name }}</option>
            @endforeach
        </select>
        <!-- gender -->
        <select name="gender" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option selected disabled hidden>gender</option>
            <option value="male">male</option>
            <option value="female">female</option>
            <option value="unkown">unkown</option>
        </select>
        <!-- color -->
        <select name="color" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option selected disabled hidden>color</option>
            @foreach ($colors as $color)
            <option value="{{ $color->id }}">{{ $color->name }}</option>
            @endforeach
        </select>
        <!-- date -->
        <div class="mb-3">
            <label for="name" class="form-label">Date</label>
            <input name="date" type="date" class="form-control" id="name" placeholder="pet's name">
        </div>
        <!-- size -->
        <div class="mb-3">
            <label for="name" class="form-label">size</label>
            <input name="size" type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
        </div>
        <!-- images -->
        <div class="mb-3">
            <label for="name" class="form-label">images</label>
            <input name="images[]" type="file" accept="image/png, image/jpeg" width="48" height="48">
        </div>
        <!-- description -->
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>
         <!-- phone number -->
         <div class="mb-3">
            <label for="phone-number" class="form-label">phone number</label>
            <input name="phone_number" type="number" class="form-control" id="phone-number" >
        </div>
        <button type="submit">Post</button>
    </form>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>
