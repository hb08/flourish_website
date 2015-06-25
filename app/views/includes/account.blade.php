<div class="panel reveal-modal large" id="profilePanel" data-reveal  aria-hidden="true" >
  <div class="row panel-content">
    <div class="row">
      <?php  $user = User::userInfo(Session::get('user')); ?>
      <h1>My Account</a>
    </div>
    <div class="medium-6 columns">
      <h3>My Info</h3>
      {{ Form::open(array('url'=>'profile')) }}
        <div class="medium-12 columns">
          <input type="text" name="user_name" value="{{$user['name']}}" />
        </div>
        <div class="medium-12 columns">
          <input type="email" name="email" value="{{$user['email']}}" />
        </div>
        <div class="medium-6 columns end">
          <input type="number" name="zip_code" value="{{$user['zip']}}" />
        </div>
        <div class="medium-12 columns">
          {{ Form::submit('Edit Info') }}
        </div>
      {{ Form::close() }}
    </div>
    <div class="medium-6 columns">
      <h3>My Lists</h3>
      <ul class="accountLists">
        <?php $list = DB::table('user_lists')->where('user_id', Session::get('user'))->lists('list_id', 'user_listname'); ?>
        @foreach($list as $key => $value)
          <li><a href="gp/{{strtolower($key)}}">{{$key}}</a></li>
        @endforeach
     </ul>
    </div>
  </div>
</div>
