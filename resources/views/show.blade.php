@extends('master/layout')

@section('style')
    <style>
        body {
            background-color: rgb(224, 224, 224);
        }

    </style>
@endsection
<!-- show this in title yield -->
@section('title')
    {{$post->title}}
@endsection

<!-- show this in content yield  in master layout-->
@section('content')
    <div class="row my-5">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10 mb-4">
                    <div class="card h-100 mb-4">
                        <img src="{{ asset('./uploads/'.$post->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5> 
                            <p class="card-text">{{$post->body}}
                        </div>
                    </div>
                    <a href="{{route('post.edit',$post->slug)}}" class="btn btn-primary">edit</a>
                 {{-- delete method 1 --}}
                    {{-- <a href="{{route('post.delete',$post->slug)}}" class="btn btn-primary">delete</a> --}}
                 {{-- delete method 2  seggesed by laravel using form--}}
                    <form id="{{$post->id}}" action="{{route('post.delete',$post->slug)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button 
                            onclick="event.preventDefault();
                                if(confirm('Are you sure'))
                                document.getElementById({{$post->id}}).submit();"
                                class="btn btn-danger" type="submit">
                            DELETE
                        </button>    
                    </form>    
                </div>
            </div>

        </div>

    </div>

@endsection
