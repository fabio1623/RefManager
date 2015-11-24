<div id="domains_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Domain</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="domain_name" class="col-sm-4 control-label">Domain</label>
			<div class="col-sm-8">
			  <input type="text" class="form-control" id="domain_name" name="domain_name" data-toggle="popover" data-placement="left" data-content="Missing or already in DB">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="add_domain_btn" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  var row = 0;

  //Create new domain panel
  $('#add_domain_btn').click(function () {
    var new_domain = $('#domain_name').val();
    var expertises = [];
    var exist = 0;

    if (new_domain != "") {
      for (var i = 0; i < domains.length; i++) {
        if ((domains[i].name).toLowerCase() == (new_domain).toLowerCase()) {
          exist = 1;
          break;
        };
      };

      if (exist == 1) {
        $("#domain_name").popover('show');
          event.stopImmediatePropagation();
      }
      else {
        if ((domains.length % 2) == 0) {
          row++;
          $('#domains_div').append('<div id="added_row_' + row + '" class="row">');
        };

        domains.push({id: domains[domains.length-1].id+1, name: new_domain, expertises: expertises});

        $('#added_row_' + row).append('<div class="col-sm-6"><div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title"><div class="row"><div class="col-sm-11">' + new_domain + '</div><div class="col-sm-1"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#criteria_modal" data-id="' + domains[domains.length-1].id + '" data-name="' + domains[domains.length-1].name + '"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div></div></h3></div><div id="domain-' + domains[domains.length-1].id + '" class="panel-body"></div></div></div>');

        if ((domains.length % 2) == 0) {
          $('#domains_div').append('</div>');
        };
      };
    }
    else {
      $("#domain_name").popover('show');
      event.stopImmediatePropagation();
    };
  });

  $( "#domain_name" ).keypress(function() {
    $("#domain_name").popover('destroy');
  });

  $('#domains_modal').on('hidden.bs.modal', function (e) {
    $("#domain_name").popover('destroy');
    $("#domain_name").val("");
  });

  $('#domains_modal').on('shown.bs.modal', function () {
    $('#domain_name').focus();
  });
</script>