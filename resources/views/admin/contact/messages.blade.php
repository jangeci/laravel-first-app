@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pb-3">
                    <h2>Messages</h2>
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
                            All Messages Data
                        </div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($messages as $message)
                                <tr>
                                    <th scope="row">{{$messages->firstItem() + $loop->index}}</th>
                                    <td>{{$message->name}}</td>
                                    <td>{{$message->subject}}</td>
                                    <td>{{$message->email}}</td>
                                    <td>{{$message->message}}</td>
                                    <td>
                                        <a href="{{url('/admin/contact/message/delete'.$message->id)}}"
                                           onclick="return confirm('Do you really want to delete this ?')"
                                           class="btn btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$messages->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

