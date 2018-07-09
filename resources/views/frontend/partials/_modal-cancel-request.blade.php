
<!-- Modal -->
<div id="cancelRequest" class="modal fade" role="dialog">
    {{ Form::open(['route'=>['transaction.cancel'],'method' => 'post','id' => 'general-form','class'=>'checkout woocommerce-checkout']) }}
    {{--<form name="checkout" method="post" action="{{ route('tailor-made') }}" class="checkout woocommerce-checkout">--}}
    {{ csrf_field() }}

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cancel Booking</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="detail" value="{{$transactionDetail->id}}">
                <p id="order_comments_field" class="form-row notes mt-20 mb-20">
                    <textarea id="request" name="request" placeholder="Why Cancel Your Booking?" rows="2" cols="6" class="input-text"></textarea>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Proceed" class="btn btn-danger"/>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>