@Auth
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Brisanje komentara</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Otkaži</button>
            {!! Form::open(['route' => 'izbrisi.komentar', 'method' => 'DELETE', 'class' => 'izbrisi']) !!}
            {{ Form::hidden('id_komentara',null,['id' => 'idkomentara']) }}
            {{ Form::button('Izbriši komentar', ['type' => 'submit', 'class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
<script>
    $(document).ready(function(){
    $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('idkomentara') // Extract info from data-* attributes
    
    var modal = $(this)
    modal.find('.modal-body').text('Jeste li sigurni da želite izbrisati ovaj komentar?')
    modal.find('#idkomentara').val(id)
        })
    });
</script>
@endauth