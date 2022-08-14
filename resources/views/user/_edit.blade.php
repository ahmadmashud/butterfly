<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="/users/edit">
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
                  <div class="form-group">
                    <label>Name Lengkap</label>
                    <input type="hidden" name="id" />
                    <input required name="nama" class="form-control @error('nama')  is-invalid @enderror" type="text" placeholder="Nama Lengkap" value="{{old('nama')}}">
                    @error('nama')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input required name="username" class="form-control @error('username')  is-invalid @enderror" type="text" placeholder="Username" value="{{old('username')}}">
                    @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Tanggal Join</label>
                    <input required name="tanggal_join" class="form-control @error('tanggal_join')  is-invalid @enderror" type="date" placeholder="Tanggal Join" value="{{old('tanggal_join')}}">
                  </div>
                  <div class="form-group">
                    <label>Role/jabatan</label>
                    <select name="role_id" class="form-control" required>
                      <option value="">Pilih</option>
                      @foreach( $roles as $key => $value)
                      <option value="{{$value->id}}">{{$value->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status Aktif</label>
                    <input type="checkbox" name="is_active" data-toggle="toggle" data-on="Aktif" data-off="Non Aktif" data-onstyle="success" data-offstyle="danger" data-size="sm" data-width="100">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input name="password" class="form-control" type="password" placeholder="Isi jika akan diubah">
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