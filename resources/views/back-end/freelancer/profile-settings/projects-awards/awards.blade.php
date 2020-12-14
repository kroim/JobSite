<freelancer_award 
    :server_errors="'{{ trans('lang.all_required') }}'"
    :ph_award_title = "'{{ trans('lang.ph_award_title') }}'"
    :ph_select_award_date = "trans('lang.select_award_date')"
    :weekdays="'{{json_encode($weekdays)}}'"
    :months="'{{json_encode($months)}}'">
</freelancer_award>