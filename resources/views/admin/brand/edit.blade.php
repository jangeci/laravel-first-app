@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">

                        <div class="card-body">
                            <form action="{{url('brand/update/'.$brand->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{$brand->brand_image}}"/>
                                <div class="form-group pb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Update Brand
                                        name</label>
                                    <input name="brand_name" type="text" class="form-control"
                                           id="exampleFormControlInput1" value="{{$brand->brand_name}}">
                                    @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group pb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Update Brand
                                        Image</label>
                                    <input name="brand_image" type="file" class="form-control"
                                           id="exampleFormControlInput1" value="{{$brand->brand_image}}">
                                    @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group pb-3">
                                    <img src="{{asset($brand->brand_image)}}" style="height: 200px; width: auto;"/>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
