@extends('admin.index')

@section('content')
<div class="container-fluid">

    <h2 class="hs-title"><i class="fa fa-cogs"></i>System &amp; Profile Settings</h2>

    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- Sidebar profile --}}
            <div class="col-md-6">
                <div class="hs-card">
                    <h5 class="hs-title mt-0 mb-4"><i class="fa fa-user-circle"></i>Dashboard Sidebar</h5>

                    <div class="text-center mb-4">
                        <label class="hs-label justify-content-center">Admin Profile Image</label>
                        <img src="{{ asset(get_setting('admin_image', 'images/channa.jpg')) }}" class="hs-avatar-preview my-3" alt="Admin">
                        <input type="file" name="admin_image" class="hs-input">
                    </div>

                    <div class="mb-3">
                        <label class="hs-label"><i class="fa fa-id-card"></i> Admin Name</label>
                        <input type="text" name="admin_name" class="hs-input" value="{{ get_setting('admin_name', 'Admin') }}">
                    </div>
                    <div>
                        <label class="hs-label"><i class="fa fa-briefcase"></i> Admin Title</label>
                        <input type="text" name="admin_title" class="hs-input" value="{{ get_setting('admin_title', 'Manager') }}">
                    </div>
                </div>
            </div>

            {{-- Public website --}}
            <div class="col-md-6">
                <div class="hs-card">
                    <h5 class="hs-title mt-0 mb-4"><i class="fa fa-desktop"></i>Website Settings</h5>

                    <div class="mb-4">
                        <label class="hs-label"><i class="fa fa-picture-o"></i> Website Logo</label>
                        <input type="file" name="logo" class="hs-input mb-3">
                        <div class="p-3 border border-secondary bg-white d-inline-block">
                            <img src="{{ asset(get_setting('logo', 'images/logo.png')) }}" alt="Logo" style="height:50px;">
                        </div>
                    </div>
                    <div>
                        <label class="hs-label"><i class="fa fa-copyright"></i> Copyright Text</label>
                        <input type="text" name="copyright" class="hs-input" value="{{ get_setting('copyright', '© ' . date('Y') . ' ' . config('app.name')) }}">
                    </div>
                </div>
            </div>

            {{-- Contact + social --}}
            <div class="col-md-12">
                <div class="hs-card">
                    <h5 class="hs-title mt-0 mb-4"><i class="fa fa-share-alt"></i>Contact &amp; Social Media</h5>
                    <div class="row">
                        @php
                            $fields = [
                                ['phone',     'fa-phone',             'Phone Number',  'text',  'col-md-4'],
                                ['email',     'fa-envelope',          'Email Address', 'email', 'col-md-4'],
                                ['address',   'fa-map-marker',        'Location',      'text',  'col-md-4'],
                                ['facebook',  'fa-facebook-official', 'Facebook URL',  'text',  'col-md-6'],
                                ['instagram', 'fa-instagram',         'Instagram URL', 'text',  'col-md-6'],
                            ];
                        @endphp
                        @foreach($fields as [$name, $icon, $label, $type, $col])
                            <div class="{{ $col }} mb-3">
                                <label class="hs-label"><i class="fa {{ $icon }}"></i> {{ $label }}</label>
                                <input type="{{ $type }}" name="{{ $name }}" class="hs-input" value="{{ get_setting($name) }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mb-5">
            <button type="submit" class="hs-btn hs-btn--primary"><i class="fa fa-save"></i> Save All Changes</button>
        </div>
    </form>
</div>
@endsection