@extends('layouts.master')
@section('content')
<div class="row">
  <h1 class="pageTitle">Garden Plotter</h1>
</div>
<div class="row panel_plot">
  <div class="row inlay">
    <div class="medium-6 columns">
      <div class="row">
        <h2>New Garden</h2>
      </div>
      <div class="row">
        <p class="medium-10 columns medium-centered">
          Select the dimensions of your new garden plot and the plant lists you'd like to use to begin.
        </p>
      </div>
      {{ Form:: open(array('url'=>'/plot/new', 'class'=>'plotForm row' )) }}
      <!-- Label -->
      <div class="row">
        <h4 class="medium-3 columns medium-offset-1 end plot text-left">Plot Size</h4>
      </div>
      <!-- Width Indputs -->
      <div class="row medium-collapse">
        <div class="medium-11 small-11 small-offset-1 columns medium-offset-1 plot_inputs medium-offset">
          <div class="medium-2  small-2 small-offset-1 medium-offset-2 columns">
            <input type="number" name="width" min="2" max="15" placeholder="W"/>
          </div>
          <label class="medium-1 small-2 columns text-left" for="width">feet</label>
          <div class="medium-2 small-2 columns" >
            <input type="number" name="height"  min="2" max="15" placeholder="H" />
          </div>
          <label class="medium-1 small-1 columns end text-left" for="height">feet</label>
        </div>
      </div>
      <div class="row">
        <h4 class="medium-3 columns medium-offset-1 end plot text-left">Plant Lists</h4>
      </div>
      <div class="row">
        <div class="medium-10 small-10 small-offset-2 columns medium-offset-2 plot_inputs">
          <!-- Always include zip code list -->
          <div class="medium-6 small-6 columns  text-left ">
            <input type="checkbox" name="garden" value="garden_zip">My Zip Code
          </div>

          <!-- Add a counter -->
          <?php $counter = 1; ?>
          @foreach($userList as $list)
            @if($counter == $count) <!-- Check if this is the end item using counter -->
              <div class="medium-6  small-6 columns text-left end">
            @else <!-- Otherwise don't add end class, but do add to counter -->
              <div class="medium-6  small-6 columns  text-left ">
                <?php $counter += 1; ?>
            @endif
                <!-- Content for all -->
                @if($list->user_listname == 'My List')
                  <input type="checkbox" name="garden_{{$list->list_id}}" value="garden_{{ $list->list_id}}" checked='checked' >{{$list->user_listname}}
                @else
                  <input type="checkbox" name="garden_{{$list->list_id}}" value="garden_{{ $list->list_id}}">{{$list->user_listname}}
                @endif

              </div>
          @endforeach
              </div>
        </div>
        <div class="row">
            {{Form::submit('Start Garden')}}
        </div>
      {{ Form::close() }}
    </div>
    </div> <!-- End Left Column -->
    <div class="medium-6 columns">
    </div> <!-- End Right Column -->
    </div> <!-- End Inlay -->
  </div> <!-- End Panel Plot -->
</div> <!-- End Row -->
@stop
