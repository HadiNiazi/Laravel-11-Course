@extends('layouts.site')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">

            <div class="card">
                <div class="card-header bg-info">
                  Show Post
                </div>
                <div class="card-body">

                    Post Id is {{ $id }}

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
