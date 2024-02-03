@extends('layouts.user')
{{-- @section('title', $title) --}}

@section('content')
<div class="row justify-content-center">            
    <div class="col-md-9">
        <div class="card">
            <div class="card-header mb-2">List of all Task </div>
            <div class="card-body">
                
                
                <table class="table" id="dataTable" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Owner's name</th>                                    
                            <th scope="col">Status</th>                                    
                            <th scope="col">Edit</th>                                    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->assign_by }}</td>
                                <td>{{ $task->status }}</td>
                                {{-- <td><a href="" class="btn btn-primary">Edit</a></td>      --}}
                                <td><a href="{{ route('tasks.edit.user', ['taskId' => $task->id]) }}" class="btn btn-primary">Edit</a></td>

                            </tr>
                        @endforeach


                    </tbody>

                </table>
                {{ $tasks->links() }}

               
            </div>
        </div>
    </div>

</div>
@endsection
