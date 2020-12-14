<div class="wt-tabscontenttitle">
    <h2>{{trans('lang.your_loc')}}</h2>
</div>
<div class="wt-formtheme">
    <fieldset>
        <div class="form-group form-group-half">
            <span class="wt-select">
                {!! Form::select('location', $locations, Auth::user()->location_id ,array('class' => '', 'placeholder' => trans('lang.select_location'))) !!}
            </span>
        </div>
        <div class="form-group form-group-half">
            {!! Form::text( 'address', e($address), ['id'=>"pac-input", 'class' =>'form-control', 'placeholder' => trans('lang.your_address')] ) !!}
        </div>
        <div class="form-group wt-formmap">
            @include('includes.map')
        </div>
        <div class="form-group form-group-half">
            {!! Form::text( 'longitude', e($longitude), ['id'=>"lng-input", 'class' =>'form-control', 'placeholder' => trans('lang.enter_logitude')] ) !!}
        </div>
        <div class="form-group form-group-half">
            {!! Form::text( 'latitude', e($latitude), ['id'=>"lat-input", 'class' =>'form-control', 'placeholder' => trans('lang.enter_latitude')] ) !!}
        </div>
    </fieldset>
</div>