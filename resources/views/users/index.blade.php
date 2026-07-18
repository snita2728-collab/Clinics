@extends('layouts.app')
@section('content')
<div class="col-md-12 main">
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">{{ App::getLocale() === 'km' ? 'អ្នកប្រើប្រាស់' : 'Users' }}</li>
	</ol>
</div><br>
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">{{ App::getLocale() === 'km' ? 'គ្រប់គ្រងអ្នកប្រើប្រាស់' : 'Manage User' }} <a class="btn btn-sm btn-primary pull-right" href="{{url('/')}}">{{ App::getLocale() === 'km' ? 'ត្រឡប់ក្រោយ' : 'Back' }} <span class="glyphicon glyphicon-share-alt"></span></a></div>
			<div class="panel-body">
				<table class="table">
				<thead>
					<tr>
						<th>{{ App::getLocale() === 'km' ? 'ឈ្មោះអ្នកប្រើប្រាស់' : 'Username' }}</th>
						<th>{{ App::getLocale() === 'km' ? 'អ៊ីមែល' : 'Email' }}</th>
						<th>{{ App::getLocale() === 'km' ? 'តួនាទី' : 'Role' }}</th>
						<th>{{ App::getLocale() === 'km' ? 'សកម្មភាព' : 'Action' }}</th>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>@if($user->role){{$user->role->name}}@endif</td>
						<td><button style="margin-right: 5px" class="btn-sm btn-primary" id="edit_user" data-info =" {{$user->id}},{{$user->name}},{{$user->email}},{{$user->role_id}}"><span class="glyphicon glyphicon-edit "></span></button>
                        @if(Auth::user()->id == $user->id)
                        @else
                        <button class="btn-sm btn-danger" id="delete_user"  data-id="{{$user->id}}"><span class="glyphicon glyphicon-remove "></span></button>
                        @endif
                        </td>
					</tr>
				@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-4" id="user_add">
	<div class="panel panel-default">
		<div class="panel-heading">{{ App::getLocale() === 'km' ? 'បន្ថែមអ្នកប្រើប្រាស់' : 'Add User' }} <span class="glyphicon glyphicon-plus"></span></div>
		<div class="panel-body">
					{!! Form::open(array('route' => 'user.store','method'=>'POST')) !!}
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>{{ App::getLocale() === 'km' ? 'ឈ្មោះអ្នកប្រើប្រាស់:' : 'Username:' }}</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>{{ App::getLocale() === 'km' ? 'អាសយដ្ឋានអ៊ីមែល:' : 'E-Mail Address:' }}</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
							<label for="role_id">{{ App::getLocale() === 'km' ? 'តួនាទី' : 'Roles' }}</label>
		                    <select class="form-control" id="role_id" name="role_id" required="">
								<option></option>
		                        @foreach($roles as $role)
		                            <option value="{{ $role->id }}" >{{ $role->name }}</option>
		                        @endforeach
		                    </select>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>{{ App::getLocale() === 'km' ? 'លេខសម្ងាត់' : 'Password' }}</label>
                            <input type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ App::getLocale() === 'km' ? 'បញ្ជាក់លេខសម្ងាត់' : 'Confirm Password' }}</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus"></span> {{ App::getLocale() === 'km' ? 'បន្ថែម' : 'Add' }}
                                </button>
                                <button type="reset" class="btn btn-default">{{ App::getLocale() === 'km' ? 'កំណត់ឡើងវិញ' : 'Reset' }}</button>
                        </div>
                   {!! Form::close()!!}
				</div>
			</div>
		</div>
		<!-- Edit User -->
		<div class="col-md-4" id="user_edit" style="display: none;">
		<div class="panel panel-default">
		<div class="panel-heading">{{ App::getLocale() === 'km' ? 'កែសម្រួលអ្នកប្រើប្រាស់' : 'Edit User' }} <span class="glyphicon glyphicon-plus"></span></div>
		<div class="panel-body">
					{!! Form::open(array('route' => 'user.edit','method'=>'POST')) !!}
					<div class="form-group">
					<input type="hidden" name="id" id="id">
                        <label>{{ App::getLocale() === 'km' ? 'ឈ្មោះអ្នកប្រើប្រាស់:' : 'Username:' }}</label>
                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                    </div>
                    <div class="form-group">
                        <label>{{ App::getLocale() === 'km' ? 'អាសយដ្ឋានអ៊ីមែល:' : 'E-Mail Address:' }}</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                    </div>
					<div class="form-group">
						<label for="role_id">{{ App::getLocale() === 'km' ? 'តួនាទី' : 'Roles' }}</label>
						<select class="form-control role" id="role_id" name="role_id">
							<<option value=""></option>
							@foreach($roles as $role)
								<option value="{{ $role->id }}">{{ $role->name }}</option>
							@endforeach
						</select>
					</div>
                    <div class="form-group">
                        <label>{{ App::getLocale() === 'km' ? 'ប្តូរលេខសម្ងាត់' : 'Change Password' }}</label>
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
					<div class="form-group">
						<label>{{ App::getLocale() === 'km' ? 'បញ្ជាក់លេខសម្ងាត់' : 'Confirm Password' }}</label>
						<input type="password" class="form-control" name="password_confirmation">
					</div>
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-edit"></span> {{ App::getLocale() === 'km' ? 'កែសម្រួល' : 'Edit' }}
                            </button>
                            <a class="btn btn-default pull-right" id="cancel">{{ App::getLocale() === 'km' ? 'បោះបង់' : 'Cancel' }}</a>
                    </div>
                   {!! Form::close()!!}
				</div>
			</div>
		</div>
		</div>
	</div>
<div class="modal fade" id="user_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">{{ App::getLocale() === 'km' ? 'លុបអ្នកប្រើប្រាស់' : 'Delete User' }}</h4>
      </div>
      {!! Form::open(array('route' => 'user.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="delete_id">
      	<label>{{ App::getLocale() === 'km' ? 'តើអ្នកប្រាកដជាចង់លុបអ្នកប្រើប្រាស់នេះមែនទេ?' : 'Are your sure want to delete this user?' }}</label>
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
	 	$('#user_add').show();
        $('#user_edit').hide();
})
	$(document).on('click', '#edit_user', function() {

        $('#user_add').hide();
        $('#user_edit').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#email').val(details[2]);
		$('#role_id').val(details[3]);
    }
    $(document).on('click', '#delete_user', function()
    {
    	var id = $(this).data('id');
    	$('#delete_id').val(id);
    	$('#user_delete').modal('show');

    });

</script>
@endsection
