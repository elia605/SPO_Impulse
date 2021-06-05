<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Мероприятия @auth @if(Auth::user()->isMember() === true) <button class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModalCenter">Подать заявку на мероприятие</button>@endif @endauth</div>
                    <div class="card-body">
                        @if($actions->count() === 0)
                            Мероприятий нет
                        @endif
                        <div class="row justify-content-center">
                            @foreach ($actions as $action)
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top darken" src="{{asset('storage/img/actions/darken/'.$action->file->name)}}"
                                         alt="Card image cap">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title actions-title">{{$action->title}} </h5><span class="badge badge-primary">Начало: {{Carbon\Carbon::make($action->action_starts_at)->diffForHumans()}}</span>
                                        <br><span class="badge badge-danger">Участников: {{$action->memberActions()->count()}}/{{$action->members_max}}</span>
                                        <p class="card-text actions-text">{{$action->description}}</p>
                                        <p class="card-text actions-text">{{$action->description}} </p>
                                        <p>@auth @if(Auth::user()->isMember() === true)
                                                     @if (Auth::user()->memberActions($action->id) < 1)
                                                <a href="#" class="btn btn-success" wire:click="participate({{$action->id}})">Я в деле!</a>
                                                         @else
                                                    <a href="#"><strong> ВЫ УЧАСТВУЕТЕ!</strong></a>
                                                         @endif
                                            @endif @endauth </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Заявка на организацию мероприятия</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название мероприятия</label>
                        <input type="text" wire:model="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Содержание</label>
                        <textarea class="form-control" wire:model="description" id="exampleInputEmail1" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Число участников</label>
                        <input type="number" wire:model="members_max" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Дата/время начала мероприятия</label>
                        <input type="datetime-local" class="form-control datepicker" wire:model="action_starts_at">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Дата/время завершения мероприятия</label>
                        <input type="datetime-local" class="form-control datepicker" wire:model="action_ends_at">
                    </div>
                    <div class="form-group">
                        @if ($file)
                            <img src="{{$file->temporaryUrl()}}" height="100px" width="auto" alt="">
                        @endif
                        <hr/>
                        <input type="file" wire:model="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" wire:click="createAction">
                </div>
            </div>
        </div>
    </div>
</div>
