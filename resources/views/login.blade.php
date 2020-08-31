@extends('template/main')

@section('title','Login Page')

@section('container')

<!-- navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light" style="border-bottom: 5px solid black; border-width: thin;">
  <a class="navbar-brand" href="/">Binusian</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="" data-toggle="tooltip" data-placement="bottom" title="Taufan Samudra Akbar">Developer</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Links
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="https://www.linkedin.com/in/taufansa/" target="_blank">LinkedIn</a>
          <a class="dropdown-item" href="https://github.com/Taufansa" target="_blank" >Github</a>
        </div>
      </li>
    </ul>
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" data-toggle="modal" data-target="#exampleModal">Login</button>
    
  </div>
</nav>

<!-- carousel -->

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://i.ibb.co/qDRMQZ7/binus-university-4-ad09a4070bd9b732995e73c57d2ebbeb-600x400.jpg" class="d-block w-100" height="575"  alt="Binus Jakarta">
      <div class="carousel-caption d-none d-md-block">
        <h5>BINUS Jakarta</h5>
        <p>Jl. Raya Kb. Jeruk No.27, RT.2/RW.9, Kb. Jeruk, Kec. Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11530</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://i.ibb.co/7krvyHM/binus-bandung.jpg" class="d-block w-100" height="575" alt="Binus Bandung">
      <div class="carousel-caption d-none d-md-block">
        <h5>BINUS Bandung</h5>
        <p>Jalan Pasir Kaliki No.25-27, Kebon Jeruk, Andir, Kb. Jeruk, Kec. Andir, Kota Bandung, Jawa Barat 40181</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://i.ibb.co/V9n45Xx/binus-malang.jpg" class="d-block w-100" height="575" alt="Binus Malang">
      <div class="carousel-caption d-none d-md-block">
        <h5>BINUS Malang</h5>
        <p>Araya Mansion No. 8 - 22, Genitri, Tirtomoyo, Kec. Pakis, Malang, Jawa Timur 65154</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<br>
<br>
<br>
<br>
<br>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/loginmodal" method="post">
            @csrf
            <div class="form-group">
                <label for="inputbinusian">Binusian ID</label>
                <input type="text" class="form-control" id="inputbinusian" name="binusian_id" required>
            </div>
            <div class="form-group">
                <label for="inputpassword">Password</label>
                <input type="password" class="form-control" id="inputpassword" name="password" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<br>
<br>

<footer class="mt-5">
  <p class="text-muted text-center mt-5 mb-5">Taufan Samudra Akbar ⓒ 2020</p>
</footer>

@include('sweetalert::alert')

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@endsection