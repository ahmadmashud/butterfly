<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="/terapis/edit" enctype="multipart/form-data">
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
                    <label>Nama Terapis</label>
                    <input required name="nama" class="form-control" type="text" placeholder="Nama Terapis">
                  </div>
                  <div class="form-group">
                    <label>ID Terapis</label>
                    <input required name="code" class="form-control" type="text" placeholder="ID Terapis">
                  </div>
                  <div class="form-group">
                    <label>Foto</label>
                    <input name="foto" class="form-control" type="file">
                    <div>
                      <p><i>isi file jika ada perubahan foto</i></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      @foreach(config('constants.status_terapis') as $key => $value)
                      <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status Aktif</label>
                    <input type="checkbox" name="is_active" data-toggle="toggle" data-on="Aktif" data-off="Non Aktif" data-onstyle="success" data-offstyle="danger" data-size="sm" data-width="100">
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
</div>