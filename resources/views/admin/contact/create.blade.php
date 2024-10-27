@extends('admin.admin_master')

@section('admin')

    <div class="card card-default">
        <div class="col-lg-12">
            <div class="card-header card-header-border-bottom">
                <h2>Create Contact</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.contact.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Address</label>
                        <input type="text" name="address" class="form-control" id="exampleFormControlInput1"
                               placeholder="Enter address">
                        @error('address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlPassword2">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleFormControlInput2"
                               placeholder="Enter phone">
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlPassword3">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput3"
                               placeholder="Enter email">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>

@endsection
