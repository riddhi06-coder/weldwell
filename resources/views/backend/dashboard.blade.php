<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')

    <style>
        body { background: #f6f7fb; }

        .stat-card {
            background: #ffffff;
            border: 1px solid #ecedf2;
            border-radius: 14px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            height: 100%;
            transition: transform .16s ease, box-shadow .16s ease, border-color .16s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            border-color: #e2e4ec;
            box-shadow: 0 10px 26px rgba(17, 24, 39, 0.07);
        }
        .stat-ico {
            width: 50px; height: 50px; border-radius: 13px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .stat-ico svg { width: 22px; height: 22px; stroke-width: 2; }
        .stat-count { font-size: 26px; font-weight: 700; color: #14161d; line-height: 1; }
        .stat-label { color: #7a8091; font-size: 13px; margin-top: 6px; }
        .stat-link { text-decoration: none; display: block; height: 100%; }
    </style>
</head>

    @include('components.backend.header')

    <!--start sidebar wrapper-->
    @include('components.backend.sidebar')
    <!--end sidebar wrapper-->

    <div class="page-body">

        <div class="container-fluid py-4">

            @php
                $u = auth()->user();
                $cards = [
                    ['label' => 'Users',            'count' => $stats['users'],           'perm' => 'users.view',               'route' => route('admin.users.index'),             'icon' => 'users',        'c' => '#4A55A2', 't' => '#ECEEF8'],
                    ['label' => 'Roles',            'count' => $stats['roles'],           'perm' => 'roles.view',               'route' => route('admin.roles.index'),             'icon' => 'shield',       'c' => '#0d9488', 't' => '#E6F4F2'],
                    ['label' => 'Brand Categories', 'count' => $stats['brandCategories'], 'perm' => 'brand-categories.view',     'route' => route('manage-brand-catgeory.index'),   'icon' => 'tag',          'c' => '#e5011c', 't' => '#FCE7EA'],
                    ['label' => 'Sub Categories',   'count' => $stats['subCategories'],   'perm' => 'brand-subcategories.view',  'route' => route('manage-brand-subcategory.index'),'icon' => 'bookmark',     'c' => '#ea580c', 't' => '#FCEDE3'],
                    ['label' => 'Testimonials',     'count' => $stats['testimonials'],    'perm' => 'testimonials.view',        'route' => route('manage-testimonials.index'),     'icon' => 'message-square','c' => '#7c3aed', 't' => '#F1EAFC'],
                    ['label' => 'Events',           'count' => $stats['events'],          'perm' => 'events.view',              'route' => route('manage-events.index'),           'icon' => 'calendar',     'c' => '#2563eb', 't' => '#E7EEFD'],
                    ['label' => 'Activity Logs',    'count' => $stats['activityLogs'],    'perm' => 'activity-logs.view',       'route' => route('admin.activity-logs.index'),     'icon' => 'activity',     'c' => '#475569', 't' => '#EEF1F6'],
                ];
            @endphp

            <div class="row g-3">
                @foreach($cards as $card)
                    @if($u && $u->hasPermission($card['perm']))
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <a href="{{ $card['route'] }}" class="stat-link">
                                <div class="stat-card">
                                    <div class="stat-ico" style="background: {{ $card['t'] }}; color: {{ $card['c'] }};">
                                        <i data-feather="{{ $card['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <div class="stat-count">{{ number_format($card['count']) }}</div>
                                        <div class="stat-label">{{ $card['label'] }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>

        <!-- Container-fluid Ends -->
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
    </div>

    </div>

    @include('components.backend.main-js')

    <script>
        // Re-render the Feather icons used in the stat cards.
        document.addEventListener('DOMContentLoaded', function () {
            if (window.feather) { window.feather.replace(); }
        });
    </script>

</body>

</html>
