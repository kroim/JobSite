@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="wt-haslayout wt-email-notification-settings wt-dbsectionspace" id="profile_settings">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="preloader-section" v-if="loading" v-cloak>
                    <div class="preloader-holder">
                        <div class="loader"></div>
                    </div>
                </div>
                <div class="wt-dashboardbox wt-dashboardtabsholder wt-accountsettingholder">
                    @if (file_exists(resource_path('views/extend/back-end/settings/tabs.blade.php'))) 
                        @include('extend.back-end.settings.tabs')
                    @else 
                        @include('back-end.settings.tabs')
                    @endif
                    <div class="wt-tabscontent tab-content">
                        <div class="wt-emailnotiholder" id="wt-emailverification">
                            <div class="wt-emailverification">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{{ trans('lang.verify_email') }}}</h2>
                                </div>
                                <div class="form-group wt-btnarea" v-if="code_send">
                                    <a href="#" class="wt-btn" v-on:click="reSendCode">{{trans('lang.send_verification_code')}}</a>
                                </div>
                                <div class="wt-settingscontent" v-else>
                                    <div class="wt-description">
                                        <p>{{{ trans('lang.verify_code_note') }}}</p>
                                    </div>
                                    <form method="POST" action="" class="wt-formtheme wt-userform">
                                        <fieldset>
                                            <div class="form-group">
                                                <input type="text" v-model="verify_code" name="code" class="form-control" placeholder="{{{ trans('lang.enter_code') }}}">
                                            </div>
                                            <div class="form-group wt-btnarea">
                                                <a href="#" v-on:click.prevent="verifyCode()" class="wt-btn">{{{ trans('lang.submit') }}}</a>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
