{{-- Dashboard content. Expected variables: $rooms, $booking, $contact
     Optional: $revenue (number), $occupancy (0-100) --}}
@php
    $revenue   = $revenue   ?? 3450; // TODO: pass real revenue from AdminController@index
    $occupancy = $occupancy ?? 85;   // TODO: pass real occupancy from AdminController@index
@endphp

<div class="container-fluid">

    {{-- Page header + live clock --}}
    <div class="hs-header-bar">
        <div>
            <h2 class="hs-title"><i class="fa fa-th-large"></i>{{ config('app.name') }} Command Center</h2>
            <small id="current-date" style="color:var(--hs-muted);"></small>
        </div>
        <div class="d-flex align-items-center">
            <div id="digital-clock" class="mr-3" style="font-family:'Courier New',monospace;font-weight:700;color:var(--hs-accent);font-size:1.2rem;background:var(--hs-bg);padding:5px 15px;border-radius:8px;border:1px solid var(--hs-line);"></div>
            <a href="{{ route('export_pdf') }}" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> Report</a>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="hs-alert hs-alert--success">{{ session('message') }}</div>
    @endif

    {{-- Stat cards --}}
    <div class="row">
        @php
            $stats = [
                ['icon' => 'fa-bed',              'color' => 'pink',   'hex' => 'var(--hs-accent)', 'value' => $rooms->count(),               'label' => 'Total Inventory'],
                ['icon' => 'fa-calendar-check-o', 'color' => 'blue',   'hex' => 'var(--hs-blue)',   'value' => $booking->count(),             'label' => 'Bookings'],
                ['icon' => 'fa-money',            'color' => 'yellow', 'hex' => 'var(--hs-gold)',   'value' => '$' . number_format($revenue), 'label' => 'Total Revenue'],
                ['icon' => 'fa-envelope-o',       'color' => 'green',  'hex' => 'var(--hs-green)',  'value' => $contact->count(),             'label' => 'Inquiries'],
            ];
        @endphp
        @foreach($stats as $s)
            <div class="col-md-3 mb-3">
                <div class="hs-block d-flex justify-content-between align-items-center">
                    <div class="hs-icon-box hs-icon-box--{{ $s['color'] }}"><i class="fa {{ $s['icon'] }}"></i></div>
                    <div class="text-right">
                        <div class="hs-stat-number" style="color:{{ $s['hex'] }};">{{ $s['value'] }}</div>
                        <div class="hs-stat-title">{{ $s['label'] }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Line chart (drawn by Admin/js/charts-home.js) + room status --}}
    <div class="row mt-3">
        <div class="col-lg-8 mb-4">
            <div class="hs-block">
                <span class="hs-block-title">Weekly Visitors &amp; Views</span>
                {{-- The id "lineCahrt" (sic) must match charts-home.js --}}
                <canvas id="lineCahrt"></canvas>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="hs-block text-center">
                <span class="hs-block-title text-left">Room Status</span>
                <div class="hs-donut">
                    <canvas id="pieChartHome1"></canvas>
                    <div class="hs-donut__center"><strong>{{ $occupancy }}%</strong><span>Occupied</span></div>
                </div>
                <div class="d-flex justify-content-around mt-3">
                    <small style="color:var(--hs-text);"><i class="fa fa-circle" style="color:#864DD9;"></i> Occupied</small>
                    <small style="color:var(--hs-text);"><i class="fa fa-circle" style="color:var(--hs-line);"></i> Available</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Revenue chart + recent inquiries --}}
    <div class="row mb-4">
        <div class="col-lg-8 mb-4">
            <div class="hs-block">
                <span class="hs-block-title">Monthly Revenue Comparison</span>
                <canvas id="barChartRevenue"></canvas>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="hs-block">
                <span class="hs-block-title">Recent Inquiries</span>
                @forelse($contact->take(4) as $msg)
                    <div class="hs-inquiry">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-comment-o mr-3" style="color:var(--hs-accent);"></i>
                            <div>
                                <h6 class="mb-0 text-white" style="font-size:13px;">{{ $msg->name }}</h6>
                                <p class="mb-0 small" style="color:var(--hs-muted);">{{ Str::limit($msg->message, 20) }}</p>
                            </div>
                        </div>
                        {{-- Replies are handled on the Messages page --}}
                        <a href="{{ url('all_messages') }}" class="btn btn-sm btn-outline-success" style="font-size:10px;">Reply</a>
                    </div>
                @empty
                    <div class="text-center py-5" style="color:var(--hs-muted);">No messages.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Live date + clock
    function updateClock() {
        const now = new Date();
        document.getElementById('current-date').innerText =
            now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        document.getElementById('digital-clock').innerText = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Monthly revenue bar chart (sample data - replace with real data)
    new Chart(document.getElementById('barChartRevenue').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{ label: 'Revenue', data: [2500, 3800, 3200, 4500, 4100, 5200], backgroundColor: '#DB6574', borderRadius: 5 }]
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

    // Occupancy doughnut
    new Chart(document.getElementById('pieChartHome1').getContext('2d'), {
        type: 'doughnut',
        data: { datasets: [{ data: [{{ $occupancy }}, {{ 100 - $occupancy }}], backgroundColor: ['#864DD9', '#25282c'], borderWidth: 0, cutout: '85%' }] },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });
</script>