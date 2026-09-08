<div class="gallery">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>gallery</h2>
            </div>
         </div>
      </div>
      <div class="row">
         {{-- ចាប់ផ្តើម Loop ទាញទិន្នន័យ --}}
         @foreach($gallery as $item)
            <div class="col-md-3 col-sm-6">
               <div class="gallery_img">
                  <!-- ប្តូរ src ឱ្យទៅរក Folder ដែលអ្នករក្សារូបភាព ឧទាហរណ៍ Folder: public/gallery -->
                  <figure>
                     <img src="{{ asset('gallery/' . $item->image) }}" alt="#" style="height: 200px; width: 100%; object-fit: cover;"/>
                  </figure>
               </div>
            </div>
         @endforeach
      </div>
   </div>
</div>