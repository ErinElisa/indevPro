@extends('layouts.main')


@section('app-title', 'Edit Pembayaran')


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
              <li class="breadcrumb-item"><a href="{{ route('payment.list') }}">Pembayaran</a></li>
              <li class="breadcrumb-item" aria-current="page">Edit Data</li>
            </ul>
          </div>
          <div class="col-md-12">
            <div class="page-header-title">
              <h2 class="mb-0">Edit Pembayaran</h2>
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
              <h5>Data Pembayaran</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                    <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal" id="datepicker" class="form-control" value="{{ $data->payment_date }}">
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Pembayar</label>
                    <div class="col-sm-9">
                      <input type="text" name="payer" class="form-control" placeholder="Nama pembayar" value="{{ $data->payer }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">Total</label>
                    <div class="col-sm-9">
                      <input type="number" name="amount" class="form-control" placeholder="Total bayar" value="{{ $data->amount }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-3 col-form-label">Nota</label>
                @if( $data->nota )
                    <div class="my-3 d-flex gap-2">
                        <div class="img-thumbnail">
                          <button type="button" class="remove-not" data-id="{{ $data->id }}" onclick="removeFile(this)">&times; Remove</button>
                          <img src="{{ asset('storage/assets/payment/'.$data->nota) }}" alt="">
                        </div>
                    </div>
                @endif
                <div id="remove-nota"></div>

                <div class="input-group mb-3">
                  <input type="file" name="nota" class="form-control" id="nota">
                  <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
                <p class="help-block">*Maksimal ukuran file adalah 2 MB.</p>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">Catatan</label>
                    <div class="col-sm-9">
                      <textarea type="text" name="note" class="form-control" cols="30" rows="5">{{ $data->note }} </textarea>
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

@push('custom-js')
<script src="{{ asset('assets') }}/js/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/datepicker-full.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/choices.min.js"></script>
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
    function serialize(formData) {
      const serialized = {};
      for (const [key, value] of formData) {
        serialized[key] = value;
      }
      return JSON.stringify(serialized);
    }

    myForm = document.querySelector('#input-form')
    myForm.addEventListener('submit', (event)=>{
      event.preventDefault();
      var form = document.querySelector('#input-form');
      var data = new FormData(form);

      var url = `{{ route('payment.edit', ['bid' => 'pay_id']) }}`;
      url = url.replace('pay_id', `{{ $data->id }}`)
      axios.post(url, data)
      .then(function (response) {
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-primary',
          },
          buttonsStyling: false
        });
        swalWithBootstrapButtons.fire('Sukses!', 'Data berhasil diperbarui.', 'success').then(()=>{
                  window.location.href = `{{ route('payment.list') }}`
        });
      })
      .catch(function (error) {
        swalWithBootstrapButtons.fire('Error!', error, 'error');
      });
    })
  </script>

<script>
    function removeFile(e){
      console.log(e.dataset.id)

      $(e).parents('.img-thumbnail').remove()

      $('#remove-nota').append(`
      <input type="hidden" name="remove_nota" value="${e.dataset.id}">
      `);
    }

    $('.img-thumbnail img').click(function(){
      window.open($(this).attr('src'), "_blank")
    })
</script>
@endpush
