@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header mb-2">Assign Task </div>
            <div class="card-body">

                <form action="{{ route('update.task', ['taskId' => $task->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
                        <div class="col-md-6">
                            <input id="title" type="text"
                                class="form-control" name="title"
                                  value="{{ old('title', $task->title) }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                        </div>
                    </div>      
                    <input id="" type="hidden"
                    class="form-control" name="user_id"
                      value="{{$task->user_id}}">                      
                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                        <div class="col-md-6">
                            <input id="description" type="text"
                                class="form-control"  name="description"
                                
                                value="{{ old('description', $task->description) }}">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status" class="col-md-4 col-form-label text-md-end">Status</label>

                        <div class="col-md-6">
                            <select name="status" style="width: 100%; height:35px;">
                                <option value="Incomplete"
                                    {{ old('status', $task->status) === 'Incomplete' ? 'selected' : '' }}>
                                    Incomplete</option>
                                <option value="completed"
                                    {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
