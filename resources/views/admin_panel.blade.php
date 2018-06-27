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
                    {{Form::text('naziv', null, ['class' => 'form-control'])}}
                    </div>
                    {{Form::submit('Napravi kategoriju', ['class' => 'btn btn-primary'])}}
                    {!!Form::close()!!}
                </div>    
                    <div class="row mt-4">
                            @if (count($kategorije) > 0)
                            @foreach ($kategorije as $kategorija)
                            <div class="col-4 mt-2">  
                            {!!Form::open(['class' => 'izbrisi','route' => ['izbrisi.kategoriju', $kategorija->id], 'method' => 'DELETE'])!!}
                            <h4>{{$kategorija->naziv_kategorije}}
                            <span>
                            {{Form::button('<i class="fas fa-window-close"></i>', ['type' => 'submit', 'class' => 'ml-2 btn btn-danger', "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Izbriši kategoriju!"])}}
                            </span></h4>
                            {!!Form::close()!!}
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
<script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            $(".izbrisi").on("submit", function(){
        return confirm("Jeste li sigurni?");
    });  
        });
</script>
@endsection