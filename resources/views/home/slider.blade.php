<section class="banner_main">
    <div id="myCarousel" class="carousel slide banner" data-ride="carousel">

        @php $slides = ['banner1.jpg', 'banner2.jpg', 'banner3.jpg']; @endphp

        <ol class="carousel-indicators">
            @foreach($slides as $i => $slide)
                <li data-target="#myCarousel" data-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>

        <div class="carousel-inner">
            @foreach($slides as $i => $slide)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <img class="d-block w-100" src="{{ asset('images/' . $slide) }}" alt="Slide {{ $i + 1 }}">
                </div>
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    {{-- Quick availability search: sends the visitor to the rooms page --}}
    <div class="booking_ocline">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="book_room">
                        <h1>Book a Room Online</h1>
                        <form class="book_now" method="GET" action="{{ url('our_rooms') }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Arrival</span>
                                    <img class="date_cua" src="{{ asset('images/date.png') }}" alt="">
                                    <input class="online_book" type="date" name="arrival" min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-12">
                                    <span>Departure</span>
                                    <img class="date_cua" src="{{ asset('images/date.png') }}" alt="">
                                    <input class="online_book" type="date" name="departure" min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="book_btn">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>