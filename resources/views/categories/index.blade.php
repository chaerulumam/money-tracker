@extends('layouts.base')

@section('title', 'Categories')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Categories</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <a href="{{ route('categories.create') }}" class="btn btn-warning">Create Categories</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info ml-1">Edit</a>
                                            </div>
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
    </div>
@endsection