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


                        <table class="table" id="posts_table">
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
                            <tbody></tbody>

                        </table>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#posts_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.posts.index') }}",

            columns: [
                {data: 'id', 'name': 'id'},
                {data: 'image'},
                {data: 'title'},
                {data: 'description'},
                {data: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });


        $('body').on('click', '.delBtn', function() {
            let post_id = $(this).data('id');

            if (confirm('Are you sure, you want to delete it!')) {
                $.ajax({
                    method: 'DELETE',
                    url: '{{ route("admin.posts.destroy", "") }}' + '/'+ post_id,
                    // data: {post_id},
                    success: function(response) {

                        if (response.message) {

                            table.draw();

                            $('#success_msg').show();
                            $('#success_msg').html(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            }

        });

        $('#saveBtn').click(function() {

            $('.error_msgs').html('');

            var formData = new FormData($('#post_form')[0]);

            $.ajax({
                method: 'POST',
                url: '{{ route("admin.posts.store") }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    if (response.message) {

                        $('#success_msg').show();
                        $('#success_msg').html(response.message);

                        $('#exampleModal').modal('hide');

                        table.draw();
                    }
                },
                error: function(error) {

                    if (error.responseJSON.errors) {
                        $('#title_error').html(error.responseJSON.errors.title);
                        $('#description_error').html(error.responseJSON.errors.description);
                        $('#image_error').html(error.responseJSON.errors.image);
                    }


                    // console.log(error.responseJSON.errors.image[0])
                }
            });

        });

        $('#new_post_btn').click(function() {
            $('#post_form').trigger("reset");
        });

        // $('.deleteBtn').click(function(event) {

        //     event.preventDefault();

        //     if ( confirm('Are you sure you, want to delete it?') ) {

        //         $('.destroy-form').submit();

        //     }


        // });

    });
</script>
@endsection
