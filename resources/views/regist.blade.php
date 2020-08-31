@extends('template/main')

@section('title','Regist Page')

@section('container')
<div class="container">
    <h3 class="text-center mt-5">Register Form</h3>
    
    <form action="/regist/create" method="post" onSubmit = "return checkPassword(this)">
    @csrf
    <div class="form-group">
        <label for="inputID">Binusian ID</label>
        <input type="text" class="form-control  @error('binusian_id') is-invalid @enderror" id="inputID" name="binusian_id" value="{{old('binusian_id')}}" required>
        @error('binusian_id')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="pass1">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="pass1" name="password" value="{{old('password')}}" required>
        @error('password')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="pass2">Confirm Password</label>
        <input type="password" class="form-control" id="pass2" name="confirm_password" required> 
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if (session('regist'))
        <div class="alert alert-primary alert-dismissible fade show mt-3">
            {{ session('regist') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('regist_fail'))
        <div class="alert alert-danger alert-dismissible fade show mt-3">
            {{ session('regist_fail') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('regist_warning'))
        <div class="alert alert-warning alert-dismissible fade show mt-3">
            {{ session('regist_warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


</div>

    <script> 
          
        // Function to check Whether both passwords 
        // is same or not. 
        function checkPassword(form) { 
            password = form.password.value; 
            confirm_password = form.confirm_password.value; 

            // If password not entered 
            if (password == '') 
                alert ("Please enter Password"); 
                    
            // If confirm password not entered 
            else if (confirm_password == '') 
                alert ("Please enter confirm password"); 
                    
            // If Not same return False.     
            else if (password != confirm_password) { 
                alert ("\nPassword did not match: Please try again...") 
                return false; 
            } 

            // If same return True. 
            else{ 
                alert("Password Match!") 
                return true; 
            } 
        } 
    </script> 


@endsection