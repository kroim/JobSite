{!! Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'menu-setting-form', '@submit.prevent'=>'submitMenuSettings'])!!}
    <div class="wt-securitysettings wt-tabsinfo wt-haslayout">
        <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.color_settings') }}}</h2>
        </div>
        <div class="wt-settingscontent wt-header-color">
            <div class="form-group la-color-picker form-group-half" v-if="show_menu_color">
                <h6>Header Color</h6>
                <verte v-model="color"  model="hex"></verte>
                <input type="hidden" name="menu[color]" :value="color">
            </div>
            <div class="form-group la-color-picker form-group-half" v-if="show_menu_hover_color">
                <h6>Menu color</h6>
               <verte v-model="menu_color"  model="hex"></verte>
                <input type="hidden" name="menu[menu_color]" :value="menu_color">
            </div>
            <div class="form-group la-color-picker form-group-half" v-if="show_menu_hover_color">
                <h6>Menu hover and active color</h6>
                <verte v-model="menu_hover_color" model="hex"></verte>
                <input type="hidden" name="menu[menu_hover_color]" :value="menu_hover_color">
            </div>
        </div>
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.pages_order') }}}</h2>
        </div>
        <page-order></page-order>
        {{-- Custom Link Component --}}
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.custom_links') }}}</h2>
        </div>
        <custom-link></custom-link>
    </div>
    <div class="wt-updatall la-updateall-holder">
        <i class="ti-announcement"></i>
        <span>{{{ trans('lang.save_changes_note') }}}</span>
        {!! Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']) !!}
    </div>
{!! Form::close() !!}
