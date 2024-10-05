@extends('layouts.main')

@section('title', 'List Pengiriman')

@push('custom-css')
    <!-- data tables css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <!-- [Page specific CSS] end -->
@endpush



@section('main-content')
    <!-- [ Main Content ] start -->
    <section class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('delivery.list') }}">Pengiriman</a></li>
                  <li class="breadcrumb-item" aria-current="page">List Data</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Data Pengiriman</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- DOM/Jquery table start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('delivery.new') }}" class="btn btn-light rounded-0">
                  <i class="ti ti-circle-check me-1"></i>Tambah Baru
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive dt-responsive">
                  <table id="delivery-table" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th class="text-center" width="50px">#</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Produk</th>
                        <th class="text-center">Pengirim</th>
                        <th class="text-center">Tujuan</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Catatan</th>
                        <th width="200px"></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- DOM/Jquery table end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </section>
  </div>

@endsection


@push('custom-js')
    <!-- datatable Js -->
    <script src="{{ asset('assets') }}/js/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        $('#delivery-table').DataTable({
          processing: true,
          serverSide: true,
          order: [[1, 'desc']],
          ajax: "{{ route('delivery.data_json') }}",
          columns: [
              { data: 'DT_RowIndex', className: "dt-body-center" },
              { data: 'date', name: 'date', className: "dt-body-center" },
              { data: 'product', name: 'product', className: "dt-body-center" },
              { data: 'sender', name: 'sender', className: "dt-body-center" },
              { data: 'destination', name: 'destination', className: "dt-body-center" },
              { data: 'qty', name: 'qty', className: "dt-body-center" },
              { data: 'note', name: 'note', className: "dt-body-center" },
              { data: 'action', name: 'action', searchable: false, orderable: false, className: "dt-body-right" }
          ]
        });
      </script>

    <script>
      function remove(e){
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-outline-danger',
              cancelButton: 'btn btn-primary',
            },
            buttonsStyling: false
          });
          swalWithBootstrapButtons
            .fire({
              title: 'Hapus data ini?',
              text: "Data akan dihapus secara permanen?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Ya, Hapus!',
              cancelButtonText: 'Tidak, Batalkan!',
              reverseButtons: false,
            })
            .then((result) => {
              if (result.isConfirmed) {
                axios.delete(`{{ route('delivery.delete') }}`, {
                  params : {
                    'did' : e.getAttribute("data-id"),
                  }
                }).then((response)=>{
                  swalWithBootstrapButtons.fire('Deleted!', 'Data berhasil dihapus.', 'success').then(()=>{
                    location.reload()
                  });
                })
              }
            });
      }
    </script>
@endpush
