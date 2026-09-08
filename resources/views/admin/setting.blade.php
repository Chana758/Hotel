@extends('admin.index')

@section('content')
<style>
    /* រៀបចំចម្ងាយឱ្យសមរម្យពី Sidebar */
    .page-content {
        padding: 40px 35px !important; 
    }
    
    .setting-card {
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        background-color: #1a1c20 !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    /* ធ្វើឱ្យអក្សរ Header និង Icon ដិតច្បាស់ */
    .card-header h5 {
        font-weight: 900 !important; /* ដាក់ឱ្យដិតបំផុត */
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #0dcaf0 !important; /* ពណ៌ Cyan ដូចរូបភាពមេផ្ញើមក */
    }

    .card-header i {
        color: #0dcaf0 !important;
        margin-right: 12px;
        font-size: 1.2rem;
    }

    /* ធ្វើឱ្យ Label ក្នុង Form ច្បាស់ */
    .form-label {
        font-weight: 800 !important; /* បង្កើនកម្រាស់អក្សរ */
        color: #ffffff !important;   /* ដាក់ពណ៌សឱ្យដាច់ពី Background */
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        margin-bottom: 10px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
    }

    .form-label i {
        color: #0dcaf0 !important;
        margin-right: 10px;
        font-size: 1rem;
    }

    /* រចនា Input ឱ្យដិត និងងាយអាន */
    .custom-input {
        background-color: #26292e !important;
        border: 1px solid #444 !important;
        color: #ffffff !important;
        padding: 12px 15px;
        border-radius: 8px;
        font-weight: 600; /* អក្សរក្នុង Input ក៏ឱ្យរាងដិតដែរ */
    }

    .custom-input:focus {
        border-color: #0dcaf0 !important;
        box-shadow: 0 0 12px rgba(13, 202, 240, 0.2);
    }

    /* ប៊ូតុង Update */
    .btn-update {
        background: linear-gradient(45deg, #0dcaf0, #008fa1);
        border: none;
        font-weight: 800;
        letter-spacing: 1.5px;
        padding: 15px 40px;
        border-radius: 10px;
        text-transform: uppercase;
    }

    /* Style សម្រាប់រូបភាព Admin ក្នុង Card */
    .admin-preview-img {
        width: 130px; 
        height: 130px; 
        border-radius: 50%; 
        border: 4px solid #0dcaf0; 
        object-fit: cover; 
        box-shadow: 0 0 25px rgba(13, 202, 240, 0.2);
    }
</style>

<div class="container-fluid">
    <!-- Main Title -->
    <div class="d-flex align-items-center mb-5 mt-2">
        <i class="fa fa-cogs fa-2x text-info me-3"></i>
        <h2 class="text-white fw-extrabold mb-0" style="letter-spacing: 1px; font-weight: 900;">SYSTEM & PROFILE SETTINGS</h2>
    </div>

    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Sidebar Info -->
            <div class="col-md-6">
                <div class="card setting-card bg-dark text-white mb-4 shadow-lg">
                    <div class="card-header border-secondary bg-transparent py-3">
                        <h5 class="mb-0"><i class="fa fa-user-circle"></i> Dashboard Sidebar</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-4 text-center">
                            <label class="form-label d-block justify-content-center">Admin Profile Image</label>
                            <div class="position-relative d-inline-block mb-3">
                                <img src="{{ asset(get_setting('admin_image', 'images/channa.jpg')) }}" class="admin-preview-img mb-2">
                            </div>
                            <input type="file" name="admin_image" class="form-control custom-input">
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label"><i class="fa fa-id-card"></i>Admin Name</label>
                            <input type="text" name="admin_name" class="form-control custom-input" value="{{ get_setting('admin_name', 'Sam Channa') }}">
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label"><i class="fa fa-briefcase"></i>Admin Title</label>
                            <input type="text" name="admin_title" class="form-control custom-input" value="{{ get_setting('admin_title', 'WEB DEVELOPER') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Frontend UI -->
            <div class="col-md-6">
                <div class="card setting-card bg-dark text-white mb-4 shadow-lg">
                    <div class="card-header border-secondary bg-transparent py-3">
                        <h5 class="mb-0"><i class="fa fa-desktop"></i> UI Frontend Setting</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-4">
                            <label class="form-label"><i class="fa fa-picture-o"></i>Website Logo</label>
                            <input type="file" name="logo" class="form-control custom-input mb-3">
                            <div class="p-3 rounded-0 border border-secondary bg-white d-inline-block shadow-sm">
                                <img src="{{ asset(get_setting('logo', 'images/logo.png')) }}" alt="Logo" style="height: 50px;">
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label"><i class="fa fa-copyright"></i>Copyright Text</label>
                            <input type="text" name="copyright" class="form-control custom-input" value="{{ get_setting('copyright', '© 2026 Your Brand') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="col-md-12">
                <div class="card setting-card bg-dark text-white mb-4 shadow-lg">
                    <div class="card-header border-secondary bg-transparent py-3">
                        <h5 class="mb-0"><i class="fa fa-share-alt"></i> Contact & Social Media</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label"><i class="fa fa-phone"></i>Phone Number</label>
                                <input type="text" name="phone" class="form-control custom-input" value="{{ get_setting('phone') }}">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label"><i class="fa fa-envelope"></i>Email Address</label>
                                <input type="email" name="email" class="form-control custom-input" value="{{ get_setting('email') }}">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label"><i class="fa fa-map-marker"></i>Location</label>
                                <input type="text" name="address" class="form-control custom-input" value="{{ get_setting('address') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="fa fa-facebook-official"></i>Facebook URL</label>
                                <input type="text" name="facebook" class="form-control custom-input" value="{{ get_setting('facebook') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="fa fa-instagram"></i>Instagram URL</label>
                                <input type="text" name="instagram" class="form-control custom-input" value="{{ get_setting('instagram') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5 text-end">
            <button type="submit" class="btn btn-update fw-bold text-white shadow-lg">
                <i class="fa fa-save me-2" style="color: #fff !important;"></i> SAVE ALL CHANGES
            </button>
        </div>
    </form>
</div>
@endsection