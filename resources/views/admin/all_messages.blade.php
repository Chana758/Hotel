@extends('admin.index')

@section('content')
<div class="page-content">
    <div class="page-header" style="background: transparent; padding: 20px 0;">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom" style="font-weight: 800; color: #DB6574; letter-spacing: 1px; text-transform: uppercase;">
                <i class="fa fa-envelope-open-o" style="margin-right: 10px;"></i> Message Center
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: transparent; padding: 0; font-size: 11px;">
                    <li class="breadcrumb-item"><a href="{{url('/')}}" style="color: #5d9cec;">Home</a></li>
                    <li class="breadcrumb-item active" style="color: #a5a7ab;">Messages</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="no-padding-bottom">
        <div class="container-fluid">
            @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert" 
                 style="background: #28a745; color: white; border: none; border-radius: 10px; box-shadow: 0 5px 15px rgba(40,167,69,0.3);">
                <i class="fa fa-check-circle" style="margin-right: 10px;"></i> {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            @endif

            <div class="block p-0" style="background: #191c21; border-radius: 15px; border: 1px solid #25282c; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" style="background: transparent; border-collapse: separate;">
                        <thead>
                            <tr style="background: rgba(219, 101, 116, 0.05);">
                                <th style="border: none; color: #DB6574; font-weight: 800; padding: 20px; font-size: 0.75rem; letter-spacing: 1px;">SENDER</th>
                                <th style="border: none; color: #DB6574; font-weight: 800; padding: 20px; font-size: 0.75rem; letter-spacing: 1px;">CONTACT INFO</th>
                                <th style="border: none; color: #DB6574; font-weight: 800; padding: 20px; font-size: 0.75rem; letter-spacing: 1px;">MESSAGE CONTENT</th>
                                <th style="border: none; color: #DB6574; font-weight: 800; padding: 20px; font-size: 0.75rem; letter-spacing: 1px;" class="text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $msg)
                            <tr style="border-bottom: 1px solid #25282c; transition: all 0.3s ease;">
                                <td style="padding: 20px; vertical-align: middle;">
                                    <div class="d-flex align-items-center">
                                        <div style="width: 35px; height: 35px; background: #DB6574; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 12px; box-shadow: 0 4px 10px rgba(219,101,116,0.3);">
                                            {{ substr($msg->name, 0, 1) }}
                                        </div>
                                        <span style="color: #ffffff; font-weight: 600; font-size: 0.9rem;">{{ $msg->name }}</span>
                                    </div>
                                </td>
                                <td style="padding: 20px; vertical-align: middle;">
                                    <div style="font-size: 0.85rem; margin-bottom: 4px;">
                                        <i class="fa fa-envelope-o" style="color: #5d9cec; width: 20px;"></i> 
                                        <span style="color: #a5a7ab;">{{ $msg->email }}</span>
                                    </div>
                                    <div style="font-size: 0.85rem;">
                                        <i class="fa fa-phone" style="color: #ffce54; width: 20px;"></i> 
                                        <span style="color: #a5a7ab;">{{ $msg->phone }}</span>
                                    </div>
                                </td>
                                <td style="padding: 20px; vertical-align: middle;">
                                    <p style="color: #d1d1d1; font-size: 0.85rem; line-height: 1.5; margin-bottom: 0; max-width: 300px;">
                                        <i class="fa fa-quote-left" style="font-size: 10px; color: #DB6574; margin-right: 5px; vertical-align: top;"></i>
                                        {{ Str::limit($msg->message, 80) }}
                                    </p>
                                </td>
                                <td style="padding: 20px; vertical-align: middle;" class="text-center">
                                    <div class="d-flex justify-content-center items-center">
                                        <button class="btn btn-sm" data-toggle="modal" data-target="#replyModal{{ $msg->id }}" 
                                                style="background: #28a745; color: #fff; border: none; border-radius: 6px; padding: 6px 12px; font-weight: 600; margin-right: 8px; transition: 0.3s; box-shadow: 0 4px 10px rgba(40,167,69,0.2);">
                                            <i class="fa fa-paper-plane-o"></i> Reply
                                        </button>
                                        
                                        <a href="{{ url('delete_msg', $msg->id) }}" class="btn btn-sm" 
                                           onclick="return confirm('Are you sure you want to delete this message?')"
                                           style="background: rgba(220, 53, 69, 0.1); color: #dc3545; border: 1px solid #dc3545; border-radius: 6px; padding: 6px 10px; transition: 0.3s;">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="replyModal{{ $msg->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content" style="background: #121418; border: 1px solid #DB6574; color: white; border-radius: 20px; box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
                                        <div class="modal-header" style="border-bottom: 1px solid #25282c; padding: 25px;">
                                            <h5 class="modal-title" style="font-weight: 800; color: #DB6574;">
                                                <i class="fa fa-reply"></i> RESPONSE TO {{ strtoupper($msg->name) }}
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" style="outline: none;"><span>&times;</span></button>
                                        </div>
                                        <form action="{{ url('send_mail', $msg->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body" style="padding: 25px;">
                                                <div style="background: rgba(255,255,255,0.03); padding: 15px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid #DB6574;">
                                                    <label style="font-size: 10px; color: #DB6574; font-weight: 800; text-transform: uppercase;">Original Message</label>
                                                    <p style="color: #a5a7ab; font-size: 13px; margin-top: 5px; line-height: 1.6;">{{ $msg->message }}</p>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label style="font-size: 10px; color: #a5a7ab; font-weight: 800;">GREETING</label>
                                                    <input type="text" name="greeting" class="form-control" 
                                                           style="background: #191c21; color: white; border: 1px solid #25282c; border-radius: 10px; padding: 10px;" 
                                                           value="Hello {{ $msg->name }}," required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label style="font-size: 10px; color: #a5a7ab; font-weight: 800;">MAIL BODY</label>
                                                    <textarea name="body" class="form-control" rows="4" 
                                                              style="background: #191c21; color: white; border: 1px solid #25282c; border-radius: 12px; padding: 15px; font-size: 14px;" 
                                                              placeholder="Type your main response here..." required></textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label style="font-size: 10px; color: #a5a7ab; font-weight: 800;">ACTION TEXT (BUTTON)</label>
                                                        <input type="text" name="actiontext" class="form-control" 
                                                               style="background: #191c21; color: white; border: 1px solid #25282c; border-radius: 10px;" 
                                                               value="Visit KETO Hotel">
                                                    </div>
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label style="font-size: 10px; color: #a5a7ab; font-weight: 800;">ACTION URL</label>
                                                        <input type="text" name="actionurl" class="form-control" 
                                                               style="background: #191c21; color: white; border: 1px solid #25282c; border-radius: 10px;" 
                                                               value="{{ url('/') }}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label style="font-size: 10px; color: #a5a7ab; font-weight: 800;">END LINE</label>
                                                    <input type="text" name="endline" class="form-control" 
                                                           style="background: #191c21; color: white; border: 1px solid #25282c; border-radius: 10px;" 
                                                           value="Thank you for choosing KETO Hotel!">
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="border-top: 1px solid #25282c; padding: 20px 25px;">
                                                <button type="button" class="btn btn-link text-light-gray" data-dismiss="modal" style="text-decoration: none; font-size: 13px;">Cancel</button>
                                                <button type="submit" class="btn" style="background: #DB6574; color: white; border-radius: 10px; padding: 10px 25px; font-weight: bold; box-shadow: 0 10px 20px rgba(219,101,116,0.2);">
                                                    SEND RESPONSE <i class="fa fa-send" style="margin-left: 8px;"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.02) !important;
        transform: scale(1.002);
    }
    .table-responsive::-webkit-scrollbar { height: 6px; }
    .table-responsive::-webkit-scrollbar-thumb { background: #25282c; border-radius: 10px; }
    .text-light-gray { color: #a5a7ab; }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Auto-hide after 3 seconds (3000ms)
        setTimeout(function() {
            $("#success-alert").slideUp(300, function(){
                $(this).remove(); 
            });
        }, 1000);
    });
</script>
@endsection