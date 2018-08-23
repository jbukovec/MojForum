@extends('layouts.app') 
@section('title', 'Pretraživanje korisnika')
@section('content')
    <div class="container">
        <h2 class="p-2 mb-3">Retultati pretrage za "{{$query}}"</h2>
        @if(count($users) != 0)
        <div class="card">
            <div class="row mt-4">
                @foreach($users as $user)
                <div class="col-md-4 text-center mt-4">
                    <a href="{{route('teme_korisnika', ['slug'=>$user->slug])}}">
                    @if ($user->naziv_slike == 'default.jpg')
                        <img style="max-width: 160px; min-width:65px; width:100%;" class="rounded profil-img" src="{{asset('storage/'. $user->naziv_slike)}}">                    
                    @else
                        <img class="rounded" style="max-width: 160px; min-width:65px; width:100%;" src="{{asset('storage/'.$user->slug.'/'. $user->naziv_slike)}}">                    
                    @endif
                    </a>
                    <div class="p-2">
                        <a href="{{route('teme_korisnika', ['slug'=>$user->slug])}}">{{$user->name}}</a>
                    </div>
                    @if(Auth::check())
                        @if(Auth::user()->is_admin == 1)
                            <div class="text-center mb-4">
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal" data-uid="{{$user->id}}" data-username="{{$user->name}}">Izbriši korisnika</button>
                            </div>  
                        @endif
                    @endif 
                </div>
                @endforeach
            </div>
            @if(count($users) != 0)
            <div class="pl-4 mt-4">{{$users->links()}}</div>
            @endif
        </div>
        @else
            <div class="alert alert-warning col mt-4" role="alert">
                Nema rezultata pretrage!
            </div>
        @endif
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
@endsection