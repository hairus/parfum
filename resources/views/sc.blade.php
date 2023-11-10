@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Show User
            </div>
            <div class="card-body">
                <div id="tampung"></div>
                <div id="modal"></div>
                <div id="transaksi"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            getData()
        })

        function getData() {
            $.ajax({
                url: "/getData",
                type: "GET",
                success: function(data) {
                    $('#tampung').html(data)
                    $("#example").dataTable()
                }
            })
        }

        function coba(id) {
            console.log(id);
            $.ajax({
                url: "/edit/" + id,
                type: "GET",
                success: function(data) {
                    $('#modal').html(data)
                    $('#exampleModal').modal('show');
                }
            });
        }

        function simpan() {
            var nama = $('#nama').val()
            var desk = $('#desk').val()
            var id = $('#id').val()
            $.ajax({
                url: "/update",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    nama: nama,
                    desk: desk,
                    id: id
                },
                success: function(data) {
                    $('#exampleModal').modal('hide');
                    getData()
                }
            })
        }

        function hapus(id) {
            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!',
                buttons: {
                    confirm: function() {
                        $.ajax({
                            url: "/destroy/" + id,
                            type: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                getData()
                            }
                        })
                    },
                    cancel: function() {
                        // $.alert('Canceled!');
                    },
                    // somethingElse: {
                    //     text: 'Something else',
                    //     btnClass: 'btn-blue',
                    //     keys: ['enter', 'shift'],
                    //     action: function() {
                    //         $.alert('Something else?');
                    //     }
                    // }
                }
            });
        }
        // transaksi
        function show(id) {
            $.ajax({
                url: "/show/" + id,
                type: "get",
                success: function(data) {
                    $('#transaksi').html(data);
                    $('#showModal').modal('show');
                }
            })
        }

        function simpanTrx() {
            const id = $('#id').val();
            const jum = $('#trx').val();
            $.ajax({
                url: "/simpanTrx",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    jum: jum,
                    id: id
                },
                success: function(data) {
                    $('#showModal').modal('hide');
                    getData()
                }
            })
        }

        function claim(id) {
            $.ajax({
                url: "/claim/" + id,
                type: "GET",
                success: function(data) {
                    getData()
                    $.confirm({
                        title: 'Claim',
                        content: 'Claim berhasil di lakukan',
                        draggable: true,
                    });
                }
            })
        }

        function hapusStempel(id){
            $.ajax({
                url: "/hapusStempel/" + id,
                type: "GET",
                success: function(data) {
                    $('#transaksi').html(data);
                    $('#hapModal').modal('show');
                }
            })
        }

        function runningHapus(){
            const id = $('#id').val();
            const jum = $('#trx').val();
            $.ajax({
                url: "/hapusStempel",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    jum: jum,
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    $('#hapModal').modal('hide');
                    getData()
                }
            })
        }
    </script>
@endsection
