@extends('layouts.app')
@section('title', 'Rezultati pretrage za "'.$query.'"') 
@section('content')
<div class="container">
    @guest
        <div class="alert alert-primary" role="alert">
            Da bi ste sudjelovali u raspravi odnosno napravili temu ili komentirali postojeće objavljene teme potrebno je kreirati račun.<br>
            Ukoliko već imate račun, ulogirajte se na stranicu.
        </div>
    @endguest 
    <h2>Rezultati pretrage za "{{$query}}"</h2>    
@if(count($teme) > 0)
    @include('includes.prikaz_tema')
@else
    <div class="alert alert-warning mt-4" role="alert">
        Nema rezultata pretrage za "{{$query}}".
    </div>
@endif
</div>
@include('includes.izbrisi_temu_modal')
@endsection