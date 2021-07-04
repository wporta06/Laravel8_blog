@extends('master/layout')

@section('style')
    <style>
        body {
            background-color: rgb(219, 219, 219);
        }

    </style>
@endsection
<!-- show this in title yield -->
@section('title')
    home page
@endsection

<!-- show this in content yield  in master layout-->
@section('content')
    <div class="row my-5">
        <div class="col-md-8 mx-auto">
            {{-- to show alert if error in input --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- ------------------------------- --}}
            <div class="row">
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <textarea class="form-control" name="body" placeholder="Description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>

@endsection
