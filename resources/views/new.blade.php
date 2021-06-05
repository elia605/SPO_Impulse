@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{$new->title}} </div>
                    <div class="card-body">
                        <img class="card-img-top darken" src="{{asset('storage/img/news/'.$new->file->name)}}">
                        <p class="mt-2">{{$new->text}}</p>
                        <hr>
                        <span class="badge badge-light">{{$new->user->name}} / {{$new->created_at}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
