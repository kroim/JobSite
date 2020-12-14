<nav id="wt-nav" class="wt-nav navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="lnr lnr-menu"></i>
    </button>
    <div class="collapse navbar-collapse wt-navigation" id="navbarNav">
        <ul class="navbar-nav">
            @if (!empty($pages) || Schema::hasTable('pages'))
                @php $order=''; $page_order=''; @endphp
                @foreach ($pages as $key => $page)
                    @php
                        $page_order = DB::table('metas')
                                        ->select('meta_value')
                                        ->where('meta_key', 'page_order')
                                        ->where('metable_type', 'App\Page')
                                        ->where('metable_id', $page->id)->first();
                        $order = !empty($page_order->meta_value) ? $page_order->meta_value : '';
                        $page_has_child = App\Page::pageHasChild($page->id); $pageID = Request::segment(2);
                        $show_page = \App\SiteManagement::where('meta_key', 'show-page-'.$page->id)->select('meta_value')->pluck('meta_value')->first();
                    @endphp
                    @if ($page->relation_type == 0 && ($show_page == 'true' || $show_page == true))
                        <li 
                            class="{{!empty($page_has_child) ? 'menu-item-has-children page_item_has_children' : '' }} @if ($pageID == $page->slug ) current-menu-item @endif"
                            style="{{!empty($order) ? 'order:'.$order : 'order:99' }}"
                        >
                            <a href="{{url('page/'.$page->slug)}}">{{{$page->title}}}</a>
                            @if (!empty($page_has_child))
                                <ul class="sub-menu">
                                    @foreach($page_has_child as $parent)
                                        @php $child = App\Page::getChildPages($parent->child_id);@endphp
                                        @if (!empty($child))
                                            <li class="@if ($pageID == $child->slug ) current-menu-item @endif">
                                                <a href="{{url('page/'.$child->slug.'/')}}">
                                                    {{{$child->title}}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            @endif
            @php
                $inner_page  = App\SiteManagement::getMetaValue('inner_page_data');
                $add_f_navbar = !empty($inner_page) && !empty($inner_page[0]['add_f_navbar']) ? $inner_page[0]['add_f_navbar'] : '';
                $add_emp_navbar = !empty($inner_page) && !empty($inner_page[0]['add_emp_navbar']) ? $inner_page[0]['add_emp_navbar'] : '';
                $add_job_navbar = !empty($inner_page) && !empty($inner_page[0]['add_job_navbar']) ? $inner_page[0]['add_job_navbar'] : '';
                $add_service_navbar = !empty($inner_page) && !empty($inner_page[0]['add_service_navbar']) ? $inner_page[0]['add_service_navbar'] : '';
                $add_article_navbar = !empty($inner_page) && !empty($inner_page[0]['add_article_navbar']) ? $inner_page[0]['add_article_navbar'] : '';
                $menu_settings  = App\SiteManagement::getMetaValue('menu_settings');
                $freelancer_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'freelancers') : ""; 
                $employer_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'employers') : ''; 
                $job_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'jobs') : ''; 
                $service_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'services') : ''; 
                $article_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'articles') : ''; 
            @endphp
            @if ($add_article_navbar !== 'false')
                <li style="{{!empty($article_order) ? 'order:'.$article_order : 'order:99' }}">
                    <a href="{{url('articles')}}">
                        {{{ trans('lang.articles') }}}
                    </a>
                </li>
            @endif
            @if ($add_f_navbar !== 'false')
                <li style="{{!empty($freelancer_order) ? 'order:'.$freelancer_order : 'order:99' }}">
                    <a href="{{url('search-results?type=freelancer')}}">
                        {{{ trans('lang.view_freelancers') }}}
                    </a>
                </li>
            @endif
            @if ($add_emp_navbar !== 'false')
            <li style="{{!empty($employer_order) ? 'order:'.$employer_order : 'order:99' }}">
                <a href="{{url('search-results?type=employer')}}">
                    {{{ trans('lang.view_employers') }}}
                </a>
            </li>
            @endif
            @if ($add_job_navbar !== 'false')
                @if ($type =='jobs' || $type == 'both')
                    <li style="{{!empty($job_order) ? 'order:'.$job_order : 'order:99' }}">
                        <a href="{{url('search-results?type=job')}}">
                            {{{ trans('lang.browse_jobs') }}}
                        </a>
                    </li>
                @endif
            @endif
            @if ($add_service_navbar !== 'false')
                @if ($type =='services' || $type == 'both')
                    <li style="{{!empty($service_order) ? 'order:'.$service_order : 'order:99' }}">
                        <a href="{{url('search-results?type=service')}}">
                            {{{ trans('lang.browse_services') }}}
                        </a>
                    </li>
                @endif
            @endif
            @php 
                $order=''; $page_order=''; 
                $custom_menus = !empty($menu_settings['custom_links']) ? $menu_settings['custom_links'] : '';
                // dd($custom_menus);
            @endphp
            @if (!empty($custom_menus))
                @foreach($custom_menus as $custom_key => $custom_value)
                    @if ($custom_value['relation_type'] == 'parent')
                        @php 
                            $order = Helper::getCustomMenuPageOrder($custom_value['custom_slug']);
                        @endphp
                        <li style="{{!empty($order) ? 'order:'.$order : 'order:99' }}">
                            <a href="{{ empty($custom_value['custom_link']) || $custom_value['custom_link'] == '#' ? 'javascript:void(0)' : $custom_value['custom_link'] }}">
                                {{$custom_value['custom_title']}}
                            </a>
                            @php 
                            $custom_menu_child = Helper::getCustomMenuChild($custom_value['custom_slug']);
                            @endphp
                            @if (!empty($custom_menu_child))
                                <ul class="sub-menu">
                                    @foreach($custom_menu_child as $custom_child)
                                        @if (!empty($custom_child) && !empty($custom_child['type']) && $custom_child['type'] == 'custom_menu')
                                            <li>
                                                <a href="{{empty($custom_child['link']) || $custom_child['link'] == '#' ? 'javascript:void(0)' : $custom_child['link']}}">
                                                    {{{$custom_child['title']}}}
                                                </a>
                                            </li>
                                        @elseif (!empty($custom_child)) 
                                            <li class="@if ($pageID == $custom_child['slug'] ) current-menu-item @endif">
                                                <a href="{{url('page/'.$custom_child['slug'].'/')}}">
                                                    {{{$custom_child['title']}}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</nav>
@push('scripts')
    
<script>
    jQuery(window).load(function () {
        var element_width = $('#wt-nav').width();
        if (element_width > 540) {
            $("#wt-nav").removeClass("navbar-expand-lg")
            $("#wt-nav").addClass("navbar-expand-xl")
            $("header").addClass('wt-headerwrap')
        } 
    });
</script>
@endpush