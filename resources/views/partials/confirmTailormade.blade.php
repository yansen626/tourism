<div id="confirmTailormadeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <h3 class="text-center">Apakah anda yakin ingin mengconfirm?</h3>
                <br />

                <form role="form" class="form-horizontal form-label-left">

                    <div class="form-group">
                        <div class="control-label col-md-3 col-sm-3 col-xs-12">
                            <label for="url">URL <span class="required">*</span></label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="url" name="url" class="form-control col-md-7 col-xs-12" required/>
                        </div>

                        <input type="hidden" id="confirm-id" name="confirm-id"/>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Tidak
                    </button>
                    <button type="submit" class="btn btn-danger confirmTailormade">
                        <span class='glyphicon glyphicon-trash'></span> Ya
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>