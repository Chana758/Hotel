<!DOCTYPE html>
<html lang="en">
  <head> 
   @include('admin.css')
   <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

   <style type="text/css">
      body {
          font-family: 'Plus Jakarta Sans', sans-serif;
          background-color: #0b0e11;
          color: #e0e0e0;
      }

      .page-content { padding-top: 20px; }

      /* 1. Statistics Cards with 4 Columns now */
      .stats-container {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
          gap: 20px;
          margin-bottom: 35px;
      }

      .stat-card {
          background: #16191d;
          padding: 22px;
          border-radius: 20px;
          border: 1px solid #25282c;
          position: relative;
          overflow: hidden;
          transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      }

      .stat-card:hover {
          transform: translateY(-8px);
          box-shadow: 0 10px 30px rgba(0,0,0,0.4);
      }

      .stat-card::after {
          content: "";
          position: absolute;
          top: 0; left: 0; width: 4px; height: 100%;
          background: #DB6574;
      }

      /* Color Themes for each card */
      .stat-card.total::after { background: #DB6574; }
      .stat-card.premium::after { background: #63d2ff; }
      .stat-card.deluxe::after { background: #f1c40f; } /* Gold color for Deluxe */
      .stat-card.regular::after { background: #4CAF50; }

      /* Hover Border Colors */
      .stat-card.total:hover { border-color: #DB6574; }
      .stat-card.premium:hover { border-color: #63d2ff; }
      .stat-card.deluxe:hover { border-color: #f1c40f; }
      .stat-card.regular:hover { border-color: #4CAF50; }

      .stat-label {
          color: #8a8d93;
          font-size: 11px;
          text-transform: uppercase;
          font-weight: 700;
          letter-spacing: 1px;
      }

      .stat-value {
          font-size: 22px;
          font-weight: 800;
          margin-top: 5px;
          color: #fff;
      }

      /* 2. Section Header */
      .inventory-header {
          margin-bottom: 25px;
          border-left: 4px solid #DB6574;
          padding-left: 15px;
      }

      .inventory-header h2 {
          font-weight: 800;
          font-size: 22px;
          color: #fff;
          margin: 0;
      }

      /* 3. Table UI */
      .table_container {
          background: #16191d;
          border-radius: 20px;
          border: 1px solid #25282c;
          overflow: hidden;
      }

      .table_deg {
          width: 100%;
          border-collapse: collapse;
      }

      .table_deg thead th {
          background: #1c2025;
          color: #DB6574;
          font-size: 11px;
          text-transform: uppercase;
          font-weight: 800;
          padding: 20px;
          text-align: center;
          border-bottom: 2px solid #25282c;
      }

      .table_deg tbody td {
          padding: 18px 15px;
          border-bottom: 1px solid #25282c;
          vertical-align: middle;
          text-align: center;
      }
      .id-badge {
            background: rgba(219, 101, 116, 0.1); /* ពណ៌ផ្កាឈូកស្រាល */
            color: #65bedb; /* ពណ៌អក្សរដូច Header */
            padding: 4px 10px;
            border-radius: 6px;
            font-family: 'Courier New', monospace; /* ប្រើ Font បែបលេខកូដ */
            font-weight: 800;
            font-size: 12px;
            border: 1px solid rgba(219, 101, 116, 0.2);
        }
      .room-title { 
        font-weight: 700; 
        color: #2ddb36; 
        font-size: 14px; }
      .room-desc-text { 
          font-size: 12px; 
          color: #e7df50; 
          line-height: 1.5;
          max-width: 300px;
          text-align: left;
          display: block;
      }

      .price-text { color: #4CAF50; font-weight: 800; font-size: 15px; }
      
      /* Badges for Room Types */
      .type-badge {
          padding: 4px 10px;
          border-radius: 6px;
          font-size: 10px;
          font-weight: 800;
          text-transform: uppercase;
      }
      .badge-premium { background: rgba(99, 210, 255, 0.1); color: #63d2ff; }
      .badge-deluxe { background: rgba(241, 196, 15, 0.1); color: #f1c40f; }
      .badge-regular { background: rgba(76, 175, 80, 0.1); color: #4CAF50; }

      .wifi-badge { font-size: 10px; font-weight: 900; padding: 3px 8px; border-radius: 4px; }
      .wifi-yes { color: #4CAF50; background: rgba(76, 175, 80, 0.15); }
      .wifi-no { color: #DB6574; background: rgba(219, 101, 116, 0.15); }

      .img_preview {
          width: 85px; 
          height: 50px; 
          object-fit: cover;
          border-radius: 3px; 
          border: 1px solid #34373d;
      }

      /* 4. Action Buttons */
      .action-wrapper { display: flex; gap: 8px; justify-content: center; align-items: center; }
      .btn-modern {
          padding: 8px 14px; font-size: 10px; font-weight: 800;
          text-transform: uppercase; border-radius: 6px;
          transition: 0.3s; cursor: pointer; text-decoration: none !important;
          border: 1px solid transparent;
      }
      .btn-edit-text { 
        color: #63d2ff !important; 
        background: rgba(99, 210, 255, 0.1); 
        border-color: rgba(99, 210, 255, 0.2); }
      .btn-edit-text:hover { 
        background: #63d2ff; 
        color: #121418 !important; }
      .btn-delete-text { color: #DB6574 !important; background: rgba(219, 101, 116, 0.1); border-color: rgba(219, 101, 116, 0.2); }
      .btn-delete-text:hover { background: #DB6574; color: #fff !important; }

   </style>
  </head>
  <body>
   @include('admin.header')
   @include('admin.sidebar')
   
   <div class="page-content">
    <div class="container-fluid">
      
      <div class="stats-container">
          <div class="stat-card total">
              <div class="stat-label">Total Rooms</div>
              <div class="stat-value">{{ $select_room->count() }} Units</div>
          </div>
          <div class="stat-card premium">
              <div class="stat-label">Premium Suites</div>
              <div class="stat-value" style="color: #63d2ff;">{{ $select_room->where('room_type', 'premium')->count() }} Units</div>
          </div>
          <div class="stat-card deluxe">
              <div class="stat-label">Deluxe Rooms</div>
              <div class="stat-value" style="color: #f1c40f;">{{ $select_room->where('room_type', 'deluxe')->count() }} Units</div>
          </div>
          <div class="stat-card regular">
              <div class="stat-label">Regular Rooms</div>
              <div class="stat-value" style="color: #4CAF50;">{{ $select_room->where('room_type', 'regular')->count() }} Units</div>
          </div>
      </div>

      <div class="inventory-header">
          <h2>ROOM MANAGEMENT SYSTEM</h2>
      </div>

      <div class="table_container">
          <div class="table-responsive"> 
              <table class="table_deg">
                  <thead>
                      <tr>
                          <th>#ID</th>
                          <th>Room Title</th>
                          <th>Description</th>
                          <th>Price</th>
                          <th>Category</th>
                          <th>WiFi</th>
                          <th>Preview</th>
                          <th>Management</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($select_room as $room)
                      <tr>
                          <td><span class="id-badge">#{{ $room->id }}</span></td>
                          <td><span class="room-title">{{ $room->room_title }}</span></td>
                          <td><span class="room-desc-text">{{ Str::limit($room->description, 60) }}</span></td>
                          <td><span class="price-text">${{ number_format($room->price) }}</span></td>
                          <td>
                              <span class="type-badge 
                                {{ $room->room_type == 'premium' ? 'badge-premium' : '' }}
                                {{ $room->room_type == 'deluxe' ? 'badge-deluxe' : '' }}
                                {{ $room->room_type == 'regular' ? 'badge-regular' : '' }}">
                                {{ $room->room_type }}
                              </span>
                          </td>
                          <td>
                              @if($room->wifi == 'yes' || $room->wifi == 1)  
                                  <span class="wifi-badge wifi-yes">YES</span>
                              @else
                                  <span class="wifi-badge wifi-no">NO</span>
                              @endif
                          </td>
                          <td><img class="img_preview" src="{{ asset($room->image) }}" alt="Room"></td>
                          <td>
                              <div class="action-wrapper">
                                  <a class="btn-modern btn-edit-text" href="{{ url('edit_room', $room->id) }}">Edit</a>
                                  <form action="{{ url('delete_room', $room->id) }}" method="POST" style="margin: 0;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn-modern btn-delete-text" onclick="return confirm('Confirm deletion?')">Delete</button>
                                  </form>
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