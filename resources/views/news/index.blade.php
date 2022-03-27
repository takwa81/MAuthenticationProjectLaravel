@extends('layouts.layout')
@section('content')
<h2 style="text-align: center; color:white; margin-top:20px;">News List</h2>
<div>
    @if ($message = Session::get('success'))
        <br>
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
</div>

<div class="container">
  <a href="{{ route('news.create') }}" class="btn btn-info" style="border-radius: 20px;">Add new product</a>

</div>
<div class="container mt-5">
        <div class="">
            <div class="">
			<div class="row d-flex">
      @foreach ($news as $item)
          <div class="col-md-4 d-flex ftco-animate fadeInUp ftco-animated">
        
          	<div class="blog-entry align-self-stretch">
            <img src="{{ URL::to('/images/news') }}/{{ $item->image }}" alt="News Image" width="250" height="250">

             
              <div class="text py-4 d-block">
              	<div class="meta">
                  <div>{{ date('d-m-Y', strtotime($item->updated_at)); }}</div>
                </div>
                <h3 class="heading mt-2">{{$item->name}}</h3>
                <p>{{$item->description}}</p>
              <div class="row d-flex">
                <div class="col-md-4">
                  <a href="{{ route('news.edit', $item->id) }}" title="Edit Student"><button class="btn btn-info btn-sm" style="border-radius:15px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                </div>
              
              <div class="col-md-4">
              <a href="{{ route('news.show', $item->id) }}" title="Edit Student"><button class="btn btn-warning btn-sm" style="border-radius:15px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>View</button></a>
              </div>
              <div class="col-md-4">
              <form method="POST" action="{{ route('news.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger btn-sm" title="Delete News" onclick="return confirm('Are You Sure')" style="border-radius: 15px;"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
              </form>
                </div>
              </div>
              </div>
             
            </div>
            
          </div>
        @endforeach
        </div>
            </div>
       
        </div>
    </div>

@endsection