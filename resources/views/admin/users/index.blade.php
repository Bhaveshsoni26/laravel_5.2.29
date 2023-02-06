@extends('layouts.admin')

@section('content')

<h1 class="page-header">Users</h1>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        
        @if($users)
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td><img height="40" width="50" src="{{ $user->photo ? $user->photo->file : 'https://picsum.photos/50/40' }}" alt=""></td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->roles->name }}</td>
            <td>{{ $user->is_active == 1 ? 'Active' : 'Not Active' }}</td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
            <td>{{ $user->updated_at->diffForHumans() }}</td>
            <td>
                {!! Form::open(['method'=>'POST', 'action'=>['AdminUsersController@destroy', $user->id], 'method'=>'DELETE' ]) !!}

                    <!-- {{Form::hidden('_method', 'DESTROY')}} -->
                    
                    <!-- {{Form::submit('', ['class' => 'fa fa-trash-o fa-lg'])}} -->
                    <button type="submit" class="fa fa-trash-o btn btn-danger"></button>
                    <!-- <i class="fa fa-trash-o fa-lg"></i> -->
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="fa fa-pencil btn btn-primary"></a>
                {!! Form::close() !!}
                
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

@endsection