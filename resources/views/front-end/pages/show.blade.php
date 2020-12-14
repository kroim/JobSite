@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master')
@push('sliderStyle') 
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush
@push('stylesheets')
    <link href="{{ asset('css/prettyPhoto-min.css') }}" rel="stylesheet">
@endpush
@section('title')
        @if ($home == false)
            {{ $page['title'] }}
        @else 
            {{ config('app.name') }} 
        @endif
    @stop
@section('description', "$meta_desc")
@if ($slider_order == 0)
    @if ($slider_style == 'style2' || $slider_style == 'style3')
        @section('homeSlider')
            <div id="slider">
                <div v-if="sliderSkeleton">
                    <slider-skeleton/>
                </div>
                <div v-else>
                    @if ($slider_style == 'style2')
                        <second-slider 
                            :page_id="{{$page['id']}}">
                        </second-slider>
                        @elseif ($slider_style == 'style3') 
                        <third-slider 
                        :page_id="{{$page['id']}}">
                    </third-slider>
                    @endif
                </div>
            </div>
        @endsection
    @endif
@endif
@section('content')
    @if ($home == false)
        @php $breadcrumbs = Breadcrumbs::generate('showPage',$page, $slug); @endphp
        @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php')))
            @include('extend.front-end.includes.inner-banner', 
                ['title' => $page['title'], 'inner_banner' => '', 'pageType' => 'showPage', 'show_banner' => $show_banner_image]
            )
        @else 
            @include('front-end.includes.inner-banner', 
                ['title' =>  $page['title'], 'inner_banner' => '', 'pageType' => 'showPage', 'show_banner' => $show_banner_image]
            )
        @endif
    @endif
    <div id="pages-list">
        @if (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
            @php session()->forget('error'); @endphp
        @endif
        @if ($home == false)
            @if ($show_banner_image == false && !empty($page['title']) && $show_title == true)
                <div class="wt-innerbannercontent wt-without-banner-title">
                    <div class="wt-title">
                        <h2>{{{ $page['title'] }}}</h2>
                    </div>
                </div>
            @endif
        @endif
        @if (!empty($page))
            @if (!empty($sections))
                <show-new-page 
                :page_id="'{{$page['id']}}'" 
                :access_type="'{{$type}}'"
                :symbol="'{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}'"
                :auth_role="'{{Auth::user() ? Auth::user()->getRoleNames()[0] : 'false'}}'"
                :slider_style= "'{{$slider_style}}'"
                >
                </show-new-page>
            @endif
            @if (!empty($description && $description != 'null'))
                <div class="dc-contentwrappers">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">
                                <div class="dc-howitwork-hold dc-haslayout">
                                    <div class="dc-haslayout dc-main-section">
                                        @php echo htmlspecialchars_decode(stripslashes($description)); @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            @if (file_exists(resource_path('views/extend/errors/404.blade.php'))) 
                @include('extend.errors.404')
            @else 
                @include('errors.404')
            @endif
        @endif
        @php
            $page_footer = Helper::getPageFooter($page['id']);
        @endphp
        @if (!empty($page_footer) && $page_footer !== 'style2' && $page_footer !== 'style3')
            @if (!empty($skills)
                || !empty($categories)
                || !empty($locations)
                || !empty($languages))
                <section class="wt-haslayaout wt-main-section wt-footeraboutus">
                    <div class="container">
                        <div class="row">
                            @if (Helper::getAccessType() != 'services')
                                @if ($skills->count() > 0)
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                        <div class="wt-widgetskills">
                                            <div class="wt-fwidgettitle">
                                                <h3>{{ trans('lang.by_skills') }}</h3>
                                            </div>
                                            @if (!empty($skills))
                                                <ul class="wt-fwidgetcontent">
                                                    @foreach ($skills as $skill)
                                                        <li><a href="{{{url('search-results?type=job&skills%5B%5D='.$skill->slug)}}}">{{{ $skill->title }}}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if ($categories->count() > 0)
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                    <div class="wt-footercol wt-widgetcategories">
                                        <div class="wt-fwidgettitle">
                                            <h3>{{ trans('lang.by_cats') }}</h3>
                                        </div>
                                        @if (!empty($categories))
                                            <ul class="wt-fwidgetcontent">
                                                @foreach ($categories as $category)
                                                    <li><a href="{{{url('search-results?type='.$type.'&category%5B%5D='.$category->slug)}}}">{{{ $category->title }}}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if ($locations->count() > 0)
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                    <div class="wt-widgetbylocation">
                                        <div class="wt-fwidgettitle">
                                            <h3>{{ trans('lang.by_locs') }}</h3>
                                        </div>
                                        @if (!empty($locations))
                                            <ul class="wt-fwidgetcontent">
                                                @foreach ($locations as $location)
                                                    <li><a href="{{{url('search-results?type='.$type.'&locations%5B%5D='.$location->slug)}}}">{{{ $location->title }}}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if ($languages->count() > 0)
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                    <div class="wt-widgetbylocation">
                                        <div class="wt-fwidgettitle">
                                            <h3>{{ trans('lang.by_lang') }}</h3>
                                        </div>
                                        @if (!empty($languages))
                                            <ul class="wt-fwidgetcontent">
                                                @foreach ($languages as $language)
                                                    <li><a href="{{{url('search-results?type='.$type.'&languages%5B%5D='.$language->slug)}}}">{{{ $language->title }}}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif
        @endif
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/prettyPhoto-min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    @if ($page_header == 'style5')
        @if (empty($slider_style))
            <script>
                jQuery('.wt-contentwrapper').addClass('inner-header-style5')
            </script>
        @elseif (!empty($slider_style) && $slider_order != 0)
            <script>
                jQuery('.wt-contentwrapper').addClass('inner-header-style5')
            </script>
        @endif
    @elseif ($page_header == 'style3')
        @if (empty($slider_style))
            <script>
                jQuery('.wt-contentwrapper').addClass('inner-header-style3')
            </script>
        @elseif ($slider_style != 'style3') 
            <script>
                jQuery('.wt-contentwrapper').addClass('inner-header-style3')
            </script>
        @endif
    @endif
    @if ($slider_style == 'style2')
        {{-- <script>
            jQuery('#wt-header').addClass('wt-headervthhree')
            jQuery('#wt-header').removeClass('wt-headervtwo')
            jQuery('.wt-formtheme.wt-formbanner.wt-formbannervtwo').remove()
        </script> --}}
        @if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] === 'amentotech.com')
            <script>
                jQuery('.wt-logo a img').attr('src',(APP_URL+'/images/logo-white.png'));
            </script>
        @endif
    @else
    @endif
    <script src="{{ asset('js/tilt.jquery.js') }}"></script>
@endpush
