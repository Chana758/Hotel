@extends('admin.index')

@section('content')
<div class="container-fluid">

    <h2 class="hs-title"><i class="fa fa-envelope-open-o"></i>Message Center</h2>

    @if(session()->has('message'))
        <div class="hs-alert hs-alert--success" id="success-alert">
            <i class="fa fa-check-circle mr-2"></i>{{ session('message') }}
        </div>
    @endif

    <div class="hs-table-box">
        <div class="table-responsive">
            <table class="hs-table">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Contact Info</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $msg)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div style="width:35px;height:35px;background:var(--hs-accent);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;margin-right:12px;">
                                        {{ Str::upper(Str::substr($msg->name, 0, 1)) }}
                                    </div>
                                    <span class="text-white font-weight-bold">{{ $msg->name }}</span>
                                </div>
                            </td>
                            <td class="text-left">
                                <div><i class="fa fa-envelope-o" style="color:var(--hs-blue);width:20px;"></i> {{ $msg->email }}</div>
                                <div><i class="fa fa-phone" style="color:var(--hs-gold);width:20px;"></i> {{ $msg->phone }}</div>
                            </td>
                            <td class="text-left" style="max-width:300px;">
                                <i class="fa fa-quote-left" style="font-size:10px;color:var(--hs-accent);"></i>
                                {{ Str::limit($msg->message, 80) }}
                            </td>
                            <td>
                                <div class="hs-row-actions">
                                    <button type="button" class="hs-btn hs-btn--sm hs-btn--success" data-toggle="modal" data-target="#replyModal{{ $msg->id }}">
                                        <i class="fa fa-paper-plane-o"></i> Reply
                                    </button>
                                    <a href="{{ url('delete_msg', $msg->id) }}" class="hs-btn hs-btn--sm hs-btn--danger"
                                       onclick="return confirm('Delete this message?')"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-5" style="color:var(--hs-muted);">No messages yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Reply modals live outside the table so the HTML stays valid --}}
@foreach($data as $msg)
    <div class="modal fade hs-modal" id="replyModal{{ $msg->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-reply"></i> Reply to {{ $msg->name }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <form action="{{ url('send_mail', $msg->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="hs-quote">
                            <label class="hs-label mt-0">Original Message</label>
                            <p class="mb-0 mt-2" style="color:var(--hs-muted);font-size:13px;">{{ $msg->message }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="hs-label mt-0">Greeting</label>
                            <input type="text" name="greeting" class="hs-input" value="Hello {{ $msg->name }}," required>
                        </div>
                        <div class="mb-3">
                            <label class="hs-label mt-0">Mail Body</label>
                            <textarea name="body" rows="4" class="hs-input" placeholder="Type your response..." required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="hs-label mt-0">Button Text</label>
                                <input type="text" name="actiontext" class="hs-input" value="Visit {{ config('app.name') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="hs-label mt-0">Button URL</label>
                                <input type="text" name="actionurl" class="hs-input" value="{{ url('/') }}">
                            </div>
                        </div>
                        <div>
                            <label class="hs-label mt-0">Closing Line</label>
                            <input type="text" name="endline" class="hs-input" value="Thank you for choosing {{ config('app.name') }}!">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="hs-btn hs-btn--secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="hs-btn hs-btn--primary">Send Response <i class="fa fa-send"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
    // Auto-hide the success message after 3 seconds
    setTimeout(function () {
        var alert = document.getElementById('success-alert');
        if (alert) { alert.style.transition = 'opacity .4s'; alert.style.opacity = 0; setTimeout(function () { alert.remove(); }, 400); }
    }, 3000);
</script>
@endsection