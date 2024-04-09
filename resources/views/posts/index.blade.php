@extends('layouts.site')

@section('title', 'Posts')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">

            @if(session('success_msg'))

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Good Job!</strong> {{ session()->get('success_msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @endif

            <a href="{{ route('posts.create') }}" class="btn btn-info btn-sm text-white mb-2">New Post</a>

            <div class="card">
                <div class="card-header bg-info text-white">
                  Posts
                </div>
                <div class="card-body">

                    @if( count($posts) > 0 )
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                                @php $count = 1; @endphp
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'. $post->image) }}" alt="img" style="width: 50px; height: 30px">
                                        </td>
                                        <td>{{ Str::limit($post->title, 10) }}</td>
                                        <td>{{ Str::limit($post->description, 15) }}</td>

                                        {{-- {{ $post->status == 1 ? 'published': 'draft' }} --}}

                                        <td>
                                            @if($post->status == 1)
                                                <span class="badge text-bg-primary" style="font-size: 11px">published</span>
                                            @else
                                                <span class="badge text-bg-danger" style="font-size: 11px">draft</span>
                                            @endif
                                        </td>

                                        <td style="display: flex">
                                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success btn-sm"> <i class="fas fa-eye"></i> </a> &nbsp;
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a> &nbsp;
                                            <form class="destroy-form" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm deleteBtn"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>

                                @php $count++ @endphp

                                @endforeach


                            </tbody>

                        </table>
                    @else
                        <h6 class="text-danger text-center">No post found</h6>
                    @endif
                    {{ $posts->links() }}

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $('.deleteBtn').click(function(event) {

            event.preventDefault();

            if ( confirm('Are you sure you, want to delete it?') ) {

                $('.destroy-form').submit();

            }


        });

    });
</script>
@endsection
