<div class="wt-settingscontent">
    @if (!empty($e_logo))
        @php
            $image = '/uploads/settings/general/'.$e_logo;
            $file_name = Helper::formateFileName($e_logo);
        @endphp
        <div class="wt-formtheme wt-userform">
            <div v-if="e_logo">
                <upload-image
                    :id="'e_logo'"
                    :img_ref="'e_banner_ref'"
                    :url="'{{url('admin/upload-temp-image/e_logo')}}'"
                    :name="'e_logo'"
                    :drop_text="'{{trans('lang.drop_logo')}}'"
                    :btn_text="'{{trans('lang.select_logo')}}'">
                </upload-image>
            </div>
            <div class="wt-uploadingbox" v-else>
                <figure><img src="{{{asset($image)}}}" alt="{{{ trans('lang.banner_photo') }}}"></figure>
                <div class="wt-uploadingbar">
                    <div class="dz-filename">{{{$file_name}}}</div>
                    <em>{{{ trans('lang.file_size') }}}<a href="javascript:void(0);" class="lnr lnr-cross" v-on:click.prevent="removeImage('hidden_e_logo')"></a></em>
                </div>
            </div>
            <input type="hidden" name="inner_page[0][e_logo]" id="hidden_e_logo" value="{{{ $e_logo }}}">
        </div>
    @else
        <div class="wt-formtheme wt-userform">
            <upload-image
                :id="'e_logo'"
                :img_ref="'e_banner_ref'"
                :url="'{{url('admin/upload-temp-image/e_logo')}}'"
                :name="'e_logo'"
                :drop_text="'{{trans('lang.drop_logo')}}'"
                :btn_text="'{{trans('lang.select_logo')}}'">
            </upload-image>
            <input type="hidden" name="inner_page[0][e_logo]" id="hidden_e_logo">
        </div>
    @endif
</div>
