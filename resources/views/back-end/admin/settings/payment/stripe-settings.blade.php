{!! Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform wt-stripe-form', 'id' =>'stripe-form', '@submit.prevent'=>'submitStripeSettings'])!!}
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.stripe_settings') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    {!! Form::text('stripe_key', e($stripe_key), ['class' => 'form-control', 'placeholder' => trans('lang.stripe_key')]) !!}
                </div>
            </div>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    {!! Form::text('stripe_secret', e($stripe_secret), ['class' => 'form-control', 'placeholder' => trans('lang.stripe_secret')]) !!}
                </div>
            </div>
        </div>
        <div class="wt-settingscontent">
            @if (!empty($stripe_img)) 
                @php $image = '/uploads/settings/payment/'.$stripe_img; @endphp
                <div class="wt-formtheme wt-userform">
                    <div v-if="this.stripe_img">
                        <upload-image 
                            :id="'stripe_img'" 
                            :img_ref="'stripe_img_ref'" 
                            :url="'{{url('admin/upload-temp-image/stripe_img')}}'" 
                            :name="'stripe_img'"
                            :drop_text="trans('lang.upload_payment_method')">
                        </upload-image>
                    </div>
                    <div class="wt-uploadingbox" v-else>
                        <figure><img src="{{{asset($image)}}}" alt="{{{ trans('lang.stripe_img') }}}"></figure>
                        <div class="wt-uploadingbar">
                            <div class="dz-filename">{{{$stripe_img}}}</div>
                            <em>{{{ trans('lang.file_size') }}}<a href="javascript:void(0);" class="lnr lnr-cross" v-on:click.prevent="removeImage('hidden_site_stripe_img')"></a></em>
                        </div>
                    </div>
                    <input type="hidden" name="stripe_img" id="hidden_site_stripe_img" value="{{{$stripe_img}}}">
                </div>
            @else
                <div class="wt-formtheme wt-userform">
                    <upload-image 
                        :id="'stripe_img'" 
                        :img_ref="'stripe_img_ref'" 
                        :url="'{{url('admin/upload-temp-image/stripe_img')}}'" 
                        :name="'stripe_img'"
                        :drop_text="trans('lang.upload_payment_method')">
                    </upload-image>
                    <input type="hidden" name="stripe_img" id="hidden_site_stripe_img">
                </div>
            @endif
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
