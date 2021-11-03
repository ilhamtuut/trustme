<div class="modal fade" id="add-bank-modal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title text-white"> Add New Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{route('bank.addBankUser')}}">
              {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-group">
                      <label>Bank Name</label>
                      <select name="bank_name" class="form-control select2" style="width: 100%;">
                        <option value="">Choose Bank Name</option>
                        @foreach($bank as $value)
                          <option value="{{$value->id}}">{{$value->name}} ({{$value->code}})</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Bank Username</label>
                      <input type="text" name="bank_username" class="form-control" placeholder="Bank Username">
                  </div>
                  <div class="form-group">
                      <label>Bank Account</label>
                      <input type="text" name="bank_account" class="form-control" placeholder="Bank Account">
                  </div>
              </div>
              <div class="modal-footer">
                <div id="action">
                  <button type="submit" class="btn btn-success" id="btn_submit">Submit</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
                <i class="hidden text-primary" id="spinner"><span class="fa fa-spin fa-spinner"></span></i>
              </div>
          </form>
      </div>
  </div>
</div>