@extends('template/main')

@section('title','Forbidden')

@section('container')

<!-- navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" style="border-bottom: 5px solid black; border-width: thin;">
  <a class="navbar-brand" href="">Binusian</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    </ul>
    <form action="/logout" method="post">
        @csrf
        <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
    </form>
  </div>
</nav>
<br>
<br>
<br>
<br>
<br>
<div class="container-sm mt-5 mb-5">

<div class="card text-center" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
  <div class="card-header" >
    Warning
  </div>
  <div class="card-body">
    <h5 class="card-title">Sorry, you are not eligble to fill this form.</h5>
    <p class="card-text">This form only applies for employees based in JABODETABEK.</p>
    <form action="/logout" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <button class="btn btn-danger mb-2 float-sm-center" type="submit">Logout</button>
            </div>
            
        </div>
    </form>
  </div>
  <div class="card-footer text-muted">
    by Management
  </div>
</div>

</div>
<br>
<br>

<footer class="mt-5">
  <p class="text-muted text-center mt-5">Taufan Samudra Akbar ⓒ 2020</p>
</footer>

@endsection