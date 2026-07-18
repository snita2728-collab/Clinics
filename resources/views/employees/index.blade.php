@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">{{ App::getLocale() === 'km' ? 'ការគ្រប់គ្រង' : 'Management' }}</li>
				<li class="active"><a href="/employee">{{ App::getLocale() === 'km' ? 'បុគ្គលិក' : 'Employee' }}</a></li>
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
                    {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ App::getLocale() === 'km' ? 'តារាងបុគ្គលិក' : 'Employee Table' }}
					<a class="btn btn-primary pull-right" href="{{route('employee.create')}}"><span class="glyphicon glyphicon-plus"></span>{{ App::getLocale() === 'km' ? 'បន្ថែមបុគ្គលិក' : 'Add Employee' }}</a></div>
					<div class="panel-body">
						<table id="example" class="table" cellspacing="0" width="100%">
						    <thead>
				        <tr>
				            <th data-sortable="true">{{ App::getLocale() === 'km' ? 'អត្តសញ្ញាណ' : 'ID' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'ឈ្មោះ' : 'Name' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'ទូរស័ព្ទ' : 'Phone' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'ថ្ងៃធ្វើការ' : 'Working Day' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'ម៉ោងចូល' : 'In-time' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'ម៉ោងចេញ' : 'Out-time' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'ប្រភេទ' : 'Type' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'សកម្មភាព' : 'Action' }}</th>
						    </tr>
					    </thead>
					    <tbody>
				    	@foreach($employees as $employee)
				        <tr>
				            <td>{{ $employee->id}}</td>
				            <td>{{$employee->first_name}} {{$employee->middle_name}} {{$employee->last_name}}</td>
				           	<td>{{$employee->phone}}</td>
				           	<td>{{$employee->working_day}}</td>
				    		<td>{{$employee->in_time}}</td>
				    		<td>{{$employee->out_time}}</td>
				    		<td>{{$employee->type}}</td>
				            <td>
				             <a class="btn btn-sm btn-primary" href="{{ route('employee.show',$employee->id) }}"><span class="glyphicon glyphicon-eye-open"></span> {{ App::getLocale() === 'km' ? 'ព័ត៌មានផ្ទាល់ខ្លួន' : 'Profile' }}</a>
				            </td>
				        </tr>
				    @endforeach
				    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
</div><!--/.main-->
<script type="text/javascript">
$(document).ready(function() {
  $(".select").select2();
});
</script>
@endsection