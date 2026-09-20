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

            {{-- Summary cards --}}
            <div class="hs-stat-grid">
                <div class="hs-stat" style="--c:var(--hs-accent);">
                    <div class="hs-stat__label">Total Rooms</div>
                    <div class="hs-stat__value" style="color:#fff;">{{ $select_room->count() }} Units</div>
                </div>
                <div class="hs-stat" style="--c:#63d2ff;">
                    <div class="hs-stat__label">Premium Suites</div>
                    <div class="hs-stat__value">{{ $select_room->where('room_type', 'premium')->count() }} Units</div>
                </div>
                <div class="hs-stat" style="--c:#f1c40f;">
                    <div class="hs-stat__label">Deluxe Rooms</div>
                    <div class="hs-stat__value">{{ $select_room->where('room_type', 'deluxe')->count() }} Units</div>
                </div>
                <div class="hs-stat" style="--c:#4CAF50;">
                    <div class="hs-stat__label">Regular Rooms</div>
                    <div class="hs-stat__value">{{ $select_room->where('room_type', 'regular')->count() }} Units</div>
                </div>
            </div>

            <h2 class="hs-title" style="border-left:4px solid var(--hs-accent);padding-left:15px;">Room Management</h2>

            <div class="hs-table-box">
                <div class="table-responsive">
                    <table class="hs-table">
                        <thead>
                            <tr><th>#ID</th><th>Room Title</th><th>Description</th><th>Price</th><th>Category</th><th>WiFi</th><th>Preview</th><th>Manage</th></tr>
                        </thead>
                        <tbody>
                            @foreach($select_room as $room)
                                <tr>
                                    <td><span class="hs-id">#{{ $room->id }}</span></td>
                                    <td class="text-white font-weight-bold">{{ $room->room_title }}</td>
                                    <td class="text-left" style="max-width:300px;color:var(--hs-muted);">{{ Str::limit($room->description, 60) }}</td>
                                    <td style="color:#4CAF50;font-weight:800;">${{ number_format($room->price) }}</td>
                                    <td><span class="hs-pill hs-pill--{{ $room->room_type }}">{{ $room->room_type }}</span></td>
                                    <td>
                                        @if(in_array($room->wifi, ['yes', '1', 1], true))
                                            <span class="hs-pill hs-pill--success">Yes</span>
                                        @else
                                            <span class="hs-pill hs-pill--danger">No</span>
                                        @endif
                                    </td>
                                    <td><img src="{{ asset($room->image) }}" class="hs-thumb" alt="{{ $room->room_title }}"></td>
                                    <td>
                                        <div class="hs-row-actions">
                                            <a href="{{ url('edit_room', $room->id) }}" class="hs-btn hs-btn--sm hs-btn--info">Edit</a>
                                            <form action="{{ url('delete_room', $room->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hs-btn hs-btn--sm hs-btn--danger" onclick="return confirm('Delete this room?')">Delete</button>
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

        @include('admin.footer')
</body>
</html>