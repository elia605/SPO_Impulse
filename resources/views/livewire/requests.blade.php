<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Заявки
                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                            @if ($type === 1)
                                <button type="button" wire:click="$set('type', 1)"
                                        class="btn btn-outline-primary active float-right">На вступление в СПО <span
                                        class="badge badge-danger">{{$members->where('status', 'unread')->count()}}</span>
                                </button>
                                <button type="button" wire:click="$set('type', 2)"
                                        class="btn btn-outline-primary float-right">На организацию мероприятия <span
                                        class="badge badge-danger">{{$actions->where('status', 'unread')->count()}}</span>
                                </button>
                            @elseif ($type === 2)
                                <button type="button" wire:click="$set('type', 1)"
                                        class="btn btn-outline-primary float-right">На вступление в СПО <span
                                        class="badge badge-danger">{{$members->where('status', 'unread')->count()}}</span>
                                </button>
                                <button type="button" wire:click="$set('type', 2)"
                                        class="btn btn-outline-primary active float-right">На организацию мероприятия
                                    <span
                                        class="badge badge-danger">{{$actions->where('status', 'unread')->count()}}</span>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="accordion">
                            @if ($type === 1)
                                @if ($members->count() > 0)
                                @foreach ($members as $member)
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse"
                                                        data-target="#member{{$member->id}}"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                    Заявка на вступление №{{$member->id}} от {{$member->FIO}}
                                                    @if ($member->status === 'unread')
                                                        / <span class="badge badge-danger">{{$member->created_at->diffForHumans()}}</span>
                                                    @endif
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="member{{$member->id}}" class="collapse" aria-labelledby="headingOne"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-auto">
                                                        <img src="{{asset('storage/img/members/'.$member->file->name)}}"
                                                             alt="" class="img img-thumbnail">
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <table class="table table-striped table-bordered">
                                                            <tr>
                                                                <td>ФИО</td>
                                                                <td>Статус</td>
                                                                <td>Группа</td>
                                                                <td>Дата рождения</td>
                                                                <td>Телефон</td>
                                                                <td>Почта</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{$member->FIO}}</td>
                                                                <td>{{$member->role}}</td>
                                                                <td>{{$member->group}}</td>
                                                                <td>{{$member->birthday}}</td>
                                                                <td>{{$member->phone}}</td>
                                                                <td>{{$member->email}}</td>
                                                            </tr>
                                                        </table>
                                                        @if ($member->status === 'unread')
                                                            <button class="btn btn-success" wire:click="acceptMemberRequest({{$member}})">Принять</button>
                                                            <button class="btn btn-danger" wire:click="rejectMemberRequest({{$member}})">Отклонить</button>
                                                        @else
                                                            <hr>
                                                            Заявка отклонена <button class="btn btn-success" wire:click="acceptMemberRequest({{$member}})">Я передумал!</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    Нет новых заявок
                                @endif
                            @elseif($type === 2)
                                @if ($actions->count() > 0)
                                @foreach ($actions as $key => $action)
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse"
                                                        data-target="#action{{$key}}"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                    Заявка на мероприятие №{{$action->id}} от {{$action->user->name}}
                                                    @if ($action->status === 'unread')
                                                    / <span class="badge badge-danger">{{$action->created_at->diffForHumans()}}</span>
                                                        @endif
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="action{{$key}}" class="collapse" aria-labelledby="headingOne"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-auto">
                                                        <img src="{{asset('storage/img/actions/'.$action->file->name)}}"
                                                             alt="" class="img img-thumbnail">
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <h4>{{$action->title}}</h4>
                                                        <p>{{$action->description}}</p>
                                                        <hr>
                                                        <p5>Число участников: {{$action->members_max}}</p5>
                                                        <p5>Начало мероприятия: {{$action->action_start_at}}</p5>
                                                        <p5>Окончание мероприятия: {{$action->action_ends_at}}</p5>
                                                        @if ($action->status === 'unread')
                                                            <button class="btn btn-success" wire:click="acceptActionRequest({{$action}})">Принять</button>
                                                            <button class="btn btn-danger" wire:click="rejectActionRequest({{$action}})">Отклонить</button>
                                                        @else
                                                            <hr>
                                                            Заявка отклонена <button class="btn btn-success" wire:click="acceptActionRequest({{$action}})">Я передумал!</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    Нет новых заявок
                                    @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
