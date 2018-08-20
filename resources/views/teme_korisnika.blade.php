@extends('layouts.app')
@section('title', 'Profil korisnika : Teme')
@section('content')
<div class="container">            
@include('includes.korisnik')
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
              <a class="nav-link active" href=""><i class="fas fa-list" style="font-size:19px;"></i> Teme <span class="badge badge-primary">{{$teme_count}}</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('komentari_korisnika', ['slug'=>$user->slug])}}"><i class="far fa-comment-dots" style="font-size:19px;"></i> Komentari <span class="badge badge-primary">{{$komentari_count}}</span></a>
            </li>
          </ul>
          @if(count($teme) > 0)
            @foreach ($teme as $tema)
            <div class="row mb-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body pb-2">
                            <a href="{{route('komentari_na_temu', ['slug'=> $tema->slug])}}"><h3>{{$tema->naslov_teme}}</h3></a>
                            @if (strlen($tema->opis_teme)>200)
                                <p class="font-italic">{{substr($tema->opis_teme,0,200)}} ...</p>
                            @else
                                <p class="font-italic">{{$tema->opis_teme}}</p>
                            @endif                                 
                        </div>
                        @auth
                            @if(Auth::user()->id == $tema->user_id || Auth::user()->is_admin == true)
                            <div class="p-2">
                                <button class="btn btn-outline-danger btn-sm float-right" style="border-color: transparent;" data-toggle="modal" data-target="#deleteModal" data-temaid="{{$tema->id}}" data-temanaslov="{{$tema->naslov_teme}}"><i class="fas fa-times"></i> <b>Izbriši temu</b></button>
                            </div>
                            @endif
                        @endauth
                    </div>
                    @if (count($tema->komentari) < 1)
                        <h5><span class="badge badge-danger mt-1">Još nema komentara</span></h5><span class="text-muted font-italic">Budite prvi koji će ostaviti komentar</span>
                    @else
                        <h5><span class="badge badge-success mt-1"><i class="fas fa-comment-alt"></i> &nbsp; Komentara: {{count($tema->komentari)}}</span></h5>
                    @endif                  
                </div>
            </div>
            <p>U kategoriji <a href="{{route('teme', ['url' => $tema->kategorija->url_naziv])}}">{{$tema->kategorija->naziv_kategorije}}</a> | </span><b>Datum objave: </b>
                @include('includes.datum_postavljanja_teme')
            </p>
            <hr>
            @endforeach
            @else
            <div class="alert alert-warning">Korisnik još nije postavio niti jednu temu do sada.  </div>
        @endif
        </div>
        {{$teme->links()}}
</div>
</div>
@include('includes.izbrisi_temu_modal')
@endsection    