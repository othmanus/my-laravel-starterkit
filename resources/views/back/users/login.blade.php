<!DOCTYPE html>
<html class="bg-black">
    <head>
    	@include('back.layouts._css')
    </head>

    <body class="bg-black">
    	<div class="form-box" id="login-box">
    		<div class="header"><i class="fa fa-lock"></i>  Se connecter</div>
    		<form action="{{ url('/login') }}" method="POST">
    			<input type="hidden" name="_token" value="{{ csrf_token() }}">
    			<div class="body bg-gray">
                    @if($errors->first('credentiels'))
                    <div class="alert alert-danger">
                        <p>{{ $errors->first('credentiels') }}</p>
                    </div>
                    @endif
    				<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
    					<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                        <p class="text-red">{{ $errors->first('email') }}</p>
    				</div>
    				<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
    					<input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                        <p class="text-red">{{ $errors->first('password') }}</p>
    				</div>         
    				<div class="form-group">
    					<input type="checkbox" name="remember" {{ old('remember') ? "checked" : "" }}> Se souvenir de moi
    				</div>
                    <p class="text-muted"><a href="{{ url('/password/reset') }}">Mot de passe oublié?</a></p>
    			</div>
    			<div class="footer">                                                               
    				<button type="submit" id="login" class="btn bg-olive btn-block">Se connecter</button>
    			</div>
    		</form>
    	</div>
    </body>
</html>

