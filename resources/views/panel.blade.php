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
                                    <a href="{{route('teme_korisnika',['slug' => Auth::user()->slug])}}"><h3>{{Auth::user()->name}}</h3></a>
                                </div>
                                <div class="m-1 p-1">
                                    <a href="{{route('slika.profila')}}" class="btn btn-primary">Promjenite sliku profila.</a>
                                </div>
                        </div>
                    </div>
                    <hr>
                    @if (count($teme_novi_komentari) > 0)
                    <h4 class="text-center mt-4 mb-2 p-2 text-primary">Novi komentari u Vašim temama</h4>
                    <ul class="list-group">
                    @foreach ($teme_novi_komentari as $tema)
                    <li class="list-group-item d-flex align-content-between">
                        <div>
                        <button class="btn btn-light btn-show" type="button" data-id="{{$tema->id}}" data-toggle="collapse" data-target="#komentariCollapse-{{$tema->id}}" aria-expanded="false" aria-controls="komentariCollapse-{{$tema->id}}">
                            <i class="far fa-comment-alt text-secondary" style="font-size: 34px; position:relative;">
                                <span class="badge badge-pill badge-primary" style="font-family: 'Roboto Light', sans-serif; font-size: 15px; display: block; position: absolute; left:1.4em; top:-0.5em;">{{count($tema->komentari)}}</span>
                            </i>
                        </button>
                        </div>
                        <div class="pl-3"><a class="font-weight-bold" href="{{route('komentari_na_temu', ['slug' => $tema->slug])}}">{{$tema->naslov_teme}}</a></div>
                    </li>
                    <div class="collapse multi-collapse" id="komentariCollapse-{{$tema->id}}">
                        <div class="card border-light card-body mt-1">
                            @foreach($tema->komentari as $komentar)
                            <div class="card border-primary mb-1">
                                <div class="card-body">
                                    <div class="media">
                                        <a href="{{route('teme_korisnika', [$komentar->user->slug])}}">
                                        @if ($komentar->user->naziv_slike == 'default.jpg')
                                        <img class="rounded rounded-circle mr-2" style="width: 50px;" src="{{asset('storage/'. $komentar->user->naziv_slike)}}">               
                                        @else
                                        <img class="rounded rounded-circle mr-2" style="width: 50px;" src="{{asset('storage/'.$komentar->user->slug.'/'. $komentar->user->naziv_slike)}}">                
                                        @endif
                                        </a>
                                        <div class="pt-1 pl-1">
                                            <a href="{{route('teme_korisnika', [$komentar->user->slug])}}" class="font-weight-bold">{{$komentar->user->name}}</a> 
                                            <p class="text-muted mb-0">
                                            </b>@include('includes.datum_komentara')</b>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="card-text pl-1 pt-3 font-italic">{{$komentar->tekst_komentara}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
<script>
    $(document).ready(function(){
        $('.btn-show').click(function(){
            var button = $(this);
            var txt = button.data('id');
            if(button.data('flag') == null || undefined){
            $.post("{{route('pogledano')}}", {_token: "{{csrf_token()}}", id: txt}, function(data){
                if(data.success == true){
                    button.data('flag', 'd');
                    button.find('span').remove();
                }
            });}
        }); 
    });
</script>
@endsection