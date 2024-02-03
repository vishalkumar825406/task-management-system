@extends('layouts.app')
@section('title', $title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header mb-2">Add Admin or User </div>
            <div class="card-body">
                <form method="POST" action="{{route('add.user')}}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                autocomplete="name" autofocus>

                        </div>
                    </div>
                   

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email id</label>

                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">Phone no:</label>

                        <div class="col-md-6">
                            <input id="phone" type="number"
                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                autocomplete="email">


                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address">


                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pincode" class="col-md-4 col-form-label text-md-end">Pin Code</label>

                        <div class="col-md-6">
                            <input id="pincode" type="number" class="form-control" name="pincode">


                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                        <label for="role" class="col-md-4 col-form-label text-md-end">Role</label>

                        <div class="col-md-6">
                            <select name="role" class="form-select" aria-label="Default select example" id="role">
                                <option selected>Select  </option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>                                 
                                                     
                            </select>                                   
                            
                        </div>
                    </div> --}}
                   

                   



                    <div class="row mb-3">
                        <label for="password"
                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="new-password">


                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                        <div class="col-md-6 offset-md-4">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
