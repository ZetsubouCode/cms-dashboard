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
            <h4 class="card-title">Input Product</h4>
        </div>
    </div>
    
    <div class="card-body">
        <p>Please fill out the details below to add a new product</p> 
        <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Name </label>
                <input type="text" class="form-control" id="name" value="" placeholder="Enter Name" name="name" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="description" rows="5" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Product Category</label>
                <select class="form-select mb-3 shadow-none" name="category_id">
                    <option selected="">Open this select menu</option>
                    @foreach ($category as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Price </label>
                <input type="number" class="form-control" id="price" value="1" placeholder="Enter Price" name="price" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Quantity </label>
                <input type="number" class="form-control" id="quantity" value="1" placeholder="Enter Quantity" name="quantity" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="customFile">Upload Image</label>
                <input type="file" class="form-control" id="upload_image" name="product_image" accept="image/*">
            </div>
            <div id="imagePreview" style="display:none; margin-top: 1rem; margin-bottom: 1.25rem;">
                <img id="previewImg" src="" alt="Image Preview" style="max-width: 150px; max-height: 150px; object-fit: cover; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select class="form-select mb-3 shadow-none" name="status">
                    <option selected="">Open this select menu</option>
                    <option value="AVAILABLE">AVAILABLE</option>
                    <option value="NOT AVAILABLE">NOT AVAILABLE</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit" class="btn btn-danger">cancel</button>
        </form>
    </div>
</div>
@endsection
