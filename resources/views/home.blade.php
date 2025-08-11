<x-layouts.main
    :title="__('Dashboard Restaurant')"
>

    @push('scripts')
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/morris.css') }}">
        <script src="{{ asset('app-assets/vendors/js/charts/chart.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/charts/raphael-min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/charts/morris.min.js') }}"></script>

        <script src="{{ asset('app-assets/js/scripts/pages/dashboard-sales.js') }}"></script>
    @endpush
</x-layouts.main>
