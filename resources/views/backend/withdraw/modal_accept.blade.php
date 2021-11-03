<div class="modal fade" id="modal-accept" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title text-white" id="title-modal"><i class="fa fa-check-circle"></i> Accept withdrawal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" id="form-accept">
              {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-group">
                      <label class="text-muted">Txid/Ref</label>
                      <input id="txid" type="text" name="txid" class="form-control" placeholder="Txid/Ref">
                  </div>
                  <div class="form-group">
                      <label class="text-muted">Security Password</label>
                      <input type="password" name="security_password" class="form-control" placeholder="Security Password">
                  </div>
              </div>
              <div class="modal-footer">
                <div id="action">
                  <button type="submit" class="btn btn-success" id="btn_submit">Submit</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
                <i class="hidden" id="spinner"><span class="fa fa-spin fa-spinner"></span></i>
              </div>
          </form>
      </div>
  </div>
</div>