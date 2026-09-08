<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style>
     /* កែសម្រួល Class មេឱ្យលាតពេញទទឹងអេក្រង់ */
     .page-content {
        width: 100% !important;
        padding: 10px 15px !important; /* បន្ថយ padding ឱ្យនៅសល់តិចបំផុត */
        margin: 0 !important;
        background-color: #121418 !important; /* ពណ៌ខ្មៅដូចរូបភាព Dashboard */
     }

     /* បន្ថែម Style ឱ្យអក្សរក្នុង Body ដិតច្បាស់ (Bold) */
     .page-content b, 
     .page-content strong,
     .page-content h2,
     .page-content .number {
        font-weight: 900 !important;
     }
   </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
    <div class="page-content">
      @if(Request::is('admin/dashboard') || Request::is('dashboard') || Request::is('/'))
          @include('admin.body')
      @else
          @yield('content')
      @endif
      
      @include('admin.footer')
    </div>

  </body>
</html>