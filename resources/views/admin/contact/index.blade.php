@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pb-3">
                    <h2>Contacts</h2>
                </div>
                <div class="col-md-12 pb-3">
                    <a href="{{route('admin.contact.add')}}">
                        <button class="btn btn-info">Add contact</button>
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
                            All Contacts Data
                        </div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Address</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phome</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php($i = 1)
                            @foreach($contacts as $contact)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$contact->address}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>
                                        <a href="{{url('/admin/contact/edit/'.$contact->id)}}"
                                           class="btn btn-info">
                                            Edit
                                        </a>
                                        <a href="{{url('/admin/contact/delete/'.$contact->id)}}"
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

