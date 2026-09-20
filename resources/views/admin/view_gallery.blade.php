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
        <div class="hs-wrapper" style="max-width:1100px;">

            {{-- Floating success message (auto-hides) --}}
            @if(session()->has('message'))
                <div class="hs-toast" id="toastBox">
                    <i class="fa fa-check-circle" style="font-size:22px;"></i>
                    <span>{{ session('message') }}</span>
                </div>
            @endif

            {{-- Upload --}}
            <div class="hs-card">
                <h2 class="hs-title mt-0"><i class="fa fa-cloud-upload"></i>Gallery Management</h2>
                <form action="{{ route('upload_gallery') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="hs-upload">
                        <label for="image-input" class="hs-upload__box">
                            <i class="fa fa-cloud-upload" id="upload-icon" style="font-size:24px;color:var(--hs-accent);"></i>
                            <img id="preview-img" src="#" alt="Preview">
                            <span id="file-name">Choose an image to upload...</span>
                            <input type="file" name="image" id="image-input" hidden onchange="previewImage(this)">
                        </label>
                        <button type="submit" class="hs-btn hs-btn--primary"><i class="fa fa-paper-plane"></i> Upload</button>
                    </div>
                </form>
            </div>

            {{-- Existing images --}}
            <div class="hs-card">
                <h2 class="hs-title mt-0"><i class="fa fa-image"></i>Existing Gallery</h2>
                <div class="hs-grid">
                    @forelse($gallery as $item)
                        <div class="hs-grid__item">
                            <img src="{{ asset('gallery/' . $item->image) }}" alt="Gallery image">
                            <a href="{{ route('delete_gallery', $item->id) }}" class="hs-grid__delete"
                               onclick="return confirm('Delete this image?')"><i class="fa fa-trash"></i></a>
                        </div>
                    @empty
                        <div style="grid-column:1/-1;text-align:center;padding:60px;color:#555;border:2px dashed #3e4147;border-radius:20px;">
                            <i class="fa fa-image mb-3" style="font-size:45px;opacity:.2;"></i>
                            <p class="mb-0">No images yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        @include('admin.footer')

        <script>
            // Show a thumbnail + file name after choosing a file
            function previewImage(input) {
                if (!input.files || !input.files[0]) return;
                var reader = new FileReader();
                reader.onload = function (e) {
                    var preview = document.getElementById('preview-img');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    document.getElementById('upload-icon').style.display = 'none';
                    var name = document.getElementById('file-name');
                    name.innerText = input.files[0].name;
                    name.style.color = '#4cd137';
                };
                reader.readAsDataURL(input.files[0]);
            }

            // Fade the toast out after 4 seconds
            setTimeout(function () {
                var toast = document.getElementById('toastBox');
                if (toast) { toast.style.opacity = 0; setTimeout(function () { toast.remove(); }, 700); }
            }, 4000);
        </script>
</body>
</html>