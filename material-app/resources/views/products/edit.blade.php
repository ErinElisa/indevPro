@extends('layouts.main')


@section('app-title', 'Edit Produk')


@section('css-plugin')
<link rel="stylesheet" href="{{ asset('assets') }}/css/plugins/dropzone.min.css">
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
              <li class="breadcrumb-item"><a href="{{ route('product.list') }}">Produk</a></li>
              <li class="breadcrumb-item" aria-current="page">Edit Data</li>
            </ul>
          </div>
          <div class="col-md-12">
            <div class="page-header-title">
              <h2 class="mb-0">Edit Produk</h2>
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
              <h5>Data Produk</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" class="form-control" placeholder="Nama produk" value="{{ $data->name }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">Harga</label>
                    <div class="col-sm-9">
                      <input type="text" name="price" class="form-control" placeholder="Harga" value="{{ $data->price }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-3 col-form-label">Gambar</label>
                @if( $data->image )
                    <div class="my-3 d-flex gap-2">
                        <div class="img-thumbnail">
                          <button type="button" class="remove-img" data-id="{{ $data->id }}" onclick="removeFile(this)">&times; Remove</button>
                          <img src="{{ asset('storage/assets/product/'.$data->image) }}" alt="">
                        </div>
                    </div>
                @endif
                <div id="remove-gambar"></div>

                <div class="input-group mb-3">
                  <input type="file" name="image" class="form-control" id="image" required>
                  <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
                <p class="help-block">*Maksimal ukuran file adalah 2 MB.</p>
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


@push('custom-js')
<script src="{{ asset('assets') }}/js/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/dropzone-amd-module.min.js"></script>
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
          url: `{{ route('product.edit', ['pid'=>$data->id]) }}`, // The URL to which you want to send the AJAX request
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
                  window.location.href = `{{ route('product.list') }}`
            });
          },
          error: function(xhr, status, error) {
            swalWithBootstrapButtons.fire('Error!', error, 'error');
            $('#input-form').removeAttr('disabled');
          }
        });
    })
  </script>

  <script>
  function removeFile(e){
    console.log(e.dataset.id)

    $(e).parents('.img-thumbnail').remove()

    $('#remove-gambar').append(`
    <input type="hidden" name="remove_gambar" value="${e.dataset.id}">
    `);
  }

  $('.img-thumbnail img').click(function(){
    window.open($(this).attr('src'), "_blank")
  })
</script>
@endpush
