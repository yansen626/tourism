<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <h3 class="text-center">Apakah anda yakin ingin mengconfirm?</h3>
                <br />

                <form role="form">
                    <input type="hidden" id="confirmed-id" name="confirmed-id"/>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Tidak
                    </button>
                    <button type="submit" class="btn btn-danger confirm">
                        <span class='glyphicon glyphicon-trash'></span> Ya
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>