<div class="container">
    <nav class="main-menu d-flex navbar navbar-expand-lg ">

     

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

        <div class="offcanvas-header justify-content-center">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body justify-content-between">
          <h5 class="filter-categories border-0 mt-3 mb-0 me-5">
            All You Need here
          </h5>

          <ul class="navbar-nav menu-list list-unstyled d-flex gap-md-3 mb-0 ">
            <li class="nav-item">
              <a href="{{route('website')}}" class="nav-link active">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown"
                aria-expanded="false">Pages</a>
              <ul class="dropdown-menu" aria-labelledby="pages">
                <li><a href="index.html" class="dropdown-item">About Us</a></li>
                <li><a href="index.html" class="dropdown-item">Shop</a></li>
                <li><a href="index.html" class="dropdown-item">Blog</a></li>
                <li><a href="index.html" class="dropdown-item">Contact</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{route('web-categories')}}" class="nav-link">Shop</a>
            </li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">Blog</a>
            </li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">Contact</a>
            </li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">Others</a>
            </li>
          </ul>

          <div class="d-none d-lg-flex align-items-end">
            <ul class="d-flex justify-content-end list-unstyled m-0">
              
              <li>
                <a href="{{route('web-register')}}" class="mx-3">
                  <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                </a>
              </li>
              <li>
                <a href="{{route('web-login')}}" class="mx-3">
                  <iconify-icon icon="healthicons:fingerprint" class="fs-4"></iconify-icon>
                </a>
              </li>
              <li>
                <a class="mx-3" href="{{route('user.logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <iconify-icon icon="healthicons:entry" class="fs-4"></iconify-icon>
                </a>
                <form action="{{route('user.logout')}}" method="POST" id="logout-form">
                  @csrf
                 
              </form>
              </li>
              

              <li class="">
                <a href="index.html" class="mx-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                  aria-controls="offcanvasCart">
                  <iconify-icon icon="mdi:cart" class="fs-4 position-relative"></iconify-icon>
                  <span class="position-absolute translate-middle badge rounded-circle bg-primary pt-2">
                    03
                  </span>
                </a>
              </li>
            </ul>

          </div>

        </div>

      </div>

    </nav>



  </div>