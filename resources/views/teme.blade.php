@extends('layouts.app') 
@section('content')
<div class="container">
    @guest
    <div class="alert alert-primary" role="alert">
        Da bi ste sudjelovali u raspravi odnosno napravili temu ili komentirali postojeće objavljene teme potrebno je kreirati račun.<br>
        Ukoliko već imate račun, ulogirajte se na stranicu.
    </div>
    @endguest 
    @auth
    @if($id != 0)
    <div class="mt-4 mb-4">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#novaTemaForm" aria-expanded="false" aria-controls="#novaTemaForm">Napravi novu temu</button>
    </div>
    <div class="collapse multi-collapse mt-2 mb-4 pt-2 pb-2" id="novaTemaForm">
        <h2>Postavi novu temu</h2>
        {!!Form::open(['route'=>['kreiraj_temu', $id],'method'=>'POST'])!!}
        <div class="form-group">
            {{Form::label('naslov','Naslov teme')}}
            {{Form::text('naslov', null, ['class'=> 'form-control mb-1'])}} 
            {{Form::label('opis','Opis teme', ['class' => 'mt-1'])}}
            {{Form::textarea('opis',null,['class'=>'form-control','rows'=>'10','id'=>'info','placeholder'=>'Unesite dodatni opis za temu.'])}}
        </div>
        {{Form::submit('Napravi temu',['class'=>'btn btn-primary'])}}
        {!!Form::close()!!}
    </div>
    @endif
    @endauth 
    @if(count($teme) > 0)
        @if ($id > 0)
            <h2>Teme u kategoriji {{$teme[0]->kategorija->naziv_kategorije}}</h2>
            @section('title', 'Teme u kategoriji '.$teme[0]->kategorija->naziv_kategorije)
        @else
            <h2>Zadnje teme</h2>
            @section('title', 'Zadnje teme')
        @endif
    @include('includes.prikaz_tema')
    @else
        @if($id > 0)
            <div class="alert alert-warning" role="alert">
                Ova kategorija još nema niti jednu postavljenu temu. Budite prvi koji će postaviti temu u ovu kategoriju. 
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                Nema postavljenih tema. 
            </div>
        @endif
    @endif
</div>
@include('includes.izbrisi_temu_modal')
@endsection