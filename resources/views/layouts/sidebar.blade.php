<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
  
  <a href="{{ route('admin.dashboard') }}" class=" d-flex align-items-center justify-content-center">
    <span class="app-brand-logo demo">
      <img src="{{ asset('assets/img/logo/logo-ap.png') }}"
           alt="Logo Jouan-Stock"
           class="img-fluid mx-auto d-block" style="max-width: 30px;">
    </span>
    <span class="app-brand-text demo menu-text fw-bold ms-2">Jouan-Stock</span>
  </a>

  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
    <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
    <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
  </a>
</div>


  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div>Dashboard</div>
      </a>
    </li>
    {{-- @can('access-superadmin') --}}
    <!-- user -->
    @can('access-superadmin')
      <li class="menu-item {{ Request::routeIs('user.*') ? 'active' : '' }}">
        <a href="{{ route('user.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div>Utilisateurs</div>
        </a>
      </li>
      @endcan
    <li class="menu-item {{ Request::routeIs('paiements.*') ? 'active' : '' }}">
      <a href="{{ route('paiements.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-cash"></i>
        <div>Paiement</div>
      </a>
    </li>
    @can('access-admin')
      <li class="menu-item {{ Request::routeIs('abonnements.*') ? 'active' : '' }}">
      <a href="{{ route('abonnements.create') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-building-store"></i>
        <div>Abonnement</div>
      </a>
    </li>
    @endcan
  </ul>
</aside>
