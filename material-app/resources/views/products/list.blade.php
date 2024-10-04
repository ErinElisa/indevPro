@extends('layouts.main')

@section('main-content')
<!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content"><!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('product.list') }}">List Produk</a></li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">List Produk</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- [ breadcrumb ] end --><!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Produk</h5>
                                <div>
                                    <a href="{{ route('product.new')}}" class="btn btn-primary">Tambah Produk</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach( $products as $p)
                                <div class="col-sm-6 col-lg-4 col-xxl-3">
                                    <div class="card border">
                                        <div class="card-body p-2">
                                            <div class="position-relative">
                                                <img src="{{ asset('storage') }}/assets/{{ $p->image }}" alt="img" class="img-fluid">
                                            </div>
                                            <ul class="list-group list-group-flush my-2">
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 me-2">
                                                            <h3 class="mb-1 text-capitalize">{{ $p->name }}</h3>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <p class="mb-0 f-w-600">
                                                                <i class="fas fa-money-bill text-success">
                                                                </i> @currency($p->price)</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <hr>
                                            <div class="position-absolute end-0">
                                                <a href="{{ route('product.edit', ['eid'=>$p->id]) }} "  class="btn btn-sm btn-outline-primary mb-2">Update</a>
                                                <a href="javascript:void(0) "  class="btn btn-sm btn-outline-danger mb-2" data-id="{{ $p->id }}" onclick="remove(this)">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- [ Main Content ] end -->
        </div>
    </div><!-- [ Main Content ] end -->
@endsection


@push('custom-js')
    <!-- datatable Js -->
    <script src="{{ asset('assets') }}/js/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                axios.delete(`{{ route('product.delete') }}`, {
                  params : {
                    'eid' : e.getAttribute("data-id"),
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
