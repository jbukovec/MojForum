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
    @else
    
    @endif
    @endauth 
    @if(count($teme) > 0)
    @if (is_int($id))
        @if ($id > 0)
            <h2>Teme u kategoriji {{$teme[0]->kategorija->naziv_kategorije}}</h2>
            @section('title', 'Teme u kategoriji '.$teme[0]->kategorija->naziv_kategorije)
        @else
            <h2>Zadnje teme</h2>
            @section('title', 'Zadnje teme')
        @endif
    @else
    <h2>Rezultati pretrage za "{{$id}}"</h2>    
    @section('title', 'Rezultati pretrage za "'.$id.'"')
    @endif    
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        @foreach ($teme as $tema)
        <div class="row mb-3">
            <div class="col-md-2 col-sm-2 p-0 pl-3 d-none d-sm-block">
                <a href="{{route('teme_korisnika', ['id'=>$tema->user->id])}}">
                    @if ($tema->user->naziv_slike == 'default.jpg')
                    <img style="max-width: 160px; min-width:50px; width:100%;" class="rounded profil-img" src="{{asset('storage/'. $tema->user->naziv_slike)}}">                    
                    @else
                    <img class="rounded" style="max-width: 160px; min-width:50px; width:100%;" src="{{asset('storage/'.$tema->user->slug.'/'. $tema->user->naziv_slike)}}">                    
                    @endif
                </a>
            </div>
            <div class="col-md-10 col-sm-10 col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('komentari_na_temu', ['slug'=> $tema->slug])}}">
                            <h3>{{$tema->naslov_teme}}</h3>
                        </a>
                        @if (strlen($tema->opis_teme)>200)
                        <p class="font-italic">{{substr($tema->opis_teme,0,200)}} ...</p>
                        @else
                        <p class="font-italic">{{$tema->opis_teme}}</p>
                        @endif
                    </div>
                </div>
                @if (count($tema->komentari) < 1) <h5><span class="badge badge-danger mt-1">Još nema komentara</span></h5><span class="text-muted font-italic">Budite prvi koji će ostaviti komentar</span>                    
                @else
                    <h5><span class="badge badge-success mt-1"><i class="fas fa-comment-alt"></i> &nbsp; Komentara: {{count($tema->komentari)}}</span></h5>
                @endif
            </div>
        </div>
        <p>Objavio korisnik <a href="{{route('teme_korisnika', ['slug'=>$tema->user->slug])}}" class="mt-2 pt-2 pb-2">{{$tema->user->name}}</a> @if (! is_int($id)) u kategoriji <a href="{{route('teme', ['url' => $tema->kategorija->url_naziv])}}">{{$tema->kategorija->naziv_kategorije}}</a> @endif <span> | </span><b>Datum objave: </b>
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
    </div>
    {{$teme->links()}}
    @else
    @if(is_int($id) && $id > 0)
    <div class="alert alert-warning" role="alert">
        Ova kategorija još nema niti jednu postavljenu temu. Budite prvi koji će postaviti temu u ovu kategoriju. 
    </div>
    @elseif(is_int($id) && $id == 0)
    <div class="alert alert-warning" role="alert">
        Nema postavljenih tema. 
    </div>
    @else
    <div class="alert alert-warning" role="alert">
        Nema rezultata pretrage za "{{$id}}". 
    </div>
    @endif
    @endif
</div>
@endsection