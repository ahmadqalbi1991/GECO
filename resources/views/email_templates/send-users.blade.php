<!doctype html>
<html lang="en">
<body>
<h4>Thank you {{ $team->team_title }} for joining {{ $team->tournament->tournament_title }}.</h4>
<h5>joining Time: {{ \Carbon\Carbon::parse($team->tournament_joining_time)->format('d M, Y') }} at {{ $team->start_time }}</h5>
<h3>Players Slot</h3>
@foreach($users as $user)
    <p> {{ $user->username }}(Slot# {{ $user->slot_number }})</p>
@endforeach
<h5>Please join tournament on mention time, otherwise you will be knockout.</h5>
</body>
</html>
