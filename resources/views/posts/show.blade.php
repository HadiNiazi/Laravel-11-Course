@extends('layouts.site')

@section('title', 'Show Post')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">

            {{-- <a href="{{ url()->previous() }}" class="btn btn-info btn-sm mb-2 text-white">Go Back</a> --}}

            <a href="{{ route('admin.posts.index') }}" class="btn btn-info btn-sm mb-2 text-white">Go Back</a>

            <div class="card">

                <div class="card-header bg-info text-white">
                  Show Post
                </div>
                <div class="card-body">


                    <table class="table">
                        <tr>
                            <th style="width:10%">Title</th>
                            <td>{{ $post->title }}</td>

                        </tr>

                        <tr>
                            <th style="width:10%">Description</th>
                            <td>{{ $post->description }}</td>
                        </tr>

                        <tr>
                            <th style="width:10%">Status</th>
                            <td>
                                @if($post->status == 1)
                                    <span class="badge text-bg-primary" style="font-size: 11px">published</span>
                                @else
                                    <span class="badge text-bg-danger" style="font-size: 11px">draft</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th style="width:10%">Created At</th>
                            {{-- <td>{{ $post->created_at ? $post->created_at->diffForHumans() : '' }}</td> --}}

                            <td>{{ $post->created_at != null ? date('D d M Y', strtotime($post->created_at)) : '' }}</td>

                        </tr>

                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
