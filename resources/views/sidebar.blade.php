@inject('request', 'Illuminate\Http\Request')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="home" class="brand-link">
    <img src="{{ asset('resources/assets/backend/dist/img/logo.png')}}" alt="Bestway Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Project</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('resources/assets/backend/dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="javascript:void(0);" class="d-block">{{ ucfirst(Auth::user()->name) }}</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @can('user_manage')
          <li class="nav-item has-treeview @if($request->segment(1) == 'permission' || $request->segment(1) == 'role' || $request->segment(1) == 'user') menu-open @endif">
            <a href="#" class="nav-link @if($request->segment(1) == 'permission' || $request->segment(1) == 'role' || $request->segment(1) == 'user') active @endif">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                User Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('permission.index') }}" class="{{ $request->segment(1) == 'permission' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-align-center nav-icon"></i>
                  <p>Permession</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('role.index') }}" class="{{ $request->segment(1) == 'role' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-user-friends nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="{{ $request->segment(1) == 'user' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-users nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
          @can('master_manage')
          <li class="nav-item has-treeview @if($request->segment(1) == 'currency' || $request->segment(1) == 'country') menu-open @endif"">
            <a href="javascript:void(0);" class="nav-link @if($request->segment(1) == 'currency' || $request->segment(1) == 'country') active @endif">
            <i class="fas fa-asterisk nav-icon"></i>
              <p>
               Manage Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('currency.index') }}" class="{{ $request->segment(1) == 'currency' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-dollar-sign nav-icon"></i>
                  <p>Currency</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('country.index') }}" class="{{ $request->segment(1) == 'country' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-city nav-icon"></i>
                  <p>Country</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('state.index') }}" class="{{ $request->segment(1) == 'state' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-flag-usa nav-icon"></i>
                  <p>State</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('city.index') }}" class="{{ $request->segment(1) == 'city' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-building nav-icon"></i>
                  <p>City</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="{{ $request->segment(1) == 'category' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-fan nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('subcategory.index') }}" class="{{ $request->segment(1) == 'subcategory' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-fan nav-icon"></i>
                  <p>Sub Category</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('brand.index') }}" class="{{ $request->segment(1) == 'brand' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-copyright nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product.index') }}" class="{{ $request->segment(1) == 'product' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-star nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('storecategory.index') }}" class="{{ $request->segment(1) == 'storecategory' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-fan nav-icon"></i>
                  <p>Store Category</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
          @can('store_manage')
          <li class="nav-item has-treeview @if($request->segment(1) == 'store') menu-open @endif">
            <a href="#" class="nav-link @if($request->segment(1) == 'store') active @endif">
              <i class="nav-icon fas fa-store"></i>
              <p>
                Store Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('store.index') }}" class="{{ $request->segment(1) == 'store' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-store-alt nav-icon"></i>
                  <p>Store</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('manufacturer.index') }}" class="{{ $request->segment(1) == 'manufacturer' ? 'nav-link active' : 'nav-link' }}">
                <i class="fas fa-cash-register nav-icon"></i>
                  <p>Manufacturer</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('retailerspurchase.index') }}" class="{{ $request->segment(1) == 'retailerspurchase' ? 'nav-link active' : 'nav-link' }}">
					<i class="fas fa-street-view nav-icon"></i>
                  <p>Retailers Purchase Product</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
             
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <script>
  
  </script>