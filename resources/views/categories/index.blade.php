@extends('layouts.layout')
@section('content')
<h2 style="text-align: center; color:white; margin-top:20px;">Caregories List</h2>
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
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Category Image</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                <tr>
                                <td class="tm-product-name">{{ $item->name }} </td>
                                    <th scope="row">
                                    <div class=""><img src="{{ URL::to('/images/categories') }}/{{ $item->image }}" alt="Avatar Image" class="rounded-circle" width="100" height="100"></div>
                                    </th>
                                    <td>
                                    <a href="{{ route('categories.show', $item->id) }}" title="Edit Student"><button class="btn btn-warning btn-sm" style="border-radius:15px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>View</button></a>
                                    </td>
                                    <td>
                                    <a href="{{ route('categories.edit', $item->id) }}" title="Edit Student"><button class="btn btn-info btn-sm" style="border-radius:15px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('categories.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
                    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-block text-uppercase mb-3">Add new Category</a>
                </div>
            </div>
       
        </div>
    </div>

@endsection