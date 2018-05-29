
@extends('layouts.app') 
@section('content')
<div class="container">            
@include('includes.korisnik')
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
              <a class="nav-link active" href="">Teme</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('komentari_korisnika', ['id'=>$user->id])}}">Komentari</a>
            </li>
          </ul>
          @if(count($teme) > 0)
            @foreach ($teme as $tema)
            <div class="row mb-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('komentari_na_temu', ['id'=> $tema->id])}}"><h3>{{$tema->naslov_teme}}</h3></a>
                            @if (strlen($tema->opis_teme)>200)
                                <p class="font-italic">{{substr($tema->opis_teme,0,200)}} ...</p>
                            @else
                                <p class="font-italic">{{$tema->opis_teme}}</p>
                            @endif                                 
                        </div>
                    </div>
                    @if (count($tema->komentari) < 1)
                        <h5><span class="badge badge-danger">Još nema komentara</span></h5><span class="text-muted font-italic">Budite prvi koji će ostaviti komentar</span>
                    @else
                        <h5><span class="badge badge-success">Komentara: {{count($tema->komentari)}}</span></h5>
                    @endif                  
                </div>
            </div>
            <p></span><b>Datum objave: </b>
                <small class="text-muted">{{$tema->created_at->format('d.m.Y. - H:i:s')}}</small>
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
@endsection    