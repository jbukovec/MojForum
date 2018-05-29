@extends('layouts.app') 
@section('content')
<div class="container">
    @include('includes.korisnik')
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link" href="{{route('teme_korisnika', ['id'=>$user->id])}}">Teme</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="">Komentari</a>
            </li>
        </ul>
        @if(count($komentari) > 0) 
        @foreach ($komentari as $komentar)
        <div class="row mb-3">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h4><a href="{{route('komentari_na_temu', ['id'=>$komentar->tema->id])}}">{{$komentar->tema->naslov_teme}}</a>
                                <span><button class="btn btn-success ml-1" type="button" data-toggle="collapse" data-target="#opis-{{$komentar->id}}" aria-expanded="false" aria-controls="collapseExample">
                                        Opis teme
                                    </button></span></h4>           
                            <div class="collapse pt-4" id="opis-{{$komentar->id}}">
                                <p class="font-italic">{{$komentar->tema->opis_teme}}</p>
                                
                            </div>
                        </div>
                        <hr>
                        <h5 class="font-weight-bold">Komentar:</h5>
                        <div class="mt-4"><p>{{$komentar->tekst_komentara}}</p></div>
                        <p>
                            <b>Datum komentara: </b>
                            <span class="text-muted font-italic">{{$komentar->created_at->format('d.m.Y. - H:i:s')}}</span>
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
@endsection