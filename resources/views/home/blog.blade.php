{{-- Optional section (currently disabled in home/index.blade.php) --}}
@php
    $posts = [
        ['image' => 'blog1.jpg', 'title' => 'Bed Room',    'tag' => 'Rest well',         'text' => 'Sleep comfortably in rooms designed for total relaxation.'],
        ['image' => 'blog2.jpg', 'title' => 'Dining',      'tag' => 'Taste the local',   'text' => 'Enjoy fresh local dishes prepared by our chefs every day.'],
        ['image' => 'blog3.jpg', 'title' => 'Experiences', 'tag' => 'Explore the city',  'text' => 'Let our team help you plan tours and unforgettable activities.'],
    ];
@endphp

<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Blog</h2>
                    <p>News, tips and stories from {{ config('app.name') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="blog_box">
                        <div class="blog_img">
                            <figure><img src="{{ asset('images/' . $post['image']) }}" alt="{{ $post['title'] }}"></figure>
                        </div>
                        <div class="blog_room">
                            <h3>{{ $post['title'] }}</h3>
                            <span>{{ $post['tag'] }}</span>
                            <p>{{ $post['text'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>