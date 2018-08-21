@extends('layouts.app') 
@section('title', 'Slike profila')
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
            @if(count($slike_profila)>0)
                <h2 class="mb-2 p-4 mt-4 text-center">Ili odabarite neku od Vaših prijašnjih slika profila. </h2>
                <div style="margin-top:25px;" class="row p-3">
                @unless (Auth::user()->naziv_slike == 'default.jpg')
                <div class="col-md-4">
                    <div class="text-center thumbnail">
                        <img class="rounded" style="max-width:400px; width:100%;" src="{{asset('storage/default.jpg')}}">
                    </div>  
                    {!!Form::open(['route'=>'postavi.img','method'=>'PUT'])!!}
                    {{Form::hidden('profilna_slika','default.jpg')}}
                    <div style="margin-bottom: 25px; margin-top:10px;" class="text-center">
                    {{Form::submit('Postavi za profilnu sliku',['class'=>'btn btn-primary btn-large'])}}
                    {!!Form::close()!!}
                    </div>
                </div>
                @endunless
                @foreach ($slike_profila as $item)
                    @if(!($item->naziv_profilne_slike == Auth::user()->naziv_slike))
                    <div class="col-md-4">
                        <div class="text-center thumbnail">
                            <img class="rounded" style="max-width:400px; width:100%;" src="{{asset('storage/'.Auth::user()->slug.'/'.$item->naziv_profilne_slike)}}">  
                        </div>
                        {!!Form::open(['route'=>'postavi.img','method'=>'PUT'])!!}
                        {{Form::hidden('profilna_slika',$item->naziv_profilne_slike)}}
                        <div style="margin-bottom: 10px; margin-top:10px;" class="text-center">
                            {{Form::submit('Postavi za profilnu sliku',['class'=>'btn btn-primary btn-large'])}}
                            {!!Form::close()!!}
                        </div>  
                        <div class="text-center" style="margin-bottom: 25px;">
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteImgModal" data-imgid="{{$item->id}}">Izbriši sliku</button>
                        </div>
                    </div>            
                    @endif             
                @endforeach
            @endif
    </div> 
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteImgModal" tabindex="-1" role="dialog" aria-labelledby="deleteImgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Brisanje slike</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Jeste li sigurni da želite izbrisati ovu sliku?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Otkaži</button>
          {!!Form::open(['route'=>'delete.img','method'=>'DELETE'])!!}
          {{Form::hidden('img_id',null, ['id' => 'img-id'])}}
          {{Form::submit('Izbriši sliku',['class'=>'btn btn-danger'])}}
          {!!Form::close()!!}
        </div>
      </div>
    </div>
</div>
<script>
    $(document).ready(function(){
            //-- modal delete--
        $('#deleteImgModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('imgid') // Extract info from data-* attributes
                
            var modal = $(this)
            modal.find('#img-id').val(id)
        })
    });
</script>
@endsection