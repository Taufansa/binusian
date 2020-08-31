@extends('template/main')

@section('title','Dashboard Page')

@section('container')
<!-- navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light" style="border-bottom: 5px solid black; border-width: thin;">
  <a class="navbar-brand" href="">Binusian</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard/registered">Data Registered</a>
      </li>
    </ul>
    <form action="/logout" method="post">
        @csrf
        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button>
    </form>
  </div>
</nav>
@include('sweetalert::alert')
<div class="container mt-3 mb-3" style = "border-style: ridge; border-width:thin; border-color: grey; border-radius: 10px; ">
    <h1 class="text-center mt-5">Flu Vaccine Registration for Employee's Children</h1>
    <hr/>
    <div class="row" style="margin-bottom: -30px;">
        <ul style="list-style-type: none; ">
            <li style="float: left;">
                <p class="" style="display: inline-block;">Welcome, {{$data->nama}}</p>
            </li>
            <li style="float: left;">
                <p class=" ml-2 mr-2"style="display: inline-block;">|</p>
            </li>
            <li style="float: left;">
                <form action="/logout" method="post">
                @csrf
                    <button type="submit" class="btn btn-danger btn-sm ">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    <hr/>
    @if (count($registered) > 0 )
    <form action="/updateChild" action="get" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">I would like to register my children/child below for Flu Vaccine on <b>Wednesday, 16 September 2020.</b></label>
            @foreach ($children as $child)
              @if (($child->age() >= $batch->minimum_age) && ($child->age() <= $batch->maximum_age))
                <div class="form-check">
                    <input class="form-check-input" name="childs[]" type="checkbox" value="{{$child->anak_ke}}" id="child">
                    <label class="form-check-label" for="child">
                        {{$child->nama}} ({{$child->age()}} Years old)
                    </label>
                </div>
              @else 
                <div class="form-check">
                    <input class="form-check-input" name="childs[]" type="checkbox" value="{{$child->anak_ke}}" id="child" disabled>
                    <label class="form-check-label" for="child">
                        {{$child->nama}} ({{$child->age()}} Years old)
                    </label>
                </div>
              @endif
            @endforeach
            <br>
            <label for="">I choose shift:</label>
            @foreach ($shifts as $shift)
            @if ($shift->shift_id == $first->shift_id)
              @php
                $counted = $shift->quota - $count;
              @endphp
              @if ($counted < $shift->quota)
                <div class="form-check">
                    <input class="form-check-input" name ="shift_id" type="radio" value="{{$shift->shift_id}}" id="shift" required>
                    <label class="form-check-label" for="shift">
                        {{$shift->shift_info}} - {{$shift->quota - $count}} Slot(s) Available.
                    </label>
                </div>
              @else
                <div class="form-check">
                    <input class="form-check-input" name ="shift_id" type="radio" value="{{$shift->shift_id}}" id="shift" disabled>
                    <label class="form-check-label" for="shift">
                        {{$shift->shift_info}} - {{$shift->quota - $count}} Slot(s) Available.
                    </label>
                </div>
              @endif
            @else
            <div class="form-check">
                <input class="form-check-input" name ="shift_id" type="radio" value="{{$shift->shift_id}}" id="shift" required>
                <label class="form-check-label" for="shift">
                    {{$shift->shift_info}} - {{$shift->quota}} Slot(s) Available.
                </label>
            </div>
            @endif
            @endforeach
            <div class="btn-group">
            <button type="submit" class="btn btn-info btn-sm mt-3">Update</button>
            <button type="button" class="btn btn-light btn-sm mt-3 ml-2" disabled>Created at : {{$first->created_at}}</button>
            <a href="/dashboard/registered" class="btn btn-success btn-sm mt-3 ml-2">See Records</a>
            </div>
        </div>
    </form>
    @else
    <form action="/registerChild" action="get" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">I would like to register my children/child below for Flu Vaccine on <b>Wednesday, 16 September 2020.</b></label>
            @foreach ($children as $child)
              @if (($child->age() >= $batch->minimum_age) && ($child->age() <= $batch->maximum_age))
                <div class="form-check">
                    <input class="form-check-input" name="childs[]" type="checkbox" value="{{$child->anak_ke}}" id="child">
                    <label class="form-check-label" for="child">
                        {{$child->nama}} ({{$child->age()}} Years old)
                    </label>
                </div>
              @else 
                <div class="form-check">
                    <input class="form-check-input" name="childs[]" type="checkbox" value="{{$child->anak_ke}}" id="child" disabled>
                    <label class="form-check-label" for="child">
                        {{$child->nama}} ({{$child->age()}} Years old)
                    </label>
                </div>
              @endif
            @endforeach
            <br>
            <label for="">I choose shift:</label>
            @foreach ($shifts as $shift)
            <div class="form-check">
                <input class="form-check-input" name ="shift_id" type="radio" value="{{$shift->shift_id}}" id="shift" required>
                <label class="form-check-label" for="shift">
                    {{$shift->shift_info}} - {{$shift->quota}} Slot(s) Available.
                </label>
            </div>
            @endforeach
            <button type="submit" class="btn btn-primary btn-sm mt-3">Register</button>
        </div>
    </form>
    @endif
    

    
</div>
<br>
<br>

<footer class="mt-5">
  <p class="text-muted text-center mt-5">Taufan Samudra Akbar ⓒ 2020</p>
</footer>
@endsection