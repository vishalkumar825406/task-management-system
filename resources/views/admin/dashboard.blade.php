@extends('layouts.app')

@section('content')
    {{-- <div class="jumbotron"> --}}
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
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header mb-2">List of all Users &nbsp;&nbsp;&nbsp;&nbsp;<a href="{{route('assignTask.multiple')}}" class="btn btn-success">Add Task</a></div>
                    <div class="card-body">
                        <table class="table" id="dataTable" class="display">
                            <thead>
                                <tr>
                                    <th scope="col">Sno</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Assign Task</th>
                                    <th scope="col">View Assigned Task</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersWithRoleTwos as $usersWithRoleTwo)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{!! $usersWithRoleTwo->name !!}</td>
                                        <td>{!! $usersWithRoleTwo->email !!}</td>
                                        <td>{!! $usersWithRoleTwo->phone !!}</td>
                                        <td><a href="{{ route('add.assignTask', ['assignId' => $usersWithRoleTwo->id]) }}" class="btn btn-success">Assign</a></td>
                                            <td><a href="{{route('view.assignTask', ['assignId' => $usersWithRoleTwo->id])}}" class="btn btn-info">View</a> </td>
                                        <td><a href="{{ route('editUser', ['userId' => $usersWithRoleTwo->id]) }}" class="btn btn-primary">Edit</a></td>

                                        <td>
                                            {{-- <a href="{{ route('delete.user', ['userId' => $usersWithRoleTwo->id]) }}" class="btn btn-danger">Delete</a> --}}
                                            <form method="POST" action="{{ route('delete.user', ['userId' => $usersWithRoleTwo->id]) }}">
                                                @csrf
                                                @method('POST') <!-- This is used to override the HTTP method to POST -->
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        </td> 
                                    </tr>
                                @endforeach


                            </tbody>

                        </table>

                    </div>
                </div>
            </div>

        </div>
    {{-- </div> --}}
@endsection
