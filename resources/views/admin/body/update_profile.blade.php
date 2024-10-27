@extends('admin.admin_master')

@section('admin')

    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>User Profile Update</h2>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="card-body">
            <form
                method="POST"
                action="{{route('admin.user.profile.update',['id' => $user->id])}}"
            >
                @csrf
                <div class="form-group">
                    <label for="current_password">UserName</label>
                    <input
                        name="name"
                        type="text"
                        class="form-control"
                        id="current_password"
                        value="{{$user->name}}"
                    >
                    @error('old_password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        id="password"
                        value="{{$user->email}}"
                    >
                </div>
                <button class="btn btn-primary btn-default" type="submit">Save</button>
            </form>
        </div>
    </div>

@endsection
