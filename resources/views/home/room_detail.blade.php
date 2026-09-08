<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $room->room_title }} - Details</title>
    {{-- ផ្នែក Stylesheet (CSS Links) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* ការកំណត់ស្ទីលទូទៅនៃទំព័រ */
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .detail-container { 
            margin-top: 50px; 
            margin-bottom: 50px; 
            background: #fff; 
            padding: 30px; 
            border-radius: 0px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        }
        .room-title { 
            font-family: 'Playfair Display', serif; 
            font-size: 3rem; 
            color: #1a1a1a; 
        }
        .room-price { 
            font-size: 1.5rem; 
            color: #d4af37; 
            font-weight: 600; 
        }
        .room-type { 
            text-transform: uppercase; 
            letter-spacing: 2px; 
            color: #888; 
            font-size: 0.9rem; 
        }
        .room-image { 
            width: 100%; 
            border-radius: 0px; 
            object-fit: cover; 
            max-height: 500px; 
        }
        .description { 
            line-height: 1.8; 
            color: #555; 
            margin-top: 20px; 
        }
        .btn-book { 
            background-color: #1a1a1a; 
            color: #d4af37; 
            border: none; 
            padding: 12px 30px; 
            border-radius: 0; 
            transition: 0.3s;
         }
        .btn-book:hover {
             background-color: #d4af37; 
             color: #1a1a1a; 
        }
        /* Custom Modal Style - កែស្ទីលផ្ទាំង Booking */
        .modal-content { border-radius: 0; border: none; }
        .form-control { border-radius: 0; padding: 12px; border: 1px solid #eee; }
        .form-control:focus { box-shadow: none; border-color: #d4af37; }
    </style>
</head>
<body>

    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
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
                            ${{ number_format($room->price) }} <span class="text-muted" style="font-size: 1rem; font-weight: 300;">/ Per Night</span>
                        </div>
                        
                        <hr>
                        
                        <p class="description">
                            {{ $room->description }}
                        </p>

                        <div class="mt-5">
                            <h5 class="mb-3">Amenities:</h5>
                            <ul class="list-unstyled d-flex gap-3 text-muted">
                                <li><i class="fa-solid fa-wifi"></i> Free WiFi</li>
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
        
        <div class="text-center">
            <a href="{{ url('/') }}" class="text-muted text-decoration-none">← Back to all rooms</a>
        </div>
    </div>

   <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="bookingModalLabel" style="font-family: 'Playfair Display', serif;">Book This Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                
                @if ($errors->any())
                    <div class="alert alert-danger p-2">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('add_booking', $room->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" placeholder="Enter your name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
 
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Phone Number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                        value="{{ old('phone', Auth::check() ? Auth::user()->phone : '') }}" 
                        placeholder="012 345 678">
                        
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Start Date</label>
                            <input type="date" name="startDate" id="startDate" class="form-control @error('startDate') is-invalid @enderror" 
                            value="{{ old('startDate') }}">
                            @error('startDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">End Date</label>
                            <input type="date" name="endDate" id="endDate" class="form-control @error('endDate') is-invalid @enderror" 
                                value="{{ old('endDate') }}">
                            @error('endDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-book w-100 mt-3 py-3">CONFIRM BOOKING</button>
                </form>
            </div>
        </div>
    </div>
   </div>
   {{-- ផ្នែក Script (JavaScript Links) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ១. កូដសម្រាប់បិទសារ Success ឬ Error ដោយស្វ័យប្រវត្តិក្រោយ ៥ វិនាទី
        setTimeout(function() {
            let alert = document.querySelector('.alert');
            if(alert) {
                // បន្ថែម Effect រលាយបន្តិចមុននឹងលុបចេញ
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000); 

        // ២. ការពារកុំឱ្យគេរើសថ្ងៃថយក្រោយ (ថ្ងៃកន្លងផុតទៅ)
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('startDate').setAttribute('min', today);
        document.getElementById('endDate').setAttribute('min', today);

        // ៣. កំណត់ឱ្យ End Date ត្រូវតែធំជាង Start Date
        document.getElementById('startDate').addEventListener('change', function() {
            var start = this.value;
            document.getElementById('endDate').setAttribute('min', start);
        });
    </script>
</body>
</html>