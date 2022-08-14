<div class="modal fade" id="fnd_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="form_modal_fnd">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar F&D</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ibox">
                                <div class="ibox-body">
                                    <div class="form-group">
                                        <label>Nama F&D</label>
                                        <select name="fnd" class="form-control" required>
                                            <option value="">Pilih</option>
                                            @foreach( $foodDrinks as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input required name="price_fnd" class="form-control" type="text" placeholder="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input required name="qty_fnd" class="form-control" type="number" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Sisa Stock</label>
                                        <input required name="stock_fnd" class="form-control" type="text" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="add_fnd" class="btn btn-primary" type="button">Tambahkan</button>
                </div>

            </form>
        </div>
    </div>
</div>