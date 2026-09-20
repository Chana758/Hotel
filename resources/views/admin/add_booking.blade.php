<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    {{-- .page-content is closed by admin/footer.blade.php --}}
    <div class="page-content">
        <div class="container-fluid">
            <div class="hs-wrapper">
                <h2 class="hs-title"><i class="fa fa-plus-circle"></i>Walk-in Booking</h2>

                <div class="hs-card">
                    @if ($errors->any())
                        <div class="hs-alert hs-alert--danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fa fa-warning mr-2"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('save_booking') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-bed"></i> Select Room</label>
                                <select name="room_id" class="hs-input" required>
                                    <option value="">-- Choose Room --</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                            {{ $room->room_title }} (${{ $room->price }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-user"></i> Customer Name</label>
                                <input type="text" name="name" class="hs-input" value="{{ old('name') }}" placeholder="Full name" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-envelope"></i> Email Address</label>
                                <input type="email" name="email" class="hs-input" value="{{ old('email') }}" placeholder="Email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-phone"></i> Phone Number</label>
                                <input type="text" name="phone" class="hs-input" value="{{ old('phone') }}" placeholder="Phone" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-calendar"></i> Check-in Date</label>
                                <input type="date" name="startDate" class="hs-input" value="{{ old('startDate') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-calendar-check-o"></i> Check-out Date</label>
                                <input type="date" name="endDate" class="hs-input" value="{{ old('endDate') }}" required>
                            </div>
                        </div>

                        <div class="hs-actions">
                            <button type="submit" class="hs-btn hs-btn--primary"><i class="fa fa-check-circle"></i> Confirm Booking</button>
                            <a href="{{ url('view_bookings') }}" class="hs-btn hs-btn--secondary"><i class="fa fa-times-circle"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('admin.footer')
</body>
</html>