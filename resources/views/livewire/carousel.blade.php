<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Информация для главной страницы (блок с меняющимися картинками)
                            <button class="btn btn-success float-right" type="button" id="dropdownMenuButton" data-toggle="modal" data-target="#modal1" aria-expanded="false">
                                Добавить элемент
                            </button>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center p-2">
                            <table class="table table-striped">
                                <tr>
                                    <td>Заголовок</td>
                                    <td>Текст</td>
                                    <td>Изображение</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($carousels as $carousel)
                                    <tr>
                                        <td>{{$carousel->title}}</td>
                                        <td>{{$carousel->text}}</td>
                                        <td><img src="{{asset('storage/img/carousel/'.$carousel->file->name)}}" width="100px" height="auto" alt=""></td>
                                        <td class="pl-0 pr-0"><input class="btn btn-warning btn-sm" value="E" type="button" wire:click="editCarousel({{$carousel}})" data-toggle="modal" data-target="#exampleModalCenter"></td>
                                        <td class="pl-0 pr-0"><input class="btn btn-danger btn-sm" value="X" type="button" wire:click="deleteCarousel({{$carousel}})"></td>
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
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" wire:model="title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Текст</label>
                        <input type="text" wire:model="text">
                    </div>
                    <hr/>
                    <div class="form-group">
                        <br>
                        <input type="file" wire:model="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" wire:click="createElement">
                </div>
            </div>
        </div>
    </div>
</div>
