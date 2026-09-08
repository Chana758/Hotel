<!-- 1. ទាញយក Google Fonts បែប Luxury -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

<style>
    /* Footer Background & General Style */
    .footer {
        background: #0a0a0a;
        padding: 100px 0 40px;
        color: #f1f1f1;
        font-family: 'Poppins', sans-serif;
        border-top: 1px solid #1a1a1a;
    }

    /* Column Headers */
    .footer h3 {
        color: #d4af37;
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        text-transform: capitalize;
        margin-bottom: 40px;
        position: relative;
    }

    /* Navigation Links */
    .link_menu { list-style: none; padding: 0; }
    .link_menu li { margin-bottom: 18px; }
    .link_menu li a {
        color: #999;
        text-decoration: none;
        font-size: 15px;
        transition: all 0.4s ease;
        display: inline-block;
    }
    .link_menu li a:hover, .link_menu li.active a {
        color: #d4af37 !important;
        transform: translateX(10px);
    }

    /* Contact Details */
    .conta { list-style: none; padding: 0; }
    .conta li { font-size: 15px; color: #bbb; display: flex; align-items: center; margin-bottom: 18px; }
    .conta li i { 
        color: #d4af37; 
        margin-right: 15px; 
        font-size: 18px;
        width: 25px;
        text-align: center;
    }

    /* Newsletter Input */
    .bottom_form {
        display: flex;
        flex-direction: column;
    }
    .bottom_form .enter {
        width: 100%;
        background: #1a1a1a !important;
        border: 1px solid #333 !important;
        padding: 15px 20px;
        color: #ffffff !important;
        border-radius: 4px;
        margin-bottom: 10px;
        font-size: 14px;
    }

    /* Subscribe Button */
    .sub_btn {
        width: 100%;
        background: #d4af37 !important;
        color: #000 !important;
        padding: 15px;
        border: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.4s;
    }
    .sub_btn:hover {
        background: #ffffff !important;
        transform: translateY(-3px);
    }

    /* Social Icons */
    .social_icon { 
        display: flex; 
        gap: 15px; 
        margin-top: 30px; 
        list-style: none; 
        padding: 0; 
    }
    .social_icon li a i {
        width: 40px;
        height: 40px;
        background: #161616;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #d4af37;
        font-size: 16px;
        transition: 0.3s;
        border: 1px solid #222;
    }
    .social_icon li a i:hover { 
        background: #d4af37; 
        color: #000; 
    }

    /* Copyright & Brand Name */
    .copyright {
        margin-top: 80px;
        padding: 40px 0;
        border-top: 1px solid #1a1a1a;
        text-align: center;
    }
    .copyright p {
        font-size: 13px;
        color: #555;
    }
    .brand-name {
        color: #d4af37;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        text-decoration: none;
        margin-left: 5px;
    }
</style>

<footer>
   <div class="footer">
      <div class="container">
         <div class="row">
            <!-- ផ្នែកទី ១: ទំនាក់ទំនង (ទាញចេញពីរូបភាពទី ៣ ក្នុង Dashboard) -->
            <div class="col-md-4">
               <h3>Reach Us</h3>
               <ul class="conta">
                  {{-- ទាញ Location --}}
                  <li><i class="fa fa-map-marker"></i> {{ get_setting('location', 'Phnom Penh, Cambodia') }}</li>
                  {{-- ទាញ Phone Number --}}
                  <li><i class="fa fa-phone"></i> {{ get_setting('phone', '+855 000 000 000') }}</li>
                  {{-- ទាញ Email Address --}}
                  <li><i class="fa fa-envelope"></i> 
                     <a href="mailto:{{ get_setting('email', 'info@hotel.com') }}" style="color: #bbb; text-decoration: none;"> 
                        {{ get_setting('email', 'info@hotel.com') }}
                     </a>
                  </li>
               </ul>
            </div>

            <!-- ផ្នែកទី ២: Navigation -->
            <div class="col-md-4">
               <h3>Navigation</h3>
               <ul class="link_menu">
                  <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                  <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ url('about') }}">About Hotel</a></li>
                  <li class="{{ Request::is('our_rooms') ? 'active' : '' }}"><a href="{{ url('our_rooms') }}">Luxury Rooms</a></li>
                  <li class="{{ Request::is('hotel_gallery') ? 'active' : '' }}"><a href="{{ url('hotel_gallery') }}">Gallery</a></li>
                  <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ url('contact') }}">Contact Us</a></li>
               </ul>
            </div>

            <!-- ផ្នែកទី ៣: Newsletter & Social Media (ទាញចេញពីរូបភាពទី ៣ ក្នុង Dashboard) -->
            <div class="col-md-4">
               <h3>Join Our Club</h3>
               <form class="bottom_form">
                  <input class="enter" placeholder="ENTER YOUR EMAIL" type="email" required>
                  <button class="sub_btn" type="submit">SUBSCRIBE</button>
               </form>
               <ul class="social_icon">
                  {{-- ទាញ Facebook URL --}}
                  <li><a href="{{ get_setting('facebook_url', '#') }}"><i class="fa fa-facebook"></i></a></li>
                  {{-- ទាញ Instagram URL --}}
                  <li><a href="{{ get_setting('instagram_url', '#') }}"><i class="fa fa-instagram"></i></a></li>
                  <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
               </ul>
            </div>
         </div>

         <!-- Copyright (ទាញចេញពីរូបភាពទី ២ ក្នុង Dashboard) -->
         <div class="copyright">
            <div class="container">
               <p>
                  {{-- ទាញ Copyright Text --}}
                  {{ get_setting('copyright', '© 2026 Your Brand') }} 
                  | CRAFTED BY {{-- បើវាចេញទទេ ជឿជាក់ហ្មងថា Key ហ្នឹងខុសហើយ --}}
                    {{ get_setting('admin_name') }}
               </p>
            </div>
         </div>
      </div>
   </div>
</footer>

<!-- Javascript Files -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.0.0.min.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>