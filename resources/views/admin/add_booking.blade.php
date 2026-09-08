<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        /* បង្រួមទំហំ Form ឱ្យនៅចំកណ្តាល និងមិនឱ្យរីកធំពេក */
        .form-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }

        .form-container { 
            background: #2d3035; 
            padding: 30px; 
            border-radius: 12px; 
            border: 1px solid #444; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }

        /* រចនា Label និង Icon ពណ៌សឱ្យដាច់ពីគ្នាស្អាត */
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
            color: #ffffff; /* Icon ពណ៌ស */
            margin-right: 10px;
            font-size: 14px;
            background: #DB6574; /* ដាក់ Background ពណ៌ផ្កាឈូកឱ្យ Icon */
            padding: 6px;
            border-radius: 5px;
            width: 28px;
            height: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-control { 
            background: #22252a !important; 
            border: 1px solid #444 !important; 
            color: #ffffff !important; 
            padding: 10px 15px;
            border-radius: 6px;
            margin-top: 5px;
        }

        .form-control:focus { 
            border-color: #DB6574 !important; 
            box-shadow: 0 0 5px rgba(219, 101, 116, 0.2) !important;
        }

        /* រៀបចំប៊ូតុងឱ្យនៅខាងឆ្វេង និងជិតគ្នា */
        .button-group {
            margin-top: 30px;
            display: flex;
            gap: 10px; /* គម្លាតរវាងប៊ូតុង */
        }

        .btn-confirm {
            background: #DB6574; 
            color: white; 
            border: none;
            padding: 10px 25px;
            font-weight: bold;
            border-radius: 5px;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        .btn-confirm:hover {
            background: #b04d5a;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #444;
            color: #ccc;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-cancel:hover {
            background: #555;
            color: white;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
    <div class="page-content">
      <div class="container-fluid">
        
        <div class="form-wrapper">
            <div class="d-flex align-items-center mb-4 mt-3">
                <h2 class="h5" style="color: #DB6574; font-weight: bold; text-transform: uppercase;">
                    <i class="fa fa-plus-circle mr-2"></i> Walk-in Booking
                </h2>
            </div>
            
            <div class="form-container">
              @if ($errors->any())
                  <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.1); border: none; color: #ff6b6b; font-size: 13px;">
                      <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                              <li><i class="fa fa-warning mr-2"></i> {{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

              <form action="{{ route('save_booking') }}" method="Post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-bed"></i> Select Room</label>
                        <select name="room_id" class="form-control" required>
                            <option value="">-- Choose Room --</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_title }} (${{ $room->price }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-user"></i> Customer Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Full Name" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-envelope"></i> Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-phone"></i> Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Phone" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-calendar"></i> Check-in Date</label>
                        <input type="date" name="startDate" class="form-control" value="{{ old('startDate') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><i class="fa fa-calendar-check-o"></i> Check-out Date</label>
                        <input type="date" name="endDate" class="form-control" value="{{ old('endDate') }}" required>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-confirm">
                        <i class="fa fa-check-circle mr-2"></i> Confirm Booking
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-cancel d-flex align-items-center">
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