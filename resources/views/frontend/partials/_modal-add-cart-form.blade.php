
<!-- Modal -->
<div id="myModalForm" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add To Cart</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="package-id">
                <input class="form-control" type="number" id="participant" placeholder="Participant" style="width: 50%;text-align: left;">
                <br>
                <textarea id="notes" rows="5" placeholder="Special Request"
                          class="form-control" style="resize: none; overflow-y: scroll;margin-bottom: 1%"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Continue Browsing</button>
                <button onclick="addToCart()" class="btn btn-default">Process</button>
            </div>
        </div>

    </div>
</div>