<freelancer_education
    ph_job_title="{{ trans('lang.ph_job_title') }}"
    ph_institute_title="{{trans('lang.ph_institute_title')}}"
    ph_desc="{{ trans('lang.ph_desc') }}"
    ph_degree_title="{{ trans('lang.ph_degree_title') }}"
    :ph_start_date="'{{ trans('lang.ph_start_date') }}'"
    :ph_end_date="'{{ trans('lang.ph_end_date') }}'"
    :weekdays="'{{json_encode($weekdays)}}'"
    :months="'{{json_encode($months)}}'">
</freelancer_education>