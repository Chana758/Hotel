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

            <div class="hs-header-bar">
                <h3 class="hs-title"><i class="fa fa-calendar-check-o"></i>Booking Reservations</h3>
                <div>
                    <a href="{{ route('export_pdf') }}" class="hs-btn hs-btn--sm hs-btn--outline"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
                    <a href="{{ route('add_booking') }}" class="hs-btn hs-btn--sm hs-btn--primary"><i class="fa fa-plus"></i> New Booking</a>
                </div>
            </div>

            <div class="hs-table-box">
                <div class="table-responsive">
                    <table class="hs-table">
                        <thead>
                            <tr>
                                <th>#ID</th><th>Booked On</th><th>Customer</th><th>Room</th><th>Type</th><th>WiFi</th>
                                <th>Check In / Out</th><th>Nights</th><th>Price / Night</th><th>Total</th><th>Image</th><th>Status</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                @php
                                    $nights   = max(1, (int) \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)));
                                    $price    = $booking->room->price ?? 0;
                                    $statuses = ['waiting' => 'warning', 'approved' => 'success', 'rejected' => 'danger'];
                                @endphp
                                <tr>
                                    <td><span class="hs-id">{{ $booking->id }}</span></td>
                                    <td style="color:var(--hs-muted);">{{ $booking->created_at->format('d M Y') }}</td>
                                    <td class="text-left hs-customer">
                                        <b>{{ $booking->name }}</b>
                                        <small><i class="fa fa-envelope" style="color:var(--hs-accent);"></i> {{ $booking->email }}</small>
                                        <small><i class="fa fa-phone" style="color:#4CAF50;"></i> {{ $booking->phone }}</small>
                                    </td>
                                    <td class="text-white">{{ $booking->room->room_title ?? 'N/A' }}</td>
                                    <td style="color:skyblue;">{{ $booking->room->room_type ?? 'N/A' }}</td>
                                    <td>
                                        @if($booking->room && in_array($booking->room->wifi, ['yes', '1', 1], true))
                                            <span class="hs-pill hs-pill--success">Yes</span>
                                        @else
                                            <span class="hs-pill hs-pill--danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span style="color:#4CAF50;font-weight:700;">{{ $booking->start_date }}</span><br>
                                        <span style="color:var(--hs-accent);font-weight:700;">{{ $booking->end_date }}</span>
                                    </td>
                                    <td>{{ $nights }}</td>
                                    <td>${{ number_format($price) }}</td>
                                    <td style="color:#4CAF50;font-weight:700;font-size:13px;">${{ number_format($nights * $price, 2) }}</td>
                                    <td>
                                        @if($booking->room && $booking->room->image)
                                            <img src="{{ asset($booking->room->image) }}" class="hs-thumb" alt="Room">
                                        @else
                                            <span style="color:#666;">N/A</span>
                                        @endif
                                    </td>
                                    <td><span class="hs-pill hs-pill--{{ $statuses[$booking->status] ?? 'danger' }}">{{ ucfirst($booking->status) }}</span></td>
                                    <td>
                                        <div class="hs-row-actions">
                                            <a href="{{ route('edit_booking', $booking->id) }}" class="hs-btn hs-btn--sm hs-btn--success" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.delete_booking', $booking->id) }}" class="hs-btn hs-btn--sm hs-btn--danger"
                                               onclick="return confirm('Delete this booking?')" title="Delete"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('admin.footer')
</body>
</html>