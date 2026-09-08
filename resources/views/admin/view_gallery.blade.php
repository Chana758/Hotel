<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <!-- បន្ថែម Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
        }
        .gallery-wrapper { 
            max-width: 1100px; 
            margin: 0 auto; 
            padding: 10px; 
        }
        
        /* Typography Styles */
        h2, .section-label, .btn-confirm { 
            font-family: 'Poppins', sans-serif;
         }

        /* Toast Message - Neon Green Glow */
        .toast-container { 
            position: fixed; 
            top: 20px; 
            right: 20px; 
            z-index: 9999; 
        }
        .custom-toast {
            background: #2d3035; 
            color: #4cd137; 
            padding: 12px 28px;
            border-radius: 50px; 
            border: 1px solid rgba(76, 209, 55, 0.4);
            display: flex; 
            align-items: center; 
            gap: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5), 0 0 15px rgba(76, 209, 55, 0.1);
            animation: slideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
        }

        /* Card Design */
        .admin-card { 
            background: #2d3035; 
            padding: 30px; 
            border-radius: 16px; 
            border: 1px solid #3e4147; 
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .section-label { 
            color: #ff7675; 
            font-size: 13px; 
            font-weight: 700; 
            text-transform: uppercase; 
            margin-bottom: 25px; 
            display: block;
            letter-spacing: 2px; 
            opacity: 1;
            text-shadow: 0 0 10px rgba(255, 118, 117, 0.2);
        }

        /* Upload Area - លេងពណ៌ Gradient Icon */
        /* ១. បន្ថយម្ពស់ជួរដេកឱ្យទាបជាងមុន */
            .upload-flex { 
                display: flex; 
                gap: 15px; 
                align-items: stretch; 
                height: 45px; /* កែពី 65px មកត្រឹម 45px (ឬតាមចិត្តចង់) */
            }

            /* ២. បន្ថយទំហំអក្សរ និងចន្លោះក្នុងប៊ូតុង */
            .btn-confirm { 
                background: linear-gradient(135deg, #DB6574, #c35a67);
                color: white; 
                border: none; 
                padding: 0 20px;    /* បន្ថយចន្លោះឆ្វេងស្តាំពី 35px មក 20px */
                font-weight: 600; 
                border-radius: 8px; /* បន្ថយភាពមូលបន្តិចឱ្យសមនឹងទំហំតូច */
                cursor: pointer;
                transition: 0.4s; 
                font-size: 13px;    /* បន្ថយទំហំអក្សរបន្តិចពី 14px មក 13px */
                display: flex; 
                align-items: center; 
                gap: 8px;           /* បន្ថយចន្លោះរវាង Icon និងអក្សរ */
                white-space: nowrap;
                box-shadow: 0 4px 12px rgba(219, 101, 116, 0.2); /* បន្ថយស្រមោលឱ្យសមទំហំ */
            }

            /* ៣. កែសម្រួល Upload Box ឱ្យស៊ីគ្នា */
            .upload-box {
                height: 60px;
                flex: 1; 
                border: 2px dashed #4a4d52; 
                background: #22252a;
                border-radius: 8px; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                padding: 0 15px; 
                gap: 10px;
            }

        /* Icon Color Gradient */
        .upload-box i { 
            font-size: 24px; 
            background: linear-gradient(135deg, #DB6574, #ff7675);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .upload-box span { 
            color: #a0a3a8; 
            font-size: 14px; 
            font-weight: 500; 
            letter-spacing: 0.3px; }

        #preview-img {
            height: 45px; 
            width: 45px; 
            object-fit: cover; 
            border-radius: 8px;
            display: none; 
            border: 2px solid #DB6574;
            box-shadow: 0 0 10px rgba(219, 101, 116, 0.3);
        }

        .btn-confirm:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 12px 25px rgba(219, 101, 116, 0.35);
            filter: brightness(1.1);
        }

        /* Gallery Grid & Item */
        .img-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); 
            gap: 25px; }
        .img-item { 
            position: relative; 
            border-radius: 0px; 
            overflow: hidden; 
            aspect-ratio: 16/11; 
            border: 1px solid #3e4147; 
            transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            background: #22252a;
        }
        .img-item:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(0,0,0,0.4); }
        
        .img-item img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            transition: 0.6s; }
        .img-item:hover img { 
            transform: scale(1.1); 
            filter: brightness(0.5); }
        
        /* Delete Button Glow */
        .delete-btn {
            position: absolute; 
            top: 12px; 
            right: 12px; 
            background: #ff4d4d;
            color: white; 
            width: 38px; 
            height: 38px; 
            border-radius: 10px;
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-size: 15px; 
            opacity: 0; 
            transition: 0.3s; 
            transform: scale(0.8);
            text-decoration: none; 
            box-shadow: 0 5px 15px rgba(255, 77, 77, 0.4);
        }
        .img-item:hover .delete-btn { 
            opacity: 1; 
            transform: scale(1); }
        .delete-btn:hover { 
            background: #ff3333; 
            transform: scale(1.1); }

        @keyframes slideIn { from { 
            transform: translateX(100%) scale(0.8); 
            opacity: 0; } 
            to { 
                transform: translateX(0) scale(1); 
                opacity: 1; } 
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
    <div class="page-content">
      <div class="gallery-wrapper">
        
        <!-- Floating Alert -->
        @if(session()->has('message'))
        <div class="toast-container" id="toastBox">
            <div class="custom-toast">
                <i class="fa fa-check-circle" style="font-size: 22px;"></i>
                <span style="font-family: 'Poppins'; font-size: 14px;">{{ session()->get('message') }}</span>
                <i class="fa fa-times" style="cursor:pointer; font-size: 12px; margin-left: 10px; opacity: 0.5;" onclick="this.parentElement.remove()"></i>
            </div>
        </div>
        @endif

        <!-- Management Section -->
        <div class="admin-card">
            <label class="section-label">Gallery Management</label>
            <form action="{{ route('upload_gallery') }}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="upload-flex">
                    <label for="image-input" class="upload-box">
                        <i class="fa fa-cloud-upload" id="upload-icon"></i>
                            <img id="preview-img" src="#" alt="preview">
                            <span id="file-name">Select your masterpiece...</span>
                        <input type="file" name="image" id="image-input" hidden onchange="previewImage(this)">
                    </label>
                    <button type="submit" class="btn-confirm">
                        <i class="fa fa-paper-plane"></i> Confirm Upload
                    </button>
                </div>
            </form>
        </div>

        <!-- Display Section -->
        <div class="admin-card">
            <label class="section-label">Existing Gallery</label>
            <div class="img-grid">
                @forelse($gallery as $item)
                <div class="img-item">
                    <img src="{{ asset('gallery/' . $item->image) }}">
                    <a href="{{ route('delete_gallery', $item->id) }}" class="delete-btn" onclick="return confirm('តើអ្នកប្រាកដថាចង់លុបរូបភាពនេះ?')">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px; color: #555; border: 2px dashed #3e4147; border-radius: 20px;">
                    <i class="fa fa-image mb-3" style="font-size: 45px; opacity: 0.1;"></i>
                    <p style="font-weight: 500; font-family: 'Poppins';">No images captured yet.</p>
                </div>
                @endforelse
            </div>
        </div>

      </div>
    </div>
    
    @include('admin.footer')

    <script>
        function previewImage(input) {
            const fileName = document.getElementById('file-name');
            const preview = document.getElementById('preview-img');
            const icon = document.getElementById('upload-icon');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    icon.style.display = 'none';
                    fileName.innerText = input.files[0].name;
                    fileName.style.color = "#4cd137";
                    fileName.style.fontWeight = "600";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        setTimeout(() => {
            const toast = document.getElementById('toastBox');
            if(toast) {
                toast.style.transition = "0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
                toast.style.opacity = "0";
                toast.style.transform = "translateX(80px) scale(0.9)";
                setTimeout(() => toast.remove(), 800);
            }
        }, 4000);
    </script>
  </body>
</html>