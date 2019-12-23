      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image"><span class="online-status online"></span> </div>
              <div class="profile-name">
                <p class="name">Richard V.Welsh</p>
                <p class="designation">Manager</p>
                <div class="badge badge-teal mx-auto mt-3">Online</div>
              </div>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}"><span class="menu-title">Dashboard</span></a></li>          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general" aria-expanded="false" aria-controls="general-pages"><span class="menu-title">Products</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="general">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.products') }}">Manage Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.product.create') }}">Add Product</a></li>                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="general-pages"><span class="menu-title">Orders</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="orders">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders') }}">Manage Orders</a></li>
              </ul>
            </div>
          </li>                   
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="general-pages"><span class="menu-title">Categories</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="categories">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories') }}">Manage Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.category.create') }}">Add Category</a></li>                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#brands" aria-expanded="false" aria-controls="general-pages"><span class="menu-title">Brands</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="brands">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.brands') }}">Manage Brands</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.brand.create') }}">Add Brand</a></li>                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#divisions" aria-expanded="false" aria-controls="general-pages"><span class="menu-title">Divisions</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="divisions">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.divisions') }}">Manage Divisions</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.division.create') }}">Add Division</a></li>                
              </ul>
            </div>
          </li>   
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#districts" aria-expanded="false" aria-controls="general-pages"><span class="menu-title">Districts</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="districts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.districts') }}">Manage Districts</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.district.create') }}">Add District</a></li>                
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sliders" aria-expanded="false" aria-controls="general-pages"><span class="menu-title">Sliders</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="sliders">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.sliders') }}">Manage Sliders</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
          <a class="nav-link" href="">
          <form class="form-inline" action="{{ route('admin.logout') }}" method="post">
              @csrf
            <input type="submit" value="Logout Now"  class="btn btn-danger">
          </form>
          </li> 
          </a>      
          <li class="nav-item purchase-button"><a class="nav-link" href="https://www.bootstrapdash.com/product/star-admin-pro/" target="_blank">Get full version</a></li>
        </ul>
      </nav>