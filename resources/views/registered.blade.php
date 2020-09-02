@extends('template/main')

@section('title','Data Registered')

@section('container')
<!-- navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" style="border-bottom: 5px solid black; border-width: thin;">
  <a class="navbar-brand" href="/dashboard">Binusian</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Data Registered</a>
      </li>
    </ul>
    <form action="/logout" method="post">
        @csrf
        <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
    </form>
  </div>
</nav>

<div class="container mt-3" style = "border-style: ridge; border-width:thin; border-color: grey; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background-color: #f0ebeb; ">

<h3 class="text-center mt-5 mb-3">Child's Data Recorded for Flu Vaccine</h3>
@include('sweetalert::alert')
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Number</th>
        <th scope="col">Child Order</th>
        <th scope="col">Shift</th>
        <th scope="col">Date Registered</th>
        <th scope="col">Date Test</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
          <tr>
          <th scope="row" class="text-center">{{$loop->iteration}}</th>
          <td class="text-center">{{$data->anak_ke}}</td>
          <td class="text-center">{{$data->shift_info}}</td>
          <td class="text-center">{{$data->created_at}}</td>
          <td class="text-center"><b>Wednesday, 16 Sept, 2020</b></td>
          </tr>
        @endforeach
    </tbody>
  </table>
  
</div>

    @if (count($datas) > 0)
      <form action="/dashboard/registered/clear" method="post">
        @csrf
        @method('delete')
        <div class="btn-group">
          <button type="submit" class="btn btn-danger btn-sm mb-5"  onclick ="return confirm('are you sure?');">Clear All</button>
          <a href="/dashboard" class="btn btn-info btn-sm ml-2 mb-5">Update Records</a>
        </div>
      </form>
    @else
        <div class="col-md-12 text-center">
        <p class=" mt-5">Please Fill the Form First.</p>
        <a href="/dashboard" class="btn btn-primary btn-sm mb-5">Fill the Form</a>
      </div>
    @endif

</div>
<br>
<br>
<br>
<br>

<footer class="mt-5">
  <p class="text-muted text-center mt-5">Taufan Samudra Akbar ⓒ 2020</p>
</footer>





@endsection