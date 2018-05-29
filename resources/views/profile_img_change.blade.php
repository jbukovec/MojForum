@extends('layouts.app') 
@section('content')
<div class="container-fluid">
<h2 class="mb-2 p-4 text-center">Odaberite sliku s Vašeg računala</h2>
        <div style="margin-top:50px;" class="text-center">
                {!!Form::open(['route' => 'image.upload','method'=>'PUT','files'=>'true'])!!} 
                <p>Odaberite sliku profila sa vašeg računala!</p>
                <div class="" style="left:50%;">
                {{Form::file('image')}}{{Form::submit('Učitaj sliku',['class'=>'btn btn-success'])}} </div>
                {{-- {{Form::hidden('_method','PUT')}} --}} 
                 </div>
                {!!Form::close()!!}
                </div>
            </div>   
                @if(count($slike_profila)>0)
                <h2 class="mb-2 p-4 mt-4 text-center">Ili odabarite neku od Vaših prijašnjih slika profila. </h2>
                <div style="margin-top:25px;" class="row">
                @unless (Auth::user()->naziv_slike == 'default.jpg')
                <div class="col-md-4">
                    {!!Form::open(['route'=>'postavi.img','method'=>'PUT'])!!}
                    <div class="text-center thumbnail">
                        <img class="rounded" style="max-width:400px; width:100%;" src="{{asset('storage/default.jpg')}}">        
                    {{Form::hidden('profilna_slika','default.jpg')}}
                        <div style="margin-bottom: 20px; margin-top:10px;" class="text-center">
                    {{Form::submit('Postavi za profilnu sliku',['class'=>'btn btn-primary btn-large'])}}
                    {!!Form::close()!!}
                        </div>
                    </div>     
                </div>
                @endunless
                @foreach ($slike_profila as $item)
               
                    @if(!($item->naziv_profilne_slike == Auth::user()->naziv_slike))
                    <div class="col-md-4">
                        {!!Form::open(['route'=>'postavi.img','method'=>'PUT'])!!}
                        <div class="text-center thumbnail">
                            <img class="rounded" style="max-width:400px; width:100%;" src="{{asset('storage/'.Auth::user()->name.'/'.$item->naziv_profilne_slike)}}">
                        
                        {{Form::hidden('profilna_slika',$item->naziv_profilne_slike)}}
                            <div style="margin-bottom: 20px; margin-top:10px;" class="text-center">
                        {{Form::submit('Postavi za profilnu sliku',['class'=>'btn btn-primary btn-large'])}}
                        {!!Form::close()!!}
                        {!!Form::open(['route'=>'delete.img','method'=>'DELETE'])!!}
                        {{Form::hidden('img_id',$item->id)}}
                        <div style="margin-top:10px;">
                        {{Form::submit('Izbriši sliku',['class'=>'btn btn-danger'])}}
                        </div>
                        {!!Form::close()!!}
                            </div>                 
                        </div>
                    </div>
                       
                    @endif             
                @endforeach
                @endif
    </div> 
@endsection