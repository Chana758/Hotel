<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500&display=swap');

.our_room {
    padding: 80px 0;
    background-color: #ffffff;
    font-family: 'Poppins', sans-serif;
}

/* Header Styling */
.premium-title {
    font-family: 'Playfair Display', serif;
    font-size: 42px;
    color: #1a1a1a;
    letter-spacing: 2px;
    margin-bottom: 10px;
}

.premium-subtitle {
    color: #888;
    font-weight: 300;
    margin-bottom: 50px;
    font-style: italic;
}

/* Card Styling */
.premium-card {
    background: #fff;
    border-radius: 0px; /* រក្សាភាព Square ដើម្បីមើលទៅ Professional */
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: 1px solid #eee;
    height: 100%;
}

.premium-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    border-color: #d4af37; /* ពណ៌មាសស្រាល */
}

/* Image Box */
.premium-img-box {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.premium-img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 1.2s ease;
}

.premium-card:hover .premium-img-box img {
    transform: scale(1.08);
}

/* Badge */
.premium-badge {
    position: absolute;
    bottom: 0;
    left: 0;
    background: #1a1a1a;
    color: #d4af37;
    padding: 5px 20px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

/* Body Content */
.premium-body {
    padding: 30px 20px;
}

.premium-body h3 {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    color: #222;
    margin-bottom: 15px;
}

.premium-divider {
    width: 40px;
    height: 2px;
    background: #d4af37;
    margin: 0 auto 15px;
}

.premium-body p {
    font-size: 14px;
    color: #777;
    line-height: 1.8;
    margin-bottom: 20px;
    height: 50px; /* កំណត់កម្ពស់អក្សរឱ្យស្មើគ្នា */
}

/* Price Styling */
.premium-price {
    font-size: 28px;
    font-weight: 500;
    color: #1a1a1a;
}

.premium-price .currency {
    font-size: 18px;
    vertical-align: top;
    margin-right: 2px;
    color: #d4af37;
}

.premium-price .per-night {
    font-size: 13px;
    color: #999;
    font-weight: 300;
}
</style>
<div class="our_room">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage text-center">
               <h2 class="premium-title">Our Rooms</h2>
               <p class="premium-subtitle">Indulge in the ultimate luxury experience with our premium accommodations.</p>
            </div>
         </div>
      </div>
      <div class="row">
         @foreach($rooms as $room)
         <div class="col-md-4 col-sm-6 mb-5">
            <a href="{{ url('room_detail', $room->id) }}" style="text-decoration: none; color: inherit;">
               <div class="premium-card">
                     <div class="premium-img-box">
                        <img src="{{ $room->image }}" alt="{{ $room->room_title }}">
                        <div class="premium-badge">{{ $room->room_type }}</div>
                     </div>
                     <div class="premium-body text-center">
                        <h3>{{ $room->room_title }}</h3>
                        <div class="premium-divider"></div>
                        <p>{{ Str::limit($room->description, 50) }}</p>
                        <div class="premium-price">
                           <span class="currency">$</span>{{ number_format($room->price) }}
                           <span class="per-night">/ night</span>
                        </div>
                     </div>
               </div>
            </a>
         </div>
         @endforeach
      </div>
   </div>
</div>