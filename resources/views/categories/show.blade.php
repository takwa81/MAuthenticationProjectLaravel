@extends('layouts.layout')
@section('content')

<div class="center-text container">
        <div style="margin: 10px auto">
            <div class="text-center">
                <img class="rounded-circle" width="150" height="150"
                    src="{{ URL::to('/images/categories') }}/{{ $category->image }}" class="card-img-top" alt="...">
                <div style="margin-top: 10px;">
                    <h2 class="card-text">{{ $category->name }}</h2>
                </div>

            </div>
        </div>
        <br>
        <!-- <table class="table" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <thead>
                <tr class="text-center table-dark">
                    <th scope="col">id</th>
                    <th scope="col">category</th>
                    <th scope="col">name</th>
                    <th scope="col">image</th>
                    <th scope="col">price</th>
                    <th scope="col">description</th>
                    <th scope="col">controller</th>

                </tr>
            </thead>

            <tbody class="align-baseline  table-light">



                @foreach ($category->products as $item)
                    <tr class="text-center">
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>

                        <td>
                            <div>
                                <img class="rounded-circle" width="50" height="50"
                                    src="{{ URL::to('/images/products') }}/{{ $item->image }}">
                            </div>
                        </td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->description }}</td>

                        <td>
                            <div class="btn-group">

                                {{-- <a href="{{ route('categories.show', $item->id) }} " style="margin: 0 10px;">
                                    <button type="submit" class="btn btn-success">Show</button>
                                </a> --}}
                                <a href="{{ route('products.edit', $item) }}" style="margin:  0 10px;">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </a>
                                <form method="POST" action="{{ route('products.destroy', $item->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <div style="margin: 0 10px;" class="form-group">
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </div>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table> -->
        <div class="container mt-5">
        <div class="">
            <div class="">
                <div class="tm-bg-primary-dark tm-block tm-block-products">
                    <div class="tm-product-table-container">
                        <table class="table table-hover tm-table-small tm-product-table">
                            <thead>
                                <tr>
                                   
                                    <th scope="col">id</th>
                                    <th scope="col">image</th>
                                    <th scope="col">category</th>
                                    <th scope="col">name</th>
                                    <th scope="col">description</th>
                                    <th scope="col">price</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>                                </tr>
                            </thead>
                            <tbody>
                                
                            @foreach ($category->products as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <th scope="row">
                                    <div class=""><img src="{{ URL::to('/images/products') }}/{{ $item->image }}" alt="Avatar Image" class="rounded-circle" width="100" height="100"></div>
                                    </th>
                                    <td>{{ $item->category->name }}</td>
                                    <td class="tm-product-name">{{ $item->name }} </td>
                                    <td>{{ Illuminate\Support\Str::limit($item->description, 20) }}</td>
                                    
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
                </div>
            </div>
       
        </div>
    </div>
    </div>

@ensection