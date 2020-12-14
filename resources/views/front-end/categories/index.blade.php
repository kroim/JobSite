@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] )
@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('categoriesListing'); @endphp
    @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php'))) 
        @include('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.cat_listing'), 'inner_banner' => '' , 'show_banner' => 'true']
        )
    @else 
        @include('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.cat_listing'), 'inner_banner' => '', 'show_banner' => 'true']
        )
    @endif
    <div class="wt-haslayout wt-main-section" id="jobs">
        @if (Session::has('payment_message'))
            @php $response = Session::get('payment_message') @endphp
            <div class="flash_msg">
                <flash_messages :message_class="'{{{$response['code']}}}'" :time ='5' :message="'{{{ $response['message'] }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <div class="wt-haslayout">
            <div class="container">
                <div class="row">
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 col-xl-9 float-left">
                            <div class="wt-companysinfoholder">
                                <div class="row">
                                    @foreach($categories as $category)
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                                            <div class="wt-companysdetails">
                                                <figure class="wt-companysimg">
                                                    <img src="{{{ asset('/images/banner.jpg') }}}" alt="{{ trans('lang.img') }}">
                                                </figure>
                                                <div class="wt-companysinfo">
                                                    <figure><img src="{{{ asset(\App\Helper::getCategoryImage($category->image)) }}}" alt="{{{ $category->title }}}"></figure>
                                                    <div class="wt-title">
                                                        <h2>{{{ $category->title }}}</h2>
                                                    </div>
                                                    <div class="wt-description">
                                                        <p>{{{ $category->abstract }}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection