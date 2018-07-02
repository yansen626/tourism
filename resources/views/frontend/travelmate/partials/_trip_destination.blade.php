<div class='row form-panel'>
    <div class='col-lg-12 col-md-12 col-xs-12'>
        <h3 class='text-center'>DESTINATION 1</h3>
    </div>
    <div class='col-lg-12 col-md-12 col-xs-12'>
        <div class='col-lg-6 col-md-6 col-xs-12'>
            <div class='row form-panel'>
                <div class='text-center' style='width: 100%;'>
                    <label for='trip_start_date_1'>START DATE</label>
                </div>
                <div class='input-group date' >
                    <input id='trip_start_date_1' name='trip_start_date[]' type='text' class='form-control' />
                    <span class='input-group-addon'>
                        <span class='glyphicon glyphicon-calendar'></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-lg-6 col-md-6 col-xs-12'>
            <div class='row form-panel'>
                <div class='text-center' style='width: 100%;'>
                    <label for='trip_end_date_1'>END DATE</label>
                </div>
                <div class='input-group date'>
                    <input id='trip_end_date_1' name='trip_end_date[]' type='text' class='form-control' />
                    <span class='input-group-addon'>
                        <span class='glyphicon glyphicon-calendar'></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class='col-lg-12 col-md-12 col-xs-12' style='margin-top: 20px;'>
        <div class='col-lg-6 col-md-6 col-xs-12'>
            <div class='row form-panel'>
                {!! Form::file('trip_image_1', array('id' => 'trip_image_1', 'class' => 'file-loading')) !!}
            </div>
        </div>
        <div class='col-lg-6 col-md-6 col-xs-12'>
            <div class='row form-panel'>
                <textarea id='trip_description_1' name='trip_description[]' rows='5' placeholder='TRIP DESCRIPTION' class='form-control' style='resize: none; overflow-y: scroll;'></textarea>
            </div>
        </div>
    </div>
</div>