@extends('layouts.site')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">

            <div class="card">
                <div class="card-header bg-info">
                  Create Post
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('posts.store') }}">

                        @csrf

                        {{-- <input type="hidden" name="csrf-token" value="{{ csrf_token() }}"> --}}

                        <div class="mb-3">
                          <label class="form-label">Title</label>
                          <input type="text" name="title" class="form-control" placeholder="Enter your title">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea class="form-control" name="description" rows="3" cols="10" placeholder="Description here..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
