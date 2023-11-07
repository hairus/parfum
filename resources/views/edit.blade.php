<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" id="nama" class="form-control" value="{{$client->nama}}">
                        <input type="hidden" id="id" class="form-control" value="{{$client->id}}">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <input type="text" id="desk" class="form-control" value="{{$client->deskripsi}}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpan()">Save changes</button>
            </div>
        </div>
    </div>
</div>

