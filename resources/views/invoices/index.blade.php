@extends('layouts.app')
@section('content')
<script type="text/javascript">
$(document).ready(function() {
  $(".select").select2();
});
</script>
<div class="col-lg-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">{{ App::getLocale() === 'km' ? 'វិក្កយបត្រ' : 'Invoice' }}</li>
			</ol>
		</div><br><!--/.row-->
<!-- Modal -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
@if (count($errors) > 0)
        <div class="alert alert-danger">
          
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>{{ App::getLocale() === 'km' ? 'វិក្កយបត្រសេវាកម្ម' : 'Service Bill' }}</div>
            <div class="panel-body">
				<div class="row">
					<div class="col-md-8">
						<!-- services -->
						<div class="row">
						{{Form::open(array('route'=>'invoice.store', 'method'=>'post', 'class'=>'form-group'))}}

						<div class="col-md-6 form-group">
							<label>{{ App::getLocale() === 'km' ? 'សេវាកម្ម:' : 'Services:' }}</label>
							<select class="form-control select" name="service_id" id="service_id">
							<option value="">{{ App::getLocale() === 'km' ? 'ជ្រើសរើសសេវាកម្ម:' : 'Select Services:' }}</option>
							@foreach($services as $service)
			  				<option value="{{$service->id}}">{{$service->name}}</option>
			 		 		@endforeach
			 		 		</select>
	 		 			</div>
						<div class="col-md-6 form-group">
							<label>{{ App::getLocale() === 'km' ? 'អ្នកជំងឺ:' : 'Patients:' }}</label>
							<select class="form-control select" name="patient_id" id="patient_id" required>
							<option value="">{{ App::getLocale() === 'km' ? 'ជ្រើសរើសអ្នកជំងឺ:' : 'Select Patient:' }}</option>
							@foreach($patients as $patient)
	  						<option value="{{$patient->id}}">ID: {{$patient->id}}. {{$patient->first_name}} {{$patient->last_name}}</option>
	 		 				@endforeach
	 		 				</select>
	 		 			</div>
	 		 			<div class=" col-md-3 form-group">
							<label>{{ App::getLocale() === 'km' ? 'ប្រភេទបង់ប្រាក់:' : 'Payment Type:' }}</label>
							<select name="payment_type" class="form-control">
								<option value="Cash">{{ App::getLocale() === 'km' ? 'សាច់ប្រាក់' : 'Cash' }}</option>
								<option value="Cheque">{{ App::getLocale() === 'km' ? 'មូលប្បទានបត្រ' : 'Cheque' }}</option>
								<option value="Credit">{{ App::getLocale() === 'km' ? 'ឥណទាន' : 'Credit' }}</option>
							</select>
						</div>
							<div class=" col-md-2 form-group">
							<label>{{ App::getLocale() === 'km' ? 'លេខវិក្កយបត្រ:' : 'Invoice No:' }}</label>
	                        <input type="text" class="form-control" name="invoice_no" value="{{$setting->invoice_prefix}}{{$invoice_no}}" readonly>
	                        </div>
	                        <div id="payment" style="display: none;">
	                        <div class=" col-md-3 form-group">
								<label>{{ App::getLocale() === 'km' ? 'វេជ្ជបណ្ឌិតណែនាំ:' : 'Doctor Reffered:' }}</label>
								<select name="doctor_id" class="form-control">
								<option></option>
									@foreach($doctors as $doctor)
									<option value="{{$doctor->id}}">{{$doctor->employee->first_name}} {{$doctor->employee->last_name}}</option>
									@endforeach
								</select>
							</div>
	                       
		                        <div class="col-md-2 form-group">
								<label>{{ App::getLocale() === 'km' ? 'បញ្ចុះតម្លៃ :' : 'Discount :' }}</label>
								<input type="number" name="discount"  placeholder="" class="form-control" id="discount"><br>
								</div>
								
		                        <div class="col-md-2 form-group">
								<label>{{ App::getLocale() === 'km' ? 'ទទួលបានសាច់ប្រាក់ :' : 'Cash :' }}</label>
								<input type="number" name="cash"  placeholder="" class="form-control" id="cash" required><br>
								</div>
								
							</div>

							<input type="submit" id="submit" class="hidden">
							<div class="col-md-12 form-group" id="comment" style="display: none;">
								<input type="textarea" class="form-control" name="comment" placeholder="{{ App::getLocale() === 'km' ? 'មតិយោបល់...' : 'Comment...' }}" >
							</div>
		 		 			{{Form::close()}}		

		 		 		</div>
		 		 		<div class="row">
						<div class="col-md-12">
		 		 				<div id="service_sales"></div></div>
						</div><br>
		 		 		</div>
		 		 		
						<div class="col-md-4">

							<h3 class='text-center'>{{ App::getLocale() === 'km' ? 'ការទូទាត់ប្រាក់' : 'Payment' }}</h3>
							<p>--------------------------------------------------------------------</p>
							<div class="row">
							<div class="col-md-12" id="calculateBtn" style="display: none">
	                            <button class="btn btn-primary" id="calculate"><span class="glyphicon glyphicon-ok"></span>{{ App::getLocale() === 'km' ? 'គណនា' : 'Calculate' }}</button> <br><br><span id="msg"></span><br>
		                        
                            </div>
                            <br>
                            <div class="col-md-12">
								<div id="tender"></div>
							</div>

		 		 			
		 		 			<div class="col-md-12" id="complete" style="display: none;">
		 		 			<p>--------------------------------------------------------------------</p>
		 		 				<button class="btn btn-success" id="complete">{{ App::getLocale() === 'km' ? 'រួចរាល់' : 'Complete' }}</button>
		 		 				<a href="{{url('invoice')}}" class="btn btn-default">{{ App::getLocale() === 'km' ? 'កំណត់ឡើងវិញ' : 'Reset' }}</a>
		 		 			</div>	
						</div>
						</div>
						</div>
					
							
						
					</div>
				</div>
		</div>
		</div>
		</div>
		</div>
		
 <script>
 var currentLocale = "{{ App::getLocale() }}";
 function del(id)
			{
				//alert(id)
				$('#service_sales').load({!! json_encode(url('/invoice/remove'))!!}+'/'+id);
			  

			}
        $(document).ready( function() {

			$('#complete').on('click', '#complete', function() 
			{
				$('#submit').click();

			});
            $('#service_id').on('change', function() {
            	$('#complete').hide();
        		$('#comment').hide();
        		$('#tender').hide();
                var service_id = $('#service_id').val();
                //ajax
              $('#service_sales').load({!! json_encode(url('/invoice/sales')) !!}+'/'+service_id);
            });

            $('#patient_id').on('change', function(){
            	var patient_id = $('#patient_id').val();
            	$('#payment').show();
            	$('#calculateBtn').show();
            });



	$('#calculate').click(function()
        {

       	$('#tender').hide();
        $('#complete').hide();
        var cash = $('#cash').val();
        var discount = $('#discount').val();
        var sub_total = $('#sub_total').val();
        var tax = $('#tax_percent').val();

        if(sub_total.length) {
       
            if(cash > 0) {

        	var total = sub_total - discount;
        	var tax_amount = total * tax /100;
        	var total_amount = total + tax_amount;
        		
        	var tender_amount = cash - total_amount.toFixed();;
        	
    		if(tender_amount < 0) {

    			$('#msg').show();
    			$("#msg").html("<div style='color:red;margin-bottom: 20px;'><span class='btn-sm alert-danger'>" + (currentLocale === 'km' ? 'សាច់ប្រាក់មិនគ្រប់គ្រាន់...' : 'Insufficient Balance...') + "</span></div>");
    		}
    		else {

	    		$('#msg').hide();
	        	$('#complete').show();
	    		$('#comment').show();
	    		$('#tender').html('<strong>' + (currentLocale === 'km' ? 'សរុបរង: ' : 'Sub Total: ') + window.formatJSPrice(sub_total) +'</strong><br><strong>' + (currentLocale === 'km' ? 'បញ្ចុះតម្លៃ: ' : 'Discount: ') + window.formatJSPrice(discount) + '</strong><br><b>------------------------------</b><br><strong>' + (currentLocale === 'km' ? 'ចំនួនត្រូវគិតពន្ធ: ' : 'Taxable Amount: ') + window.formatJSPrice(total)+'</strong><br><strong>' + (currentLocale === 'km' ? 'ពន្ធ' : 'HST') + '('+ tax+'%): '+ window.formatJSPrice(tax_amount) +'</strong><br><b>-----------------------------<b><br><strong>' + (currentLocale === 'km' ? 'សរុប: ' : 'Total: ') + window.formatJSPrice(total_amount) +'</strong><br><strong>' + (currentLocale === 'km' ? 'ទទួលបានសាច់ប្រាក់: ' : 'Cash: ') + window.formatJSPrice(cash) + '</strong><br><strong>' + (currentLocale === 'km' ? 'ប្រាក់អាប់: ' : 'Return: ') + window.formatJSPrice(tender_amount)+ '</strong>');
	    		$('#tender').show();
	    	}  
    	}
        else {
        	$('#msg').show();
        	$("#msg").html("<div style='color:red;margin-bottom: 20px;'><span class='btn-sm alert-danger'>" + (currentLocale === 'km' ? 'សូមបញ្ចូលចំនួនសាច់ប្រាក់...' : 'Enter Cash Amount...') + "</span></div>");
        }
    }
    else
    {
    	$('#msg').show();
    	$("#msg").html("<div style='color:red;margin-bottom: 20px;'><span class='btn-sm alert-danger'>" + (currentLocale === 'km' ? 'សូមជ្រើសរើសវេជ្ជបណ្ឌិតជាមុនសិន...' : 'Please Select Doctor First...') + "</span></div>");

    }

});
   });
    </script>
  		@endsection