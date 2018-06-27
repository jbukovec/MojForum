@extends('layouts.app')
@section('title', 'Profil korisnika : Teme')
@section('content')
<div class="container">            
@include('includes.korisnik')
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
              <a class="nav-link active" href=""><i class="fas fa-list" style="font-size:19px;"></i> Teme <span class="badge badge-primary">{{count($teme)}}</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('komentari_korisnika', ['slug'=>$user->slug])}}"><i class="far fa-comment-dots" style="font-size:19px;"></i> Komentari <span class="badge badge-primary">{{$count_komentari}}</span></a>
            </li>
          </ul>
          @if(count($teme) > 0)
            @foreach ($teme as $tema)
            <div class="row mb-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('komentari_na_temu', ['slug'=> $tema->slug])}}"><h3>{{$tema->naslov_teme}}</h3></a>
                            @if (strlen($tema->opis_teme)>200)
                                <p class="font-italic">{{substr($tema->opis_teme,0,200)}} ...</p>
                            @else
                                <p class="font-italic">{{$tema->opis_teme}}</p>
                            @endif                                 
                        </div>
                    </div>
                    @if (count($tema->komentari) < 1)
                        <h5><span class="badge badge-danger mt-1">Još nema komentara</span></h5><span class="text-muted font-italic">Budite prvi koji će ostaviti komentar</span>
                    @else
                        <h5><span class="badge badge-success mt-1"><i class="fas fa-comment-alt"></i> &nbsp; Komentara: {{count($tema->komentari)}}</span></h5>
                    @endif                  
                </div>
            </div>
            <p>U kategoriji <a href="{{route('teme', ['url' => $tema->kategorija->url_naziv])}}">{{$tema->kategorija->naziv_kategorije}}</a> | </span><b>Datum objave: </b>
                <span class="text-muted">
                    @if($tema->created_at->isToday())
                        Danas u {{$tema->created_at->format('H:i')}}
                    @elseif($tema->created_at->isYesterday())
                        Jučer u {{$tema->created_at->format('H:i')}}
                    @else
                        {{$tema->created_at->day}}.
                        @switch($tema->created_at->month)
                        @case(1)
                        Siječanja
                        @break
                        @case(2)
                        Veljače
                        @break
                        @case(3)
                        Ožujka
                        @break
                        @case(4)
                        Travnja
                        @break
                        @case(5)
                        Svibnja
                        @break
                        @case(6)
                        Lipnja
                        @break
                        @case(7)
                        Srpnja
                        @break
                        @case(8)
                        Kolovoza
                        @break
                        @case(9)
                        Rujna
                        @break
                        @case(10)
                        Listopada
                        @break
                        @case(11)
                        Studenog
                        @break
                        @case(12)
                        Prosinca
                        @break
                        @endswitch
                        {{$tema->created_at->format('Y. \u H:i')}}
                    @endif
                </span>
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