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
    <div class="col-md-8">
        {{-- show alert after inserting data & redirected to home --}}
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>    
        @endif        
        <div class="row">
            @foreach( $posts as $post)
            <div class="col-md-4 mb-4" >
                <div class="card h-100 mb-4">
                    <img src="{{ asset('./uploads/'.$post->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{Str::limit($post->body,50)}}     {{-- to show just 50 letters --}}
                           <a href="{{route('post.show',$post->slug)}}" class="btn btn-primary">See More</a>  {{-- route() to send to page show with the id to --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{-- ??§§§!! --}}
        <div class="d-flex justify-content-center mb-4">
            {{ $posts->links() }}
        </div>
    </div>

</div>

@endsection