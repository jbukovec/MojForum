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
                    <div class="card-body pb-2">
                        <a href="{{route('komentari_na_temu', ['slug'=> $tema->slug])}}">
                            <h3>{{$tema->naslov_teme}}</h3>
                        </a>
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
                @if(count($tema->komentari) < 1)
                    <h5><span class="badge badge-danger mt-1">Još nema komentara</span></h5><span class="text-muted font-italic">Budite prvi koji će ostaviti komentar</span>                    
                @else
                <h5><span class="badge badge-success mt-1"><i class="fas fa-comment-alt"></i> &nbsp; Komentara: {{count($tema->komentari)}}</span></h5>
                @endif
            </div>
        </div>
            <p>Objavio korisnik <a href="{{route('teme_korisnika', ['slug'=>$tema->user->slug])}}" class="mt-2 pt-2 pb-2">{{$tema->user->name}}</a> 
                @if (isset($query)) 
                    u kategoriji <a href="{{route('teme', ['url' => $tema->kategorija->url_naziv])}}">{{$tema->kategorija->naziv_kategorije}}</a> 
                @endif
                @if (isset($id)) 
                    @if($id == 0)
                        u kategoriji <a href="{{route('teme', ['url' => $tema->kategorija->url_naziv])}}">{{$tema->kategorija->naziv_kategorije}}</a> 
                    @endif
                @endif 
                <span> | </span><b>Datum objave: </b>
                @include('includes.datum_postavljanja_teme')
            </p>
        <hr> 
    @endforeach
</div>
{{$teme->links()}}