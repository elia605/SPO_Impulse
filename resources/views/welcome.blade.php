@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleIndicators" class="carousel slide mb-2" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($carousels as $key => $carousel)
                        <div class="carousel-item @if ($key === 0) active @endif">
                            <img src="{{asset('storage/img/carousel/'.$carousel->file->name)}}" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{$carousel->title}}</h5>
                                <p>{{$carousel->text}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center pt-2">
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-header">Последние новости <a href="" class="float-right">Все новости</a></div>

                    <div class="card-body">
                        <div class="col-md-10">
                            @foreach($news as $new)
                                <div class="row">
                                    <div class="col-md-auto">
                                        <img src="{{asset('storage/img/news/'.$new->file->name)}}" style="width: 100px;" alt="">
                                    </div>
                                    <div class="col">
                                        <h5 class="card-title"><a href="{{route('newView', [$new])}}">{{$new->title}}</a></h5>

                                        <p class="card-text news">{{$new->text}}</p>
                                    </div>
                                </div>
                                <hr>
                                <span class="badge badge-light">{{$new->user->name}} / {{$new->created_at}}</span>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="vk_widget">
                <!-- VK Widget -->
                <div id="vk_groups"></div>
            </div>
        </div>
    </div>
@endsection
