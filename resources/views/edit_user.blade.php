@extends('layouts.app')
@section('title', $title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header mb-2">Add Admin or User </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('edit.user', ['userId' => $userId]) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" value="{{ old('name', $user->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    autocomplete="name" autofocus>

                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email id</label>

                            <div class="col-md-6">
                                <input id="email" type="email" value="{{ old('email', $user->email) }}"
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
                                <input id="phone" type="number" value="{{ old('phone', $user->phone) }}"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    autocomplete="email">


                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" value="{{ old('address', $user->address) }}" class="form-control"
                                    name="address">


                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pincode" class="col-md-4 col-form-label text-md-end">Pin Code</label>

                            <div class="col-md-6">
                                <input id="pincode" type="number" value="{{ old('pincode', $user->pincode) }}" class="form-control"
                                    name="pincode">
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
