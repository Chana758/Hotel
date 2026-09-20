<div class="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage"><h2>Contact Us</h2></div>
            </div>
        </div>

        <div class="row">
            {{-- Contact form --}}
            <div class="col-md-6">
                @if(session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif

                <form id="request" class="main_form" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Name" type="text" name="name" value="{{ old('name') }}">
                            @error('name') <span style="color:red;">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Email" type="email" name="email" value="{{ old('email') }}">
                            @error('email') <span style="color:red;">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Phone Number" type="text" name="phone" value="{{ old('phone') }}">
                            @error('phone') <span style="color:red;">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <textarea class="textarea" placeholder="Message" name="message">{{ old('message') }}</textarea>
                            @error('message') <span style="color:red;">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="send_btn">Send</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Map --}}
            <div class="col-md-6">
                <div class="map_main">
                    <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d250151.46367837288!2d104.7253777478073!3d11.579317639841996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109513dc76a6be3%3A0x9c010ee85ab525bb!2z4Z6X4Z-S4Z6T4Z-G4Z6W4Z-B4Z6J!5e0!3m2!1skm!2skh!4v1777294262984!5m2!1skm!2skh"
                                width="600" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Breathing room between the Send button and the footer */
    .contact { padding-bottom: 80px; }

    /* Keep the Send button from stretching or wrapping */
    .contact .send_btn {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        width: auto !important;
        min-width: 200px;
        padding: 16px 50px !important;
        white-space: nowrap;
    }
</style>
<script>
    // Fade out the success message after 5 seconds
    document.addEventListener('DOMContentLoaded', function () {
        var alertBox = document.getElementById('success-alert');
        if (!alertBox) return;
        setTimeout(function () {
            alertBox.style.transition = 'opacity .6s ease';
            alertBox.style.opacity = '0';
            setTimeout(function () { alertBox.remove(); }, 600);
        }, 5000);
    });
</script>