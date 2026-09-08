<footer class="footer">
  <div class="footer__block block no-margin-bottom">
    <div class="container-fluid text-center">
       <p class="no-margin-bottom">
          {{-- ទាញឆ្នាំបច្ចុប្បន្ន និង Copyright Text ពី Setting --}}
          {{ date('Y') }} &copy; {{ get_setting('copyright', 'Your Brand') }}. 
          
          {{-- បង្ហាញឈ្មោះមេជាអ្នកបង្កើត --}}
          Crafted by <a target="_blank" href="#" style="color: #d4af37;">{{ get_setting('admin_name', 'SAM CHANNA') }}</a>
       </p>
    </div>
  </div>
</footer>
</div>
</div>
<!-- JavaScript files-->
<script src="{{ asset('Admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Admin/vendor/popper.js/umd/popper.min.js') }}"> </script>
<script src="{{ asset('Admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('Admin/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
<script src="{{ asset('Admin/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('Admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('Admin/js/charts-home.js') }}"></script>
<script src="{{ asset('Admin/js/front.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>