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
            <h2 class="hs-title"><i class="fa fa-plus-circle"></i>Add New Image to Gallery</h2>

            <div class="hs-card">
                @if(session()->has('message'))
                    <div class="hs-alert hs-alert--success">{{ session('message') }}</div>
                @endif

                <form action="{{ route('upload_gallery') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="hs-label"><i class="fa fa-image"></i> Upload Image</label>
                    <input type="file" name="image" class="hs-input" required>
                    <small class="text-muted d-block mt-2">Recommended size: 800x600px (JPG, PNG, WebP)</small>

                    <div class="hs-actions">
                        <button type="submit" class="hs-btn hs-btn--primary"><i class="fa fa-upload"></i> Add to Gallery</button>
                    </div>
                </form>
            </div>
        </div>

        @include('admin.footer')
</body>
</html>