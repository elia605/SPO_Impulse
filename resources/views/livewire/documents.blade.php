<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Документы <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Создать документ
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal1">Грамоты участникам мероприятия</a>
                                <a class="dropdown-item" href="#">Персональная грамота</a>
                                <hr>
                                <a class="dropdown-item" href="#">Информация о мероприятии</a>
                                <a href="" class="dropdown-item">Список участников СПО</a>
                            </div>
                        </div></div>
                    <div class="card-body">
                        <div class="row justify-content-center p-2">
                            <table class="table table-striped">
                                @foreach ($files as $file)
                                    <tr>
                                        <td>{{$file}}</td>
                                    </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Грамоты участникам мероприятия</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Мероприятие</label>
                        <select class="form-control" wire:model="selectedAction" name="action">
                            <option value="" selected>Выберите мероприятие</option>
                            @foreach ($actions as $action)
                                <option value="{{$action->id}}">{{$action->title}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="checkbox">Разослать копии по email</label>
                        <input type="checkbox" wire:model="sendByEmail" name="checkbox">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" wire:click="createDocs">
                </div>
            </div>
        </div>
    </div>
</div>
