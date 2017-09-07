
<!-- Modal -->
<div class="modal fade" id="add-cart-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-top: 10%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Success</h4>
            </div>
            <div class="modal-body text-center">
                Successfully Add to Cart
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="{{ route('cart-list') }}" type="button" class="btn btn-primary">View Cart</a>
            </div>
        </div>
    </div>
</div>