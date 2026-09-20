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
        <div class="hs-wrapper hs-wrapper--narrow">
            <div class="hs-card mt-4">
                <h1 class="hs-card__title h4">Add New Room</h1>

                @if(session('success'))
                    <div class="hs-alert hs-alert--success text-center">{{ session('success') }}</div>
                @endif

                <form action="{{ url('store_room') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="hs-label">Room Title</label>
                        <input type="text" name="room_title" class="hs-input" value="{{ old('room_title') }}" placeholder="e.g. Deluxe Ocean View">
                        @error('room_title') <span class="hs-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="hs-label">Description</label>
                        <textarea name="description" rows="3" class="hs-input" placeholder="Enter room details...">{{ old('description') }}</textarea>
                        @error('description') <span class="hs-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="hs-label">Price ($)</label>
                        <input type="number" name="price" class="hs-input" value="{{ old('price') }}" placeholder="Enter price">
                        @error('price') <span class="hs-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="hs-label">Room Type</label>
                        <select name="room_type" class="hs-input">
                            @foreach(['regular' => 'Regular', 'premium' => 'Premium', 'deluxe' => 'Deluxe'] as $value => $label)
                                <option value="{{ $value }}" {{ old('room_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="hs-label">Free Wi-Fi</label>
                        <select name="wifi" class="hs-input">
                            <option value="1" {{ old('wifi') === '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('wifi') === '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="hs-label">Room Image</label>
                        <input type="file" name="image" class="hs-input">
                        @error('image') <span class="hs-error">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="hs-btn hs-btn--primary hs-btn--block">Add Room</button>
                </form>
            </div>
        </div>

        @include('admin.footer')
</body>
</html>