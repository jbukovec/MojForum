@auth
@if($user->id == Auth::id() )
    <h2 class="p-1 mb-4">Sve Vaše teme</h2>
@else
<div class="row mb-3">
        <div class="col-md-2 col-sm-2 col-3">
            <div>
                @if ($user->naziv_slike == 'default.jpg')
                    <img style="max-width: 160px; min-width:65px; width:100%;" class="rounded profil-img" src="{{asset('storage/'. $user->naziv_slike)}}">                    
                @else
                    <img class="rounded" style="max-width: 160px; min-width:65px; width:100%;" src="{{asset('storage/'.$user->name.'/'. $user->naziv_slike)}}">                    
                @endif           
            </div>
        </div>
        <div class="col-10"><h2 class="p-1 mb-4">Stranica korisnika <b>{{$user->name}}</b></h2></div>
</div>
@endif
@endauth
@guest
<div class="row mb-3">
        <div class="col-md-2 col-sm-2 col-3">
            <div>
                @if ($user->naziv_slike == 'default.jpg')
                    <img style="max-width: 160px; min-width:65px; width:100%;" class="rounded profil-img" src="{{asset('storage/'. $user->naziv_slike)}}">                    
                @else
                    <img class="rounded" style="max-width: 160px; min-width:65px; width:100%;" src="{{asset('storage/'.$user->name.'/'. $user->naziv_slike)}}">                    
                @endif           
            </div>
        </div>
        <div class="col-10"><h3 class="p-1 mb-4">Stranica korisnika <b>{{$user->name}}</b></h3></div>
</div>
@endguest