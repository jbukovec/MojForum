@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">Dobrodošli</h1>
                <p class="lead">Odaberite kategoriju za koju želite pregledati teme ili postaviti pitanja drugim korisnicima ili temu za diskusiju.</p>
                <hr class="my-4">
            </div>
            <div>
                <div class="mt-5 mb-5 pt-2">
                    {!!Form::open(['route' => 'pretrazi.teme', 'class' => 'form-inline justify-content-center', 'method' => 'GET'])!!}
                    {{Form::text('q', null, ['class' => 'form-control mr-2 w-75', 'placeholder' => 'Pretraga'])}}
                    {{Form::submit('Pretraži', ['class' => 'btn btn-outline-primary my-2 my-sm-0'])}}
                    {!!Form::close()!!}
               {{-- <form class="form-inline justify-content-center">
                    <input class="form-control mr-2 w-75" type="search" placeholder="Pretraga" aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pretraži</button>
                </form> --}}
                </div>
            </div>
        <div class="row">
            @foreach ($kategorije as $kategorija)
            <div class="col-md-4 text-center">
                <div class="mt-2 p-1">
                    <a href="{{route('teme', ['id' => $kategorija->url_naziv])}}"><h2>{{$kategorija->naziv_kategorije}}</h2>
                        <h4><span class="badge badge-pill badge-primary">Tema u kategoriji: {{count($kategorija->teme)}}</span></h4>
                    </a>
                </div>
            </div>  
            @endforeach
        </div>
    </div>
@endsection