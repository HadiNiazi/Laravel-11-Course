@extends('layouts.site')

@section('title', 'Posts')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">

            <div>
                <span id="success_msg" class="alert-success alert" style="display: none"></span>
            </div><br>

            <div>
                <span id="error_msg" class="alert-danger alert" style="display: none"></span>
            </div><br>
            {{-- @if(session('success_msg'))

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Good Job!</strong> {{ session()->get('success_msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @endif --}}

            <a href="javascript:void(0)" id="new_post_btn" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info btn-sm text-white mb-2">New Post</a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="post_form">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter your title">
                                    <span id="title_error" class="text-danger error_msgs"></span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" cols="10" rows="3" placeholder="Enter desc..." class="form-control"></textarea>
                                    <span id="description_error" class="text-danger error_msgs"></span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    <span id="image_error" class="text-danger error_msgs"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="saveBtn" type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-info text-white">
                  Posts
                </div>
                <div class="card-body">


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->description }}</td>

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

@section('scripts')
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
@endsection
