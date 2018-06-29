@extends('layouts.app')
@section('title', 'Admin panel')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Administratorska kontrolna ploča</div>
                <div class="card-body">
                    <div class="alert alert-info">Logirani ste kao Administrator!</div>      
                <div class="card card-body mt-4 text-primary bg-light border-primary">
                    <h4>Napravi novu kategoriju</h4>
                    {!!Form::open(['route' => 'napravi.kategoriju'])!!}
                    <div class="form-group">
                    {{Form::label('naziv', 'Naziv kategorije', ['class' => 'pt-2 pl-2'])}}
                    {{Form::text('naziv', null, ['class' => 'form-control', 'id' => 'kategorija-input'])}}
                    <div class="invalid-feedback mt-2 pt-1">
                        Uneseni naziv kategorije se već koristi!
                    </div>
                    </div>
                    {{Form::submit('Napravi kategoriju', ['class' => 'btn btn-primary', 'id' => 'napravi-kategoriju', 'disabled'])}}
                    {!!Form::close()!!}
                </div>    
                    <div class="row mt-4">
                        @if (count($kategorije) > 0)
                            @foreach ($kategorije as $kategorija)
                            <div class="col-4 mt-2">
                            <h4>{{$kategorija->naziv_kategorije}}
                            <span><button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-katid="{{$kategorija->id}}" data-katnaslov="{{$kategorija->naziv_kategorije}}"><i class="fas fa-times"></i></button></span>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Brisanje kategorije</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Otkaži</button>
            {!! Form::open(['route' => 'izbrisi.kategoriju', 'method' => 'DELETE', 'class' => 'izbrisi']) !!}
            {{ Form::hidden('id_kategorije',null,['id' => 'katid']) }}
            {{ Form::button('Izbriši temu', ['type' => 'submit', 'class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
<script>
$(document).ready(function(){
    //-- modal --
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('katid') // Extract info from data-* attributes
        
        var modal = $(this)
        modal.find('.modal-body').text('Jeste li sigurni da želite izbrisati kategoriju "'+ button.data('katnaslov')+'"?')
        modal.find('#katid').val(id)
        })
    //-- modal --

    var timeout;
	$('#kategorija-input').keyup(function () {
        $('#napravi-kategoriju').attr('disabled',true);
        var txt = $('#kategorija-input').val();
        if(txt){
            if(timeout != null){
                clearTimeout(timeout);
                }
                timeout = setTimeout(function () {
                    $.post("{{route('kategorija.postoji')}}", {contentType: "application/json; charset=utf-8" ,_token: "{{csrf_token()}}", naziv: txt}, function(data){
                        if(data.postoji == true){
                            $('#kategorija-input').addClass('is-invalid'); 
                        }
                        else {
                            $('#kategorija-input').removeClass('is-invalid');
                            $('#napravi-kategoriju').removeAttr('disabled');
                        }
                    });
                }, 500); 
        }
        else {
            clearTimeout(timeout);
            $('#napravi-kategoriju').attr('disabled',true);
        }
    });

});
</script>
@endsection