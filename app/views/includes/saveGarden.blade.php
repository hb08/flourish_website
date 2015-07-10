<div id="saveDialog" class="panel reveal-modal" data-reveal aria-hidden="true" role="dialog">
  <div class="row panel-content">
    <h1>Save Your Garden!</h1>
    <div class="medium-8 columns medium-offset-2">
      {{ Form::open(array('url' => 'saveGarden')) }}
      <input type="text" name="garden_name" id="garden_name" placeholder="My Garden Name" />
      <textarea  class="hidden" name="garden" id="holdGarden"></textarea>
      <textarea class="hidden" name="shapes" id="holdShapes"></textarea>
      <textarea class="hidden" name="plants" id="holdPlants"></textarea>
      <input type="submit" class="linkButton save_garden" value="Save Garden">
    </div>
  </div><!-- End Content -->
</div><!-- End saveDialog -->
