@extends('auth.layout')
@section('content')
<div class="container">
<h1 class="tm-block-title mb-4" style="text-align: center; margin-top:40px; font-size:30px">Welcome to Dashboard <br>Login</h1>
</div>
<div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-12 mx-auto tm-login-col">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12 text-center">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form method="POST" action="/login-user" class="tm-login-form">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input
                      name="email"
                      type="text"
                      class="form-control validate"
                      id="email"
                      value="{{old('email')}}"
                      required
                    />
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input
                      name="password"
                      type="password"
                      class="form-control validate"
                      id="password"
                      value=""
                      required
                    />
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>

                  </div>
                  <div class="form-group mt-4">
                    <button
                      type="submit"
                      class="btn btn-primary btn-block text-uppercase"
                    >
                      Login
                    </button>
                  </div>
               
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection