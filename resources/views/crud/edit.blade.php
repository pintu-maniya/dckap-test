@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Users</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{$user->name}}" required />
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{$user->email}}"  required />
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    <textarea class="form-control" style="height:150px" name="address" placeholder="Address">{{$user->address}}</textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>DOB:</strong>
                    <input type="date" name="dob" class="form-control" placeholder="YY/MM/DD" value="{{$user->dob}}" required />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Education:</strong>
                    <select name="education" class="form-control" placeholder="Education"  required>
                        <option>Select Education</option>
                        <option {{($user->education == 'bca') ? 'selected' : '' }} value="bca">B.C.A.</option>
                        <option {{($user->education == 'mca') ? 'selected' : '' }}  value="mca">M.C.A.</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <label class="radio-inline"><input type="radio" name="status" value="1" required {{ ($user->status == 1) ? 'checked' : '' }}   /> Active</label>
                    <label class="radio-inline"><input type="radio" name="status" value="0" required {{ ($user->status == 0) ? 'checked' : '' }}   /> Inactive</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pin code:</strong>
                    <input type="text" name="pincode" class="form-control" placeholder="Pin Code" value="{{$user->pincode}}" required />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Profile Pic:</strong>
                    <input type="hidden" name="old_profile_pic" class="form-control" placeholder="Profile_pic" value="{{$user->profile_pic}}" required />
                    <input type="file" name="profile_pic" class="form-control" placeholder="Profile_pic"  />
                    @if($user->profile_pic)
                        <img src="/uploads/{{ $user->profile_pic }}" width="100px">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Country:</strong>
                    <select name="country" id="country" class="form-control" placeholder="Country" required>
                        <option>Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{$country->name}}" {{ ($user->country == $country->name) ? 'selected' : '' }} data-id="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>City:</strong>
                    <input type="hidden" id="old_city" value="{{$user->city}}">
                    <select name="city" id="city" data-city="{{$user->city}}" class="form-control" placeholder="city" required>
                        <option >Select City</option>

                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
@push('custom-scripts')
    <script src="{{ asset('js/custom.js') }}" type="text/javascript" ></script>
@endpush
