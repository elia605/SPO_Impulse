@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{$action->title}} <hr/><span class="badge badge-danger">Уже участвует: {{$members->count()}}/{{$action->members_max}}</span>
                            <span class="badge badge-light">Начало: {{$action->action_starts_at->format('d.m, H:i')}}</span>
                            <span class="badge badge-light">Окончание: {{$action->action_ends_at->format('d.m, H:i')}}</span></h3>
                    </div>
                    <div class="card-body">
                        <img class="card-img-top darken" src="{{asset('storage/img/actions/darken/'.$action->file->name)}}">
                        <p class="mt-2">{{$action->description}}</p>
                        <hr>
                        <span class="badge badge-light">{{\App\Models\User::find($action->user_id)->name}} / {{$action->created_at}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
