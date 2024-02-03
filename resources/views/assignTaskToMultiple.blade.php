@extends('layouts.app')
@section('title', $title)
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header mb-2">Assign Task </div>
            <div class="card-body">
                <form method="POST" action="{{route('assignTask.to.multiple')}}">
                    @csrf
                    <div class="row mb-3">
                        <label for="selectUser" class="col-md-4 col-form-label text-md-end">select users</label>

                        <div class="col-md-6">                                
                                <select name="assigned_users[]"  multiple class="form-select" aria-label="Default select example" id="selectUser">
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                </select>                           
                            
                        </div>
                    </div>
                    <input type="hidden" value="{{ Auth::user()->name }}" name="assign_by">


                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="title"
                                autocomplete="title" autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                        <div class="col-md-6">
                            <textarea id="description" type="text"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                autocomplete="description"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
