@extends('master/layout') <!-- is like import, from master layout to show header...-->


@section('style')
    <style>
        body {
         background-color: blue;
        }
    </style>
@endsection
<!-- show this in title yield -->
@section('title')        
    Welcome page
@endsection

<!-- show this in content yield  in master layout-->
@section('content')       
    <div class="row">
        <div class="col-md-8">
            <h1> hello from welcome page</h1>
        </div>
    
    </div>
@endsection



