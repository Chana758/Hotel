<div class="page-content">
    <div class="page-header" style="padding: 25px 0;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h5 no-margin-bottom" style="font-weight: 800; color: #DB6574; letter-spacing: 1px;">
                    <i class="fa fa-th-large"></i> HOTEL COMMAND CENTER
                </h2>
                <small id="current-date" style="color: #a5a7ab;"></small>
            </div>
            <div class="d-flex align-items-center">
                <div id="digital-clock" class="mr-3" style="font-family: 'Courier New', Courier, monospace; font-weight: bold; color: #DB6574; font-size: 1.2rem; background: #121418; padding: 5px 15px; border-radius: 8px; border: 1px solid #25282c;"></div>
                <a href="{{ url('export_pdf') }}" class="btn btn-sm btn-danger shadow-sm">
                    <i class="fa fa-file-pdf-o"></i> Report
                </a>
            </div>
        </div>
    </div>

    <style>
        /* រក្សា CSS ដើមរបស់មេ */
        .block {
            background: linear-gradient(145deg, #191c21, #121418) !important;
            border: 1px solid #25282c !important;
            border-radius: 15px !important;
            box-shadow: 5px 5px 15px #0a0c0e !important;
            height: 100%;
        }
        section { padding: 20px 0 !important; }
        .stat-title { color: #d1d1d1 !important; font-size: 0.75rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
        .text-light-gray { color: #a5a7ab; }
        .icon-box { width: 55px; height: 55px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 24px; }
        .ib-pink { background: rgba(219, 101, 116, 0.15); color: #DB6574; }
        .ib-blue { background: rgba(93, 156, 236, 0.15); color: #5d9cec; }
        .ib-yellow { background: rgba(255, 206, 84, 0.15); color: #ffce54; }
        .ib-green { background: rgba(160, 212, 104, 0.15); color: #a0d468; }
        .title-dash { color: #fff; font-weight: 600; margin-bottom: 20px; display: block; border-left: 3px solid #DB6574; padding-left: 10px; text-transform: uppercase; font-size: 0.85rem; }
        .piechart-container { position: relative; display: flex; align-items: center; justify-content: center; height: 250px; }
        .percentage-center { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; }
        .percentage-center strong { font-size: 2.2rem; color: #fff; display: block; line-height: 1; }
        .percentage-center span { font-size: 0.7rem; color: #d1d1d1; text-transform: uppercase; }
    </style>

    @if(session()->has('message'))
    <div class="container-fluid">
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: #191c21; border-color: #a0d468; color: #a0d468;">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="color: #fff;">&times;</span>
            </button>
        </div>
    </div>
    @endif

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="statistic-block block p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="icon-box ib-pink"><i class="fa fa-bed"></i></div>
                            <div class="text-right">
                                <div class="number" style="font-size: 26px; font-weight: 800; color: #DB6574;">{{ $rooms->count() }}</div>
                                <div class="stat-title">Total Inventory</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="statistic-block block p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="icon-box ib-blue"><i class="fa fa-calendar-check-o"></i></div>
                            <div class="text-right">
                                <div class="number" style="font-size: 26px; font-weight: 800; color: #5d9cec;">{{ $booking->count() }}</div>
                                <div class="stat-title">Bookings</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="statistic-block block p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="icon-box ib-yellow"><i class="fa fa-money"></i></div>
                            <div class="text-right">
                                <div class="number" style="font-size: 26px; font-weight: 800; color: #ffce54;">$3,450</div>
                                <div class="stat-title">Total Revenue</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="statistic-block block p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="icon-box ib-green"><i class="fa fa-envelope-o"></i></div>
                            <div class="text-right">
                                <div class="number" style="font-size: 26px; font-weight: 800; color: #a0d468;">{{ $contact->count() }}</div>
                                <div class="stat-title">Inquiries</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="block p-4">
                        <span class="title-dash">Weekly Visitors & Views</span>
                        <canvas id="lineCahrt"></canvas>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="block p-4 text-center">
                        <span class="title-dash text-left">Room Status</span>
                        <div class="piechart-container">
                            <canvas id="pieChartHome1"></canvas>
                            <div class="percentage-center">
                                <strong>85%</strong>
                                <span>Occupied</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around mt-3">
                            <small style="color: #d1d1d1;"><i class="fa fa-circle" style="color: #864DD9;"></i> Occupied</small>
                            <small style="color: #d1d1d1;"><i class="fa fa-circle" style="color: #25282c;"></i> Available</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding-bottom: 50px !important;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="block p-4">
                        <span class="title-dash">Monthly Revenue Comparison</span>
                        <canvas id="barChartRevenue"></canvas>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="block p-4">
                        <span class="title-dash">Recent Inquiries</span>
                        <div class="inquiry-list mt-3">
                            @forelse($contact->take(4) as $msg)
                            <div class="d-flex align-items-center justify-content-between p-3 mb-2" style="background: rgba(255,255,255,0.05); border-radius: 10px; border: 1px solid #25282c;">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3" style="color: #DB6574;"><i class="fa fa-comment-o"></i></div>
                                    <div>
                                        <h6 class="mb-0 text-white" style="font-size: 13px;">{{ $msg->name }}</h6>
                                        <p class="mb-0 small" style="color: #a5a7ab;">{{ Str::limit($msg->message, 20) }}</p>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#replyModal{{ $msg->id }}" style="font-size: 10px; padding: 2px 8px; border-radius: 5px;">
                                    Reply
                                </button>
                            </div>

                            <div class="modal fade" id="replyModal{{ $msg->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content" style="background: #191c21; border: 1px solid #DB6574; color: white; border-radius: 15px;">
                                        <div class="modal-header" style="border-bottom: 1px solid #25282c;">
                                            <h5 class="modal-title" style="font-size: 16px;">Reply to: {{ $msg->name }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="{{ url('send_mail', $msg->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body text-left">
                                                <div class="p-3 mb-3" style="background: #121418; border-left: 3px solid #DB6574; border-radius: 5px;">
                                                    <small style="color: #DB6574; font-weight: bold; display: block; margin-bottom: 5px;">Customer Message:</small>
                                                    <p style="color: #d1d1d1; font-size: 14px; margin-bottom: 0;">{{ $msg->message }}</p>
                                                </div>

                                                <div class="form-group">
                                                    <small style="color: #a5a7ab; display: block; margin-bottom: 5px;">Your Response:</small>
                                                    <textarea name="message" class="form-control" rows="4" style="background: #121418; color: white; border: 1px solid #25282c;" required placeholder="Write your response here..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="border-top: 1px solid #25282c;">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger btn-sm">Send Now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5" style="color: #a5a7ab;">No messages.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').innerText = now.toLocaleDateString('en-US', options);
        document.getElementById('digital-clock').innerText = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000);
    updateClock();

    const ctxBar = document.getElementById('barChartRevenue').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue',
                data: [2500, 3800, 3200, 4500, 4100, 5200],
                backgroundColor: '#DB6574',
                borderRadius: 5,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { grid: { color: '#25282c' }, ticks: { color: '#8a8d93' } },
                x: { grid: { display: false }, ticks: { color: '#8a8d93' } }
            },
            plugins: { legend: { display: false } }
        }
    });

    const ctxPie = document.getElementById('pieChartHome1').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [85, 15],
                backgroundColor: ['#864DD9', '#25282c'],
                borderWidth: 0,
                cutout: '85%'
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });
</script>