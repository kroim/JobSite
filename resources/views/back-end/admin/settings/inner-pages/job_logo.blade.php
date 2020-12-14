<div class="wt-settingscontent">
    @if (!empty($job_logo))
        @php
            $image = '/uploads/settings/general/'.$job_logo;
            $file_name = Helper::formateFileName($job_logo);
        @endphp
        <div class="wt-formtheme wt-userform">
            <div v-if="this.job_logo">
                <upload-image
                    :id="'job_logo'"
                    :img_ref="'job_banner_ref'"
                    :url="'{{url('admin/upload-temp-image/job_logo')}}'"
                    :name="'job_logo'"
                    :drop_text="'{{trans('lang.drop_logo')}}'"
                    :btn_text="'{{trans('lang.select_logo')}}'">
                </upload-image>
            </div>
            <div class="wt-uploadingbox" v-else>
                <figure><img src="{{{asset($image)}}}" alt="{{{ trans('lang.banner_photo') }}}"></figure>
                <div class="wt-uploadingbar">
                    <div class="dz-filename">{{{$file_name}}}</div>
                    <em>{{{ trans('lang.file_size') }}}<a href="javascript:void(0);" class="lnr lnr-cross" v-on:click.prevent="removeImage('hidden_job_logo')"></a></em>
                </div>
            </div>
            <input type="hidden" name="inner_page[0][job_logo]" id="hidden_job_logo" value="{{{ $job_logo }}}">
        </div>
    @else
        <div class="wt-formtheme wt-userform">
            <upload-image
                :id="'job_logo'"
                :img_ref="'job_banner_ref'"
                :url="'{{url('admin/upload-temp-image/job_logo')}}'"
                :name="'job_logo'"
                :drop_text="'{{trans('lang.drop_logo')}}'"
                :btn_text="'{{trans('lang.select_logo')}}'">
            </upload-image>
            <input type="hidden" name="inner_page[0][job_logo]" id="hidden_job_logo">
        </div>
    @endif
</div>
