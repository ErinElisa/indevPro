 <!-- [ Header Topbar ] start -->
 <header class="pc-header">
    <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
      <div class="me-auto pc-mob-drp">
        <ul class="list-unstyled">
          <!-- ======= Menu collapse Icon ===== -->
          <li class="pc-h-item pc-sidebar-collapse">
            <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <li class="pc-h-item pc-sidebar-popup">
            <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
        </ul>
      </div>
      <!-- [Mobile Media Block end] -->
      <div class="ms-auto">
        <ul class="list-unstyled">

          <li class="dropdown pc-h-item header-user-profile">
            <a
              class="pc-head-link dropdown-toggle arrow-none me-0"
              data-bs-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="false"
              data-bs-auto-close="outside"
              aria-expanded="false"
            >
              <img src="https://avatar.uimaterial.com/?setId=j0U8zmEwkjhzMVzW6ZSO&name=ar" alt="user-image" class="user-avtar" />
            </a>
            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
              <div class="dropdown-header d-flex align-items-center justify-content-between">
                <h5 class="m-0">Profile</h5>
              </div>
              <div class="dropdown-body">
                <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                  <div class="d-flex mb-1">
                    <div class="flex-shrink-0">
                      <img src="https://avatar.uimaterial.com/?setId=j0U8zmEwkjhzMVzW6ZSO&name=ar" alt="user-image" class="user-avtar wid-35" />
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h6 class="mb-1"></h6>
                      <span>email</span>
                    </div>
                  </div>
                  <hr class="border-secondary border-opacity-50" />
                  <div class="d-grid mb-3">
                    <form method="POST" action="#">
                      @csrf
                      <button class="btn btn-primary w-100 mt-4" type="submit">
                        <svg class="pc-icon me-2">
                          <use xlink:href="#custom-logout-1-outline"></use></svg>Logout
                      </button>
                    </form>
                  </div>
                  <div
                    class="card border-0 shadow-none drp-upgrade-card mb-0"
                    style="background-image: url({{ asset('assets') }}/images/layout/img-profile-card.jpg)"
                  >
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
   </div>
  </header>
