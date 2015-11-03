<!-- Modal -->
<div class="modal fade" id="services_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New service</h4>
      </div>
      <div class="modal-body">
        <form action="{{ action('SubServiceController@storeExternal') }}" method="POST">
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <label for="service-name" class="control-label">Name of the service:</label>
            <input type="text" class="form-control" name="service-name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="btn" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>