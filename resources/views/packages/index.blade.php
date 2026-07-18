@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">{{ App::getLocale() === 'km' ? 'កញ្ចប់សេវា' : 'Package' }}</li>
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
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">{{ App::getLocale() === 'km' ? 'តារាងកញ្ចប់សេវា' : 'Package Table' }}<a class="btn btn-sm btn-primary pull-right" href="{{url('/')}}">
					{{ App::getLocale() === 'km' ? 'ត្រឡប់ក្រោយ' : 'Back' }} <span class="glyphicon glyphicon-share-alt"></span></a></div>
					<div class="panel-body">
					@if($packages->count())
						<table id="example" class="table" cellspacing="0" width="100%">
						<thead>
				        <tr>
				           <th>{{ App::getLocale() === 'km' ? 'ល.រ.' : 'S.N.' }}</th>
						   <th>{{ App::getLocale() === 'km' ? 'ឈ្មោះកញ្ចប់សេវា' : 'Package Name' }}</th>
						   <th>{{ App::getLocale() === 'km' ? 'ការពិនិត្យ/វិភាគ' : 'Tests' }}</th>
						   <th>{{ App::getLocale() === 'km' ? 'តម្លៃ' : 'Price' }}</th>
						   <th>{{ App::getLocale() === 'km' ? 'សកម្មភាព' : 'Action' }}</th>
				            
				        </tr>
				    	</thead>
				    	<tbody>

						<?php $i=1;?>
						@foreach($packages as $package)

							<tr>
								<td>{{$i++}}</td>
								<td>{{$package->name}}</td>
								<td>
						    		@foreach($package->packageTests()->get() as $package_test)
						    			<li>{{$package_test->test->name}}<a class="btn-sm" id="test_delete" data-id="{{$package_test->id}}"><span class="glyphicon glyphicon-remove"></span></a></li>
						    		@endforeach
						    	</td> 
						    	<td>{{format_price($package->price)}}</td>	
								<td>
                           <button id="package_edit" class="btn-sm btn-info" data-edit="{{$package->id}}, {{$package->name}}, {{$package->description}}, {{$package->price}}, {{$package->status}}"><span class="glyphicon glyphicon-edit" ></span>
                            </button>

                             <button class="btn-sm btn-danger" data-package="{{$package->id}}" id="package_delete"><span class="glyphicon glyphicon-remove"></span></button>
                            </td>
							</tr>
						     </td>
				        </tr>
				    @endforeach
				    </tbody>
					</table>
					@endif

					</div>
				</div>
			</div>
			<div class="col-md-4 add">
			<div class="panel panel-default">
				<div class="panel-heading">{{ App::getLocale() === 'km' ? 'បន្ថែមតម្លៃកញ្ចប់ថ្មី' : 'Add New Package' }}</div>
				<div class="panel-body">
				{!! Form::open(array('route' => 'package.store','method'=>'POST')) !!}
			    <div class=" form-group">
					<label>{{ App::getLocale() === 'km' ? 'ឈ្មោះកញ្ចប់សេវា:' : 'Package Name:' }}</label>
				 	{!! Form::text('name', null, array('class' => 'form-control')) !!}
				</div>
				<div class="form-group">
					<label>{{ App::getLocale() === 'km' ? 'ការពិពណ៌នា:' : 'Description:' }}</label>
					<input type="text" name="description" class="form-control">
				</div>
				<div class="form-group">
		      	<label>{{ App::getLocale() === 'km' ? 'ជ្រើសរើសការពិនិត្យ/វិភាគ:' : 'Select Tests:' }}</label>
			        <select name="test_id[]" class="form-control select" required style="width:100%" multiple="">
			        <option></option>
			            @foreach($tests as $test)
			                <option value="{{$test->id}}" data-name="{{$test->name}}">{{ $test->name}}</option>
			            @endforeach
			        </select>
			    </div>
			    <div class="form-group">
			    	<label>{{ App::getLocale() === 'km' ? 'តម្លៃ:' : 'Price:' }}</label>
			    	<input type="text" name="price" class="form-control" required="">
			    </div>
			     <div class="form-group">
	    	<label for="with_tax">{{ App::getLocale() === 'km' ? 'រួមបញ្ចូលពន្ធ' : 'With Tax' }}</label>
	    	<input type="checkbox" name="with_tax" id="with_tax" >
	    </div>
			    </div>
			    <div class="panel-footer">
				<button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-edit'></span>{{ App::getLocale() === 'km' ? 'បន្ថែម' : 'Add' }}</button>
				<button class="btn btn-default pull-right" type="reset">{{ App::getLocale() === 'km' ? 'កំណត់ឡើងវិញ' : 'Reset' }}</button>
           		</div>
           		{!! Form::close()!!}
			</div>
		</div>
		<!-- Edit Test -->
		<div class="col-md-4 edit" style="display: none">
			<div class="panel panel-default">
				<div class="panel-heading">{{ App::getLocale() === 'km' ? 'កែសម្រួលកញ្ចប់សេវា' : 'Edit Package' }}</div>
				<div class="panel-body">
				{!! Form::open(array('route' => 'package.edit','method'=>'POST' )) !!}
				<input name="id" type="name" class="hidden form-control" id="id" >
			    <div class=" form-group">
					<label>{{ App::getLocale() === 'km' ? 'ឈ្មោះកញ្ចប់សេវា:' : 'Package Name:' }}</label>
				 	{!! Form::text('name', null, array('class' => ' form-control',  'id'=>'name')) !!}
				</div>
				<div class="form-group">
					<label>{{ App::getLocale() === 'km' ? 'ការពិពណ៌នា:' : 'Description:' }}</label>
					<input type="text" name="description" class="form-control" id="description">
				</div>
			    <div class="form-group">
			    	<label>{{ App::getLocale() === 'km' ? 'តម្លៃ:' : 'Price:' }}</label>
			    	<input type="text" name="price" class="form-control"  id="price">
			    </div>
			
				<div class="form-group">
				<label>{{ App::getLocale() === 'km' ? 'បន្ថែមការពិនិត្យ/វិភាគ:' : 'Add Tests:' }}</label>
			        <select name="test_id[]" class="form-control select" style="width:100%"  multiple>
			       
			            @foreach($tests as $test)
			                <option value="{{$test->id}}" data-name="{{$test->name}}">{{ $test->name}}</option>
			            @endforeach
			        
			        </select>
			    </div> 
			     <div class="form-group">
			    	<label for="with_tax">{{ App::getLocale() === 'km' ? 'រួមបញ្ចូលពន្ធ' : 'With Tax' }}</label>
			    	<input type="checkbox" name="with_tax" id="with_tax" >
			    </div>
			    </div>
				<div class="panel-footer">
					<button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-edit'></span>{{ App::getLocale() === 'km' ? 'កែសម្រួល' : 'Edit' }}</button>
					<a class="btn btn-default pull-right" id="cancel">{{ App::getLocale() === 'km' ? 'បោះបង់' : 'Cancel' }}</a>
           		</div>
           		
           		{!! Form::close()!!}
			</div>
		</div>
