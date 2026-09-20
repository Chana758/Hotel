<div class="gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage"><h2>Gallery</h2></div>
            </div>
        </div>
        <div class="row">
            @foreach($gallery as $item)
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure>
                            {{-- Images are stored in public/gallery --}}
                            <img src="{{ asset('gallery/' . $item->image) }}" alt="Gallery photo" style="height:200px;width:100%;object-fit:cover;">
                        </figure>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>