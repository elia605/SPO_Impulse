<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Бойцы СПО «Импульс» <button class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModalCenter">Добавить бойца</button></div>

                    <div class="card-body">
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
                                <td></td>
                                <td></td>
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
                                    <td class="pl-0 pr-0"><input class="btn btn-warning btn-sm" value="E" type="button" wire:click="editMember({{$member}})" data-toggle="modal" data-target="#exampleModalCenter"></td>
                                    <td class="pl-0 pr-0"><input class="btn btn-danger btn-sm" value="X" type="button" wire:click="deleteMember({{$member}})"></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Добавить бойца</h5>
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
                        <label for="exampleInputEmail1">Почта</label>
                        <input type="email" wire:model="email" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Группа</label>
                        <input type="tel" wire:model="group" class="form-control">
                    </div>
                    <div class="form-group">

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
