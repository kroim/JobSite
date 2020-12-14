<div class="wt-settingscontent">
    @if (!empty($f_logo))
        @php
            $image = '/uploads/settings/general/'.$f_logo;
            $file_name = Helper::formateFileName($f_logo);
        @endphp
        <div class="wt-formtheme wt-userform">
            <div v-if="f_logo">
                <upload-image
                    :id="'f_logo'"
                    :img_ref="'f_banner_ref'"
                    :url="'{{url('admin/upload-temp-image/f_logo')}}'"
                    :name="'f_logo'"
                    :drop_text="'{{trans('lang.drop_logo')}}'"
                    :btn_text="'{{trans('lang.select_logo')}}'">
                </upload-image>
            </div>
            <div class="wt-uploadingbox" v-else>
                <figure><img src="{{{asset($image)}}}" alt="{{{ trans('lang.banner_photo') }}}"></figure>
                <div class="wt-uploadingbar">
                    <div class="dz-filename">{{{$file_name}}}</div>
                    <em>{{{ trans('lang.file_size') }}}<a href="javascript:void(0);" class="lnr lnr-cross" v-on:click.prevent="removeImage('hidden_f_logo')"></a></em>
                </div>
            </div>
            <input type="hidden" name="inner_page[0][f_logo]" id="hidden_f_logo" value="{{{ $f_logo }}}">
        </div>
    @else
        <div class="wt-formtheme wt-userform">
            <upload-image
                :id="'f_logo'"
                :img_ref="'f_banner_ref'"
                :url="'{{url('admin/upload-temp-image/f_logo')}}'"
                :name="'f_logo'"
                :drop_text="'{{trans('lang.drop_logo')}}'"
                :btn_text="'{{trans('lang.select_logo')}}'">
            </upload-image>
            <input type="hidden" name="inner_page[0][f_logo]" id="hidden_f_logo">
        </div>
    @endif
</div>
