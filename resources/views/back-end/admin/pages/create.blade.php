@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('sliderStyle')
    <link href="{{ asset('css/antd.css') }}" rel="stylesheet">
@endpush
@push('PackageStyle')
    <link href="{{ asset('css/dd.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="pages-listing wt-page-builder" id="pages-list">
        <section class="wt-haslayout wt-dbsectionspace">
            <create-new-page
                :parent_pages="'{{  json_encode($parent_page) }}'"
                :section_list="'{{json_encode($sections)}}'"
                :app_styles = "'{{json_encode($app_style_list)}}'"
                :access_type="'{{$access_type}}'"
                :slider_styles="'{{json_encode($slider_style_list)}}'"
            >
            </create-new-page>
        </section>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dd.min.js') }}"></script>	
@endpush
