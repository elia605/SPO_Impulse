<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Бойцы СПО «Импульс» @auth @if(Auth::user()->isGuest())<button class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModalCenter">Вступить в ряды @endif @endauth</button>
                    </div>

                    <div class="card-body">
                        @if($members->count() !== 0)
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <td>ФИО</td>
                                <td></td>
                                <td>Дата рождения</td>
                                <td>Статус</td>
                                <td>Телефон</td>
                                <td>Почта</td>
                                <td>Группа</td>
                            </tr>
                            </thead>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{$member->FIO}}</td>
                                    <td><img src="{{asset('storage/img/members/'.$member->file->name)}}" alt=""></td>
                                    <td>{{$member->birthday}}</td>
                                    <td>{{$member->role}}</td>
                                    <td>{{$member->phone}}</td>
                                    <td>{{$member->email}}</td>
                                    <td>{{$member->group}}</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            Участников нет
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Подать заявку на вступление в ряды СПО «Импульс»</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ФИО</label>
                        <input type="text" wire:model="FIO" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Дата рождения</label>
                        <input type="date" wire:model="birthday" class="form-control datepicker">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Должность</label>
                        <input type="text" wire:model="role" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Телефон</label>
                        <input type="tel" wire:model="phone" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Группа</label>
                        <input type="tel" wire:model="group" class="form-control">
                    </div>
                    <div class="form-group">
                        @if ($file !== null)
                            <img src="{{$file->temporaryUrl()}}" height="100px" width="auto" alt="">
                        @endif
                        <br>
                        <input type="file" wire:model="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" wire:click="createMember">
                </div>
            </div>
        </div>
    </div>
</div>
