<!DOCTYPE html>
<html>
   <head>
      @include('home.css') {{-- ហៅ CSS មកកុំឱ្យខូចរាង --}}
   </head>
   <body class="main-layout">
      <header>
         @include('home.header') {{-- ហៅ Header មកឱ្យមានប៊ូតុង Login --}}
      </header>

      @include('home.contact') {{-- ហៅសាច់កូដ About ដែលមេមានស្រាប់ --}}

      @include('home.footer')
   </body>
</html>