@extends('layout.base')

@section('content')
@if(session('messageAlert'))
<div class="bd-example">
    <div class="alert alert-left alert-{{session('messageAlert.type')}} alert-dismissible fade show mb-3" role="alert"> {{-- success/info/warning/danger --}}

        <span> {{session('messageAlert.message')}}</span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
<div class="card col-md-10 mx-auto">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Input User</h4>
        </div>
    </div>
    
    <div class="card-body">
        <p>Please fill out the details below to add a new user</p> 
        <form action="{{ route('user.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Name </label>
                <input type="text" class="form-control" id="exampleInputText1" value="" placeholder="Enter Username" name="username" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText2">Email </label>
                <input type="email" class="form-control" id="exampleInputText2" value="" placeholder="Enter Email" name="email" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText3">Password </label>
                <input type="password" class="form-control" id="exampleInputText3" value="" placeholder="Enter Password" name="password" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText2">Phone Number </label>
                <input type="tel" class="form-control" id="exampleInputText2" value="" placeholder="Enter Phone Number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleFormControlTextarea1">Address</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Enter Address" name="address"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit" class="btn btn-danger">cancel</button>
        </form>
    </div>
</div>
@endsection
