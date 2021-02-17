@extends('layouts.app')
@section('content')
<style>
    #required_doc {
        border: 1px solid #ddd;
        padding: 20px;
    }

    #required_doc_div {
        display: none;
    }

</style>
<div class="page-header">
    <h2> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2>
</div>

@if(Auth::user()->group_id != 7)
<div class="toolbar-nav">
    <div class="row">
        <div class="col-md-6 ">
            <div class="submitted-button">
                <button name="apply" class="tips btn btn-sm btn-default  " title="{{ __('core.btn_back') }}"><i
                        class="fa  fa-check"></i> {{ __('core.sb_apply') }} </button>
                <button name="save" class="tips btn btn-sm btn-default" id="saved-button"
                    title="{{ __('core.btn_back') }}"><i class="fa  fa-paste"></i> {{ __('core.sb_save') }} </button>
            </div>
        </div>
        <div class="col-md-6 text-right ">
            <a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-default  btn-sm "
                title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>
        </div>
    </div>
</div>
@endif


{!! Form::open(array('url'=>'insuranceclaims?return='.$return, 'class'=>'form-horizontal validated concave-form','files'
=> true ,'id'=> 'FormTable' )) !!}

<div class="p-5">
    <ul class="parsley-error-list">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend> General Information</legend>
                {!! Form::hidden('id', $row['id']) !!}

                @if(Auth::user()->group_id == 7 || Auth::user()->group_id == 5)
                @php
                $userid = Auth::id();
                $subscriptions = App\Models\Insurancesubscriptions::where('entry_by',$userid)->where('status',1)->get();
                @endphp


                <div class="form-group row">
                    <label for="Insurance Package" class=" control-label col-md-4 text-left"> Insurance Package  <span style="color:red">*</span></label>
                    <div class="col-md-6">

                        <select name='package_id' rows='5' class="form-control package_trigger" required>
                            <option selected disabled>-- Select Package --</option>
                            @foreach($subscriptions as $sub)
                                @if(Helper::verifyOrder($sub->id))
                                <option value="{{$sub->package_id}}" @if($row['package_id']==$sub->package_id ) selected @endif >{{ \App\Models\Insurancepackage::find($sub->package_id)->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>


                @else

                <div class="form-group row">
                    <label for="Insurance Package" class=" control-label col-md-4 text-left"> Insurance Package  <span style="color:red">*</span></label>
                    <div class="col-md-6">
                        <select name='package_id' rows='5' id='package_id' class='select2' required></select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                @endif




                @if(Auth::user()->group_id == 7 || Auth::user()->group_id == 5)
                <div class="form-group row">
                    <label for="Insurance" class=" control-label col-md-4 text-left"> Insurance  <span style="color:red">*</span></label>
                    <div class="col-md-6">
                        <select name='insurance_id' rows='5' class='form-control dynamic_insurance' required>
                            <option disabled selected>-- Select Insurance Package First --</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div id="required_doc_div">
                    <div class="form-group row">
                        <label class="control-label col-md-4 text-left"> Required Documents for Claim </label>
                        <div class="col-md-6">
                            <div id="required_doc"></div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>


                @else
                <div class="form-group row">
                    <label for="Insurance" class=" control-label col-md-4 text-left"> Insurance  <span style="color:red">*</span></label>
                    <div class="col-md-6">
                        <select name='insurance_id' rows='5' id='insurance_id' class='select2' required></select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                @endif




                <div class="form-group row">
                    <label for="Documents" class=" control-label col-md-4 text-left"> Documents  <span style="color:red">*</span></label>
                    <div class="col-md-6">

                        <a href="javascript:void(0)" class="btn btn-xs btn-primary pull-right"
                            onclick="addMoreFiles('documents')"><i class="fa fa-plus"></i></a>
                        <div class="documentsUpl multipleUpl">
                            <div class="fileUpload btn ">
                                <span> <i class="fa fa-file"></i> </span>
                                <div class="title"> Browse File </div>
                                <input required type="file" name="documents[]" class="upload"
                                    accept="image/x-png,image/gif,image/jpeg,application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />

                            </div>
                        </div>
                        <ul class="uploadedLists ">
                            <?php $cr= 0; 
										$row['documents'] = explode(",",$row['documents']);
										?>
                            @foreach($row['documents'] as $files)
                            @if(file_exists('./uploads/files'.$files) && $files !='')
                            <li id="cr-<?php echo $cr;?>" class="">
                                <a href="{{ url('/uploads/files/'.$files) }}" target="_blank">
                                    {!! SiteHelpers::showUploadedFile( $files ,"/uploads/images/",100) !!}
                                </a>
                                <span class="pull-right removeMultiFiles" rel="cr-<?php echo $cr;?>"
                                    url="/uploads/files{{$files}}">
                                    <i class="fa fa-trash-o  btn btn-xs btn-danger"></i></span>
                                <input type="hidden" name="currdocuments[]" value="{{ $files }}" />
                                <?php ++$cr;?>
                            </li>
                            @endif

                            @endforeach
                        </ul>

                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="form-group row  ">
                    <label for="Payment Method" class=" control-label col-md-4 text-left"> Payment Method </label>
                    <div class="col-md-6">

						<?php 
						$payment_method = explode(',',$row['payment_method']);
						$payment_method_opt = array( 'bkash' => 'Bkash' ,  'rocket' => 'Rocket' ,  'bank' => 'Bank Account' , ); ?>
                        <select name='payment_method' rows='5' class='form-control' required>
							<option disabled selected>-- Select Payment Method --</option>
                            <?php 
								foreach($payment_method_opt as $key=>$val){
									echo "<option  value ='$key' ".($row['payment_method'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
								}?>
                        </select>

                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                <div class="form-group row  ">
                    <label for="Payment Note" class=" control-label col-md-4 text-left"> Payment Note </label>
                    <div class="col-md-6">
                        <textarea name='payment_note' rows='5' id='payment_note' class='form-control form-control-sm'
                            placeholder='If you want your claim money to your bank account, please provide: Account Name, Account Number, Bank name, Branch Name' required>{{ $row['payment_note'] }}</textarea>
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                <div class="form-group row ">
                    <label for="Hospital Name" class=" control-label col-md-4 text-left"> Hospital Name </label>
                    <div class="col-md-6">
                        <input type='text' name='hospital_name' id='hospital_name' value='{{ $row['hospital_name'] }}'
                            class='form-control form-control-sm' />
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="form-group row">
                    <label for="Admit Date" class=" control-label col-md-4 text-left"> Admit Date </label>
                    <div class="col-md-6">
                        <div class="input-group input-group-sm m-b" style="width:150px !important;">
                            <input type='date' name='admit_date' id='admit_date' value='{{ $row['admit_date'] }}'
                                class='form-control form-control-sm txtDate' />
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="form-group row">
                    <label for="Admit Date" class=" control-label col-md-4 text-left">Release Date </label>
                    <div class="col-md-6">
                        <div class="input-group input-group-sm m-b" style="width:150px !important;">
                            <input type='date' name='release_date' id='release_date' value='{{ $row['release_date'] }}'
                                class='form-control form-control-sm txtDate' />
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>



                @if(\Auth::user()->group_id != 7 && \Auth::user()->group_id != 5 )
                <div class="form-group row ">
                    <label for="Premium" class=" control-label col-md-4 text-left"> Premium </label>
                    <div class="col-md-6">
                        <input type='number' name='premium' id='premium' value='{{ $row['premium'] }}'
                            class='form-control form-control-sm' />
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="form-group row">
                    <label for="Claim Note" class=" control-label col-md-4 text-left"> Claim Note </label>
                    <div class="col-md-6">
                        <textarea name='claim_note' rows='5' id='claim_note'
                            class='form-control form-control-sm '>{{ $row['claim_note'] }}</textarea>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                @endif


                @if(\Auth::user()->group_id != 7 && \Auth::user()->group_id != 5 )
                <div class="form-group row  ">
                    <label for="Status" class=" control-label col-md-4 text-left"> Status  <span style="color:red">*</span></label>
                    <div class="col-md-6">
                        <select name='status' rows='5' id='status' class='select2' required></select>
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                @else
                <input type="hidden" name="status" value="4">
                @endif

            </fieldset>

            <input type="hidden" name="action_task" value="save" />
            <p class="text-right">
                @if(\Auth::user()->group_id == 7 || \Auth::user()->group_id == 5)
                <a href="javascript:void(0)"  id="apply_now" class="tips btn btn-sm  btn-success"> CLAIM NOW </a>
                @endif
            </p>

        </div>

    </div>

</div>
</div>


{!! Form::close() !!}


<!-- Modal -->
<div class="modal fade" id="otpModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">OTP Verification Process</h4>
                <a style="padding: 0;margin: 0;" type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            <div class="modal-body">
                <p>Please submit OTP verification code sent to your mobile number.</p>
                <form id="otp_form">
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="otp_code" name="otp_code">
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
                <p class="res"></p>
                <p class="text-danger otp_failed">Did not recieve OTP? <a href="javascript:void(0)" id="apply_now">Click
                        here</a> to regenerate.</p>
            </div>
        </div>
    </div>
</div>






<script type="text/javascript">
    $(document).ready(function () {

        $("#package_id").jCombo("{!! url('insuranceclaims/comboselect?filter=con_package:id:title') !!}", {
            selected_value: '{{ $row["package_id"] }}'
        });

        $("#insurance_id").jCombo("{!! url('insuranceclaims/comboselect?filter=con_insurance:id:title') !!}", {
            selected_value: '{{ $row["insurance_id"] }}'
        });

        $("#status").jCombo("{!! url('insuranceclaims/comboselect?filter=con_status:id:name') !!}", {
            selected_value: '{{ $row["status"] }}'
        });

        $('.removeMultiFiles').on('click', function () {
            var removeUrl = '{{ url("insuranceclaims/removefiles?file=")}}' + $(this).attr('url');
            $(this).parent().remove();
            $.get(removeUrl, function (response) {});
            $(this).parent('div').empty();
            return false;
        });

    });

    jQuery(document).on('click', '.txtDate', function () {
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10) month = '0' + month.toString();
        if (day < 10) day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;
        jQuery('.txtDate').attr('max', maxDate);
    });

    jQuery(document).on('change', '#division', function () {
        jQuery.ajax({
            url: "{{ url('/getdistrict')}}/" + jQuery(this).find('option:selected').val(),
            cache: false,
            success: function (response) {
                jQuery('.select_district').html(response);
            }
        });
    });


    jQuery(document).on('change', '.package_trigger', function () {
        var url = '{{ url("getinsurance")}}/' + jQuery(this).find('option:selected').val();
        jQuery.get(url, function (response) {
            jQuery('.dynamic_insurance').html(response);
        });

    });

    jQuery(document).ready(function () {
        var url = '{{ url("getinsurance")}}/' + jQuery('.package_trigger').find('option:selected').val();
        jQuery.get(url, function (response) {
            jQuery('.dynamic_insurance').html(response);
        });
        var selectedInsurance = '{{ $row['insurance_id '] ?? ''}}';
        setTimeout(function () {
            jQuery('.dynamic_insurance option[value=' + selectedInsurance + ']').prop('selected', true);
        }, 1000);

    });

    jQuery(document).on('change', '.dynamic_insurance', function () {
        jQuery('.row').show();
        var url = '{{ url("getinsurancetype")}}/' + jQuery('.dynamic_insurance').find('option:selected').val();
        jQuery.get(url, function (response) {
            jQuery('#required_doc').html(response);
            jQuery('#required_doc_div').show();
        });
        url = '{{ url("getinsurancehiddenfields")}}/' + jQuery('.dynamic_insurance').find('option:selected')
            .val();
        jQuery.get(url, function (response) {
            var obj = JSON.parse(response);
            obj.forEach(function (item) {
                jQuery('#' + item).closest('.row').hide();
            });
        });
    });


    jQuery(document).on('click', '#apply_now', function (e) {
		var x = true;
		jQuery('#FormTable input,#FormTable select,#FormTable textarea').each(function(key,val){
        if(jQuery(this).attr('required') != undefined){
          if(jQuery(this).val() == ''){
            if(x){
              alert('All fields are required. Fill the required fields first!');
               x = false;
            }
          }
        }
	});
	
	if(x){
		jQuery.ajax({
                url: "{{ url('/generate-otp')}}",
                method: 'POST',
                data: {
                    mobile_number: '<?= \Auth::user()->username; ?>',
                    masking: 0,
                    _token: '<?= csrf_token(); ?>'
                },
                cache: false,
                success: function (response) {
                    console.log(response);
                }
            });

            jQuery('#otpModal').modal({
                backdrop: 'static',
                keyboard: false
            })

	}


	});
	


    jQuery(document).on('submit', '#otp_form', function (e) {
        e.preventDefault();
        jQuery('#res').html('');
        jQuery.ajax({
            url: "{{ url('/verify-otp')}}",
            method: 'POST',
            data: {
                mobile_number: '<?= \Auth::user()->username; ?>',
                otp_code: jQuery('#otp_code').val(),
                _token: '<?= csrf_token(); ?>'
            },
            cache: false,
            success: function (response) {
                if (response) {
                    jQuery('#FormTable').submit();
                } else if (response == 0) {
                    jQuery('.res').html(
                        '<p class="text-danger">Invalid OTP. Please try with correct OTP.</p>')
                } else if (response == 2) {
                    jQuery('.res').html(
                        '<p class="text-danger">OTP has Expired. Please try with new OTP.</p>')
                }
            }
        });

    });

</script>
@stop
