@extends('layouts.app')
@section('title', 'Naslovna')
@section('content')
    <div class="container mb-4 pb-4">
        <div class="mt-1 mb-4 pt-1 pb-4">
            {!!Form::open(['route' => 'pretrazi.teme', 'class' => 'form-inline justify-content-center', 'method' => 'GET'])!!}
            {{Form::text('q', null, ['class' => 'form-control mr-2', 'style' => 'font-size:20px; width:80%', 'placeholder' => 'Pretraži teme'])}}
            {{Form::button('<i class="fas fa-search"></i>', ['class' => 'btn btn-outline-primary my-2 my-sm-0','style' => 'font-size:20px;', 'type' => 'submit'])}}
            {!!Form::close()!!}
        </div>
        <h1 class="text-center text-secondary display-4 d-none d-md-block" style="margin-top:5%; margin-bottom:45px;">Kategorije</h1>
        <h1 class="text-center text-secondary d-block d-md-none" style="margin-top:5%; margin-bottom:45px;font-size:42px;">Kategorije</h1>
        <div class="row align-items-end">
            @foreach ($kategorije as $kategorija)
            <div class="col-md-6 col-lg-4 text-center">
                <div class="mt-2 mb-2 p-1" style="box-shadow: 0px 30px 15px -31px rgba(0, 0, 0, 0.1);">     
                    <a href="{{route('teme', ['id' => $kategorija->url_naziv])}}"><h2>{{$kategorija->naziv_kategorije}}</h2></a>
                    <h4 class="mb-0 pb-2 pt-1 text-muted" style="font-size:18px;">Broj tema u kategoriji</h4>
                    <h4 class="pb-2"><span class="badge badge-pill badge-primary">{{count($kategorija->teme)}}</span></h4>
                </div>
            </div>  
            @endforeach
        </div>
    </div>
@endsection