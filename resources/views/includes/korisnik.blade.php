@auth
@if($user->id == Auth::id() )
    <h2 class="p-1 mb-4">Sve Vaše teme i komentari</h2>
@else
<div class="row mb-3">
        <div class="col-md-2 col-sm-2 col-3 d-none d-md-block">
            <div>
                @if ($user->naziv_slike == 'default.jpg')
                    <img style="max-width: 160px; min-width:65px; width:100%;" class="rounded profil-img" src="{{asset('storage/'. $user->naziv_slike)}}">                    
                @else
                    <img class="rounded" style="max-width: 160px; min-width:65px; width:100%;" src="{{asset('storage/'.$user->slug.'/'. $user->naziv_slike)}}">                    
                @endif           
            </div>
        </div>
            <div class="col-10 d-none d-md-block">
                <h3 class="pt-2">Stranica korisnika <b>{{$user->name}}</b></h3>
                @include('includes.user_reg_datum')
            </div>
    
        <div class="col-12 d-block d-md-none text-center">
            <div>
                @if ($user->naziv_slike == 'default.jpg')
                    <img style="max-width: 160px; min-width:65px; width:100%;" class="rounded profil-img" src="{{asset('storage/'. $user->naziv_slike)}}">                    
                @else
                    <img class="rounded" style="max-width: 160px; min-width:65px; width:100%;" src="{{asset('storage/'.$user->slug.'/'. $user->naziv_slike)}}">                    
                @endif           
            </div>
        </div>
        <div class="col-12 d-block d-md-none text-center">
            <h3 class="pt-3">Stranica korisnika <b>{{$user->name}}</b></h3>
            @include('includes.user_reg_datum')
        </div>
    </div>
@endif
@endauth
@guest
<div class="row mb-3">
    <div class="col-md-2 col-sm-2 col-3 d-none d-md-block">
        <div>
            @if ($user->naziv_slike == 'default.jpg')
                <img style="max-width: 160px; min-width:65px; width:100%;" class="rounded profil-img" src="{{asset('storage/'. $user->naziv_slike)}}">                    
            @else
                <img class="rounded" style="max-width: 160px; min-width:65px; width:100%;" src="{{asset('storage/'.$user->slug.'/'. $user->naziv_slike)}}">                    
            @endif           
        </div>
    </div>
        <div class="col-10 d-none d-md-block">
            <h3 class="pt-2">Stranica korisnika <b>{{$user->name}}</b></h3>
            @include('includes.user_reg_datum')
        </div>

    <div class="col-12 d-block d-md-none text-center">
        <div>
            @if ($user->naziv_slike == 'default.jpg')
                <img style="max-width: 160px; min-width:65px; width:100%;" class="rounded profil-img" src="{{asset('storage/'. $user->naziv_slike)}}">                    
            @else
                <img class="rounded" style="max-width: 160px; min-width:65px; width:100%;" src="{{asset('storage/'.$user->slug.'/'. $user->naziv_slike)}}">                    
            @endif           
        </div>
    </div>
    <div class="col-12 d-block d-md-none text-center">
        <h3 class="pt-3">Stranica korisnika <b>{{$user->name}}</b></h3>
        @include('includes.user_reg_datum')
    </div>
</div>
@endguest