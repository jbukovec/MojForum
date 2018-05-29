@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="card bg-light text-dark">

        <div class="card-body">
            <h2 class="font-weight-bold">{{$tema->naslov_teme}}</h2>
            <hr>
            <p class="text-body mt-1 p-2" style="font-size:18px;">{{$tema->opis_teme}}</p>
            <div class="d-flex justify-content-end mt-2 pt-4">
                <div class="p-2 mt-4 text-right">
                    <a href="">{{$tema->user->name}}</a> 
                    <p class="text-muted"><b>Objavljeno: </b>{{$tema->created_at->format('d.m.Y.')}}</p>
                </div>   
                <div>
                    @if ($tema->user->naziv_slike == 'default.jpg')
                        <img class="rounded" style="width: 80px;" src="{{asset('storage/'. $tema->user->naziv_slike)}}">               
                    @else
                        <img class="rounded" style="width: 80px;" src="{{asset('storage/'.$tema->user->name.'/'. $tema->user->naziv_slike)}}">                
                    @endif
                 </div>           
            </div>
        </div>
    </div>
        @if (count($komentari)>0)
        @foreach ($komentari as $komentar)
    	    <div class="row mt-4">
            <div class="col-2" style="max-width: 115px;">               
                <div>
                    @if ($komentar->user->naziv_slike == 'default.jpg')
                        <img class="rounded" style="min-width: 40px; max-width:85px; width:100%;" src="{{asset('storage/'. $komentar->user->naziv_slike)}}">               
                    @else
                        <img class="rounded" style="min-width: 40px; max-width:85px; width:100%;" src="{{asset('storage/'.$komentar->user->name.'/'. $komentar->user->naziv_slike)}}">                
                    @endif
                    </div></div>
                <div class="col">
                    <div class="card p-3">
                    <a class="font-weight-bold" href="{{route('teme_korisnika', ['id'=>$komentar->user->id])}}">{{$komentar->user->name}}</a>
                    <p class="m-1 p-1 font-weight-light font-italic">{{$komentar->tekst_komentara}}</p>
                    <hr>
                    <p class="text-muted font-italic"><b>Objavljeno: </b>{{$komentar->created_at->format('d.m.Y. - H:i:s')}}</p>
                    </div>
                </div>
            </div>
        @endforeach

        @else
        <div class="alert alert-warning mt-4 mb-4" role="alert">
                Ova tema nema komentara. Budite prvi koji će postaviti komentar na ovu temu.
        </div>
        @endif
        <div class="mt-4 pl-2">
            {{$komentari->links()}}
        </div>

        @auth      
            <div class="card border-warning mt-4 mb-4 p-4">
                <h2 class="mb-4">Komentiraj ovu temu</h2>
                {!!Form::open(['route'=>['ostavi_komentar', $tema->id],'method'=>'POST'])!!}
                <div class="form-group">
                {{Form::label('komentar','Tekst komentara',['class'=>'p-1 mb-2'])}}   
                {{Form::textarea('komentar',null,['class'=>'form-control','rows'=>'8','id'=>'info','placeholder'=>'Unesite Vaš komentar.'])}}
                </div>
                {{Form::submit('Komentiraj',['class'=>'btn btn-primary'])}}
                {!!Form::close()!!}
            </div>
        @endauth
        
@guest
<div class="alert alert-primary" role="alert">
Da bi ste sudjelovali u raspravi odnosno napravili temu ili komentirali postojeće objavljene teme potrebno je kreirati račun.<br>
Ukoliko već imate račun, ulogirajte se na stranicu.
</div>
@endguest

</div>
@endsection