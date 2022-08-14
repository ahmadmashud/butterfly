<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="/rooms">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah {{$title}} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="ibox">
                <div class="ibox-body">
                  @csrf
                  <div class="form-group">
                    <label>No Room</label>
                    <input required name="no" class="form-control" type="text" placeholder="No Room">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <input type="checkbox" checked="true" name="is_used"   data-toggle="toggle" data-on="Kosong" 
                        data-off="Dipakai" data-onstyle="success" data-offstyle="danger" data-size="sm" data-width="100">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>

      </form>
    </div>
  </div>
</div>