@extends('admin.admin_master')

@section('admin')

    <div class="card card-default">
        <div class="col-lg-12">
            <div class="card-header card-header-border-bottom">
                <h2>Edit Home About</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('home.about.update', ['id'=> $homeAbout->id])}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                               placeholder="Enter Title"
                               value="{{$homeAbout->title}}"
                        >
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlPassword">Short Description</label>
                        <textarea type="text" name="short_description" rows="3" class="form-control"
                                  id="exampleFormControlPassword"
                                  placeholder="Short Description">{{$homeAbout->short_description}}</textarea>
                        @error('short_description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlPassword2">Long Description</label>
                        <textarea type="text" name="long_description" rows="3" class="form-control"
                                  id="exampleFormControlPassword2"
                                  placeholder="Long Description">{{$homeAbout->long_description}}</textarea>
                        @error('long_description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>

@endsection
