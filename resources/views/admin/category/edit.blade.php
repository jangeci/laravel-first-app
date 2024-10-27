<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category - {{$category->category_name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{url('category/update/'.$category->id)}}" method="POST">
                                @csrf
                                <div class="form-group pb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Update category
                                        name</label>
                                    <input name="category_name" type="text" class="form-control"
                                           id="exampleFormControlInput1" value="{{$category->category_name}}">
                                    @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
