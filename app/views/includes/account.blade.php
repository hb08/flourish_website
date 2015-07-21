<?php
  // Keep here for all page availability, or move to new include to keep seperate
  $list = DB::table('user_lists')->where('user_id', Session::get('user'))->lists('list_id', 'user_listname');
  $gardens = DB::table('garden_plots')->where('user_id', Session::get('user'))->lists('garden_id', 'garden_name');
  $start = public_path();
  $start .= '/gp/view/gardens/';
?>
<div class="panel reveal-modal large" id="profilePanel" data-reveal aria-hidden="true" >
  <div class="row panel-content">
    <div class="row">
      <?php  $user = User::userInfo(Session::get('user')); ?>
      <h1>My Account</a>
    </div>
    <div class="medium-6 columns">
      <h3>My Info</h3>
      {{ Form::open(array('url'=>'profile')) }}
        <div class="medium-12 columns">
          <p class="text-left bold">{{$user['name']}}</p>
        </div>
        <div class="medium-12 columns">
          <input type="email" name="email" value="{{$user['email']}}" required='required' />
        </div>
        <div class="medium-6 columns end">
          <input type="number" name="zip_code" value="{{$user['zip']}}" required='required' />
        </div>
        <div class="medium-12 columns">
          {{ Form::submit('Edit Info') }}
        </div>
      {{ Form::close() }}
    </div>
    <div class="medium-6 columns">
      <div class="medium-5 columns">
        <h3>My Lists</h3>
        <ul class="accountLists">
          @foreach($list as $key => $value)
            <li><a href="gp/{{strtolower($key)}}">{{$key}}</a></li>
          @endforeach
       </ul>
     </div>
     <div class="medium-7 columns">
       <h3>My Gardens</h3>
       <ul class="accountLists">
         @foreach($gardens as $key => $value)
           <li><a href="/public/gp/view/gardens/{{$value}}">{{$key}}</a></li>
         @endforeach
      </ul>
      </div>
    </div>
  </div>
</div>
