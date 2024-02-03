@extends('layouts.app')
@section('title', $title)

@section('content')
@if (session('success'))
<div id="flash-message" class="alert alert-success">
    {{ session('success') }}
</div>

<script>
    // Wait for 5 seconds (5000 milliseconds) and then hide the flash message
    setTimeout(function() {
        document.getElementById('flash-message').style.display = 'none';
    }, 3000);
</script>
@endif

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
                            <th scope="col">Delete</th>                                    
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
                                {{-- <td><a href="" class="btn btn-primary">Edit</a></td> --}}
                                <td><a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary">Edit</a></td>
                                {{-- @if ($task->admin_id == Auth::user()->id)
                                @else
                                    <td><a href="" class="btn btn-secondary disabled" aria-disabled="true">Edit</a></td>
                                @endif --}}

                                <td>
                                    <form action="{{ url('/delete-task', ['id' => $task->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>





                               

                                

                                    {{-- @if ($task->admin_id == Auth::user()->id)
                                  
                                @else
                                    <td><a href="" class="btn btn-secondary disabled" aria-disabled="true">Delete</a></td>
                                @endif --}}
                                    
                                </form>
                                  
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
