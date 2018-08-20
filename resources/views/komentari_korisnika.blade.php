@extends('layouts.app')
@section('title', 'Profil korisnika : Komentari')
@section('content')
<div class="container">
    @include('includes.korisnik')
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link" href="{{route('teme_korisnika', ['slug'=>$user->slug])}}"><i class="fas fa-list" style="font-size:19px;"></i> Teme <span class="badge badge-primary">{{$teme_count}}</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href=""><i class="far fa-comment-dots" style="font-size:19px;"></i> Komentari <span class="badge badge-primary">{{$komentari_count}}</span></a>
            </li>
        </ul>
        @if(count($komentari) > 0) 
        @foreach ($komentari as $komentar)
        <div class="row mb-3">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <h4><a href="{{route('komentari_na_temu', ['slug'=>$komentar->tema->slug])}}">{{$komentar->tema->naslov_teme}}</a>
                                @if(! empty($komentar->tema->opis_teme))
                                <span><button class="btn btn-outline-primary ml-1" type="button" data-toggle="collapse" data-target="#opis-{{$komentar->id}}" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-caret-down"></i></button></span>
                                @endif
                            </h4>
                            <p><span class="text-muted">U kategoriji </span><a href="{{route('teme', ['url' => $komentar->tema->kategorija->url_naziv])}}">{{$komentar->tema->kategorija->naziv_kategorije}}</a></p>         
                            @if(! empty($komentar->tema->opis_teme))
                            <div class="collapse mt-2 pt-3" id="opis-{{$komentar->id}}">
                                <p class="font-italic pb-1">{{$komentar->tema->opis_teme}}</p>   
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div class="mt-3"><p><i class="fas fa-comment-alt text-primary" style="font-size: 18px;"> :</i> {{$komentar->tekst_komentara}}</p></div>
                        @auth
                            @if(Auth::user()->id == $komentar->user_id || Auth::user()->is_admin == true)
                            <div class="row pl-3 pb-2">   
                            <button class="btn btn-outline-danger btn-sm float-left" data-toggle="modal" data-target="#deleteModal" data-idkomentara="{{$komentar->id}}"><i class="fas fa-times"></i> <b>Izbriši komentar</b></button>
                            </div>
                            @endif
                        @endauth
                        <p class="mb-0">
                            <b>Datum komentara: </b>
                            <span class="text-muted font-italic">
                                @include('includes.datum_komentara')
                            </span>
                        </p>

                    </div>
                </div>
            </div>
            </div>
            @endforeach 
            @else
            <div class="alert alert-warning">Korisnik još nije komentirao niti jednu temu do sada. </div>
            @endif
        {{$komentari->links()}}
    </div>
</div>
@include('includes.izbrisi_komentar_modal')
@endsection