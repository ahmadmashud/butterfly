<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="/packageRooms/edit" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit {{$title}} </h5>
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
                  <input type="hidden" name="id" />
                  <div class="form-group">
                    <label>Nama Paket</label>
                    <input required name="nama" class="form-control" type="text" placeholder="Nama Paket">
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input required name="harga" class="form-control" type="text" placeholder="Harga">
                  </div>
                  <div class="form-group">
                    <label>Komisi Terapis</label>
                    <input required name="km_terapis" class="form-control" type="text" placeholder="Komisi Terapis">
                  </div>
                  <div class="form-group">
                    <label>Komisi Supplier</label>
                    <input required name="km_supplier" class="form-control" type="text" placeholder="Komisi Supplier">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <input type="checkbox"  name="is_active" data-toggle="toggle" data-on="Aktif" data-off="Non Aktif" data-onstyle="success" data-offstyle="danger" data-size="sm" data-width="100">
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