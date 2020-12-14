<div class="wt-tabscontenttitle">
    <h2>{{{ trans('lang.add_socials') }}}</h2>
</div>
    @if (file_exists(resource_path('views/extend/back-end/admin/settings/footer/socials.blade.php')))
        @include('extend.back-end.admin.settings.footer.socials')
    @else
        @include('back-end.admin.settings.footer.socials')
    @endif
    {!! Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id'
        =>'footer-setting-form', '@submit.prevent'=>'submitFooterSettings']) !!}
        @if (file_exists(resource_path('views/extend/back-end/admin/settings/footer/logo.blade.php')))
            @include('extend.back-end.admin.settings.footer.logo')
        @else
            @include('back-end.admin.settings.footer.logo')
        @endif
        @if (file_exists(resource_path('views/extend/back-end/admin/settings/footer/background.blade.php')))
            @include('extend.back-end.admin.settings.footer.background')
        @else
            @include('back-end.admin.settings.footer.background')
        @endif
        <div class="wt-location wt-tabsinfo">
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.footer_style') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="amt-section-select amt-profile-settings">
                    <ul class="at-profile-setting__imgs">
                        <li v-for="(style, index) in getFooterStyles()" :key="index">
                        <input 
                            type="radio" 
                            name="footer[footer_style]"  
                            :id="'footer_image'+index"
                            :checked="style.value == '{{$selected_footer}}'"  
                            :value="style.value"
                        >
                            <label :for="'footer_image'+index">
                                <span>
                                    <img :src='style.img' alt="Image Description">
                                    <span class="at-tick"><span><i class="fas fa-check"></i></span></span>
                                </span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="wt-location wt-tabsinfo">
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.about_us_note') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::textarea('footer[description]', e($footer_desc), array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.copyright_text') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::text('footer[copyright]', e($footer_copyright), array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.footer_menu_1') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::text('footer[menu_title_1]', $menu_title_1 ,array('class' => 'form-control', 'placeholder' => trans('lang.menu_title'))) !!}
                    </div>
                </div>
            </div>
            <div class="wt-settingscontent la-footer-settings">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <span class="wt-select">
                            {!! Form::select('footer[menu_pages_1][]', $pages, $menu_pages_1 ,array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_pages'))) !!}
                        </span>
                    </div>
                </div>
            </div>
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.footer_menu') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <span class="wt-select">
                            {!! Form::select('footer[pages][]', $pages, $menu_pages ,array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_pages'))) !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="wt-updatall la-updateall-holder">
            <i class="ti-announcement"></i>
            <span>{{{ trans('lang.save_changes_note') }}}</span>
            {!! Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']) !!}
        </div>
        {{-- <div class="wt-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'wt-btn']) !!}
        </div> --}}
    {!! Form::close() !!}
    <div class="wt-settingscontent">
        @if (file_exists(resource_path('views/extend/back-end/admin/settings/footer/search-menu.blade.php')))
            @include('extend.back-end.admin.settings.footer.search-menu')
        @else
            @include('back-end.admin.settings.footer.search-menu')
        @endif
    </div>
