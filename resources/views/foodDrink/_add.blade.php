<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="/foodDrinks">
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
                    <label>Name</label>
                    <input required name="nama" class="form-control" type="text" placeholder="Nama">
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input required name="harga" class="form-control" type="text" placeholder="Harga">
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="id_category_food_drink" class="form-control">
                      @foreach($category as $key => $value)
                      <option value="{{$value->id}}">{{$value->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Stock</label>
                    <input required name="stock" class="form-control" type="text" placeholder="Stock">
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