@php $brand = config('app.name', 'MyHotel'); @endphp

<header class="header">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      {{-- Brand + sidebar toggle --}}
      <div class="navbar-header d-flex align-items-center">
        <a href="{{ route('dashboard') }}" class="navbar-brand">
          {{-- Full logo (first two letters highlighted) --}}
          <div class="brand-text brand-big visible text-uppercase brand-logo">
            <strong class="text-primary">{{ Str::substr($brand, 0, 2) }}</strong><span class="text-white">{{ Str::substr($brand, 2) }}</span>
          </div>
          {{-- Compact logo (shown when the sidebar is collapsed) --}}
          <div class="brand-text brand-sm brand-logo">
            <strong class="text-primary">{{ Str::upper(Str::substr($brand, 0, 1)) }}</strong><span class="text-white">{{ Str::upper(Str::substr($brand, 2, 1)) }}</span>
          </div>
        </a>

        <button type="button" class="sidebar-toggle btn-toggle-custom">
          <i class="fa fa-long-arrow-left"></i>
        </button>
      </div>

      {{-- Logout --}}
      <div class="right-menu list-inline no-margin-bottom">
        <div class="list-inline-item logout">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">
              <i class="fa fa-sign-out"></i> Logout
            </button>
          </form>
        </div>
      </div>

    </div>
  </nav>
</header>