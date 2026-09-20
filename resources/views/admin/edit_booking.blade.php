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
                <h2 class="hs-title"><i class="fa fa-edit"></i>Update Booking #{{ $booking->id }}</h2>

                <div class="hs-card">
                    @if(session()->has('message'))
                        <div class="hs-alert hs-alert--success">{{ session('message') }}</div>
                    @endif
                    @if(session()->has('error'))
                        <div class="hs-alert hs-alert--danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ url('update_booking', $booking->id) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-bed"></i> Select Room</label>
                                <select name="room_id" class="hs-input" required>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                                            {{ $room->room_title }} (${{ $room->price }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-user"></i> Customer Name</label>
                                <input type="text" name="name" class="hs-input" value="{{ $booking->name }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-envelope"></i> Email Address</label>
                                <input type="email" name="email" class="hs-input" value="{{ $booking->email }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-phone"></i> Phone Number</label>
                                <input type="text" name="phone" class="hs-input" value="{{ $booking->phone }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-calendar"></i> Check-in Date</label>
                                <input type="date" name="startDate" class="hs-input" value="{{ \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-calendar-check-o"></i> Check-out Date</label>
                                <input type="date" name="endDate" class="hs-input" value="{{ \Carbon\Carbon::parse($booking->end_date)->format('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="hs-label"><i class="fa fa-info-circle"></i> Booking Status</label>
                                <select name="status" class="hs-input">
                                    @foreach(['waiting' => 'Waiting', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label)
                                        <option value="{{ $value }}" {{ $booking->status == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="hs-actions">
                            <button type="submit" class="hs-btn hs-btn--primary"><i class="fa fa-save"></i> Save Changes</button>
                            <a href="{{ url('view_bookings') }}" class="hs-btn hs-btn--secondary"><i class="fa fa-times-circle"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('admin.footer')
</body>
</html>