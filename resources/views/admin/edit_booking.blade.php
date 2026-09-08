<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        .form-wrapper { max-width: 900px; margin: 0 auto; }
        .form-container { background: #2d3035; padding: 30px; border-radius: 12px; border: 1px solid #444; }
        
        label { 
            color: #DB6574; 
            margin-top: 10px; 
            font-weight: 700; 
            font-size: 11px; 
            text-transform: uppercase; 
            display: flex; 
            align-items: center; 
        }
        
        label i { 
            color: #ffffff; 
            margin-right: 10px; 
            font-size: 14px; 
            background: #DB6574; 
            padding: 6px; 
            border-radius: 5px; 
            width: 28px; height: 28px; 
            display: flex; justify-content: center; align-items: center; 
        }
        
        .form-control { 
            background: #22252a !important; 
            border: 1px solid #444 !important; 
            color: #ffffff !important; 
            padding: 10px 15px; 
            border-radius: 6px; 
            margin-top: 5px; 
        }
        
        .button-group { margin-top: 30px; display: flex; gap: 10px; }
        
        /* ប៊ូតុង Save Changes ពណ៌ផ្កាឈូកតាមរូប */
        .btn-update { 
            background: #DB6574; 
            color: white; 
            border: none; 
            padding: 12px 25px; 
            font-weight: bold; 
            border-radius: 5px; 
            cursor: pointer; 
            display: flex;
            align-items: center;
        }
        
        /* ប៊ូតុង Cancel ពណ៌ប្រផេះតាមរូប */
        .btn-cancel { 
            background: #444; 
            color: #ccc; 
            border: none; 
            padding: 12px 25px; 
            border-radius: 5px; 
            text-decoration: none; 
            display: flex;
            align-items: center;
        }
        
        .btn-update:hover { background: #c55664; color: #fff; }
        .btn-cancel:hover { background: #555; color: #fff; }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
    <div class="page-content">
      <div class="container-fluid">
        <div class="form-wrapper">
            <h2 class="h5 mb-4 mt-3" style="color: #DB6574; font-weight: bold; text-transform: uppercase;">
                <i class="fa fa-edit mr-2"></i> Update Booking Details #{{ $booking->id }}
            </h2>
            
            <div class="form-container">
              <!-- បង្ហាញ Message ជោគជ័យ ឬ ជួបបញ្ហា -->
              @if(session()->has('message'))
                  <div class="alert alert-success" style="color: #4cd137; background: rgba(76, 209, 55, 0.1); border: none; margin-bottom: 20px;">
                      {{ session()->get('message') }}
                  </div>
              @endif

              @if(session()->has('error'))
                  <div class="alert alert-danger" style="color: #ff6b6b; background: rgba(220, 53, 69, 0.1); border: none; margin-bottom: 20px;">
                      {{ session()->get('error') }}
                  </div>
              @endif

              <form action="{{ url('update_booking', $booking->id) }}" method="Post">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-bed"></i> Select Room</label>
                        <select name="room_id" class="form-control" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_title }} (${{ $room->price }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-user"></i> Customer Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $booking->name }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-envelope"></i> Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ $booking->email }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-phone"></i> Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ $booking->phone }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-calendar"></i> Check-in Date</label>
                        <input type="date" name="startDate" class="form-control" value="{{ $booking->start_date }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-calendar-check-o"></i> Check-out Date</label>
                        <input type="date" name="endDate" class="form-control" value="{{ $booking->end_date }}" required>
                    </div>
                </div>

                <!-- ផ្នែកជ្រើសរើស Status (តាមសំណូមពររបស់ប្អូន) -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-info-circle"></i> Booking Status</label>
                        <select name="status" class="form-control" style="cursor: pointer;">
                            <option value="waiting" {{ $booking->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                            <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-update">
                        <i class="fa fa-save mr-2"></i> Save Changes
                    </button>
                    <a href="{{ url('view_bookings') }}" class="btn-cancel">
                        <i class="fa fa-times-circle mr-2"></i> Cancel
                    </a>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    @include('admin.footer')
  </body>
</html>