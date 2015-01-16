@extends('layouts.login')

@section('content')


    <fieldset>


    </fieldset>
</form>


<div class="form-box" id="login-box">
    <div class="header">Exodus <br><h5>Please sign in to continue</h5></div>
        <form role="form" method="POST" action="{{{ URL::to('/users/login') }}}" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
           <div class="body bg-gray">
                <div class="form-group">
                    <label for="email">{{{ Lang::get('confide::confide.username_e_mail') }}}</label>
                    <input class="form-control" tabindex="1" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                </div>
                <div class="form-group">
                <label for="password">
                    {{{ Lang::get('confide::confide.password') }}}
                </label>
                <input class="form-control" tabindex="2" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                <p class="help-block">
                    <a href="{{{ URL::to('/users/forgot_password') }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
                </p>
                </div>
           </div>
           <div class="footer">                                                               
                <div class="checkbox">
                    <label for="remember">
                        <input type="hidden" name="remember" value="0">
                        <input tabindex="4" type="checkbox" name="remember" id="remember" value="1"> {{{ Lang::get('confide::confide.login.remember') }}}
                    </label>
                </div>
                @if (Session::get('error'))
                    <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
                @endif

                @if (Session::get('notice'))
                    <div class="alert">{{{ Session::get('notice') }}}</div>
                @endif
                <div class="form-group">
                    <button tabindex="3" type="submit" class="btn btn-default">{{{ Lang::get('confide::confide.login.submit') }}}</button>
                </div>
           </div>
       </form>

       <div class="margin text-center">
           <span>&copy Kemptville Computers, {{ date('Y') }}.  All rights reserved.</span>
       </div>
</div>
@stop