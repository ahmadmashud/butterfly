<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="/products">
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
                    <label>Name Produk</label>
                    <input required name="nama" class="form-control" type="text" placeholder="Nama Produk">
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
                    <label>Komisi GRO</label>
                    <input required name="km_gro" class="form-control" type="text" placeholder="Komisi GRO">
                  </div>
                  <div class="form-group">
                    <label>Komisi Supplier</label>
                    <input required name="km_spv" class="form-control" type="text" placeholder="Komisi Supplier">
                  </div>
                  <div class="form-group">
                    <label>Komisi Staff</label>
                    <input required name="km_staff" class="form-control" type="text" placeholder="Komisi Staff">
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