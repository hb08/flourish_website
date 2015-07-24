<div id="calAdd" class="panel reveal-modal calc" data-reveal aria-hidden="true" role="dialog">
  <div class="row panel-content">
    <h1>Add Milestone</h1>
    <div class="medium-8 columns medium-offset-2">
      {{ Form::open(array('url' => 'addMilestone')) }}
        <p class="medium-12 columns text-center">Add</p>
        <div class="row choice">
          <select name="name">
            <option selected="selected">Select Plant</option>
            @foreach($pnames as $p)
            <option value="{{$p['id']}}">{{$p['name']}}
            @endforeach
          </select>
        </div>
        <p class="medium-12 columns text-center">Planted on</p>
        <div class="row">
          <div class="medium-5 medium-centered columns">
            <input type="date" name="startDate" required>
          </div>
        </div>
        <p class="medium-12 columns text-center">Track</p>
        <div class="row">
          <div class="medium-4 columns">
            <input type="checkbox" name="addMilestone[]" value="Planting" checked="checked"><label>Planting</label>
          </div>
          <div class="medium-4 columns">
            <input type="checkbox" name="addMilestone[]" value="Misc" checked="checked"><label>Misc</label>
          </div>
          <div class="medium-4 columns">
            <input type="checkbox" name="addMilestone[]" value="Harvest" checked="checked"><label>Harvest</label>
          </div>
        </div>
        <input type="submit" class="linkButton save_garden" value="Add Plant!">
      {{ Form::close() }}
    </div>
  </div><!-- End Content -->
</div><!-- End Details Add -->
