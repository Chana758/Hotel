<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')

   <style type="text/css">
    /* រៀបចំ Container ឱ្យនៅចំកណ្តាល */
    .form_container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 0;
    }

    /* រចនាកាតព័ទ្ធជុំវិញ Form */
    .card_design {
        background-color: #2d3035;
        border-radius: 12px;
        padding: 40px;
        width: 100%;
        max-width: 600px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    }

    .card_design h1 {
        font-size: 24px;
        color: #ffffff;
        margin-bottom: 30px;
        text-align: center;
        border-bottom: 1px solid #444;
        padding-bottom: 15px;
    }

    .div_deg {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    label {
        color: #d1d1d1;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 500;
    }

    /* រចនា Input ឱ្យស្របតាម Admin Template */
    input[type='text'], input[type='number'], textarea, select {
        background-color: #34373d !important;
        border: 1px solid #4b4f56 !important;
        border-radius: 6px !important;
        padding: 12px !important;
        color: #fff !important;
        width: 100%;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #db6574 !important;
        outline: none;
        box-shadow: 0 0 5px rgba(219, 101, 116, 0.3);
    }

    /* ប៊ូតុង Update */
    .btn_submit {
        background-color: #db6574;
        color: white;
        border: none;
        padding: 14px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
        transition: 0.3s;
    }

    .btn_submit:hover {
        background-color: #b54d5a;
        transform: translateY(-2px);
    }

    .current_img {
        margin: 10px 0;
        border-radius: 8px;
        border: 1px solid #444;
    }

    .error_msg {
        color: #db6574;
        font-size: 13px;
        margin-top: 5px;
    }
   </style>
  </head>
  <body>
   @include('admin.header')
   @include('admin.sidebar')

   <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">

        <div class="form_container">
            <div class="card_design">
                <h1>Update Room</h1>

                <form action="{{ url('update_room', $room->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="div_deg">
                        <label>Room Title</label>
                        <input type="text" name="room_title" value="{{ old('room_title', $room->room_title) }}">
                        @error('room_title') <span class="error_msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="div_deg">
                        <label>Description</label>
                        <textarea name="description" rows="4">{{ old('description', $room->description) }}</textarea>
                        @error('description') <span class="error_msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="div_deg">
                        <label>Price ($)</label>
                        <input type="number" name="price" value="{{ old('price', $room->price) }}">
                        @error('price') <span class="error_msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="div_deg">
                        <label>Room Type</label>
                        <select name="room_type">
                            <option value="regular" {{ old('room_type', $room->room_type) == 'regular' ? 'selected' : '' }}>Regular</option>
                            <option value="premium" {{ old('room_type', $room->room_type) == 'premium' ? 'selected' : '' }}>Premium</option>
                            <option value="deluxe" {{ old('room_type', $room->room_type) == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                        </select>
                    </div>

                    <div class="div_deg">
                        <label>Free Wi-Fi</label>
                        <select name="wifi">
                            <option value="1" {{ old('wifi', $room->wifi) == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('wifi', $room->wifi) == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="div_deg">
                        <label>Current Image</label>
                        <img class="current_img" width="120" src="{{ asset($room->image) }}">
                    </div>

                    <div class="div_deg">
                        <label>Upload New Image (Optional)</label>
                        <input type="file" name="image">
                        @error('image') <span class="error_msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="div_deg">
                        <input class="btn_submit" type="submit" value="Update Room">
                    </div>
                </form>
            </div>
        </div>

      </div>
    </div>
   </div>

   @include('admin.footer')
  </body>
</html>