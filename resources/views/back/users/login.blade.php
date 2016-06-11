<!DOCTYPE html>
<html class="bg-black">
<head>
   @include('back.layouts._css')
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url("/") }}"><b>Gym</b>All</a>
        </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Veuillez vous connecter pour accéder à votre session</p>
        @if($errors->first('credentiels'))
        <div class="alert alert-danger">
            <p>{{ $errors->first('credentiels') }}</p>
        </div>
        @endif
        <form action="{{ url('/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">    
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? "checked" : "" }}> Se souvenir de moi
                        </label>
                    </div>           
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Se connecter</button>
                </div><!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/password/reset') }}">Mot de passe oublié?</a>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

</html>

