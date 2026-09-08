<div class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Contact Us</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <!-- ដាក់កូដនេះនៅពីលើ <form> ក្នុងទំព័រ Contact របស់មេ -->
                  @if(session('success'))
                     <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" 
                           style="color: #155724; background-color: #d4edda; border-color: #c3e6cb; padding: 15px; margin-bottom: 20px; position: relative;">
                        
                        <strong>ជោគជ័យ!</strong> {{ session('success') }}
                        
                        <!-- ប៊ូតុងខ្វែង (X) -->
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" 
                                 style="position: absolute; right: 10px; top: 10px; background: none; border: none; font-size: 20px; cursor: pointer;">
                              <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                  @endif
                  <!-- បន្ថែម Method="POST" និង Action ទៅកាន់ Route របស់អ្នក -->
                  <form id="request" class="main_form" method="POST" action="{{ route('contact.store') }}">
                     @csrf <!-- បន្ថែមដើម្បីការពារសុវត្ថិភាព Form -->

                     <div class="row">
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Name" type="text" name="name" value="{{ old('name') }}"> 
                           @error('name')
                              <span style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>

                        <div class="col-md-12">
                           <input class="contactus" placeholder="Email" type="email" name="email" value="{{ old('email') }}"> 
                           @error('email')
                              <span style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>

                        <div class="col-md-12">
                           <input class="contactus" placeholder="Phone Number" type="text" name="phone" value="{{ old('phone') }}"> 
                           @error('phone')
                              <span style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>

                        <div class="col-md-12">
                           <textarea class="textarea" placeholder="Message" name="message">{{ old('message') }}</textarea>
                           @error('message')
                              <span style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>

                        <div class="col-md-12">
                           <button type="submit" class="send_btn">Send</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="col-md-6">
                  <div class="map_main">
                     <div class="map-responsive">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d250151.46367837288!2d104.7253777478073!3d11.579317639841996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109513dc76a6be3%3A0x9c010ee85ab525bb!2z4Z6X4Z-S4Z6T4Z-G4Z6W4Z-B4Z6J!5e0!3m2!1skm!2skh!4v1777294262984!5m2!1skm!2skh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div> 
      <script>
      // រង់ចាំឱ្យ Document ដើរចប់
      document.addEventListener("DOMContentLoaded", function() {
         var alert = document.getElementById('success-alert');
         if (alert) {
               // កំណត់ឱ្យបាត់ទៅវិញក្រោយ 5 វិនាទី
               setTimeout(function() {
                  alert.style.transition = "opacity 0.6s ease";
                  alert.style.opacity = "0";
                  setTimeout(function() {
                     alert.remove();
                  }, 600); // រង់ចាំ Animation ចប់ទើបលុបចេញពី HTML
               }, 5000); 
         }
      });
   </script>