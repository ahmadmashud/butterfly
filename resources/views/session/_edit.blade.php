<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="/sessions/edit">
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
                    <label>Waktu Per Sesi (Menit)</label>
                    <input required name="waktu_per_sesi" class="form-control" type="text" placeholder="Waktu Sesi">
                  </div>
                  <div class="form-group">
                    <label>Minimum Sesi</label>
                    <input required name="minimum_sesi" class="form-control" type="text" placeholder="Minimum Sesi">
                  </div>
                  <!-- <div class="form-group">
                    <label>Harga</label>
                    <input required name="harga" class="form-control" type="text" placeholder="Harga">
                  </div> -->
                  <div class="form-group">
                    <label>Diskon (Persentase)</label>
                    <input required name="discount" class="form-control" type="text" placeholder="Diskon">
                  </div>
                  <div class="form-group">
                    <label>Diskon Sesi Ke</label>
                    <input required name="discount_sesi_ke" class="form-control" type="text" placeholder="Diskon Sesi Ke">
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