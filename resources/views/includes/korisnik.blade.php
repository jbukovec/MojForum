@if(Auth::check() && $user->id == Auth::id())
    <h2 class="p-1">Sve Vaše teme i komentari</h2>
    <div class="pl-1">@include('includes.user_reg_datum')</div>
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
                @if(Auth::check())
                    @if(Auth::user()->is_admin == 1)
                    <div class="pt-3">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal" data-uid="{{$user->id}}" data-username="{{$user->name}}">Izbriši korisnika</button>
                    </div>  
                    @endif
                @endif 
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
            @if(Auth::check())
                @if(Auth::user()->is_admin == 1)
                    <div class="text-center p-3">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal" data-uid="{{$user->id}}" data-username="{{$user->name}}">Izbriši korisnika</button>
                    </div>  
                @endif
            @endif 
        </div>
    </div>

    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteUserModalLabel">Brisanje korisnika</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Otkaži</button>
              {!! Form::open(['route' => 'delete.user', 'method' => 'DELETE']) !!}
              {{ Form::hidden('user_id', null, ['id' => 'uid'] ) }}
              {{ Form::submit('Izbriši', ['type'=> 'submit', 'class' => 'btn btn-danger']) }}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>

    <script>
        $(document).ready(function(){
            $('#deleteUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var user_name = button.data('username') // Extract info from data-* attributes
            var user_id = button.data('uid')
        
            var modal = $(this)
            modal.find('.modal-body p').text("Jeste li sigurni da želite izbrisati korisnika " + "'" + user_name + "'?")
            modal.find('.modal-footer #uid').val(user_id)
            })
        });
    </script>
@endif