@if($thisPanel == 'details')
<div id="detailsRemove" class="panel reveal-modal" data-reveal aria-hidden="true" role="dialog">
  <div class="row panel-content">
    <h1>Edit Plant Lists</h1>
    <div class="medium-8 columns medium-offset-2">
      {{ Form::open(array('url' => 'removeItem')) }}
        <p class="medium-12 columns text-center">Select any lists</p>
          <div class="medium-5 medium-centered columns">
            <input class="hidden" type="text" name="plant" value="{{ $chart->id }}">
            <input class="text-center" type="text" name="name" value="{{$chart->plant_name }}" >
          </div>
        <p class="medium-12 columns text-center">should be on:</p>
        @foreach(User::userLists() as $k => $v)
        <div class="medium-4 columns checkSpace medium-collapse">
          <input type="checkbox" name="addList[]" value="{{$v}}" checked="checked"><label>{{$k}}</label>
        </div>
        @endforeach
        <input type="submit" class="linkButton save_garden" value="Yes, Change Lists!">
      {{ Form::close() }}
    </div>
  </div><!-- End Content -->
</div><!-- End Details Remove -->
<div id="detailsAdd" class="panel reveal-modal" data-reveal aria-hidden="true" role="dialog">
  <div class="row panel-content">
    <h1>Add Plant</h1>
    <div class="medium-8 columns medium-offset-2">
      {{ Form::open(array('url' => 'addItem')) }}
        <p class="medium-12 columns text-center">Add</p>
          <div class="medium-5 medium-centered columns">
            <input class="hidden" type="text" name="plant" id="addPlant" value="{{$chart->id}}">
            <input class="text-center" type="text" name="name" id="addName" value="{{$chart->plant_name}}" >
          </div>
        <p class="medium-12 columns text-center">to</p>
        @foreach(User::userLists() as $k => $v)
        <div class="medium-4 columns checkSpace medium-collapse">
          <input type="checkbox" name="addList[]" value="{{$v}}" checked="checked"><label>{{$k}}</label>
        </div>
        @endforeach
        <input type="submit" class="linkButton save_garden" value="Add Plant!">
      {{ Form::close() }}
    </div>
  </div><!-- End Content -->
</div><!-- End Details Add -->
@elseif($thisPanel == 'search')
<div id="searchRemove" class="panel reveal-modal" data-reveal aria-hidden="true" role="dialog">
  <div class="row panel-content">
    <h1>Edit Plant Lists</h1>
    <div class="medium-8 columns medium-offset-2">
      {{ Form::open(array('url' => 'removeItem')) }}
        <p class="medium-12 columns text-center">Select any lists</p>
          <div class="medium-5 medium-centered columns">
            <input class="hidden" type="text" name="plant" id="plantId">
            <input class="text-center" type="text" name="name" id="plantName" >
          </div>
        <p class="medium-12 columns text-center">should be on:</p>
        @foreach(User::userLists() as $k => $v)
        <div class="medium-4 columns checkSpace medium-collapse">
          <input class="lids" type="checkbox" name="addList[]" value="{{$v}}" checked="checked"><label>{{$k}}</label>
        </div>
        @endforeach
        <input type="submit" class="linkButton save_garden" value="Change My Lists!">
      {{ Form::close() }}
    </div>
  </div><!-- End Content -->
</div><!-- End Search Remove -->
<div id="searchAdd" class="panel reveal-modal" data-reveal aria-hidden="true" role="dialog">
  <div class="row panel-content">
    <h1>Add Plant</h1>
    <div class="medium-8 columns medium-offset-2">
      {{ Form::open(array('url' => 'addItem')) }}
        <p class="medium-12 columns text-center">Add</p>
          <div class="medium-5 medium-centered columns">
            <input class="hidden" type="text" name="plant" id="addPlant">
            <input class="text-center" type="text" name="name" id="addName" >
          </div>
        <p class="medium-12 columns text-center">to</p>
        @foreach(User::userLists() as $k => $v)
        <div class="medium-4 columns checkSpace medium-collapse">
          <input type="checkbox" name="addList[]" value="{{$v}}" checked="checked"><label>{{$k}}</label>
        </div>
        @endforeach
        <input type="submit" class="linkButton save_garden" value="Add Plant!">
      {{ Form::close() }}
    </div>
  </div><!-- End Content -->
</div><!-- End Search Add -->
@elseif($thisPanel == 'list' || (int)$thisPanel > 0 || $thisPanel == 'gardens')
<div id="listRemove" class="panel reveal-modal slim" data-reveal aria-hidden="true" role="dialog">
  <div class="row panel-content">
    <h1>Remove Plant</h1>
    <div class="medium-8 columns medium-offset-2">
      {{ Form::open(array('url' => 'removeItem')) }}
        <p class="medium-12 columns text-center">Are you sure you want to permanently delete </p>
          <div class="medium-5 medium-centered columns">
            <input class="hidden" type="text" name="plant" id="plantId">
            <input class="hidden" type="text" name="list" id="listId" value="{{$thisPanel}}">
            <input class="text-center" type="text" name="name" id="plantName" >
          </div>
        <p class="medium-12 columns text-center">from your lists?</p>
        <input type="submit" class="linkButton save_garden" value="Yes, Remove Garden!">
      {{ Form::close() }}
    </div>
  </div><!-- End Content -->
</div><!-- End List Remove -->
@endif
