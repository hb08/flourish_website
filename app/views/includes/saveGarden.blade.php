@if(!empty($input))
<div id="saveDialog" class="panel reveal-modal" data-reveal aria-hidden="true" role="dialog">
  <div class="row panel-content">
    <h1>Save Your Garden!</h1>
    <div class="medium-8 columns medium-offset-2">
    {{ Form::open(array('action' => 'PlotController@saveGarden' ))}}
      <input type="text" name="garden_name" id="garden_name" placeholder="My Garden Name" />
      <textarea  class="hidden" name="garden" id="holdGarden"></textarea>
      <textarea class="hidden" name="shapes" id="holdShapes"></textarea>
      <textarea  type="text" class="hidden" name="width" id="gardenWidth" >{{ $input['width'] }}</textarea>
      <textarea  type="text" class="hidden" name="height" id="gardenHeight">{{ $input['height'] }}</textarea>
      <input type="submit" class="linkButton save_garden" value="Save Garden">
    {{ Form::close() }}
    </div>
  </div><!-- End Content -->
</div><!-- End saveDialog -->
@elseif(!empty($size))
<div id="saveDialog" class="panel reveal-modal" data-reveal aria-hidden="true" role="dialog">
  <div class="row panel-content">
    <h1>Save Your Changes!</h1>
    <div class="medium-8 columns medium-offset-2">
    {{ Form::open(array('action' => 'PlotController@saveGarden' ))}}
    <form action="saveGarden" method="POST">
      <input type="text" name="garden_name" id="garden_name" value="{{$garden_name}}" />
      <textarea  class="hidden" name="garden" id="holdGarden"></textarea>
      <textarea class="hidden" name="shapes" id="holdShapes"></textarea>
      <textarea  type="text" class="hidden" name="width" id="gardenWidth" >{{ $size->width }}</textarea>
      <textarea  type="text" class="hidden" name="height" id="gardenHeight">{{ $size->height }}</textarea>
      <input type="submit" class="linkButton save_garden" value="Save Garden">
    {{ Form::close() }}
    </div>
  </div><!-- End Content -->
</div><!-- End saveDialog -->
@endif
