@if (Schema::hasTable('users'))
    @php
    $inner_header = '';
    @endphp
    @if (Schema::hasTable('pages') || Schema::hasTable('site_managements'))
        @php
            $settings = array();
            $pages = App\Page::all();
            $setting = \App\SiteManagement::getMetaValue('settings');
            $page_id='';
            $page_header= !empty($setting[0]['header_style']) ? $setting[0]['header_style'] : '';
            $page_header_styling='';
            $default_header_styling = \App\SiteManagement::getMetaValue('menu_settings');
            $menu_color = !empty($default_header_styling) && !empty($default_header_styling['menu_color']) ? $default_header_styling['menu_color'] : '';
            $menu_hover_color = !empty($default_header_styling) && !empty($default_header_styling['menu_hover_color']) ? $default_header_styling['menu_hover_color'] : '';
            $color = !empty($default_header_styling) && !empty($default_header_styling['color']) ? $default_header_styling['color'] : '';
            $page_order = !empty($default_header_styling) && !empty($default_header_styling['pages']) ? $default_header_styling['pages'] : array();
            $logo = !empty($setting[0]['logo']) ? Helper::getHeaderLogo($setting[0]['logo']) : '/images/logo.png';
            $inner_header = !empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->uri() != '/' ? 'wt-headervtwo' : '';
            $type = Helper::getAccessType();
            if (!empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->uri() != '/' && Route::getCurrentRoute()->uri() != 'home') {
                if (Request::segment(1) == 'page' && !empty(Request::segment(2))) {
                    $selected_page_data = APP\Page::getPageData(Request::segment(2));
                    $selected_page = !empty($selected_page_data) ? APP\Page::find($selected_page_data->id) : '';
                    $page_id = !empty($selected_page) ? $selected_page->id : '';
                    $slider = Helper::getPageSlider($page_id);
                    $page_header = Helper::getPageHeader($page_id);
                    $page_header_styling = !empty($selected_page) && !empty($selected_page->metaValue('header_styling')) 
                                            ? Helper::getUnserializeData($selected_page->metaValue('header_styling')['meta_value']) 
                                            :'';
                    $selected_logo = !empty($page_header_styling) && !empty($page_header_styling['logo']) ? 'uploads/pages/'.$page_id .'/'.$page_header_styling['logo'] : '';
                    $selected_menu_color = !empty($page_header_styling) && !empty($page_header_styling['menuColor']) ? $page_header_styling['menuColor'] : '';
                    $selected_menu_hover_color = !empty($page_header_styling) && !empty($page_header_styling['menuHoverColor']) ? $page_header_styling['menuHoverColor'] : '';    
                    $selected_color =  !empty($page_header_styling) && !empty($page_header_styling['color']) ? $page_header_styling['color'] : '';  
                } elseif (Request::segment(1) == 'search-results') {
                    $inner_page  = App\SiteManagement::getMetaValue('inner_page_data');
                    if (!empty($_GET['type'])) {
                        if ($_GET['type'] == 'freelancer') {
                            $header_styling = !empty($inner_page) && !empty($inner_page[0]['freelancer_header_styling']) ? $inner_page[0]['freelancer_header_styling'] : 'false';
                            if ($header_styling == 'true') {
                                $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['f_menu_color']) ? $inner_page[0]['f_menu_color'] : '';
                                $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['f_hover_color']) ? $inner_page[0]['f_hover_color'] : '';    
                                $selected_color = !empty($inner_page) && !empty($inner_page[0]['f_menu_text_color']) ? $inner_page[0]['f_menu_text_color'] : '';  
                                $selected_logo = !empty($inner_page) && !empty($inner_page[0]['f_logo']) ? 'uploads/settings/general/'.$inner_page[0]['f_logo'] : '';  
                            }
                            $page_header = !empty($inner_page) && !empty($inner_page[0]['f_header_style']) ? $inner_page[0]['f_header_style'] : '';
                        } elseif ($_GET['type'] == 'employer') {
                            $header_styling = !empty($inner_page) && !empty($inner_page[0]['employer_header_styling']) ? $inner_page[0]['employer_header_styling'] : 'false';
                            if ($header_styling == 'true') {
                                $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['e_menu_color']) ? $inner_page[0]['e_menu_color'] : '';
                                $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['e_hover_color']) ? $inner_page[0]['e_hover_color'] : '';    
                                $selected_color = !empty($inner_page) && !empty($inner_page[0]['e_menu_text_color']) ? $inner_page[0]['e_menu_text_color'] : '';  
                                $selected_logo = !empty($inner_page) && !empty($inner_page[0]['e_logo']) ? 'uploads/settings/general/'.$inner_page[0]['e_logo'] : '';  
                            }
                            $page_header = !empty($inner_page) && !empty($inner_page[0]['emp_header_style']) ? $inner_page[0]['emp_header_style'] : '';
                        } elseif ($_GET['type'] == 'job') {
                            $header_styling = !empty($inner_page) && !empty($inner_page[0]['job_header_styling']) ? $inner_page[0]['job_header_styling'] : 'false';
                            if ($header_styling == 'true') {
                                $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['job_menu_color']) ? $inner_page[0]['job_menu_color'] : '';
                                $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['job_hover_color']) ? $inner_page[0]['job_hover_color'] : '';    
                                $selected_color = !empty($inner_page) && !empty($inner_page[0]['job_menu_text_color']) ? $inner_page[0]['job_menu_text_color'] : '';  
                                $selected_logo = !empty($inner_page) && !empty($inner_page[0]['job_logo']) ? 'uploads/settings/general/'.$inner_page[0]['job_logo'] : '';  
                            }
                            $page_header = !empty($inner_page) && !empty($inner_page[0]['job_header_style']) ? $inner_page[0]['job_header_style'] : '';
                        } elseif ($_GET['type'] == 'service') {
                            $header_styling = !empty($inner_page) && !empty($inner_page[0]['service_header_styling']) ? $inner_page[0]['service_header_styling'] : 'false';
                            if ($header_styling == 'true') {
                                $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['service_menu_color']) ? $inner_page[0]['service_menu_color'] : '';
                                $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['service_hover_color']) ? $inner_page[0]['service_hover_color'] : '';    
                                $selected_color = !empty($inner_page) && !empty($inner_page[0]['service_menu_text_color']) ? $inner_page[0]['service_menu_text_color'] : '';  
                                $selected_logo = !empty($inner_page) && !empty($inner_page[0]['service_logo']) ? 'uploads/settings/general/'.$inner_page[0]['service_logo'] : '';  
                            }
                            $page_header = !empty($inner_page) && !empty($inner_page[0]['service_header_style']) ? $inner_page[0]['service_header_style'] : '';
                        }
                    }
                } elseif (Request::segment(1) == 'articles') {
                    $inner_page  = App\SiteManagement::getMetaValue('inner_page_data');
                    $header_styling = !empty($inner_page) && !empty($inner_page[0]['article_header_styling']) ? $inner_page[0]['article_header_styling'] : 'false';
                    if ($header_styling == 'true') {
                        $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['article_menu_color']) ? $inner_page[0]['article_menu_color'] : '';
                        $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['article_hover_color']) ? $inner_page[0]['article_hover_color'] : '';    
                        $selected_color = !empty($inner_page) && !empty($inner_page[0]['article_menu_text_color']) ? $inner_page[0]['article_menu_text_color'] : '';  
                        $selected_logo = !empty($inner_page) && !empty($inner_page[0]['article_logo']) ? 'uploads/settings/general/'.$inner_page[0]['article_logo'] : '';  
                    }
                    $page_header = !empty($inner_page) && !empty($inner_page[0]['article_header_style']) ? $inner_page[0]['article_header_style'] : '';
                }
            } else {
                $page_id = APP\SiteManagement::getMetaValue('homepage')['home'];
                $slider = Helper::getPageSlider($page_id);
                $page_header = Helper::getPageHeader($page_id);
            }
            if (($page_header == 'style4' || $page_header == 'style5') && empty($menu_color)) {
                $menu_color = '#ffffff';
            }
            //$selected_header = !empty($setting[0]['header_style']) ? $setting[0]['header_style'] : '';
            if ($page_header == 'style5') {
                $categories = App\Category::all()->toArray();
            }
        @endphp
    @endif
    @php
        $logo =  !empty($selected_logo) ? $selected_logo : $logo;
        $menu_color =  !empty($selected_menu_color) ? $selected_menu_color : $menu_color;
        $menu_hover_color =  !empty($selected_menu_hover_color) ? $selected_menu_hover_color : $menu_hover_color;
        $color =  !empty($selected_color) ? $selected_color : $color;
    @endphp
    @push('stylesheets')
        <style>
            .wt-header .wt-navigation>ul>.menu-item-has-children:after,
            .wt-header .wt-navigation > ul > li > a {
                color: {{$menu_color}};
            }
            @media (max-width: 991px) {
                .wt-header .wt-navigation>ul>.menu-item-has-children:after, 
                .wt-header .wt-navigation > ul > li > a {
                    color:{{$menu_color =='#ffffff' ? '#767676' : $menu_color}};
                }
            }
            .wt-navigation > ul > li.current-menu-item > a,
            .wt-navigation ul li .sub-menu > li:hover > a,
            .wt-navigation > ul > li:hover > a{
                color: {{$menu_hover_color}};
            }
            .wt-header .wt-navigationarea .wt-navigation > ul > li > a:after{
                background: {{$menu_hover_color}};
            }
            .wt-header .wt-navigationarea .wt-userlogedin .wt-username span,
            .wt-header .wt-navigationarea .wt-userlogedin .wt-username h3 {color: {{$color}} };
        </style>
    @endpush
    @if (!empty($page_header))
        @if ($page_header == 'style1')
            @if (file_exists(resource_path('views/extend/includes/headers/header1.blade.php'))) 
                @include('extend.includes.headers.header1', ['page_order' => $page_order])
            @else 
                @include('includes.headers.header1', ['page_order' => $page_order])
            @endif
        @elseif ($page_header == 'style2')
            @if (file_exists(resource_path('views/extend/includes/headers/header2.blade.php'))) 
                @include('extend.includes.headers.header2', ['styling' => $page_header_styling])
            @else 
                @include('includes.headers.header2', ['styling' => $page_header_styling])
            @endif
        @elseif ($page_header == 'style3')
            @if (file_exists(resource_path('views/extend/includes/headers/header3.blade.php'))) 
                @include('extend.includes.headers.header3', ['styling' => $page_header_styling])
            @else 
                @include('includes.headers.header3', ['styling' => $page_header_styling])
            @endif
        @elseif ($page_header == 'style4')
            @if (file_exists(resource_path('views/extend/includes/headers/header4.blade.php'))) 
                @include('extend.includes.headers.header4', ['styling' => $page_header_styling])
            @else 
                @include('includes.headers.header4', ['styling' => $page_header_styling])
            @endif  
        @elseif ($page_header == 'style5')
            @if (file_exists(resource_path('views/extend/includes/headers/header5.blade.php'))) 
                @include('extend.includes.headers.header5', ['styling' => $page_header_styling])
            @else 
                @include('includes.headers.header5', ['styling' => $page_header_styling])
            @endif      
        @endif
    @elseif (!empty($slider) && $slider['index'] == 0) 
        @if (!empty($slider['style']) && $slider['style'] == 'style3')
            <header id="wt-header" class="wt-header wt-headervfour wt-haslayout">
                <div class="wt-navigationarea">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                @if (!empty($logo) || Schema::hasTable('site_managements'))
                                    <strong class="wt-logo"><a href="{{{ url('/') }}}"><img src="{{{ asset($logo) }}}" alt="{{{ trans('Logo') }}}"></a></strong>
                                @endif
                                <div class="wt-rightarea">
                                    @guest
                                        <div class="wt-loginarea">
                                            <div class="wt-loginoption">
                                                <a href="javascript:void(0);" id="wt-loginbtn" class="wt-loginbtn">{{{trans('lang.login') }}}</a>
                                                <div class="wt-loginformhold" @if ($errors->has('email') || $errors->has('password')) style="display: block;" @endif>
                                                    <div class="wt-loginheader">
                                                        <span>{{{ trans('lang.login') }}}</span>
                                                        <a href="javascript:;"><i class="fa fa-times"></i></a>
                                                    </div>
                                                    <form method="POST" action="{{ route('login') }}" class="wt-formtheme wt-loginform do-login-form">
                                                        @csrf
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                                    placeholder="Email" required autofocus>
                                                                @if ($errors->has('email'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                                    placeholder="Password" required>
                                                                @if ($errors->has('password'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="wt-logininfo">
                                                                    <button type="submit" class="wt-btn do-login-button">{{{ trans('lang.login') }}}</button>
                                                                <span class="wt-checkbox">
                                                                    <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                    <label for="remember">{{{ trans('lang.remember') }}}</label>
                                                                </span>
                                                            </div>
                                                        </fieldset>
                                                        <div class="wt-loginfooterinfo">
                                                            @if (Route::has('password.request'))
                                                                <a href="{{ route('password.request') }}" class="wt-forgot-password">{{{ trans('lang.forget_pass') }}}</a>
                                                            @endif
                                                            <a href="{{{ route('register') }}}">{{{ trans('lang.create_account') }}}</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <a href="{{{ route('register') }}}" class="wt-btn">{{{ trans('lang.join_now') }}}</a>
                                        </div>
                                    @endguest
                                    @auth
                                        @php
                                            $user = !empty(Auth::user()) ? Auth::user() : '';
                                            $role = !empty($user) ? $user->getRoleNames()->first() : array();
                                            $profile = \App\User::find(Auth::user()->id)->profile;
                                            $user_image = !empty($profile) ? $profile->avater : '';
                                            $employer_job = \App\Job::select('status')->where('user_id', Auth::user()->id)->first();
                                            $profile_image = !empty($user_image) ? '/uploads/users/'.$user->id.'/'.$user_image : 'images/user-login.png';
                                            $payment_settings = \App\SiteManagement::getMetaValue('commision');
                                            $payment_module = !empty($payment_settings) && !empty($payment_settings[0]['enable_packages']) ? $payment_settings[0]['enable_packages'] : 'true';
                                            $employer_payment_module = !empty($payment_settings) && !empty($payment_settings[0]['employer_package']) ? $payment_settings[0]['employer_package'] : 'true';
                                        @endphp
                                        <div class="wt-userlogedin">
                                            <figure class="wt-userimg">
                                                <img src="{{{ asset(Helper::getImage('uploads/users/' . Auth::user()->id, $profile->avater, '' , 'user.jpg')) }}}" alt="{{{ trans('lang.user_avatar') }}}">
                                            </figure>
                                            <div class="wt-username">
                                                <h3>{{{ Helper::getUserName(Auth::user()->id) }}}</h3>
                                                <span>{{{ !empty(Auth::user()->profile->tagline) ? str_limit(Auth::user()->profile->tagline, 26, '') : Helper::getAuthRoleName() }}}</span>
                                            </div>
                                            @if (file_exists(resource_path('views/extend/back-end/includes/profile-menu.blade.php'))) 
                                                @include('extend.back-end.includes.profile-menu')
                                            @else 
                                                @include('back-end.includes.profile-menu')
                                            @endif
                                        </div>
                                    @endauth
                                </div>
                                @if (file_exists(resource_path('views/extend/includes/menu.blade.php'))) 
                                    @include('extend.includes.menu')
                                @else 
                                    @include('includes.menu')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        @else
            @if (file_exists(resource_path('views/extend/includes/headers/header1.blade.php'))) 
                @include('extend.includes.headers.header1', ['styling' => $page_header_styling])
            @else 
                @include('includes.headers.header1', ['styling' => $page_header_styling])
            @endif
        @endif
    @else
        @if (file_exists(resource_path('views/extend/includes/headers/header1.blade.php'))) 
            @include('extend.includes.headers.header1', ['styling' => $page_header_styling])
        @else 
            @include('includes.headers.header1', ['styling' => $page_header_styling])
        @endif
    @endif
@endif

