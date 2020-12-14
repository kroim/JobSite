@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] )
@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('raiseDispute'); @endphp
    @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php'))) 
        @include('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.dispute'), 'inner_banner' => '', 'show_banner' => 'true' ]
        )
    @else 
        @include('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.dispute'), 'inner_banner' => '', 'show_banner' => 'true' ]
        )
    @endif
    <div class="wt-main-section wt-paddingtopnull wt-haslayout" id="jobs">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                    <div class="preloader-section" v-if="loading" v-cloak>
                        <div class="preloader-holder">
                            <div class="loader"></div>
                        </div>
                    </div>
                    <div class="wt-proposalholder wt-haslayout">
                        <div class="proposalhead">
                            <h3>{{ trans('lang.raise_dispute_text') }}</h3>
                            <a href="{{{ url('job/'.$job->slug) }}}">{{{ $job->title }}}</a>
                        </div>
                        <div class="wt-proposalamount-holder">
                            {!! Form::open([
                                'url' => '', 'class' =>'"wt-formtheme wt-formproposal',
                                'id' => 'dispute-form', '@submit.prevent' => 'submitDispute("'.$job->id.'")'])
                            !!}
                                <div class="wt-tabscontenttitle"><span>{{ trans('lang.reason_for_dispute') }}</span></div>
                                <div class="form-group">
                                    <span class="wt-select">
                                        {!! Form::select('reason', $reasons, null, array('class' => 'form-control', 'data-placeholder' => trans('lang.select_reason'))) !!}
                                    </span>
                                </div>
                                <div class="wt-tabscontenttitle"><span>{{ trans('lang.dispute_question') }}</span></div>
                                <div class="form-group">
                                        {!! Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => trans('lang.dispute_desc'))) !!}
                                </div>
                                <div class="wt-btnarea">
                                    {!! Form::submit(trans('lang.btn_submit'), ['class' => 'wt-btn']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
