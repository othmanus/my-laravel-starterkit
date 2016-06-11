<!-- Modal delete -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete-title" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-body">
                <p>Ete vous sur de continuer cette opération ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btn-delete-confirm" data-dismiss="modal"><i class="fa fa-trash-o"></i> Supprimer</button>
                <button type="button" class="btn btn-default" id="btn-delete-cancel" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirmer suppression -->
<script type="text/javascript">
    $('.btn-delete').on('click', function(e){ 
        e.preventDefault();
        var $form=$(this).closest('form');
        $('#modal-delete').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#btn-delete-confirm', function() {
            $form.trigger('submit');
        });
        return false;
    });
</script>