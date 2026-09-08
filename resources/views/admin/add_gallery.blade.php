<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        .form-wrapper { max-width: 800px; margin: 0 auto; padding: 20px; }
        .form-container { 
            background: #2d3035; 
            padding: 40px; 
            border-radius: 12px; 
            border: 1px solid #444;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        label { 
            color: #DB6574; 
            font-weight: 700; 
            font-size: 11px; 
            text-transform: uppercase; 
            margin-bottom: 15px;
            display: block;
            letter-spacing: 1px;
        }
        /* Style សម្រាប់ប្រអប់ជ្រើសរើស File */
        .custom-file-input {
            background: #22252a;
            border: 2px dashed #444;
            color: #8a8d93;
            padding: 40px 20px;
            border-radius: 8px;
            width: 100%;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .custom-file-input:hover {
            border-color: #DB6574;
            background: #292c31;
        }
        .btn-submit { 
            background: #DB6574; 
            color: white; 
            border: none; 
            padding: 12px 30px; 
            font-weight: bold; 
            border-radius: 5px; 
            cursor: pointer;
            margin-top: 25px;
            text-transform: uppercase;
            transition: 0.3s;
        }
        .btn-submit:hover {
            background: #c55664;
            box-shadow: 0 4px 12px rgba(219, 101, 116, 0.3);
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
    <div class="page-content">
      <div class="form-wrapper">
        <h2 class="h5 mb-4" style="color: #DB6574; font-weight: bold; text-transform: uppercase;">
            <i class="fa fa-plus-circle mr-2"></i> Add New Image to Gallery
        </h2>

        <div class="form-container">
            <!-- បង្ហាញសារជោគជ័យ -->
            @if(session()->has('message'))
                <div class="alert alert-success" style="background: rgba(76, 209, 55, 0.1); color: #4cd137; border: none;">
                    {{ session()->get('message') }}
                </div>
            @endif

            <form action="{{ url('upload_gallery') }}" method="Post" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" name="image" class="form-control-file custom-file-input" required>
                    <small class="text-muted mt-2 d-block">Recommended size: 800x600px (JPG, PNG, WebP)</small>
                </div>

                <div class="text-left">
                    <button type="submit" class="btn-submit">
                        <i class="fa fa-upload mr-2"></i> Add to Gallery
                    </button>
                </div>
            </form>
        </div>
      </div>
    </div>
    @include('admin.footer')
  </body>
</html>