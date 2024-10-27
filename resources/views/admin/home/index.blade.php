@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pb-3">
                    <h2>Home About</h2>
                </div>
                <div class="col-md-12 pb-3">
                    <a href="{{route('home.about.add')}}">
                        <button class="btn btn-info">Add about</button>
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
                            All About Data
                        </div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Title</th>
                                <th scope="col">Short Description</th>
                                <th scope="col">Long Description</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php($i = 1)
                            @foreach($homeAbout as $about)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$about->title}}</td>
                                    <td>
                                        {{$about->short_description}}
                                    </td>
                                    <td>
                                        {{$about->long_description}}
                                    </td>
                                    <td>
                                        <a href="{{route('home.about.edit', ['id' => $about->id])}}"
                                           class="btn btn-info">
                                            Edit
                                        </a>
                                        <a href="{{url('/home/about/delete/'.$about->id)}}"
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

