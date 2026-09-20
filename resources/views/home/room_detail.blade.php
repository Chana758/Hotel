<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->room_title }} | {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .detail-container { margin: 50px 0; background: #fff; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,.05); }
        .room-title { font-family: 'Playfair Display', serif; font-size: 3rem; color: #1a1a1a; }
        .room-price { font-size: 1.5rem; color: #d4af37; font-weight: 600; }
        .room-type { text-transform: uppercase; letter-spacing: 2px; color: #888; font-size: .9rem; }
        .room-image { width: 100%; object-fit: cover; max-height: 500px; }
        .description { line-height: 1.8; color: #555; margin-top: 20px; }
        .btn-book { background: #1a1a1a; color: #d4af37; border: none; padding: 12px 30px; border-radius: 0; transition: .3s; }
        .btn-book:hover { background: #d4af37; color: #1a1a1a; }
        .modal-content { border-radius: 0; border: none; }
        .form-control { border-radius: 0; padding: 12px; border: 1px solid #eee; }
        .form-control:focus { box-shadow: none; border-color: #d4af37; }
    </style>
</head>
<body>

<div class="container">

    {{-- Flash messages --}}
    @foreach(['message' => 'success', 'error' => 'danger'] as $key => $type)
        @if(session()->has($key))
            <div class="alert alert-{{ $type }} alert-dismissible fade show mt-3 flash-alert" role="alert">
                <i class="fa-solid {{ $type === 'success' ? 'fa-circle-check' : 'fa-triangle-exclamation' }} me-2"></i>{{ session($key) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach

    <div class="detail-container">
        <div class="row">
            <div class="col-md-7">
                <img src="{{ asset($room->image) }}" class="room-image" alt="{{ $room->room_title }}">
            </div>

            <div class="col-md-5">
                <div class="ps-md-4">
                    <span class="room-type">{{ $room->room_type }}</span>
                    <h1 class="room-title mb-3">{{ $room->room_title }}</h1>
                    <div class="room-price mb-4">
                        ${{ number_format($room->price) }}
                        <span class="text-muted" style="font-size:1rem;font-weight:300;">/ per night</span>
                    </div>

                    <hr>
                    <p class="description">{{ $room->description }}</p>

                    <div class="mt-5">
                        <h5 class="mb-3">Amenities</h5>
                        <ul class="list-unstyled d-flex gap-3 text-muted">
                            @if(in_array($room->wifi, ['yes', '1', 1], true))
                                <li><i class="fa-solid fa-wifi"></i> Free WiFi</li>
                            @endif
                            <li><i class="fa-solid fa-tv"></i> Smart TV</li>
                            <li><i class="fa-solid fa-wind"></i> AC</li>
                        </ul>
                    </div>

                    <div class="mt-5">
                        <button type="button" class="btn btn-book w-100" data-bs-toggle="modal" data-bs-target="#bookingModal">
                            BOOK THIS ROOM NOW
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mb-5">
        <a href="{{ url('our_rooms') }}" class="text-muted text-decoration-none">&larr; Back to all rooms</a>
    </div>
</div>

{{-- Booking modal --}}
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="bookingModalLabel" style="font-family:'Playfair Display',serif;">Book This Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger p-2">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('add_booking', $room->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" placeholder="Enter your name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" placeholder="Enter your email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Phone Number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', Auth::check() ? Auth::user()->phone : '') }}" placeholder="012 345 678">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Start Date</label>
                            <input type="date" name="startDate" id="startDate" class="form-control @error('startDate') is-invalid @enderror" value="{{ old('startDate') }}">
                            @error('startDate') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">End Date</label>
                            <input type="date" name="endDate" id="endDate" class="form-control @error('endDate') is-invalid @enderror" value="{{ old('endDate') }}">
                            @error('endDate') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-book w-100 mt-3 py-3">CONFIRM BOOKING</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // 1. Fade out flash messages after 5 seconds
    setTimeout(function () {
        document.querySelectorAll('.flash-alert').forEach(function (el) {
            el.style.transition = 'opacity .5s ease';
            el.style.opacity = '0';
            setTimeout(function () { el.remove(); }, 500);
        });
    }, 5000);

    // 2. Block past dates
    var today = new Date().toISOString().split('T')[0];
    var startInput = document.getElementById('startDate');
    var endInput = document.getElementById('endDate');
    startInput.min = today;
    endInput.min = today;

    // 3. End date can never be before start date
    startInput.addEventListener('change', function () { endInput.min = this.value; });

    // 4. Re-open the modal when validation failed so the errors are visible
    @if ($errors->any())
        new bootstrap.Modal(document.getElementById('bookingModal')).show();
    @endif
</script>
</body>
</html>