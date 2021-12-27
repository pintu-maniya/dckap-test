@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Users</a>
            </div>
            <br>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
    <br>
    <table id="myTable" class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>DOB</th>
            <th>Status</th>
            <th>Education</th>
            <th>Pin Code</th>
            <th>Profile Pic</th>
            <th>County</th>
            <th>City</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($users as $key =>$user)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ date('d-m-Y',strtotime($user->dob)) }}</td>
                <td>
                    @if($user->status == 1)
                    <span class="text-success">Active</span>
                    @else
                        <span class="text-danger">Inactives</span>
                    @endif
                <td>{{ $user->education }}</td>
                <td>{{ $user->pincode }}</td>
                <td> @if($user->profile_pic)
                        <img src="/uploads/{{ $user->profile_pic }}" width="100px"></td>
                     @endif
                <td>{{ $user->country }}</td>
                <td>{{ $user->city }}</td>
                <td>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection

