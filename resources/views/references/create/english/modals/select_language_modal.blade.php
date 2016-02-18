<div id="select_language_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="select_language_modal_label">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add a translation</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="language_select" class="control-label">Language</label>
              <select id="language_select" class="form-control selectpicker" data-width="100%" data-live-search="true" name="language">
                <option></option>
                @foreach ($translation_languages as $language)
                  <option value="{{ $language->id }}">{{ $language->name }}</option>
                @endforeach
              </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a id="add_language_btn" tabindex="0" class="btn btn-primary" role="button" data-toggle="popover" data-placement="top" data-trigger="focus" title="Warning" data-content="You have to choose a language.">Add</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  $('#add_language_btn').popover();
  
  $('#add_language_btn').on('show.bs.popover', function (e) {
      if ($('#language_select').val() != '') {
          e.preventDefault(); 
      }
  });

  $('#add_language_btn').click( function(e) {
      if ($('#language_select').val() != '') {
          $('#form_add_translation').submit();
      }
  });
</script>