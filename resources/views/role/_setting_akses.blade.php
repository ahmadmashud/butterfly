<div class="modal fade" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="/roles/privilege">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="ibox">
                <div class="ibox-body">
                  <h5 class="modal-title" id="exampleModalLabel">Atur Akses <span id="role_nama"></span> </h5>
                  @csrf
                  <input type="hidden" name="id" />
                  <table style="width: 100%;text-align: center;font-weight:bold" border="1">
                    <thead>
                      <tr style="background-color: #dadada;">
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Jenis</th>
                        <th style="text-align: center;">Akses</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($privileges as $key => $value)
                      <tr>
                        <td>{{$value->nama}}</td>
                        <td>{{$value->type}}</td>
                        <td><input name="privilege[]" class="form-control" type="checkbox" value="{{$value->id}}" readonly></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>