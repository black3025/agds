@php
  $containerNav = $containerNav ?? 'container-fluid';
  $navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
          <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      <p class="navbar-nav flex-row align-items-left fw-bold">{{strtoupper(explode(".",Route::currentRouteName())[0])}}</p>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
              @if(Auth::user()->unreadNotifications->count()>0)
                <li class="nav-item navbar-dropdown">
                      <a id="navbarDropdown" class="dropdown-item" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          <i class='bx bxs-bell'></i>
                          <span class="badge bg-info badge-xs">{{Auth::user()->unreadNotifications->count()}}</span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end">
                                  @if(Auth::user()->unreadNotifications->count()>0)
                                    <li class="d-flex justify-content-end mx-1 my-2">
                                        <a href="{{route('mark-as-read')}}" class="btn btn-info btn-sm">Mark All as Read</a>
                                    </li>
                                  @endif
                                  @foreach (auth()->user()->unreadNotifications as $notification)
                                    <li><a href="#" class="dropdown-item"><li class="p-1"> {{$notification->data['data']}}</li></a>
                                  @endforeach
                                  <!-- @foreach (auth()->user()->readNotifications as $notification)
                                    <li><a href="#" class="dropdown-item"><li class="p-1 text-secondary"> {{$notification->data['data']}}</li></a>
                                  @endforeach -->
                      </ul>
                  </li>
              @else
                      <a id="navbarDropdown" class="dropdown-item">
                          <i class='bx bxs-bell'></i>
                          <span class="badge bg-info badge-xs">{{Auth::user()->unreadNotifications->count()}}</span>
                      </a>
              @endif
          <!-- Place this tag where you want the button to render. -->
      
          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset('storage/profile-photos/'.Auth::user()->profile_pic) }}" alt class="w-px-40 h-40 rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{route('user.show',Auth::user()->id)}}">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ asset('storage/profile-photos/'.Auth::user()->profile_pic) }}" alt class="w-px-40 h-40 rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-medium d-block">{{Auth::User()->fname}}</span>
                      <small class="text-muted">{{Auth::User()->role->name}}</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{route('logout')}}">
                  <i class='bx bx-power-off me-2'></i>
                  <span class="align-middle">Log Out</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
