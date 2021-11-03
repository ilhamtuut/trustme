<div
    class="menu-w color-style-default menu-position-side menu-side-left menu-layout-compact sub-menu-style-inside sub-menu-color-light selected-menu-color-light menu-activated-on-click menu-has-selected-link {{session('isDark') ? 'color-scheme-dark' : 'color-scheme-light'}}">
    <div class="logo-w logo-w-exchange">
        <a class="logo" onclick="_callBlockUi()" href="{{url('/')}}">
            <img src="{{asset('statics/images/logo-v1.png')}}" style="width: 26px">
            <div class="logo-label">
                {{config('app.name')}}
            </div>
        </a>
    </div>
    @if(Auth::check())
    <div class="logged-user-w avatar-inline">
        <div class="logged-user-i d-flex">
            <div class="avatar-w">
                <img width="50" alt="Avatar {{Auth::User()->name}}" src="{{Auth::User()->profile_photo_path}}">
            </div>
            <div class="logged-user-info-w">
                @if(Auth::user()->hasRole('user'))
                <div class="logged-user-name">
                    {{Auth::User()->name}}
                </div>
                <div class="logged-user-role">
                    {{Auth::User()->username}}
                </div>
                <div class="mt-1 logged-user-role normal-font">
                    Asset Estimation:
                </div>
                <div class="logged-user-role text-success normal-font depositData">
                load...
                </div>
                @else
                <h6 class="logged-user-name mt-1">
                    Administrator
                </h6>
                @endif
            </div>
        </div>
    </div>
    @endif
    @include('components.sidebarMenu')
</div>