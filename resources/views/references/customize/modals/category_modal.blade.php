<div id="categories_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Category</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
    			<label for="category_name" class="col-sm-4 control-label">Category</label>
    			<div class="col-sm-8">
    			  <input type="text" class="form-control" id="category_name" name="category_name" data-toggle="popover" data-placement="left" data-content="Missing or already in DB">
    			</div>
    		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="add_category_btn" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>

  //Create new category panel
  $('#add_category_btn').click(function () {
    var new_category = $('#category_name').val();
    var measures = [];
    var exist = 0;

    if (new_category != "") {
      for (var i = 0; i < categories.length; i++) {
        if ((categories[i].name).toLowerCase() == (new_category).toLowerCase()) {
          exist = 1;
          break;
        };
      };

      if (exist == 1) {
        $("#category_name").popover('show');
          event.stopImmediatePropagation();
      }
      else {
        categories.push({id: categories[categories.length-1].id+1, name: new_category, measures: measures});

        $('#categories_div').append('<div class="col-sm-10 col-sm-offset-1"><div class="panel panel-default"><div class="panel-heading" data-toggle="collapse" href="#collapse_category-' + (categories.length-1).toString() + '" aria-expanded="true" aria-controls="category-' + (categories.length-1).toString() + '"><h3 class="panel-title"><div class="row"><div class="col-sm-11">' + new_category + '</div><div class="col-sm-1"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#measures_modal" data-id="' + categories[categories.length-1].id + '" data-name="' + categories[categories.length-1].name + '"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div></div></h3></div><div id="collapse_category-' + (categories.length-1).toString() + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-' + (categories.length-1).toString() + '"><div id="category-' + (categories[categories.length-1].id).toString() + '" class="panel-body"></div></div></div></div>');
      };
    }
    else {
      $("#category_name").popover('show');
      event.stopImmediatePropagation();
    };
  });

  $( "#category_name" ).keypress(function() {
    $("#category_name").popover('destroy');
  });

  $('#categories_modal').on('hidden.bs.modal', function (e) {
    $("#category_name").popover('destroy');
    $("#category_name").val("");
  });

  $('#categories_modal').on('shown.bs.modal', function () {
    $('#category_name').focus();
  });
</script>