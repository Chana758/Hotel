<style>
    .about .read_more {
        display: inline-block !important;
        width: auto !important;
        max-width: none !important;
        padding: 12px 40px !important;
        white-space: nowrap;
    }
</style>

<div class="about">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="titlepage">
                    <h2>About Us</h2>
                    
                    <p>Welcome to {{ config('app.name') }}, where comfort meets warm hospitality. Our rooms are designed for rest, our team is here to make every stay memorable, and our doors are always open to travelers, families and business guests alike.</p>
                    <a class="read_more" href="{{ url('our_rooms') }}">Explore Our Rooms</a>
                </div>
            </div>
            <div class="col-md-7">
                <div class="about_img">
                    <figure><img src="{{ asset('images/about.png') }}" alt="About {{ config('app.name') }}"></figure>
                </div>
            </div>
        </div>
    </div>
</div>