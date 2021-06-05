<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                Пользователи ресурса
                            </div>
                            <div class="col" wire:ignore.self>
                                <input type="text" wire:model="search" class="form-control float-right w-10" placeholder="Поиск">
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <td>Имя</td>
                                <td>Роль</td>
                                <td>E-mail</td>
                                <td>Дата создания</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </thead>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>@if ($user !== null)
                                            @if ($user->isAdmin())
                                                <span class="badge badge-danger">Администратор</span>
                                            @elseif ($user->isOrg() === 'org')
                                                <span class="badge badge-warning">Организатор</span>
                                            @elseif ($user->isMember())
                                                <span class="badge badge-success">Член</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td class="pl-0 pr-0"><input class="btn btn-warning btn-sm" value="E" type="button" wire:click="editUser({{$user}})" data-toggle="modal" data-target="#exampleModalCenter"></td>
                                    <td class="pl-0 pr-0"><input class="btn btn-danger btn-sm" value="X" type="button" wire:click="deleteUser({{$user}})"></td>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Изменение пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Имя пользователя</label>
                        <input type="text" wire:model="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="text" wire:model="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Роль</label>
                        <input type="text" wire:model="role" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <hr>
                    <h6>Доступные роли: admin, org, member, guest</h6>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" wire:click="saveEditions({{$selectedUser}})">
                </div>
            </div>
        </div>
    </div>
</div>
