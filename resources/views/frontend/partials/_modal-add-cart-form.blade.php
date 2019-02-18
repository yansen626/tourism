
<!-- Modal -->
<div id="myModalForm" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add To Cart</h4>
            </div>
            <div class=" col-md-12 modal-body">
                <div class="col-md-12 pb-10">
                    <span>Select Date = </span>
                    <input id='start_date' name="start_date" value="{{old('start_date')}}"  type="text" class="form-control">
                </div>
                <div class="col-md-12 pb-10">
                    <input type="hidden" id="package-id">
                    <input class="form-control" type="number" id="participant" onfocusout="editParticipant()"
                           placeholder="Participant" style="width: 50%;text-align: left;">
                    <input type="hidden" id="list-prices">
                    <input type="hidden" id="price-form">
                    <span>Total Price = </span>Rp <span id="total-price">0</span>
                </div>
                <div class="col-md-12">
                    <textarea id="notes" rows="5" placeholder="Special Request"
                          class="form-control" style="resize: none; overflow-y: scroll;margin-bottom: 1%"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                @php($url = route('addCart') )
                @php($csrfToken = csrf_token() )
                <button type="button" class="btn btn-default" data-dismiss="modal">Continue Browsing</button>
                <button onclick="addToCart('{{$url}}', '{{$csrfToken}}')" class="btn btn-default">Process</button>
            </div>
        </div>

    </div>
</div>