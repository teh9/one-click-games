@extends('layouts.app')

@section('title')
    Users page
@endsection
@section('content')
    <div class="container p-5">
        <button id="addUser" class="btn btn-success">Add new user</button>
        <table class="table table-bordered text-center align-middle mt-3">
            <thead>
                <tr>
                    <th scope="col">User name</th>
                    <th scope="col">User email</th>
                    <th scope="col">User age</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @foreach($users as $key => $value)
                <tr id="userId{{$value->id}}">
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->age }}</td>
                    <td>
                        <button onclick="updateUser({{$value->id}})"
                                class="btn btn-sm btn-primary">Edit
                        </button>
                        <button onclick="deleteUser({{$value->id}})"
                                class="btn btn-sm btn-danger">Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

@push('scripts')
<script type="text/javascript" src="js/application/users.js"></script>
@endpush
