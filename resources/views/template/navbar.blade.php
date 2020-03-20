
<nav class="navbar navbar-dark nav-top">
  </nav>
<nav class="navbar navbar-expand-lg  nav-content nav-body">
    @if (session()->has('member'))
    <div class="tab"></div>
    <div class="nav-main">
        <a href="/"><div class="logo link-to-index"><img class="img-logo-ku" src="{{ asset('img/KU_SubLogo.png') }}" alt=""></div></a>
        <a href="/"><strong class="title link-to-index"></strong>SAKUNA หอพัก</strong></a>
        <form class="form-inline search">
            <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search">
            <div class="dropdown show">
                <a class="btn btn-outline-success dropdown-toggle mr-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  หมวดหมู่
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#" >Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        @if(session()->get('member')['Admin'] != 1 || session()->get('permission') != 1)
        <div class="menu">
            <div class="nav-icon"><i class="fas fa-shopping-basket"><sup><span class="badge badge-pill badge-danger">1</></sup></i><span>ใบแจ้งหนี้</span></div>
            <div class="nav-icon"><i class="fas fa-clipboard-list"><sup><span class="badge badge-pill badge-danger">1</span></sup></i><span>แจ้งเตือน</span></div>
            {{-- <div class="nav-icon"><i class="fas fa-bell"><sup><span class="badge badge-pill badge-danger">1</span></sup></i><span>แจ้งเตือน</span></div> --}}
        </div>
        @else
        <div class="menu-2">
            <div class="nav-icon"><i class="fas fa-toolbox"></i><span>จัดก่ารห้อง</span></div>
            {{-- <div class="nav-icon"><i class="fas fa-clipboard-list"></i><span>ประวัติ</span></div> --}}
            <div class="nav-icon"><i class="fas fa-exclamation"></i><span>บันทึกค่าเช่า</span></div>
            <div class="nav-icon"><i class="fas fa-chart-bar"></i><span>ผู้เช่าห้อง</span></div>
            <div class="nav-icon"><i class="fas fa-bell"></i><span>แจ้งเตือน</span></div>
        </div>
        @endif
        <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown profile">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle ml-2 img-profile"  src="{{asset(session()->get('icon'))}}" alt="Profile image"> <span class="font-weight-normal">{{session()->get('member')['thainame']}}</span></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle img-profile" src="{{asset(session()->get('icon'))}}" alt="Profile image">
                <p class="mb-1 mt-3">{{session()->get('member')['thainame']}}</p>
                <p class="font-weight-light text-muted mb-0">{{session()->get('member')['mail1']}}</p>
              </div>
              <a class="dropdown-item" href="/profile/me"><i class="dropdown-item-icon icon-user text-primary" ></i> My Profile <sup><span class="badge badge-pill badge-danger">1</span></sup></a>
              @if(session()->get('member')['Admin'] == 1)
              @if(session()->get('permission') != 1)
              <a class="dropdown-item" href="/1"><i class="dropdown-item-icon icon-user text-primary" ></i>AdminMode</a>
              @else
              <a class="dropdown-item" href="/0"><i class="dropdown-item-icon icon-user text-primary"></i>GeneralMode</a>
              @endif
              @endif
              <a href="/logout" class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
            </div>
          </li>
    </div>
    @else
    @if(isset($msg))
        <strong class="ml-5 status-login-fail">{{$msg}}</strong>
    @else
        <strong class="ml-5 status-login">ล็อกอินเพื่อเข้าสู่ระบบ</strong>
    @endif


    @endif
    </nav>
