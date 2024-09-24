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
            <h4 class="card-title">Input Supply</h4>
        </div>
    </div>
    
    <div class="card-body">
        <p>Please fill out the details below to add a new supply</p> 
        <form action="{{ route('supply.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Name </label>
                <input type="text" class="form-control" id="exampleInputText1" value="" placeholder="Enter Name" name="name" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Price per Unit </label>
                <input type="number" class="form-control" id="exampleInputText1" value="1" placeholder="Enter Price" name="price_per_unit" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Unit of Measurement </label>
                <input type="text" class="form-control" id="exampleInputText1" value="" placeholder="Enter Unit of Measurement" name="unit_of_measurement" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Quantity </label>
                <input type="number" class="form-control" id="exampleInputText1" value="1" placeholder="Enter Quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Date Aquired </label>
                <input type="date" class="form-control" id="exampleInputText1" name="date_aquired" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Location </label>
                <input type="text" class="form-control" id="exampleInputText1" value="" placeholder="Enter Location" name="location">
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Supplier Name </label>
                <input type="text" class="form-control" id="exampleInputText1" value="" placeholder="Enter Supplier Name" name="supplier_name">
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Low Stock Percentage </label>
                <input type="number" class="form-control" id="exampleInputText1" value="10" placeholder="Enter Percentage" name="low_stock_percentage" min="0" max="100" step="0.01" required>
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select class="form-select mb-3 shadow-none" name="status">
                    <option selected="">Open this select menu</option>
                    <option value="IN STOCK">IN STOCK</option>
                    <option value="PRE-ORDER">PRE-ORDER</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit" class="btn btn-danger">cancel</button>
        </form>
    </div>
</div>
@endsection
