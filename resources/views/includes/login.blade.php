<div class="panel reveal-modal xlarge" id="loginPanel" data-reveal aria-hidden="true" >
		<div class="row panel-content">
			<!-- if there are login errors, show them here -->
			<p id="errorP">
					{{ $errors->first('user_name') }}
					{{ $errors->first('password') }}
					{{ isset($errorMsg) ? $errorMessage: '' }}
			</p>
			<div class="medium-6 columns">
				{{--{{ Form::open(array('url' => 'login')) }}--}}
				<form action="/login">
					<h1>Login</h1>
					<p class="medium-8 medium-offset-2 end columns">Add a plant to your list, or create a new garden by logging in below!</p>

					<div class="medium-6 columns">
					    <input type="text" name="user_name" placeholder="Username" required/>
					</div>

					<div class="medium-6 columns">
					    <input type="password" name="password" placeholder="Password" required/>
					</div>

					<div class="medium-12 columns">
						{{--{{ Form::submit('Login!') }}--}}
						<input type="submit" value="Login!">
					</div>
				{{--{{ Form::close() }}--}}
				</form>
			</div>
			<div class="medium-6 columns">
				{{--{{ Form::open(array('url' => 'register')) }}--}}
				<form action="/register">
					<h1>Register</h1>
					<p class="medium-8 medium-offset-2 columns">Enjoy all the garden planning tools Flourish has to offer by registering below!</p>
					<div class="medium-6 columns">
	  					<input type="text" name="user_name" placeholder="Username" required/>
					</div>
					<div class="medium-4 end columns">
					    <input type="number" name="zip_code" placeholder="Zip Code" required/>
					</div>

					<div class="medium-6 columns">
					    <input type="password" name="password" placeholder="Password" required/>
					</div>

					<div class="medium-6 columns">
					    <input type="email" name="email" placeholder="Email Address" required/>
					</div>

					<div class="medium-12 columns">
						{{--{{ Form::submit('Sign Up!') }}--}}
						<input type="submit" value="Sign Up!">
					</div>
				{{--{{ Form::close() }}--}}
				</form>
			</div>
		</div>
		 <a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
</div>
@if(isset($userattempt))
	<div id="userAttempt">
	</div>
@endif
