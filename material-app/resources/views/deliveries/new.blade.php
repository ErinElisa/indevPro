@extends('layouts.main')


@section('app-title', 'Tambah Pengiriman')


@section('css-plugin')
<link rel="stylesheet" href="{{ asset('assets') }}/css/plugins/dropzone.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/css/plugins/datepicker-bs5.min.css">
@endsection

@section('main-content')
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
              <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
            </ul>
          </div>
          <div class="col-md-12">
            <div class="page-header-title">
              <h2 class="mb-0">Tambah Pengiriman Baru</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->


    <!-- [ Main Content ] start -->
    <form id="input-form" action="" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h5>Data Pengiriman</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Tanggal Pengiriman</label>
                        <div class="col-sm-9">
                          <input type="date" name="tanggal" id="datepicker" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Produk</label>
                    <div class="col-sm-9">
                      <select class="form-control select-product" data-trigger name="product">
                        <option value="" disabled selected>Pilih Produk</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Pengirim</label>
                    <div class="col-sm-9">
                      <input type="text" name="sender" class="form-control" placeholder="Nama pengirim">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">Tujuan</label>
                    <div class="col-sm-9">
                      <input type="text" name="destination" class="form-control" placeholder="Nama Tujuan">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">QTY</label>
                    <div class="col-sm-9">
                      <input type="text" name="qty" class="form-control" placeholder="Kuantiti">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">Catatan</label>
                    <div class="col-sm-9">
                      <textarea type="text" name="note" class="form-control" cols="30" rows="5"> </textarea>
                    </div>
                  </div>
                </div>
              </div>

            <div class="card-footer d-flex justify-content-between gap-3">
              <a href="{{ route('product.list') }}" class="btn btn-outline-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan Data <i class="ti ti-arrow-narrow-right"></i></button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- [ Main Content ] end -->
</section>
@endsection


@section('js-plugin')

<script src="{{ asset('assets') }}/js/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/datepicker-full.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/choices.min.js"></script>
@endsection


@section('custom-js')
<script>
    (function () {
        const d_week = new Datepicker(document.querySelector('#datepicker'), {
          buttonClass: 'btn',
          todayBtn: true,
          clearBtn: true,
          format: 'yyyy-mm-dd'
        });
    })();
</script>

<script>
    $('#input-form').submit(function(e){
      $('#input-form').attr('disabled', 'true');
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          url: `{{ route('delivery.new') }}`, // The URL to which you want to send the AJAX request
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(response) {
            const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-primary',
              },
              buttonsStyling: false
            });
            swalWithBootstrapButtons.fire('Sukses!', 'Data berhasil disimpan.', 'success').then(()=>{
                  window.location.href = `{{ route('delivery.list') }}`
            });
          },
          error: function(xhr, status, error) {
            swalWithBootstrapButtons.fire('Error!', error, 'error');
            $('#input-form').removeAttr('disabled');
          }
        });
    })
  </script>
@endsection
