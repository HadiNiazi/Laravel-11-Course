@extends('layouts.site')

@section('title', 'Edit Post')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">

            <a href="{{ route('admin.posts.index') }}" class="btn btn-info btn-sm mb-2 text-white">Go Back</a>

            <div class="card">
                <div class="card-header bg-info text-white">
                  Edit Post
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('alert-success'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Good Job!</strong> {{ session()->get('alert-success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @endif

                    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">

                        @csrf
                        @method('PATCH')

                        {{-- <input type="hidden" name="csrf-token" value="{{ csrf_token() }}"> --}}

                        <div class="mb-3">
                          <label class="form-label">Title</label>
                          <input type="text" name="title" class="form-control" placeholder="Enter your title" value="{{ old('title', $post->title) }}">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea class="form-control" name="description" rows="3" cols="10" placeholder="Description here...">{{ old('description', $post->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="" selected disabled>Choose Option</option>
                                <option @selected($post->status == 1) value="1">Yes</option>
                                <option @selected($post->status == 0) value="0">No</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
