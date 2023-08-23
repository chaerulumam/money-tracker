@extends('layouts.base')

@section('title', 'Update')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Update Category</h3>
            </div>

            <form action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $category->title }}" placeholder="e.g Gaji, Token, SPayLater">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection