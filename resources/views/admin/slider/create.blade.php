@extends('admin.admin_master')

@section('admin')

    <div class="card card-default">
        <div class="col-lg-12">
            <div class="card-header card-header-border-bottom">
                <h2>Create Slide</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('home.slider.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                               placeholder="Enter Title">
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlPassword">Description</label>
                        <textarea type="text" name="description" rows="3" class="form-control"
                                  id="exampleFormControlPassword"
                                  placeholder="Description"></textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Image</label>
                        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>

@endsection
