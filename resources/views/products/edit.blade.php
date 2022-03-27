@extends('layouts.layout')
@section('content')
<div class="container tm-mt-big tm-mb-big">
        <div class="row">
            <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Edit Product</h2>
                        </div>
                        
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                        <br>

                    @endif
                    </div>
                    <div class="row tm-edit-product-row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <form class="tm-edit-product-form" method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="form-group mb-3">
                                    <label for="name">Product Name
                    </label>
                                    <input id="name" name="name" type="text" value="{{$product->name}}" class="form-control validate" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Product Price
                    </label>
                                    <input id="name" name="price" type="bumber" value="{{$product->price}}" class="form-control validate" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description</label
                    >
                    <input id="name" name="description" type="text" value="{{$product->description}}" class="form-control validate" />

                     </div>
                  <div class="form-group mb-3">
                    <label
                      for="category"
                      >Category</label
                    >
                    <select
                      class="custom-select tm-select-accounts"
                      id="category"
                    >
                      <option>Select category</option>
                      @foreach ($categories as $category)
                        <option value="{{ $category->id}}">{{ $category->name }}</option>
                    @endforeach
                    </select>
                  </div>
                  

                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                        <div class="tm-product-img-edit mx-auto">
                            <img src="{{ URL::to('/images/products') }}/{{ $product->image }}" alt="Product image" class="img-fluid d-block mx-auto">
                            <i class="fas fa-cloud-upload-alt tm-upload-icon" onclick="document.getElementById('fileInput').click();"></i>
                        </div>
                        <div class="custom-file mt-3 mb-3">
                            <input id="fileInput" type="file" style="display:none;" name="image" />
                            <input type="button"  class="btn btn-primary btn-block mx-auto" value="CHANGE IMAGE NOW" onclick="document.getElementById('fileInput').click();" />
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase">Update Now</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection