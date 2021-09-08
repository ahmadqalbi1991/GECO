@extends('admin.main')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@section('content')
    @include('admin.layout.sidebar')
    <main class="main-content mt-1 border-radius-lg">
        @include('admin.layout.navbar')
        @include('admin.layout.alert')

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="text-right">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn bg-gradient-primary">Back</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex flex-row justify-content-between align-items-center">
                            <h4>{{ $team->team_title }}</h4>
                            <div class="float-right">
                                <img style="width: 100px" src="{{ asset('teams/' . $tournament->tournament_title . '/' .$team->team_logo) }}" alt="">
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="{{ route('admin.team.update') }}" method="POST">
                                @csrf
                                @if($team->users->whereNull('slot_number')->count())
                                    @foreach($team->users as $key => $user)
                                        @php $key++ @endphp
                                        <div class="row">
                                            <div class="col-3">
                                                {{ $user->username }}
                                                <input type="hidden" id="user_id{{ $key }}" value="{{ $user->id }}">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="username[]" id="slot_{{ $key }}" placeholder="Slot Number {{ $key }}"
                                                       class="form-control
                                        slot_number" @if($user->slot_number) value="{{ $user->slot_number }}" disabled @endif>
                                            </div>
                                            <div class="col-5 justify-content-center align-items-center">
                                                <button @if($user->slot_number) disabled @endif id="slot_{{ $key }}" type="button" class="btn
                                                btn-success
                                            btn-sm"
                                                        onclick="setSlot({{
                                                $key }})">Set Slot
                                                    Number
                                                </button>
                                                <button @if($user->slot_number) disabled @endif id="btn-{{ $key }}" type="button" class="btn btn-danger
                                            btn-sm"
                                                        onclick="sendUsernameMail({{
                                                $key }}, {{ $team->id }}, {{ $user->id }})">Send Wrong Username Email
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="joining_date">Joining Date</label>
                                                <div class="input-group mb-4">
                                                <span class="input-group-text"><i
                                                        class="ni ni-calendar-grid-58"></i></span>
                                                    <input @if($team->tournament_joining_time) value="{{ date('d-m-Y', strtotime($team->tournament_joining_time))
                                                     }}" @endif
                                                        placeholder="Please
                                                           select
                                                            date" name="joining_date" type="text"
                                                           class="form-control" id="datepicker">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="joining_time">Joining Time</label>
                                                <div class="input-group mb-4">
                                                <span class="input-group-text"><i
                                                        class="fas fa-clock"></i></span>
                                                    <input placeholder="Please select time" name="joining_time" type="text"
                                                           class="form-control timepicker" id="timepicker">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="team_status">Team Status</label>
                                                <select name="team_status" id="team_status" class="form-control">
                                                    <option @if($team->team_status == 'pending') selected @endif value="pending">Pending</option>
                                                    <option @if($team->team_status == 'in_game') selected @endif value="in_game">In Game</option>
                                                    <option @if($team->team_status == 'winner') selected @endif value="winner">Winner</option>
                                                    <option @if($team->team_status == 'defeat') selected @endif value="defeat">Defeat</option>
                                                    <option @if($team->team_status == 'draw') selected @endif value="draw">Draw</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="points">Points</label>
                                            <input type="number" name="points" id="points" class="form-control" value="{{ $team->points }}">
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $team->id }}">
                                    <div class="col-12 text-right">
                                        @if(!$team->users->whereNull('slot_number')->count())
                                            <a href="{{ route('admin.team.send-users-email', $team->id) }}" class="btn btn-info">Send Tournament
                                                Detail</a>
                                            @endif
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @if($team->users->whereNull('slot_number')->count())
        <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>

        <script>
            function setSlot(index) {
                var id = $('#user_id' + index).val();
                var slot = $('#slot_' + index).val();

                if (!slot) {
                    alert('Please enter slot number in ' + index);
                    return;
                }

                $.ajax({
                    url: '{{ route("admin.team.set-slot") }}',
                    type: 'post',
                    data: {id: id, slot_number: slot},
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $("#slot_" + index).attr('disabled', 'disabled');
                        $("#btn-" + index).attr('disabled', 'disabled');
                    }
                })
            }

            function sendUsernameMail(index, id, user_id) {
                $.ajax({
                    url: '{{ route("admin.team.send-wrong-user-mail") }}',
                    type: 'post',
                    data: {id: id, user_id: user_id},
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert('Mail has been sent')
                    }
                })
            }
        </script>
    @else
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
        <script>
            $(function () {
                $('input.timepicker').timepicker({
                    timeFormat: 'hh:mm p',
                    interval: 30,
                    maxTime: '11:59pm',
                    defaultTime: "{{ $team->start_time ? $team->start_time : 12 }}",
                    startTime: '12:00am',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true
                });
                $("#datepicker").datepicker({
                    format: "dd-mm-yyyy",
                });
            });
        </script>
    @endif

@endsection
