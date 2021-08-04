<x-admin-master attribute="value">
    <x-slot name="scripts">
      <script type="text/javascript">
        myLineChart.data.datasets[0].data = @json($monthly_posts);
        myLineChart.update('active');
        console.log(myPieChart);
        console.log(myPieChart.config.data);
        myPieChart.config.data.datasets[0].data = @json($categories_cnt);
        myPieChart.config.data.labels = @json($categories);
        myPieChart.update();
        let cat_items = $('.category-color');
        console.log(myPieChart.config.data.datasets[0].backgroundColor);
        for (var i = 0; i < cat_items.length; i++) {
            $(cat_items[i]).css('color',myPieChart.config.data.datasets[0].backgroundColor[i]);
        }
      </script>

    </x-slot>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="display-3 mb-0 text-gray-800">Admin Dashboard</h1>
    </div>

    @if (auth()->user()->hasPermission('view-admin-dashboard'))

        @include('admin.users.dashboards.admin')

    @else
        {{-- here abondoned from AdminController and will redirect to profile of user --}}

        @include('admin.users.dashboards.member')

    @endif


</x-admin-master>
