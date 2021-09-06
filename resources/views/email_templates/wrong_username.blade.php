<!doctype html>
<html lang="en">
<body>
<h4>{{ $username }} username is invalid.</h4>
<p>We are sorry, we didn't found any user against "{{ $username }}". Please click the link in below and re-enter username. Thank you.</p>
<br><br>
<a href="{{ route('site.tournament.team.change-username', $id) }}">{{ route('site.tournament.team.change-username', $id) }}</a>
</body>
</html>
