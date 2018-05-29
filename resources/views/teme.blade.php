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
        {{Form::submit('Postavi temu',['class'=>'btn btn-primary'])}} {!!Form::close()!!}
    </div>
    @else
    
    @endif
    @endauth 
    @if(count($teme) > 0)
    @if (is_int($id))
        @if ($id > 0)
            <h2>Teme u kategoriji {{$teme[0]->kategorija->naziv_kategorije}}</h2>
        @else
            <h2>Zadnje teme</h2>
        @endif
    @else
    <h2>Rezultati pretrage za "{{$id}}"</h2>    
    @endif    
    <div class="my-3 p-3 bg-white rounded box-shadow">
        @foreach ($teme as $tema)
        <div class="row mb-3">
            <div class="col-md-2 col-sm-2 col-2">
                <div>
                    @if ($tema->user->naziv_slike == 'default.jpg')
                    <img style="max-width: 160px; min-width:50px; width:100%;" class="rounded profil-img" src="{{asset('storage/'. $tema->user->naziv_slike)}}">                    
                    @else
                    <img class="rounded" style="max-width: 160px; min-width:50px; width:100%;" src="{{asset('storage/'.$tema->user->name.'/'. $tema->user->naziv_slike)}}">                    
                    @endif
                </div>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('komentari_na_temu', ['id'=> $tema->id])}}">
                            <h3>{{$tema->naslov_teme}}</h3>
                        </a>
                        @if (strlen($tema->opis_teme)>200)
                        <p class="font-italic">{{substr($tema->opis_teme,0,200)}} ...</p>
                        @else
                        <p class="font-italic">{{$tema->opis_teme}}</p>
                        @endif
                    </div>
                </div>
                @if (count($tema->komentari)
                < 1) <h5><span class="badge badge-danger">Još nema komentara</span></h5><span class="text-muted font-italic">Budite prvi koji će ostaviti komentar</span>                    
                @else
                    <h5><span class="badge badge-success">Komentara: {{count($tema->komentari)}}</span></h5>
                @endif
            </div>
        </div>
        <p> Objavio korisnik <a href="{{route('teme_korisnika', ['id'=>$tema->user->id])}}" class="mt-2 pt-2 pb-2">{{$tema->user->name}}</a><span> | </span><b>Datum objave: </b>
            <small class="text-muted">{{$tema->created_at->format('d.m.Y. - H:i:s')}}</small>
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