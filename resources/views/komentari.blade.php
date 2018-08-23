@extends('layouts.app')
@section('title', 'Komentari na temu')
@section('content')
<div class="container">
    <div class="card bg-light text-dark">

        <div class="card-body">
            <h2 class="font-weight-bold">{{$tema->naslov_teme}}</h2>
            <hr>
            <p class="text-body mt-1 p-2" style="font-size:18px;">{{$tema->opis_teme}}</p>
            <div class="d-none d-sm-block">
                <div class="d-flex justify-content-end mt-2 pt-4">
                    <div class="p-2 mt-4 text-right">
                        <a href="{{route('teme_korisnika', ['slug'=>$tema->user->slug])}}">{{$tema->user->name}}</a> 
                        <p class="text-muted">@include('includes.datum_postavljanja_teme')</p>
                    </div>   
                    <div>
                        @if ($tema->user->naziv_slike == 'default.jpg')
                            <img class="rounded" style="width: 80px;" src="{{asset('storage/'. $tema->user->naziv_slike)}}">               
                        @else
                            <img class="rounded" style="width: 80px;" src="{{asset('storage/'.$tema->user->slug.'/'. $tema->user->naziv_slike)}}">                
                        @endif
                    </div>           
                </div>
            </div>
            <div class="d-block d-sm-none mt-2 pt-4 text-center">
                <div>
                    @if ($tema->user->naziv_slike == 'default.jpg')
                        <img class="rounded" style="width: 80px;" src="{{asset('storage/'. $tema->user->naziv_slike)}}">               
                    @else
                        <img class="rounded" style="width: 80px;" src="{{asset('storage/'.$tema->user->slug.'/'. $tema->user->naziv_slike)}}">                
                    @endif
                </div>
                <div class="pt-2 text-center">
                    <a href="{{route('teme_korisnika', ['slug'=>$tema->user->slug])}}">{{$tema->user->name}}</a> 
                    <p class="text-muted">@include('includes.datum_postavljanja_teme')</p>
                </div>            
            </div>
        </div>
    </div>
        @if (count($komentari)>0)
        @foreach ($komentari as $komentar)
    	    <div class="row mt-4">
            <div class="col-1 p-0 ml-3 d-none d-sm-none d-md-block" style="max-width: 115px;">               
                <a href="{{route('teme_korisnika', ['slug'=>$komentar->user->slug])}}">
                    @if ($komentar->user->naziv_slike == 'default.jpg')
                        <img class="rounded" style="min-width: 40px; max-width:85px; width:100%;" src="{{asset('storage/'. $komentar->user->naziv_slike)}}">               
                    @else
                        <img class="rounded" style="min-width: 40px; max-width:85px; width:100%;" src="{{asset('storage/'.$komentar->user->slug.'/'. $komentar->user->naziv_slike)}}">                
                    @endif
                </a>
            </div>
                <div class="col">
                    <div class="card p-3">
                    <a class="font-weight-bold" href="{{route('teme_korisnika', ['slug'=>$komentar->user->slug])}}">
                        <div class="media pb-1"><span class="pr-2 d-block d-sm-block d-md-none">
                            @if ($komentar->user->naziv_slike == 'default.jpg')
                                <img class="rounded rounded-circle mr-2" style="width: 50px;" src="{{asset('storage/'. $komentar->user->naziv_slike)}}">               
                            @else
                                <img class="rounded rounded-circle mr-2" style="width: 50px;" src="{{asset('storage/'.$komentar->user->slug.'/'. $komentar->user->naziv_slike)}}">                
                            @endif
                        </span>
                        <div class="media-body pt-2 d-block d-sm-block d-md-none">@if($komentar->user->id != $tema->user->id){{$komentar->user->name}}@else<span class="badge badge-primary" style="font-size: 13px;">{{$komentar->user->name}}</span>@endif</div>
                        <div class="media-body d-none d-md-block">@if($komentar->user->id != $tema->user->id){{$komentar->user->name}}@else<span class="badge badge-primary" style="font-size: 13px;">{{$komentar->user->name}}</span>@endif</div>
                    </div>
                    </a>
                    <p class="m-1 p-1 font-weight-light font-italic">{{$komentar->tekst_komentara}}</p>
                    <hr>
                    <div>
                    @auth
                        @if(Auth::user()->id == $komentar->user_id || Auth::user()->is_admin == true)
                            <button class="btn btn-outline-danger btn-sm float-right d-none d-sm-block" style="border-color: transparent;" data-toggle="modal" data-target="#deleteModal" data-idkomentara="{{$komentar->id}}"><i class="fas fa-times"></i> <b>Izbriši komentar</b></button>
                        @endif
                    @endauth
                    <p class="text-muted font-italic mb-0"><b><i class="far fa-clock" style="font-size: 16px;"></i> </b>
                    @include('includes.datum_komentara')
                    </p>
                    @auth
                        @if(Auth::user()->id == $komentar->user_id || Auth::user()->is_admin == true)
                            <button class="btn btn-outline-danger btn-sm float-left d-block d-sm-none mt-3" style="border-color: transparent;" data-toggle="modal" data-target="#deleteModal" data-idkomentara="{{$komentar->id}}"><i class="fas fa-times"></i> <b>Izbriši komentar</b></button>
                        @endif
                    @endauth
                    </div>
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
                {{--{{Form::submit('Komentiraj',['class'=>'btn btn-primary'])}}--}}
                {{ Form::button('<i class="fab fa-telegram-plane" aria-hidden="true"></i> Komentiraj', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
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
@include('includes.izbrisi_komentar_modal')
@endsection