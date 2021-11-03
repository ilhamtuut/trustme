<div id="kt_header" class="header header-fixed">
  <!--begin::Container-->
  <div class="container-fluid d-flex align-items-stretch justify-content-between">
      <!--begin::Header Menu Wrapper-->
      <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
      </div>
      <!--end::Header Menu Wrapper-->
      <!--begin::Topbar-->
      <div class="topbar">
          <!--begin::User-->
          <div class="topbar-item">
              <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                  <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                  <span class="text-white font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ucfirst(Auth::user()->username)}}</span>
                  <span class="symbol symbol-35 symbol-light-default">
                      <span class="symbol-label font-size-h5 font-weight-bold" style="background-image:url('{{asset('dist/assets/media/svg/avatars/009-boy-4.svg')}}')"></span>
                  </span>
              </div>
          </div>
          <!--end::User-->
      </div>
      <!--end::Topbar-->
  </div>
  <!--end::Container-->
</div>