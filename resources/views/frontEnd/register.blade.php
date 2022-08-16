@extends('frontEnd.layout')
@push('title')
    <title>Register</title>
@endpush
@section('content')
@if(session()->has('message'))
<div class="alert alert-success" style="font-weight: 200;">
   {{session('message')}}
</div>
   @endif
<section id="aa-myaccount">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
         <div class="aa-myaccount-area">
             <div class="row">
               <div class="col-md-12">
                 <div class="aa-myaccount-register">
                  <h4>Register</h4>
                  <form action="{{ url('/add-customer') }}" method="POST"  class="aa-login-form">
                    @csrf
                     <label for="">Username<span>*</span></label>
                     <input type="text"  name="username" placeholder="Username">
                     <span class="text-danger">
                        @error('username')
                            {{$message}}
                        @enderror
                        </span>
                     <label for="">Email<span>*</span></label>
                     <input type="email" name="email" placeholder="Email">
                     <span class="mb-3 text-danger">
                        @error('email')
                            {{$message}}
                        @enderror
                        </span>
                     <label for="">Mobile<span>*</span></label>
                     <input type="number" name="mobile" placeholder="Mobile">
                     <span class="mb-3 text-danger">
                        @error('mobile')
                            {{$message}}
                        @enderror
                        </span>
                     <label for="">Password<span>*</span></label>
                     <input type="password" name="password" placeholder="Password">
                     <span class="mb-3 text-danger">
                        @error('password')
                            {{$message}}
                        @enderror
                        </span>
                     <label for="">Confirm Password<span>*</span></label>
                     <input type="password" name="confirm_password" placeholder="Confirm Password">
                     <span class="mb-3 text-danger">
                        @error('confirm_password')
                            {{$message}}
                        @enderror
                        </span>
                     <button type="submit" class="aa-browse-btn">Register</button>
                   </form>
                 </div>
               </div>
             </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
