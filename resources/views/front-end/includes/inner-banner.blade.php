@if (Schema::hasTable('site_managements'))
    @php 
        $setting = \App\SiteManagement::getMetaValue('settings');
        $hide_banner = 'false';
        if (Request::segment(1) == 'page' && !empty(Request::segment(2))) {
            $selected_page_data = APP\Page::getPageData(Request::segment(2));
            $selected_page = !empty($selected_page_data) ? APP\Page::find($selected_page_data->id) : '';
            $page_id = !empty($selected_page) ? $selected_page->id : '';
            $slider = Helper::getPageSlider($page_id);
            $selected_header = Helper::getPageHeader($page_id);
        } elseif (Request::segment(1) == 'search-results') {
            $inner_page  = App\SiteManagement::getMetaValue('inner_page_data');
            if (!empty($_GET['type'])) {
                if ($_GET['type'] == 'freelancer') {
                    $selected_header = !empty($inner_page) && !empty($inner_page[0]['f_header_style']) ? $inner_page[0]['f_header_style'] : '';
                } elseif ($_GET['type'] == 'employer') {
                    $selected_header = !empty($inner_page) && !empty($inner_page[0]['emp_header_style']) ? $inner_page[0]['emp_header_style'] : '';
                } elseif ($_GET['type'] == 'job') {
                    $selected_header = !empty($inner_page) && !empty($inner_page[0]['job_header_style']) ? $inner_page[0]['job_header_style'] : '';
                } elseif ($_GET['type'] == 'service') {
                    $selected_header = !empty($inner_page) && !empty($inner_page[0]['service_header_style']) ? $inner_page[0]['service_header_style'] : '';
                }
            }
        } elseif (Request::segment(1) == 'articles') {
            $inner_page  = App\SiteManagement::getMetaValue('inner_page_data');
            $selected_header = !empty($inner_page) && !empty($inner_page[0]['article_header_style']) ? $inner_page[0]['article_header_style'] : '';
        }
        if (empty($selected_header)) {
            $selected_header = !empty($setting[0]['header_style']) ? $setting[0]['header_style'] : ''; 
        }
        $inner_header_style4_bg = !empty($selected_header) && $selected_header == 'style4' ? 'wt-gradientbg4' : '';
    @endphp
@endif
@if (!empty($selected_header) && ($selected_header == 'style4' || $selected_header == 'style2'))
    @php $hide_banner = !empty($show_banner) && $show_banner == 'true' ? 'false' : 'true';   @endphp
    @if($hide_banner == 'false')
        @if (!empty($pageType) && $pageType == 'showPage')
            <div id="wt-innerbannerholdertwo" class="wt-haslayout wt-innerbannerholdertwo" style="background-image:url({{{ !empty($banner) ? asset($banner) : ''}}})">
        @elseif (!empty($path))
            <div id="wt-innerbannerholdertwo" class="wt-haslayout wt-innerbannerholdertwo {{$inner_header_style4_bg}}" style="background-image:url({{{ !empty($show_banner) && $show_banner == 'true' ? asset(Helper::getBannerImage($inner_banner, $path)) : ''}}})">
        @else
            <div id="wt-innerbannerholdertwo" class="wt-haslayout wt-innerbannerholdertwo {{$inner_header_style4_bg}}" style="background-image:url({{{ !empty($show_banner) && $show_banner == 'true' ? asset(Helper::getBannerImage($inner_banner, 'uploads/settings/general')) : '' }}})">
        @endif
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-12 col-lg-4">
                            <div class="wt-innerbannercontent wt-bannertitletwo">
                                @if (!empty($pageType) && $pageType == 'showPage' )
                                    @if (!empty($page) && $show_title == true)
                                        <div class="wt-title">
                                            <h2>{{{ $page['title'] }}}</h2>
                                        </div>
                                    @endif
                                @else
                                    <div class="wt-title"><h1>{{ $title }}</h1></div>	
                                @endif
                                @if (!empty($show_breadcrumbs) && $show_breadcrumbs === 'true')
                                    <ol class="wt-breadcrumb">
                                        @if (!empty($breadcrumbs))
                                            @foreach ($breadcrumbs as $breadcrumb)
                                                @if ($breadcrumb->url && !$loop->last)
                                                    <li><a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a></li>
                                                @else
                                                    <li class="active">{{{ $breadcrumb->title }}}</li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ol>
                                @endif						       
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="wt-bannercontent wt-bannercontentseven">
                                <search-form
                                    :widget_type="'home'"
                                    :placeholder="'{{ trans('lang.looking_for') }}'"
                                    :freelancer_placeholder="'{{ trans('lang.search_filter_list.freelancer') }}'"
                                    :employer_placeholder="'{{ trans('lang.search_filter_list.employers') }}'"
                                    :job_placeholder="'{{ trans('lang.search_filter_list.jobs') }}'"
                                    :service_placeholder="'{{ trans('lang.search_filter_list.services') }}'"
                                    :no_record_message="'{{ trans('lang.no_record') }}'"
                                    :style_type="'new'"
                                    >
                                </search-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
@else
    @if (!empty($show_banner) && $show_banner == 'true')
        @if (!empty($pageType) && $pageType == 'showPage' )
        <div class="wt-haslayout wt-innerbannerholder" style="background-image:url({{{ asset($banner) }}})">
        @elseif (!empty($path))
        <div class="wt-haslayout wt-innerbannerholder" style="background-image:url({{{ asset(Helper::getBannerImage($inner_banner, $path)) }}})">
        @else 
        <div class="wt-haslayout wt-innerbannerholder" style="background-image:url({{{ asset(Helper::getBannerImage($inner_banner, 'uploads/settings/general')) }}})">
        @endif        
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                        <div class="wt-innerbannercontent">
                            <div class="wt-title"><h2>{{ $title }}</h2></div>
                            @if (!empty($show_breadcrumbs) && $show_breadcrumbs === 'true')
                                <ol class="wt-breadcrumb">
                                    @if (!empty($breadcrumbs))
                                        @foreach ($breadcrumbs as $breadcrumb)
                                            @if ($breadcrumb->url && !$loop->last)
                                                <li><a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a></li>
                                            @else
                                                <li class="active">{{{ $breadcrumb->title }}}</li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ol>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
@push('scripts')
@if (!empty($selected_header) && ($selected_header == 'style4' || $selected_header == 'style2') && Request::segment(1) == 'search-results')
    @if($hide_banner !== 'false')
        <script>
            $('main').css('margin-top','65px');
        </script>
    @endif
@endif
@endpush