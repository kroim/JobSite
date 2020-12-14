@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 'extend.front-end.master' : 'front-end.master')
@section('content')
    @php
        if (Schema::hasTable('site_managements')) {
            $breadcrumbs_settings = \App\SiteManagement::getMetaValue('show_breadcrumb');
            $show_breadcrumbs = !empty($breadcrumbs_settings) ? $breadcrumbs_settings : 'true';
        } else {
            $show_breadcrumbs ='';
        }
        $breadcrumbs = Breadcrumbs::generate('notFound');
    @endphp
    @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php'))) 
        @include('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.404_error'), 'inner_banner' => '', 'show_banner' => 'true' ]
        )
    @else 
        @include('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.404_error'), 'inner_banner' => '', 'show_banner' => 'true' ]
        )
    @endif
    <div class="wt-haslayout wt-main-section">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-10 push-md-1 col-lg-8 push-lg-2">
                    <div class="wt-404errorpage">
                        <figure class="wt-404errorimg"><img src="{{{ asset('images/404-img.jpg') }}}" alt="{{ trans('lang.404_img') }}"></figure>
                        <div class="wt-404errorcontent">
                            <div class="wt-title">
                                <h3>{{ trans('lang.link_crashed') }}</h3>
                            </div>
                            <div class="wt-description">
                                <p>{{ trans('lang.crashed_note') }} <a href="{{{ url('/') }}}">{{ trans('lang.homepage') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection