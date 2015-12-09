<div id="select_language_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="select_language_modal_label">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add a translation</h4>
      </div>
      <div class="modal-body">
        <div class='row'>
          <div class="form-group">
            <label for="language_select" class="col-sm-4 control-label">Language</label>
            <div class="col-sm-8">
                <select class="form-control" id="language_select" name="">
                <option></option>
                @foreach ($languages as $language)
                  <option>{{ $language->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->