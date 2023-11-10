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
                <div class="loading" id="loadingDiv"></div>
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

        function showloading() {
            var $loading = $('#loadingDiv').show();
            $loading.show();
        }

        function hideloading() {
            var $loading = $('#loadingDiv').hide();
            $loading.hide();
        }

        function getData() {
            showloading()
            $.ajax({
                url: "/getData",
                type: "GET",
                success: function(data) {
                    $('#tampung').html(data)
                    $("#example").dataTable()
                    hideloading()
                }
            })
        }

        function coba(id) {
            $.ajax({
                url: "/edit/" + id,
                type: "GET",
                success: function(data) {
                    showloading()
                    $('#modal').html(data)
                    $('#exampleModal').modal('show');
                    hideloading()
                }
            });
        }

        function simpan() {
            showloading()
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
                    hideloading()
                }
            })
        }

        function hapus(id) {

            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!',
                buttons: {
                    confirm: function() {
                        showloading()
                        $.ajax({
                            url: "/destroy/" + id,
                            type: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                getData()
                                hideloading()
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
            showloading()
            $.ajax({
                url: "/show/" + id,
                type: "get",
                success: function(data) {

                    $('#transaksi').html(data);
                    $('#showModal').modal('show');
                    hideloading()
                }
            })
        }

        function simpanTrx() {
            showloading()
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
                    hideloading()
                }
            })
        }

        function claim(id) {
            showloading()
            $.ajax({
                url: "/claim/" + id,
                type: "GET",
                success: function(data) {
                    getData()
                    hideloading()
                    $.confirm({
                        title: 'Claim',
                        content: 'Claim berhasil di lakukan',
                        draggable: true,
                    });
                }
            })
        }

        function hapusStempel(id) {
            showloading()
            $.ajax({
                url: "/hapusStempel/" + id,
                type: "GET",
                success: function(data) {
                    $('#transaksi').html(data);
                    $('#hapModal').modal('show');
                    hideloading()
                }
            })
        }

        function runningHapus() {

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
                    showloading()
                    $('#hapModal').modal('hide');
                    getData()
                    hideloading()
                }
            })
        }
    </script>
@endsection
<style>
    /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
