<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')

   <style type="text/css">
      .table_deg {
          border: 1px solid #444;
          margin: auto;
          width: 100%;
          text-align: center;
          margin-top: 20px;
          background-color: #22252a;
          border-collapse: collapse;
      }

      th {
          background-color: #DB6574;
          color: white;
          padding: 12px 5px;
          font-size: 11px;
          text-transform: uppercase;
          letter-spacing: 0.8px;
          border-bottom: 2px solid #34373d;
      }

      td {
          color: #dbdbdb;
          padding: 12px 4px;
          border-bottom: 1px solid #34373d;
          font-size: 11px;
          vertical-align: middle !important;
      }

      tr:hover {
          background-color: #2d3035;
      }

      .id-column {
          font-weight: bold;
          color: #DB6574;
          background: rgba(219, 101, 116, 0.1);
          border-radius: 4px;
          padding: 2px 8px;
      }

      .img_size {
          width: 65px;
          height: 40px;
          border-radius: 0px;
          object-fit: cover;
          display: block; 
          margin: auto;
          border: 1px solid #555;
          transition: transform 0.3s;
      }

      .customer-info b {
          font-size: 12px;
          color: #fff;
          display: block;
      }
      .customer-info small {
          font-size: 10px;
          color: #8a8d93;
          display: block;
      }

      .wifi-badge {
          font-size: 10px;
          padding: 2px 8px;
          border-radius: 4px;
          font-weight: bold;
      }
      .bg-yes { background-color: #28a745; color: white; }
      .bg-no { background-color: #dc3545; color: white; }

      .status-pill {
          padding: 4px 10px;
          border-radius: 50px;
          font-size: 9px;
          font-weight: bold;
          text-transform: uppercase;
      }

      /* រចនាប៊ូតុង Action ឱ្យនៅជិតគ្នា និងស្អាត */
      .btn_design {
          padding: 6px 10px;
          font-size: 12px;
          border-radius: 4px;
          color: white !important;
          transition: 0.3s;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          text-decoration: none !important;
      }
      .btn-danger { background-color: #dc3545; }
      .btn-danger:hover { background-color: #bd2130; box-shadow: 0 0 10px rgba(220, 53, 69, 0.5); }
      
      .btn-success { background-color: #28a745; }
      .btn-success:hover { background-color: #218838; box-shadow: 0 0 10px rgba(40, 167, 69, 0.5); }
      
      .action-gap {
          display: flex;
          justify-content: center;
          gap: 6px;
      }
   </style>
  </head>
  <body>
   @include('admin.header')
   @include('admin.sidebar')
   
   <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">
        
        {{-- Header ផ្នែកខាងលើ --}}
        <div class="card-header d-flex align-items-center justify-content-between" style="background-color: #2d3035; border: 1px solid #444; padding: 15px; border-radius: 5px; margin-top: 20px;">
            <h3 class="h4 mb-0" style="color: #DB6574; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                <i class="fa fa-calendar-check-o mr-2"></i> Booking Reservations
            </h3>
            <div>
                <a href="{{ route('export_pdf') }}" class="btn btn-sm" style="background: rgba(219, 101, 116, 0.1); color: #DB6574; border: 1px solid #DB6574; margin-right: 5px;">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </a>
                <a href="{{ route('add_booking') }}" class="btn btn-sm" style="background: #DB6574; color: white;">
                    <i class="fa fa-plus"></i> New Booking
                </a>
            </div>
        </div>

        {{-- តារាងបង្ហាញទិន្នន័យ --}}
        <div class="table-responsive"> 
           <table class="table_deg">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Booking Date</th>
                    <th>Customer Info</th>
                    <th>Room Title</th>
                    <th>Type</th>
                    <th>WiFi</th>
                    <th>Check In/Out</th>
                    <th>Nights</th>
                    <th>Price/Night</th>
                    <th>Total</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th style="width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    @php
                        $startDate = \Carbon\Carbon::parse($booking->start_date);
                        $endDate = \Carbon\Carbon::parse($booking->end_date);
                        $totalNights = $startDate->diffInDays($endDate) ?: 1; 
                        $pricePerNight = $booking->room->price ?? 0;
                        $totalPayment = $totalNights * $pricePerNight;
                    @endphp
                    <tr>
                        <td><span class="id-column">{{ $booking->id }}</span></td>
                        <td style="color: #8a8d93;">{{ $booking->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="customer-info">
                                <b>{{ $booking->name }}</b>
                                <small><i class="fa fa-envelope" style="color: #DB6574;"></i> {{ $booking->email }}</small>
                                <small><i class="fa fa-phone" style="color: #4CAF50;"></i> {{ $booking->phone }}</small>
                            </div>
                        </td>
                        <td style="font-weight: 500; color: #fff;">{{ $booking->room->room_title ?? 'N/A' }}</td>
                        <td>
                             <span style="color: skyblue;">{{ $booking->room->room_type ?? 'N/A' }}</span>
                        </td>
                        <td>
                            @if($booking->room && ($booking->room->wifi == 'yes' || $booking->room->wifi == '1'))
                                <span class="wifi-badge bg-yes">YES</span>
                            @else
                                <span class="wifi-badge bg-no">NO</span>
                            @endif
                        </td>
                        <td>
                            <div style="line-height: 1.4;">
                                <span style="color: #4CAF50; font-weight: bold;">{{ $booking->start_date }}</span><br>
                                <span style="color: #db6574; font-weight: bold;">{{ $booking->end_date }}</span>
                            </div>
                        </td>
                        <td style="color: #e9ecef;">{{ $totalNights }} <small>Nights</small></td>
                        <td style="color: #f8f9fa;">${{ number_format($pricePerNight, 0) }}</td>
                        <td style="color: #4CAF50; font-weight: bold; font-size: 13px;">
                            ${{ number_format($totalPayment, 2) }}
                        </td>
                        <td>
                            @if($booking->room && $booking->room->image)
                                <img src="{{ asset($booking->room->image) }}" class="img_size">
                            @else
                                <span style="font-size: 9px; color: #666;">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->status == 'waiting')
                                <span class="status-pill" style="background: rgba(255, 193, 7, 0.2); color: #ffc107;">Waiting</span>
                            @elseif($booking->status == 'approved')
                                <span class="status-pill" style="background: rgba(40, 167, 69, 0.2); color: #28a745;">Approved</span>
                            @else
                                <span class="status-pill" style="background: rgba(220, 53, 69, 0.2); color: #dc3545;">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-gap">
                                <a href="{{ route('edit_booking', $booking->id) }}" class="btn_design btn-success" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.delete_booking', $booking->id) }}" class="btn_design btn-danger" onclick="return confirm('Delete this booking?')" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
   </div>

    @include('admin.footer')
  </body>
</html>