@extends('layouts.layout')
@section('content')
<h2 style="text-align: center; color:white; margin-top:20px;">Producs List</h2>
<div>
    @if ($message = Session::get('success'))
        <br>
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
</div>
<div class="container mt-5">
        <div class="">
            <div class="">
                <div class="tm-bg-primary-dark tm-block tm-block-products">
                    <div class="tm-product-table-container">
                        <table class="table table-hover tm-table-small tm-product-table">
                            <thead>
                                <tr>
                                    <th scope="col">PRODUCT Image</th>
                                    <th scope="col">PRODUCT NAME</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            @foreach ($products as $item)
                                <tr>
                                    <th scope="row">
                                    <div class="tm-gray-circle"><img src="{{ URL::to('/images/products') }}/{{ $item->image }}" alt="Avatar Image" class="rounded-circle" width="100" height="100"></div>
                                    </th>
                                    <td class="tm-product-name">{{ $item->name }} </td>
                                    <td>{{ Illuminate\Support\Str::limit($item->description, 20) }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                    <a href="{{ route('products.edit', $item->id) }}" title="Edit Student"><button class="btn btn-info btn-sm" style="border-radius:15px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('products.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Product" onclick="return confirm('Are You Sure')" style="border-radius: 15px;"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- table container -->
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
                </div>
            </div>
       
        </div>
    </div>

@endsection