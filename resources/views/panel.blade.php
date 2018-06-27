@extends('layouts.app')
@section('title', 'Korisnički panel')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Kontrolna ploča</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col"><a class="btn btn-success float-right" href="{{route('promjena_lozinke_form')}}">Promijenite lozinku</a></div>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col col-md-4 mt-2 p-4 text-center">
                            @if (Auth::user()->naziv_slike == 'default.jpg')
                            <img style="max-width:225px;border-radius:50%;min-width:65px;width:100%;" src="{{asset('storage/'.Auth::user()->naziv_slike)}}">
                            @else
                            <img style="max-width:225px;border-radius:50%;min-width:65px;width:100%;" src="{{asset('storage/'.Auth::user()->slug.'/'.Auth::user()->naziv_slike)}}">
                            @endif
                                <div class="mt-3 text-center">
                                    <h3>{{Auth::user()->name}}</h3>
                                {{--<b>Korisnik od: </b>{{Auth::user()->created_at->format('d.m.Y.')}}<br>--}}
                                </div>
                                <div class="m-1 p-1">
                                    <a href="{{route('slika.profila')}}" class="btn btn-primary">Promjenite sliku profila.</a>
                                </div>
                        </div>
                    </div>
                    <hr>
                    @if (count($teme_novi_komentari) > 0)
                    <h4 class="text-center mt-4 mb-2 p-2 text-primary">Novi nepročitani komentari u temama koje ste vi započeli</h4>
                    <ul class="list-group">
                    @foreach ($teme_novi_komentari as $tema)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{route('komentari.zadnja', ['id' => $tema->slug])}}">{{$tema->naslov_teme}}</a>
                            <span class="badge badge-primary badge-pill">{{count($tema->komentari)}}</span>
                        </li>
                    @endforeach
                    </ul>                    
                    @else
                    <div class="alert alert-info">Nema novih komentara u temama koje ste vi započeli!</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection