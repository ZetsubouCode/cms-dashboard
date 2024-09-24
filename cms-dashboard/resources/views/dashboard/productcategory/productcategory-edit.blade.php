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
            <h4 class="card-title">Edit Payment Method</h4>
        </div>
    </div>
    
    <div class="card-body">
        <p>Please update the details below to modify the payment method</p>
        <form action="{{ route('productcategory.update', ['id' => $data->id??'']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Name </label>
                <input type="text" class="form-control" id="exampleInputText1" value="{{$data->name??''}}" placeholder="Enter Name" name="name" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description" >{{$data->description??''}}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select class="form-select mb-3 shadow-none" name="status">
                    <option selected="">Open this select menu</option>
                    <option value="ACTIVE" {{ $data->status == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                    <option value="INACTIVE" {{ $data->status == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection