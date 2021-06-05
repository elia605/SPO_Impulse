@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Новости
                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModalCenter">Создать новость</button>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <td>Заголовок</td>
                                <td>Текст</td>
                                <td></td>
                                <td>Дата создания</td>
                            </tr>
                            </thead>
                            @foreach ($news as $new)
                                <tr>
                                    <td>{{$new->title}}</td>
                                    <td>{{$new->text}}</td>
                                    <td><img src="{{asset('storage/img/news/'.$new->file->name)}}" width="50px" alt=""></td>
                                    <td>{{$new->created_at}}</td>
                                    <td><input type="submit" wire:click="deleteNews({{$new}})"></td>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Создать новость</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" wire:model="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Текст</label>
                        <textarea wire:model="text" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Тег</label>
                        <input type="text" wire:model="tag" class="form-control">
                    </div>
                    <hr/>
                    <div class="form-group">
                        @if ($file !== null)
                            <img src="{{$file->temporaryUrl()}}" height="100px" width="auto" alt="">
                        @endif
                        <br>
                        <input type="file" wire:model="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" wire:click="createNews">
                </div>
            </div>
        </div>
    </div>
@endsection
