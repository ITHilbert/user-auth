<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head></head>
    <body>
        <h1>Passwort ändern</h1>
        <a href="{{ route('password.editwithtoken', [$user->edit_pw_token, $user->email]) }}">
            Link
        </a>
    </body>
</html>
