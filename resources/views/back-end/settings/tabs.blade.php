@php 
    $curr_user_id = !empty(Auth::user()) ? Auth::user()->id : '';
    $role_type = App\User::getUserRoleType($curr_user_id);
    $register_form = App\SiteManagement::getMetaValue('reg_form_settings');
    $selected_registration_type = !empty($register_form) && !empty($register_form[0]['registration_type']) ? $register_form[0]['registration_type'] : 'multiple';
@endphp
<div class="wt-dashboardtabs">
    <ul class="wt-tabstitle nav navbar-nav">
        @if (!empty($role_type) && $role_type->name <> 'admin' )
            <li class="nav-item">
                <a class="{{{ \Request::route()->getName()==='manageAccount'? 'active': '' }}}" href="{{{ route('manageAccount') }}}">{{{ trans('lang.manage_account') }}}</a>
            </li>
            <li class="nav-item">
                <a class="{{{ \Request::route()->getName()==='emailNotificationSettings'? 'active': '' }}}" href="{{{ route('emailNotificationSettings') }}}">{{{ trans('lang.email_notify') }}}</a>
            </li>
            <li class="nav-item">
                <a class="{{{ \Request::route()->getName()==='deleteAccount'? 'active': '' }}}" href="{{{ route('deleteAccount') }}}">{{{ trans('lang.delete_account') }}}</a>
            </li>
            @if (Auth::user()->user_verified == 0 && $selected_registration_type == 'multiple')
                <li class="nav-item">
                    <a class="{{{ \Request::route()->getName()==='emailVerification'? 'active': '' }}}" href="{{{ route('emailVerification') }}}">{{{ trans('lang.email_verification') }}}</a>
                </li>
            @endif
        @endif
        <li class="nav-item">
            <a class="{{{ \Request::route()->getName()==='resetPassword'? 'active': '' }}}" href="{{{ route('resetPassword') }}}">{{{ trans('lang.reset_pass') }}}</a>
        </li>
    </ul>
</div>