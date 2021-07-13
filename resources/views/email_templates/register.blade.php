<!doctype html>
<html lang="en">
<body>
    <h4>Thank you for joining us.</h4>
    <p>Please click on the below link to activate your account.</p>
    <br><br>
    <a href="{{ route('site.user.verify', [$code, $user_id]) }}" target="_blank">Click Here</a>
</body>
</html>
