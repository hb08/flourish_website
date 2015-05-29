@extends('layouts.master')
@section('content')
<div class="pure-g">
	<div class="pure-u-1-2 login panel-g">
		{{ Form::open(array('url' => 'login')) }}
			<h1>Login</h1>
			
			<!-- if there are login errors, show them here -->
			<p>
			    {{ $errors->first('user_name') }}
			    {{ $errors->first('password') }}
			</p>
			
			<p>
			    {{ Form::label('user_name', 'User Name') }}
			    {{ Form::text('user_name', Input::old('user_name')) }}
			</p>
			
			<p>
			    {{ Form::label('password', 'Password') }}
			    {{ Form::password('password') }}
			</p>
			
			<p>{{ Form::submit('Submit!') }}</p>
		{{ Form::close() }}	
	</div>
	<div class="pure-u-1-2">
		{{ Form::open(array('url' => 'register')) }}
			<h1>Register</h1>
			<p>
			    {{ Form::label('user_name', 'User Name') }}
			    {{ Form::text('user_name', Input::old('user_name')) }}
			</p>
			
			<p>
			    {{ Form::label('password', 'Password') }}
			    {{ Form::password('password') }}
			</p>
			
			<p>
			    {{ Form::label('email', 'Email Address') }}
			    {{ Form::email('email', Input::old('email')) }}
			</p>
			
			<p>
			    {{ Form::label('zip_code', 'Zip Code') }}
			    {{ Form::number('zip_code', Input::old('zip_code')) }}
			</p>
			
			<p>{{ Form::submit('Register!') }}</p>
		{{ Form::close() }}
	</div>
</div>
	
@stop


