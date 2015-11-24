<div id="criteria_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Expertise</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="expertise_name" class="col-sm-4 control-label">Expertise</label>
			<div class="col-sm-8">
			  <input type="text" class="form-control" id="expertise_name" name="expertise_name" data-toggle="popover" data-placement="left" data-content="Missing or already in DB">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="add_expertise_btn" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  var domain_id;

  //Load modal with id & name of the domain
  $('#criteria_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var domain_name = button.data('name');
    domain_id = button.data('id'); // Extract info from data-* attributes

    var modal = $(this)
    modal.find('.modal-title').text('Add expertise on ' + domain_name)
  });

  //Add expertise in the domain panel
  $('#add_expertise_btn').click(function () {
    var new_expertise = $('#expertise_name').val();
    var domain;
    var exist = 0;

    //Get current domain
    for (var i = 0; i < domains.length; i++) {
      if (domains[i].id == domain_id) {
        domain = domains[i];
        break;
      };
    };

    var expertises = domain.expertises;

    if (new_expertise != "") {
      for (var i = 0; i < expertises.length; i++) {
        if ((expertises[i].name).toLowerCase() == (new_expertise).toLowerCase()) {
          exist = 1;
          break;
        };
      };

      if (exist == 1) {
        $("#expertise_name").popover('show');
        event.stopImmediatePropagation();
      }
      else {
        if (expertises.length == 0) {
          expertises.push({id: 0, name: new_expertise});
        }
        else {
          expertises.push({id: expertises[expertises.length-1].id+1, name: new_expertise});
        };
        
        $('#domain-' + domain_id).append('<div class="checkbox col-sm-6"><label><input type="checkbox"> ' + new_expertise + '</label></div>');
      };
    }
    else {
      $("#expertise_name").popover('show');
      event.stopImmediatePropagation();
    };
  });

  $( "#expertise_name" ).keypress(function() {
    $("#expertise_name").popover('destroy');
  });

  $('#criteria_modal').on('hidden.bs.modal', function (e) {
    $("#expertise_name").popover('destroy');
    $("#expertise_name").val("");
  });

  $('#criteria_modal').on('shown.bs.modal', function () {
    $('#expertise_name').focus();
  });
</script>