@extends('layouts.user')
@section('title', 'Edit Task')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header mb-2">Assign Task </div>
                <div class="card-body">

                    <form action="{{ route('tasks.update', ['taskId' => $task->id]) }}" method="post">
                        @csrf
                        @method('put')

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

                        <!-- Add other form fields as needed -->

                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
