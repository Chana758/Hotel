<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

<style>
    .site-footer { background: #0a0a0a; padding: 100px 0 40px; color: #f1f1f1; font-family: 'Poppins', sans-serif; border-top: 1px solid #1a1a1a; }
    .site-footer h3 { color: #d4af37; font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; margin-bottom: 40px; }

    .site-footer .link_menu, .site-footer .conta, .site-footer .social_icon { list-style: none; padding: 0; }
    .site-footer .link_menu li { margin-bottom: 18px; }
    .site-footer .link_menu li a { color: #999; text-decoration: none; font-size: 15px; transition: .4s; display: inline-block; }
    .site-footer .link_menu li a:hover, .site-footer .link_menu li.active a { color: #d4af37 !important; transform: translateX(10px); }

    .site-footer .conta li { font-size: 15px; color: #bbb; display: flex; align-items: center; margin-bottom: 18px; }
    .site-footer .conta li i { color: #d4af37; margin-right: 15px; font-size: 18px; width: 25px; text-align: center; }

    .site-footer .bottom_form { display: flex; flex-direction: column; }
    .site-footer .enter { width: 100%; background: #1a1a1a !important; border: 1px solid #333 !important; padding: 15px 20px; color: #fff !important; border-radius: 4px; margin-bottom: 10px; font-size: 14px; }
    .site-footer .sub_btn { width: 100%; background: #d4af37 !important; color: #000 !important; padding: 15px; border: none; border-radius: 4px; font-size: 13px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; cursor: pointer; transition: .4s; }
    .site-footer .sub_btn:hover { background: #fff !important; transform: translateY(-3px); }

    .site-footer .social_icon { display: flex; gap: 15px; margin-top: 30px; }
    .site-footer .social_icon li a i { width: 40px; height: 40px; background: #161616; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #d4af37; font-size: 16px; transition: .3s; border: 1px solid #222; }
    .site-footer .social_icon li a i:hover { background: #d4af37; color: #000; }

    .site-footer .copyright { margin-top: 80px; padding: 40px 0; border-top: 1px solid #1a1a1a; text-align: center; }
    .site-footer .copyright p { font-size: 13px; color: #555; margin: 0; }
</style>

<footer>
    <div class="site-footer">
        <div class="container">
            <div class="row">

                {{-- Contact details (Admin > Settings) --}}
                <div class="col-md-4">
                    <h3>Reach Us</h3>
                    <ul class="conta">
                        <li><i class="fa fa-map-marker"></i> {{ get_setting('address', 'Phnom Penh, Cambodia') }}</li>
                        <li><i class="fa fa-phone"></i> {{ get_setting('phone', '+855 000 000 000') }}</li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:{{ get_setting('email', 'info@example.com') }}" style="color:#bbb;text-decoration:none;">{{ get_setting('email', 'info@example.com') }}</a>
                        </li>
                    </ul>
                </div>

                {{-- Navigation --}}
                <div class="col-md-4">
                    <h3>Navigation</h3>
                    <ul class="link_menu">
                        <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                        <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('about') }}">About Us</a></li>
                        <li class="{{ request()->is('our_rooms') ? 'active' : '' }}"><a href="{{ url('our_rooms') }}">Luxury Rooms</a></li>
                        <li class="{{ request()->is('hotel_gallery') ? 'active' : '' }}"><a href="{{ url('hotel_gallery') }}">Gallery</a></li>
                        <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                {{-- Newsletter + social links --}}
                <div class="col-md-4">
                    <h3>Join Our Club</h3>
                    <form class="bottom_form">
                        <input class="enter" placeholder="ENTER YOUR EMAIL" type="email" required>
                        <button class="sub_btn" type="submit">Subscribe</button>
                    </form>
                    <ul class="social_icon">
                        <li><a href="{{ get_setting('facebook', '#') }}"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ get_setting('instagram', '#') }}"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>
                    {{ get_setting('copyright', '© ' . date('Y') . ' ' . config('app.name')) }}
                    | Crafted by {{ get_setting('admin_name', 'Admin') }}
                </p>
            </div>
        </div>
    </div>
</footer>

{{-- JavaScript --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>