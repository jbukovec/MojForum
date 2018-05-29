@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Promjena lozinke</div>
 
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('promijeni_lozinku') }}">
                        {{ csrf_field() }}
 
                        <div class="form-group row">
                            <label for="new-password" class="col-md-4 control-label">Dosadašnja lozinka</label>
 
                            <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control{{ $errors->has('current-password') ? ' is-invalid' : '' }}" name="current-password" required>
 
                                @if ($errors->has('current-password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="new-password" class="col-md-4 control-label">Nova lozinka</label>
 
                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control {{ $errors->has('new-password') ? ' is-invalid' : '' }}" name="new-password" required>
 
                                @if ($errors->has('new-password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="new-password-confirm" class="col-md-4 control-label">Potvrdi novu lozinku</label>
 
                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Promijeni lozinku
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection