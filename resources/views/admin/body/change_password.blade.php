@extends('admin.admin_master')

@section('admin')

    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
        </div>
        <div class="card-body">
            <form
                method="POST"
                action="{{route('admin.password.update')}}"
                autocomplete="off"
                >
                @csrf
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input
                        autoComplete='off'
                        name="old_password"
                        type="password"
                        class="form-control"
                        id="current_password"
                        placeholder="Current Password">
                    @error('old_password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input
                        autoComplete='off'
                        type="password"
                        name="password"
                        class="form-control"
                        id="password"
                        placeholder="New Password">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input
                        autoComplete='off'
                        type="password"
                        name="confirm_password"
                        class="form-control"
                        id="confirm_password"
                        placeholder="Confirm Password">
                    @error('confirm_password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <button class="btn btn-primary btn-default" type="submit">Save</button>
            </form>
        </div>
    </div>

@endsection
