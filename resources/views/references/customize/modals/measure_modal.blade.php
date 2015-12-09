<div id="measures_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New measure</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="measure_name" class="col-sm-4 control-label">Measure</label>
			<div class="col-sm-8">
			  <input type="text" class="form-control" id="measure_name" name="measure_name" data-toggle="popover" data-placement="left" data-content="Missing or already in DB">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="add_measure_btn" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  var category_id;

  //Load modal with id & name of the category
  $('#measures_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var category_name = button.data('name');
    category_id = button.data('id'); // Extract info from data-* attributes

    var modal = $(this)
    modal.find('.modal-title').text('Add measure on ' + category_name)
  });

  //Add measure in the category panel
  $('#add_measure_btn').click(function () {
    var new_measure = $('#measure_name').val();
    var category;
    var exist = 0;

    //Get current category
    for (var i = 0; i < categories.length; i++) {
      if (categories[i].id == category_id) {
        category = categories[i];
        break;
      };
    };

    var measures = category.measures;

    if (new_measure != "") {
      for (var i = 0; i < measures.length; i++) {
        if ((measures[i].name).toLowerCase() == (new_measure).toLowerCase()) {
          exist = 1;
          break;
        };
      };

      if (exist == 1) {
        $("#measure_name").popover('show');
        event.stopImmediatePropagation();
      }
      else {
        if (measures.length == 0) {
          measures.push({id: 0, name: new_measure});
        }
        else {
          measures.push({id: measures[measures.length-1].id+1, name: new_measure});
        };

        $('#category-' + category_id).append('<div class="form-group"><label for="category-' + (category_id).toString() + '"-measure-' + (measures[measures.length-1].id).toString() + '" class="col-sm-4 control-label">' + new_measure + '</label><div class="col-sm-4"><input type="text" class="form-control" id="category-' + (category_id).toString() + '-measure-' + (measures[measures.length-1].id).toString() + '" name="category-' + (category_id).toString() + '-measure-' + (measures[measures.length-1].id).toString() + '" placeholder=""></div></div>');
      };
    }
    else {
      $("#measure_name").popover('show');
      event.stopImmediatePropagation();
    };
  });

  $( "#measure_name" ).keypress(function() {
    $("#measure_name").popover('destroy');
  });

  $('#measures_modal').on('hidden.bs.modal', function (e) {
    $("#measure_name").popover('destroy');
    $("#measure_name").val("");
  });

  $('#measures_modal').on('shown.bs.modal', function () {
    $('#measure_name').focus();
  });
</script>