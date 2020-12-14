<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2>{{{ trans('lang.footer_bg') }}}</h2>
    </div>
    <div class="wt-settingscontent">
        @if (!empty($footer_bg)) 
            @php $image = '/uploads/settings/footer/'.$footer_bg; @endphp
            <div class="wt-formtheme wt-userform">
                <div v-if="this.footer_bg">
                    <upload-image 
                        :id="'footer_bg'" 
                        :img_ref="'footer_bg_ref'" 
                        :url="'{{url('admin/upload-temp-image/footer_bg')}}'" 
                        :name="'footer_bg'"
                        >
                    </upload-image>
                </div>
                <div class="wt-uploadingbox" v-else>
                    <figure><img src="{{{asset($image)}}}" alt="{{{ trans('lang.footer_bg') }}}"></figure>
                    <div class="wt-uploadingbar">
                        <div class="dz-filename">{{{$footer_bg}}}</div>
                        <em>{{{ trans('lang.file_size') }}}<a href="javascript:void(0);" class="lnr lnr-cross" v-on:click.prevent="removeImage('hidden_site_footer_bg')"></a></em>
                    </div>
                </div>
                <input type="hidden" name="footer[footer_bg]" id="hidden_site_footer_bg" value="{{{$footer_bg}}}">
            </div>
        @else
            <div class="wt-formtheme wt-userform">
                <upload-image 
                    :id="'footer_bg'" 
                    :img_ref="'footer_bg_ref'" 
                    :url="'{{url('admin/upload-temp-image/footer_bg')}}'" 
                    :name="'footer_bg'"
                    >
                </upload-image>
                <input type="hidden" name="footer[footer_bg]" id="hidden_site_footer_bg">
            </div>
        @endif
    </div>
</div>