<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" id="nama" value="{{$client->nama}}" disabled class="form-control">
                        <input type="hidden" id="id" value="{{$client->id}}" disabled class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">jumlah Stempel</label>
                        <input type="number" id="trx" class="form-control">
                    </div>
                    <code>
                        @foreach ($client->trxs as $data)
                        <ul>
                            <li>{{ $data->jumlah }} {{ date_format($data->created_at, 'd/m/Y H:i:s') }}</li>
                        </ul>
                        @endforeach
                    </code>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanTrx()">Save changes</button>
            </div>
        </div>
    </div>
</div>

