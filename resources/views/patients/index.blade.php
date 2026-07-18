@extends('layouts.app')
@section('content')
@include('patients.partials.add')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">{{ App::getLocale() === 'km' ? 'អ្នកជំងឺ' : 'Patient' }}</li>
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
					<div class="panel-heading">{{ App::getLocale() === 'km' ? 'តារាងអ្នកជំងឺ' : 'Patient Table' }}<a class="btn btn-primary pull-right" data-toggle="modal" href="#addPatient"><span class="glyphicon glyphicon-plus"></span>{{ App::getLocale() === 'km' ? 'បន្ថែមអ្នកជំងឺ' : 'Add Patient' }}</a></div>
					<div class="panel-body">
						<table id="example" class="table" cellspacing="0" width="100%">
						<thead>
				        <tr>
				            <th >{{ App::getLocale() === 'km' ? 'អត្តសញ្ញាណ' : 'ID' }}</th>
					        <th>{{ App::getLocale() === 'km' ? 'ឈ្មោះ' : 'Name' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'ទូរស័ព្ទ' : 'Phone' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'អាសយដ្ឋាន' : 'Address' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'អ៊ីមែល' : 'Email' }}</th>
					        <th data-sortable="true">{{ App::getLocale() === 'km' ? 'សកម្មភាព' : 'Action' }}</th>
						    </tr>
					    </thead>
					    <tbody>
				    	@foreach($patients as $patient)
				        <tr>
				            <td>{{ $patient->id}}</td>
				            <td>{{$patient->first_name}} {{$patient->middle_name}} {{$patient->last_name}}</td>
				           <td>{{$patient->phone}}</td>
				    		<td>{{$patient->district}}, {{$patient->location}}</td>
				    		<td>{{$patient->email}}</td>
				            <td>
				             <a class="btn btn-sm btn-primary" href="{{ route('patient.show',$patient->id) }}"><span class="glyphicon glyphicon-eye-open"></span> {{ App::getLocale() === 'km' ? 'ព័ត៌មានផ្ទាល់ខ្លួន' : 'Profile' }}</a>
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


@endsection