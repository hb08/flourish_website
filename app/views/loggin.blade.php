
@if(Session::has('ustatus'))
	<p class="pure-u-1-1">Logged In!</p>	
@else
<div class="panel-g pure-u-19-24 offset-md-1-12">
	<div class="inlay pure-g">
		<div class="pure-u-1-2 login">
			{{ Form::open(array('url' => 'login')) }}
				<h1>Login</h1>
				<p>Add to your plant list or check on your garden by logging in below.</p>
				<!-- if there are login errors, show them here -->
				<p>
				    {{ $errors->first('user_name') }}
				    {{ $errors->first('password') }}
				</p>
				
				<p>
				    {{ Form::text('user_name', Input::old('username') , array('placeholder' => 'Username' )) }}
				    {{ Form::password('password', array('placeholder' => 'Password')) }}
				</p>
				
				<p>{{ Form::submit('Submit!') }}</p>
			{{ Form::close() }}	
		</div>
		<div class="pure-u-1-2">
			{{ Form::open(array('url' => 'register')) }}
				<h1>Register</h1>
				<p>
				    {{ Form::text('user_name', Input::old('username') , array('placeholder' => 'Username' )) }}
				    {{ Form::email('email', Input::old('email'), array('placeholder' => 'Email')) }}
				</p>
				
				<p>
				    {{ Form::password('password', array('placeholder' => 'Password')) }}			
				    {{ Form::password('password', array('placeholder' => 'Re-type Password')) }}
				</p>
				<p>
					<input type="number" placeholder="Zip Code" name="zip_code" />
				</p>


				
				<p>{{ Form::submit('Register!') }}</p>
			{{ Form::close() }}
		</div>
	</div>
</div>