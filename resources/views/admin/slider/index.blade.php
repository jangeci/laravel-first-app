@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pb-3">
                    <h2>Home Slider</h2>
                </div>
                <div class="col-md-12 pb-3">
                    <a href="{{route('home.slider.create')}}">
                        <button class="btn btn-info">Add slide</button>
                    </a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card-header">
                            All Slides
                        </div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php($i = 1)
                            @foreach($slides as $slide)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$slide->title}}</td>
                                    <td>
                                        {{$slide->description}}
                                    </td>
                                    <td><img style="height:200px; width: auto" src="{{asset($slide->image)}}" alt=""/>
                                    </td>
                                    <td>
                                        <a href="{{route('home.slider.edit', ['id' => $slide->id])}}"
                                           class="btn btn-info">
                                            Edit
                                        </a>
                                        <a href="{{url('/home/slider/delete/'.$slide->id)}}"
                                           onclick="return confirm('Do you really want to delete this ?')"
                                           class="btn btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
