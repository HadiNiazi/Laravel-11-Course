@extends('layouts.site')

@section('title', 'Create Post')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">

            <div class="card">
                <div class="card-header bg-info">
                  Create Post
                </div>
                <div class="card-body">

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    @if(session('success_msg'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Good Job!</strong> {{ session()->get('success_msg') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @endif

                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">

                        @csrf

                        {{-- <input type="hidden" name="csrf-token" value="{{ csrf_token() }}"> --}}

                        <div class="mb-3">
                          <label class="form-label">Title</label>
                          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror " placeholder="Enter your title" value="{{ old('title') }}">
                          @error('title')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" cols="10" placeholder="Description here...">{{ old('description') }}</textarea>
                          @error('description')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
