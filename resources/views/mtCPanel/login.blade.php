@extends('mtCPanel.layouts.login')

@section('content')


<div class="padding-15">

    

    <div class="login-box">

        <!-- login form -->
        <form class="sky-form boxed" role="form" method="POST" action="{{ route('mtCPanel.login.submit') }}">
            {{ csrf_field() }}
            <header><i class="fa fa-users"></i> Sign In</header>

            @if(isset($loginError))
                <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">{{Lang::get('admin.loginErrorMessage')}}</div>
            @endif
            <!--
            <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                Invalid Email or Password!
            </div>

            <div class="alert alert-warning noborder text-center weight-400 nomargin noradius">
                Account Inactive!
            </div>

            <div class="alert alert-default noborder text-center weight-400 nomargin noradius">
                <strong>Too many failures!</strong> <br />
                Please wait: <span class="inlineCountdown" data-seconds="180"></span>
            </div>
            -->

            <fieldset>	
            
                <section>
                    <label class="label">E-mail</label>
                    <label class="input">
                        <i class="icon-append fa fa-envelope"></i>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="@lang('admin.email')" required autofocus>
                        <span class="tooltip tooltip-top-right">Email Address</span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </label>
                </section>
                
                <section>
                    <label class="label">Password</label>
                    <label class="input">
                        <i class="icon-append fa fa-lock"></i>
                        <input id="password" type="password" class="form-control" name="password" placeholder="@lang('admin.password')" required>
                        <b class="tooltip tooltip-top-right">Type your Password</b>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><i></i> @lang('admin.rememberMe')
                    </label>
                </section>

            </fieldset>

            <footer>
                <button type="submit" class="btn btn-primary pull-right">Sign In</button>
                <div class="forgot-password pull-left">
                    <a href="{{ route('password.request') }}">@lang('admin.forgetPassword')</a> <br />
                </div>
            </footer>
        </form>
        <!-- /login form -->

    </div>

</div>

@endsection