@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-header">
                            All Brands
                        </div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">SL NO</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            {{--                            @php($i = 1)--}}
                            @foreach($brands as $brand)
                                <tr>
                                    <th scope="row">{{$brands->firstItem() + $loop->index}}</th>
                                    <td>{{$brand->brand_name}}</td>
                                    <td><img style="height:200px; width: auto" src="{{asset($brand->brand_image)}}" alt=""/></td>
                                    <td>
                                        @if($brand->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                        @else
                                            {{--{{$category->created_at->diffForHumans()}}--}}
                                            {{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-info">
                                            Edit
                                        </a>
                                        <a href="{{url('brand/delete/'.$brand->id)}}"
                                           onclick="return confirm('Do you really want to delete this ?')"
                                           class="btn btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{$brands->links()}}

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Brand Name
                        </div>
                        <div class="card-body">
                            <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group pb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Brand name</label>
                                    <input name="brand_name" type="text" class="form-control" id="exampleFormControlInput1">
                                    @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group pb-3">
                                    <label for="exampleFormControlInput2" class="form-label">Brand Image</label>
                                    <input name="brand_image" type="file" class="form-control" id="exampleFormControlInput2">
                                    @error('brand_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
