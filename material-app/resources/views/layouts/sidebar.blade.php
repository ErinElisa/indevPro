
 <!-- [ Sidebar Menu ] start -->
 <nav class="pc-sidebar">
    <div class="navbar-wrapper">
      <div class="m-header">
        <a href="{{ route('dashboard') }}" class="b-brand text-primary">
          <!-- ========   Change your logo from here   ============ -->
          <img src="{{ asset('assets/images/logo-pon.svg') }}" />
          <span class="badge bg-light-success rounded-pill ms-2 theme-version">v1.0.0</span>
        </a>
      </div>
      <div class="navbar-content">
        <div class="card pc-user-card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <img src="https://avatar.uimaterial.com/?setId=j0U8zmEwkjhzMVzW6ZSO&name=ar" alt="user-image" class="user-avtar wid-45 rounded-circle" />
              </div>
              <div class="flex-grow-1 ms-3 me-2">
                <h6 class="mb-0">ar</h6>
                <small>pemilik</small>
              </div>
              <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
                <svg class="pc-icon">
                  <use xlink:href="#custom-sort-outline"></use>
                </svg>
              </a>
            </div>
            <div class="collapse pc-user-links" id="pc_sidebar_userlink">
              <div class="pt-3">
                <form method="POST" action="#">
                  @csrf
                  <a href="javascript:void(0)" onclick="$(this).closest('form').submit()">
                    <i class="ti ti-power"></i>
                    <span>Logout</span>
                  </a>
                </form>
              </div>
            </div>
          </div>
        </div>

        <ul class="pc-navbar">
          <li class="pc-item pc-caption">
            <label>Navigation</label>
            <i class="ti ti-dashboard"></i>
          </li>
          <li class="pc-item pc-hasmenu">
            <a href="{{ route('dashboard') }}" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-status-up"></use>
                </svg>
              </span>
              <span class="pc-mtext">Dashboard</span>
            </a>
          </li>

          <li class="pc-item pc-caption">
            <label>Data</label>
            <i class="ti ti-chart-arcs"></i>
          </li>


          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-shapes"></use>
                  </svg>
              </span>
              <span class="pc-mtext">Produk</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="#">List Produk</a></li>
              <li class="pc-item"><a class="pc-link" href="#">New Data</a></li>
            </ul>
          </li>

          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-box-1"></use>
                  </svg>
              </span>
              <span class="pc-mtext">Pengiriman</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="#">List Pengiriman</a></li>
              <li class="pc-item"><a class="pc-link" href="#">Tambah Data</a></li>
            </ul>
          </li>

          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-presentation-chart"></use>
                  </svg>
              </span>
              <span class="pc-mtext">Pembayaran</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="#">List Pembayaran</a></li>
              <li class="pc-item"><a class="pc-link" href="#">New Data</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- [ Sidebar Menu ] end -->
