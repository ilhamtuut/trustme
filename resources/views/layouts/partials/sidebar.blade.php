<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
<div class="brand flex-column-auto" id="kt_brand">
    <a href="{{route('home')}}" class="brand-logo">
        <img height="35px" class="mr-3" alt="Logo" src="{{asset('images/trust-logo.png')}}" />
    </a>
</div>
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <li class="menu-section">
                <h4 class="menu-text">Main</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
            <li class="menu-item {{ isset($page) && $page == 'home' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                <a href="{{route('home')}}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            @role('member')
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'wallet' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 Z" fill="#000000" opacity="0.3"/>
                                <path d="M18.5,11 L5.5,11 C4.67157288,11 4,11.6715729 4,12.5 L4,13 L8.58578644,13 C8.85100293,13 9.10535684,13.1053568 9.29289322,13.2928932 L10.2928932,14.2928932 C10.7456461,14.7456461 11.3597108,15 12,15 C12.6402892,15 13.2543539,14.7456461 13.7071068,14.2928932 L14.7071068,13.2928932 C14.8946432,13.1053568 15.1489971,13 15.4142136,13 L20,13 L20,12.5 C20,11.6715729 19.3284271,11 18.5,11 Z" fill="#000000"/>
                                <path d="M5.5,6 C4.67157288,6 4,6.67157288 4,7.5 L4,8 L20,8 L20,7.5 C20,6.67157288 19.3284271,6 18.5,6 L5.5,6 Z" fill="#000000"/>
                            </g>
                          </svg>
                      </span>
                      <span class="menu-text">Wallets</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item menu-item-submenu {{ isset($active) && $active == 'my_wallet' ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                              <a href="{{route('balance.my')}}" class="menu-link menu-toggle">
                                  <span class="svg-icon menu-icon">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M18,16 L9,16 C8.44771525,16 8,15.5522847 8,15 C8,14.4477153 8.44771525,14 9,14 L17,14 C17.5522847,14 18,13.5522847 18,13 C18,12.4477153 17.5522847,12 17,12 L9,12 C7.34314575,12 6,13.3431458 6,15 C6,16.6568542 7.34314575,18 9,18 L19.5,18 C21,18 21,18.5 21,19 C21,19.5 21,20 19.5,20 L7,20 C4.790861,20 3,18.209139 3,16 L3,8 C3,5.790861 4.790861,4 7,4 L17,4 C19.209139,4 21,5.790861 21,8 L21,13.0000005 C21,14.6568542 19.6568542,16 18,16 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                  </span>
                                  <span class="menu-text">USD Wallet</span>
                              </a>
                          </li>
                          <li class="menu-item menu-item-submenu {{ isset($active) && $active == 'register_wallet' ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                              <a href="{{route('balance.register')}}" class="menu-link menu-toggle">
                                  <span class="svg-icon menu-icon">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M18,16 L9,16 C8.44771525,16 8,15.5522847 8,15 C8,14.4477153 8.44771525,14 9,14 L17,14 C17.5522847,14 18,13.5522847 18,13 C18,12.4477153 17.5522847,12 17,12 L9,12 C7.34314575,12 6,13.3431458 6,15 C6,16.6568542 7.34314575,18 9,18 L19.5,18 C21,18 21,18.5 21,19 C21,19.5 21,20 19.5,20 L7,20 C4.790861,20 3,18.209139 3,16 L3,8 C3,5.790861 4.790861,4 7,4 L17,4 C19.209139,4 21,5.790861 21,8 L21,13.0000005 C21,14.6568542 19.6568542,16 18,16 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                  </span>
                                  <span class="menu-text">Register Wallet</span>
                              </a>
                          </li>
                          <li class="menu-item menu-item-submenu {{ isset($active) && $active == 'trustme_coin' ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                              <a href="{{route('balance.harvest')}}" class="menu-link menu-toggle">
                                  <span class="svg-icon menu-icon">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                              <rect x="0" y="0" width="24" height="24"/>
                                              <circle fill="#000000" cx="12" cy="12" r="8"/>
                                          </g>
                                      </svg>
                                  </span>
                                  <span class="menu-text">Trustme Coin</span>
                              </a>
                          </li>
                          <li class="menu-item menu-item-submenu {{ isset($active) && $active == 'spartan_coin' ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                              <a href="{{route('balance.spartan')}}" class="menu-link menu-toggle">
                                  <span class="svg-icon menu-icon">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                              <rect x="0" y="0" width="24" height="24"/>
                                              <circle fill="#000000" cx="12" cy="12" r="8"/>
                                          </g>
                                      </svg>
                                  </span>
                                  <span class="menu-text">Spartan Coin</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'program' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z" fill="#000000"/>
                            </g>
                          </svg>
                      </span>
                      <span class="menu-text">Investments</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item menu-item-submenu {{ isset($active) && $active == 'invest' ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="{{route('program.index')}}" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24"/>
                                          <path d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z" fill="#000000"/>
                                          <path d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z" fill="#000000" opacity="0.3"/>
                                          <path d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.959697, 3.661508) rotate(-270.000000) translate(-11.959697, -3.661508) "/>
                                      </g>
                                  </svg>
                                </span>
                                <span class="menu-text">Invest</span>
                            </a>
                        </li>
                        <li class="menu-item menu-item-submenu {{ isset($active) && $active == 'my_plan' ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="{{route('program.history')}}" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <polygon fill="#000000" opacity="0.3" points="6 3 18 3 20 6.5 4 6.5"/>
                                            <path d="M6,5 L18,5 C19.1045695,5 20,5.8954305 20,7 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,7 C4,5.8954305 4.8954305,5 6,5 Z M9,9 C8.44771525,9 8,9.44771525 8,10 C8,10.5522847 8.44771525,11 9,11 L15,11 C15.5522847,11 16,10.5522847 16,10 C16,9.44771525 15.5522847,9 15,9 L9,9 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                </span>
                                <span class="menu-text">My Invest</span>
                            </a>
                        </li>
                        <li class="menu-item menu-item-submenu {{ isset($type) && $type == 'bonus' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
                                            <path d="M11,13 L11,11 C11,10.4477153 11.4477153,10 12,10 C12.5522847,10 13,10.4477153 13,11 L13,13 L15,13 C15.5522847,13 16,13.4477153 16,14 C16,14.5522847 15.5522847,15 15,15 L13,15 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,15 L9,15 C8.44771525,15 8,14.5522847 8,14 C8,13.4477153 8.44771525,13 9,13 L11,13 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                </span>
                                <span class="menu-text">Bonus</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ isset($active) && $active == 'bonus_pasif' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{route('program.bonus_profit')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Daily</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ isset($active) && $active == 'bonus_sponsor' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{route('program.bonus_active','sponsor')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Sponsor</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                      </ul>
                  </div>
              </li>
              <li class="menu-item {{ isset($page) && $page == 'bounty' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="{{route('bounty.index')}}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16"></rect>
                                <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                    </span>
                    <span class="menu-text">Bounty Spartan Coin</span>
                </a>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'withdraw' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24"/>
                              <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
                              <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
                              <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
                              <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
                          </g>
                      </svg>
                    </span>
                    <span class="menu-text">Withdraw</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item {{ isset($active) && $active == 'wd' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                            <a href="{{route('withdraw.index')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Trustme Coin</span>
                            </a>
                        </li>
                        <li class="menu-item {{ isset($active) && $active == 'spartan' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                            <a href="{{route('withdraw.spartan')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Spartan Coin</span>
                            </a>
                        </li>
                    </ul>
                </div>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'team' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g id="Stockholm-icons-/-Communication-/-Group" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                  <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                  <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
                              </g>
                          </svg>
                      </span>
                      <span class="menu-text">Membership</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                        <li class="menu-item menu-item-submenu {{ isset($active) && $active == 'add_member' ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="{{route('user.add_member')}}" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Stockholm-icons-/-Communication-/-Add-user" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path>
                                        </g>
                                    </svg>
                                </span>
                                <span class="menu-text">Add Member</span>
                            </a>
                        </li>
                        <li class="menu-item menu-item-submenu {{ isset($active) && $active == 'members' ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="{{route('user.list_donwline')}}" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Stockholm-icons-/-Communication-/-Group" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
                                        </g>
                                    </svg>
                                </span>
                                <span class="menu-text">My Teams</span>
                            </a>
                        </li>
                      </ul>
                  </div>
              </li>
            @endrole
            @role(['master_admin'])
            <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'users' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Stockholm-icons-/-General-/-User" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-text">Users</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        @foreach (App\Role::orderBy('name')->get() as $role)
                          @if(Auth::user()->hasRole('master_admin') && $role->name == 'member')
                            <li class="menu-item {{ isset($active) && $active == '$role->name' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{route('user.list_user',$role->name)}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{$role->display_name}}</span>
                                </a>
                            </li>
                          @endif
                        @endforeach
                    </ul>
                </div>
            </li>
            @endrole
            @role(['super_admin','admin'])
              <li class="menu-item {{ isset($page) && $page == 'balance' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                <a href="{{route('balance.user')}}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                              <g id="Stockholm-icons-/-Shopping-/-Money" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                  <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" id="Combined-Shape-Copy" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "></path>
                                  <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" id="Combined-Shape" fill="#000000"></path>
                              </g>
                          </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-text">Balance</span>
                </a>
              </li>
              <li class="menu-item {{ isset($page) && $page == 'bounty' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="{{route('bounty.list')}}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16"></rect>
                                <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                    </span>
                    <span class="menu-text">Bounty Spartan Coin</span>
                </a>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'bonus_active' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24" />
                                  <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                  <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                              </g>
                          </svg>
                          <!--end::Svg Icon-->
                      </span>
                      <span class="menu-text">Bonus</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'list_daily' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('program.list_bonus_active','daily')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Daily</span>
                              </a>
                          </li>
                          <li class="menu-item {{ isset($active) && $active == 'list_sponsor' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('program.list_bonus_active','sponsor')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Sponsor</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'convert' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24"></rect>
                              <path d="M5.5,4 L9.5,4 C10.3284271,4 11,4.67157288 11,5.5 L11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M14.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,17.5 C13,16.6715729 13.6715729,16 14.5,16 Z" fill="#000000"></path>
                              <path d="M5.5,10 L9.5,10 C10.3284271,10 11,10.6715729 11,11.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,12.5 C20,13.3284271 19.3284271,14 18.5,14 L14.5,14 C13.6715729,14 13,13.3284271 13,12.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                          </svg>
                          <!--end::Svg Icon-->
                      </span>
                      <span class="menu-text">Convert</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'list_convert' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('convert.list')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">List</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'account' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="5" rx="1"/>
                                  <path d="M5,7 L8,7 L8,21 L7,21 C5.8954305,21 5,20.1045695 5,19 L5,7 Z M19,7 L19,19 C19,20.1045695 18.1045695,21 17,21 L11,21 L11,7 L19,7 Z" fill="#000000"/>
                              </g>
                          </svg>
                      </span>
                      <span class="menu-text">WD Account</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'list_wallet' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('trustme_coin.list')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">List Address</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'deposit' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="5" rx="1"/>
                                  <path d="M5,7 L8,7 L8,21 L7,21 C5.8954305,21 5,20.1045695 5,19 L5,7 Z M19,7 L19,19 C19,20.1045695 18.1045695,21 17,21 L11,21 L11,7 L19,7 Z" fill="#000000"/>
                              </g>
                          </svg>
                      </span>
                      <span class="menu-text">Deposit</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'list_deposit' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('deposit.list')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Trustme Coin</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'withdraw' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
                                <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
                                <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
                                <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
                            </g>
                        </svg>
                      </span>
                      <span class="menu-text">Withdraw</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'trustme' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('withdraw.list_withdraw','trustme')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Trustme Coin</span>
                              </a>
                          </li>
                          <li class="menu-item {{ isset($active) && $active == 'spartan' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                            <a href="{{route('withdraw.list_withdraw','spartan')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Spartan Coin</span>
                            </a>
                        </li>
                      </ul>
                  </div>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'package' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <polygon fill="#000000" opacity="0.3" points="6 3 18 3 20 6.5 4 6.5"/>
                                  <path d="M6,5 L18,5 C19.1045695,5 20,5.8954305 20,7 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,7 C4,5.8954305 4.8954305,5 6,5 Z M9,9 C8.44771525,9 8,9.44771525 8,10 C8,10.5522847 8.44771525,11 9,11 L15,11 C15.5522847,11 16,10.5522847 16,10 C16,9.44771525 15.5522847,9 15,9 L9,9 Z" fill="#000000"/>
                              </g>
                          </svg>
                      </span>
                      <span class="menu-text">Plan</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'by_admin' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('program.by_admin')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Register</span>
                              </a>
                          </li>
                          <li class="menu-item {{ isset($active) && $active == 'list_package_admin' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('program.list','admin')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Plan Admin</span>
                              </a>
                          </li>
                          <li class="menu-item {{ isset($active) && $active == 'list_package_member' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('program.list','member')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Plan Member</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'users' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                          <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                              <g id="Stockholm-icons-/-General-/-User" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                  <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                  <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path>
                              </g>
                          </svg>
                          <!--end::Svg Icon-->
                      </span>
                      <span class="menu-text">Users</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'index' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('user.index')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Create</span>
                              </a>
                          </li>
                          @foreach (App\Role::orderBy('name')->get() as $role)
                            @if(Auth::user()->hasRole('admin') && $role->name == 'member')
                              <li class="menu-item {{ isset($active) && $active == '$role->name' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                  <a href="{{route('user.list_user',$role->name)}}" class="menu-link">
                                      <i class="menu-bullet menu-bullet-dot">
                                          <span></span>
                                      </i>
                                      <span class="menu-text">{{$role->display_name}}</span>
                                  </a>
                              </li>
                            @elseif(Auth::user()->hasRole('super_admin'))
                              <li class="menu-item {{ isset($active) && $active == '$role->name' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                  <a href="{{route('user.list_user',$role->name)}}" class="menu-link">
                                      <i class="menu-bullet menu-bullet-dot">
                                          <span></span>
                                      </i>
                                      <span class="menu-text">{{$role->display_name}}</span>
                                  </a>
                              </li>
                            @endif
                          @endforeach
                      </ul>
                  </div>
              </li>

              <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'setting' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                          <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                              <g id="Stockholm-icons-/-Shopping-/-Settings" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect id="Bound" opacity="0.200000003" x="0" y="0" width="24" height="24"></rect>
                                  <path d="M4.5,7 L9.5,7 C10.3284271,7 11,7.67157288 11,8.5 C11,9.32842712 10.3284271,10 9.5,10 L4.5,10 C3.67157288,10 3,9.32842712 3,8.5 C3,7.67157288 3.67157288,7 4.5,7 Z M13.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L13.5,18 C12.6715729,18 12,17.3284271 12,16.5 C12,15.6715729 12.6715729,15 13.5,15 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                  <path d="M17,11 C15.3431458,11 14,9.65685425 14,8 C14,6.34314575 15.3431458,5 17,5 C18.6568542,5 20,6.34314575 20,8 C20,9.65685425 18.6568542,11 17,11 Z M6,19 C4.34314575,19 3,17.6568542 3,16 C3,14.3431458 4.34314575,13 6,13 C7.65685425,13 9,14.3431458 9,16 C9,17.6568542 7.65685425,19 6,19 Z" id="Combined-Shape" fill="#000000"></path>
                              </g>
                          </svg>
                          <!--end::Svg Icon-->
                      </span>
                      <span class="menu-text">Settings</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'setting' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('setting.index')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Settings</span>
                              </a>
                          </li>
                      </ul>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'roi' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('setting.package')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Plan</span>
                              </a>
                          </li>
                      </ul>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'composition' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('composition.index')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Composition</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              @role('super_admin')
                <li class="menu-item menu-item-submenu {{ isset($page) && $page == 'generate' ? 'menu-item-open menu-item-here' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                      <span class="svg-icon menu-icon">
                          <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24"></polygon>
                              <path d="M18.5,8 C17.1192881,8 16,6.88071187 16,5.5 C16,4.11928813 17.1192881,3 18.5,3 C19.8807119,3 21,4.11928813 21,5.5 C21,6.88071187 19.8807119,8 18.5,8 Z M18.5,21 C17.1192881,21 16,19.8807119 16,18.5 C16,17.1192881 17.1192881,16 18.5,16 C19.8807119,16 21,17.1192881 21,18.5 C21,19.8807119 19.8807119,21 18.5,21 Z M5.5,21 C4.11928813,21 3,19.8807119 3,18.5 C3,17.1192881 4.11928813,16 5.5,16 C6.88071187,16 8,17.1192881 8,18.5 C8,19.8807119 6.88071187,21 5.5,21 Z" fill="#000000" opacity="0.3"></path>
                              <path d="M5.5,8 C4.11928813,8 3,6.88071187 3,5.5 C3,4.11928813 4.11928813,3 5.5,3 C6.88071187,3 8,4.11928813 8,5.5 C8,6.88071187 6.88071187,8 5.5,8 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 C14,5.55228475 13.5522847,6 13,6 L11,6 C10.4477153,6 10,5.55228475 10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,18 L13,18 C13.5522847,18 14,18.4477153 14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 C10,18.4477153 10.4477153,18 11,18 Z M5,10 C5.55228475,10 6,10.4477153 6,11 L6,13 C6,13.5522847 5.55228475,14 5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 C18.4477153,14 18,13.5522847 18,13 L18,11 C18,10.4477153 18.4477153,10 19,10 Z" fill="#000000"></path>
                            </g>
                          </svg>
                          <!--end::Svg Icon-->
                      </span>
                      <span class="menu-text">Generate</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'bonus' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('generate.viewGenerateBonus')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Bonus</span>
                              </a>
                          </li>
                      </ul>
                      <ul class="menu-subnav">
                          <li class="menu-item {{ isset($active) && $active == 'log' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                              <a href="{{route('generate.log')}}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">Log</span>
                              </a>
                          </li>
                      </ul>
                  </div>
                </li>
              @endrole
            @endrole
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
</div>
