@extends('layouts.master')
@section('content')
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
@stop
