@extends('layouts.master')
@section('title', $title)
@section('content')

    <div class="profile-edit-container">
        <div class="profile-edit-container">
            <div class="profile-edit-header fl-wrap">
                <h4>@lang('corals-directory-basic::auth.profile')</h4>
            </div>
            <!-- statistic-container-->
            <div class="custom-form">
                {!! CoralsForm::openForm($user = user(), ['url' => url('profile'), 'method'=>'PUT','class'=>'ajax-form','files'=>true]) !!}

                <div class="col-md-6">
                    <!-- profile-edit-container-->


                    <label><i class="fa fa-user-o"></i></label>
                    {!! CoralsForm::text('name','User::attributes.user.name',true) !!}
                    <label><i class="fa fa-user-o"></i></label>
                    {!! CoralsForm::text('last_name','User::attributes.user.last_name',true) !!}
                    <label><i class="fa fa-envelope-o"></i> </label>
                    {!! CoralsForm::email('email','User::attributes.user.email',true) !!}
                    <label><i class="fa fa-phone"></i> </label>
                    {!! CoralsForm::text('phone_country_code','User::attributes.user.phone_country_code',false,null,['id'=>'authy-countries']) !!}
                    <label><i class="fa fa-phone"></i> </label>
                    {!! CoralsForm::text('phone_number','User::attributes.user.phone_number',false,null,['id'=>'authy-cellphone']) !!}
                    <label></label>
                    {!! CoralsForm::textarea('properties[about]', 'User::attributes.user.about' , false, null,[
                         'class'=>'limited-text',
                         'maxlength'=>250,
                         'help_text'=>'<span class="limit-counter">0</span>/250',
                     'rows'=>'4']) !!}
                </div>
                <div class="col-md-6">
                    <img id="image_source"
                         class="profile-user-img img-responsive img-circle"
                         style="width: 200px"
                         src="{{ user()->picture }}"
                         alt="User profile picture">
                    {{ CoralsForm::hidden('profile_image') }}
                    <small class="crop_update">@lang('corals-admin::labels.auth.click_pic_update')</small>
                    <label><i class="fa fa-map-marker"></i> </label>

                    <label><i class="fa fa-lock"></i></label>
                    {!! CoralsForm::password('password','User::attributes.user.password') !!}
                    <label><i class="fa fa-lock"></i></label>
                    {!! CoralsForm::password('password_confirmation','User::attributes.user.password_confirmation') !!}

                    @if(\TwoFactorAuth::isActive())
                        {!! CoralsForm::checkbox('two_factor_auth_enabled','User::attributes.user.two_factor_auth_enabled',\TwoFactorAuth::isEnabled($user)) !!}

                        @if(!empty(\TwoFactorAuth::getSupportedChannels()))
                            {!! CoralsForm::radio('channel','User::attributes.user.channel', false,\TwoFactorAuth::getSupportedChannels(),\Arr::get($user->getTwoFactorAuthProviderOptions(),'channel', null)) !!}
                        @endif
                    @endif
                    {!! CoralsForm::text('job_title','User::attributes.user.job_title') !!}
                </div>
            </div>
            <!-- profile-edit-container end-->
            <!-- profile-edit-container-->
            <div class="profile-edit-container">
                <div class="custom-form">
                    {!! CoralsForm::formButtons(trans('corals-directory-basic::auth.save',['title' => $title_singular]),[],['href'=>url('dashboard')]) !!}
                </div>
            </div>
            <!-- profile-edit-container end-->
        </div>


    {!! CoralsForm::closeForm() !!}

    @include('User::users.profile.cropper_modal')

@endsection
@section('js')
    @include('User::users.profile.scripts')
@endsection
