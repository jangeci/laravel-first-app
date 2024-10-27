@extends('admin.admin_master')

@section('admin')

    <div class="card card-default">
        <div class="col-lg-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card-header card-header-border-bottom">
                <h2>Create Slide</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('home.slider.update', ['id'=> $slide->id])}}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="old_image" value="{{$slide->image}}"/>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               id="exampleFormControlInput1"
                               placeholder="Enter Title"
                               value="{{$slide->title}}"
                        />
                        @error('title')
                        <span class=" text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlPassword">Description</label>
                        <textarea type="text"
                                  name="description"
                                  rows="3"
                                  class="form-control"
                                  id="exampleFormControlPassword"
                                  placeholder="Description"
                        >{{$slide->description}}</textarea>
                        @error('description')
                        <span class=" text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Image</label>
                        <input
                            type="file"
                            name="image"
                            class="form-control-file"
                            id="exampleFormControlFile1"
                            value="{{$slide->image}}"
                        >
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group pb-3">
                        <img src="{{asset($slide->image)}}" style="height: 200px; width: auto;"/>
                    </div>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update slide</button>
                    </div>
                </form>
            </div>

@endsection
