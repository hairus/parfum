<div class="table-responsive">
    <table id="example" class="table table-bordered table-hover">
        <thead>
            <th>No</th>
            <th>Name</th>
            <th>Deskripsi</th>
            <th>Stempel</th>
            <th>Bonus</th>
            <th>Claim</th>
            <th>#</th>
        </thead>
        <tbody>
            @foreach ($clients as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->deskripsi }}</td>
                    <td>{{ $data->trxs->count() }}</td>
                    <td>
                        {{-- {{ $data->trxs->sum('bonus') }} --}}
                        @if ($data->trxs->count() > 9)
                            <button class="btn btn-sm btn-primary" onclick="claim({{$data->id}})">
                                <i class="fa-solid fa-check"></i> claim
                            </button>
                        @endif
                    </td>
                    <td>{{ $data->claims->count() }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="coba({{ $data->id }})">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="show({{ $data->id }})">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="hapus({{ $data->id }})">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