</div>
			
<div class="modal fade" id="delete"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">{{ App::getLocale() === 'km' ? 'លុបការពិនិត្យ/វិភាគ' : 'Delete Test' }}</h4>
      </div>
      {!! Form::open(array('route' => 'package.test.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="delete_id">
      	<label>{{ App::getLocale() === 'km' ? 'តើអ្នកប្រាកដជាចង់លុបការពិនិត្យ/វិភាគនេះមែនទេ?' : 'Are your sure want to delete this test test?' }}</label>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> {{ App::getLocale() === 'km' ? 'ទេ' : 'No' }}</button>
           <button class="btn btn-danger" type="submit"><span class='glyphicon glyphicon-ok'></span> {{ App::getLocale() === 'km' ? 'បាទ/ចាស' : 'Yes' }}</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>

<div class="modal fade" id="deletePackage"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">{{ App::getLocale() === 'km' ? 'លុបកញ្ចប់សេវា' : 'Delete Package' }}</h4>
      </div>
      {!! Form::open(array('route' => 'package.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="package_id">
      	<label>{{ App::getLocale() === 'km' ? 'តើអ្នកប្រាកដជាចង់លុបកញ្ចប់សេវានេះមែនទេ?' : 'Are your sure want to delete this pacakge?' }}</label>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> {{ App::getLocale() === 'km' ? 'ទេ' : 'No' }}</button>
           <button class="btn btn-danger" type="submit"><span class='glyphicon glyphicon-ok'></span> {{ App::getLocale() === 'km' ? 'បាទ/ចាស' : 'Yes' }}</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
<script type="text/javascript">
$('#cancel').click(function(){
	 	$('.edit').hide();
        $('.add').show();
});
  
 $(document).on('click', '#package_edit', function() {
 		
        var stuff = $(this).data('edit').split(',');
        fillmodalData(stuff)
        $('.add').hide();
        $('.edit').show();
        
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#description').val(details[2]);
        $('#price').val(details[3]);
        
    }
     $(document).on('click', '#test_delete', function() 
    {
    	var id = $(this).data('id');
    	$('#delete_id').val(id);
    	$('#delete').modal('show');
    });

    $(document).on('click', '#package_delete', function() 
    {
    	var id = $(this).data('package');
    	$('#package_id').val(id);
    	$('#deletePackage').modal('show');
    });

</script>
@endsection
		
				    	