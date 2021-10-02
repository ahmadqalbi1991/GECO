@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        <section class="upcoming-games-area contact-area upcoming-games-bg pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="md-stepper-horizontal orange">
                            <div class="md-step active">
                                <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                                <div class="md-step-title">Tournaments</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step active">
                                <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                                <div class="md-step-title">Tournament</div>
                                <div class="md-step-optional">Detail</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step active">
                                <div class="md-step-circle"><span>3</span></div>
                                <div class="md-step-title">Tournament</div>
                                <div class="md-step-optional">Registration</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step">
                                <div class="md-step-circle"><span>4</span></div>
                                <div class="md-step-title">Tournament</div>
                                <div class="md-step-optional">Joined</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="section-title title-style-three mb-20">
                            <h2><span>{{ $tournament->tournament_title }}</span></h2>
                        </div>
                    </div>
                    <form action="{{ route('site.tournament.pay') }}" method="post" id="tournament-form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                        <div class="card-body">
                            <p><strong>Note: </strong>Team name and logo cannot be replaced.</p>
                            <div class="row">
                                <div class="col-12">
                                    <label for="team_title">Team Title</label>
                                    <input type="text" name="team_title" id="team_title"
                                           class="form-control @error('team_title') is-invalid
@enderror"
                                           placeholder="Enter Your Team Title">
                                    @error('team_title')
                                    <span>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id="players">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Player 1</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" name="names[]" id="name1" class="form-control"
                                                       required placeholder="Player Name">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="usernames[]" id="username1" class="form-control"
                                                       required placeholder="Username">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="image">Team Logo</label>
                                    <input type="file" name="image" id="image"
                                           class="form-control @error('image') is-invalid @enderror ">
                                    @error('image')
                                    <span>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @if($tournament->tournament_type == 'team')
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="javascript:void(0)" onclick="addTeam()"><i class="fas fa-plus"></i> Add
                                            Team Player</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            @if($tournament->price == 0)
                                <button type="submit" class="btn btn-success">Join</button>
                            @else
                                <div id="paypal-button-container"></div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script
        src="https://www.paypal.com/sdk/js?client-id={{ site_setting('paypal_password') }}"> // Required. Replace YOUR_CLIENT_ID with your sandbox
        // client ID.
    </script>
    <script>
        paypal.Buttons({
            createOrder: function (data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $tournament->price }}'
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    if (details.status == 'COMPLETED') {
                        $("#tournament-form").append('<input type="hidden" name="payment_method" value="paypal">');
                        $("#tournament-form").submit();
                    }
                });
            }
        }).render('#paypal-button-container');

        var i = 1;

        function addTeam() {
            i++;

            if (i > 5) {
                i--;
                alert("You cannot add more players");
                return false;
            }

            var html = '<div class="col-md-12">' +
                '<div class="form-group">' +
                '<label>Player ' + i + '</label>' +
                '<div class="row">' +
                '<div class="col-6">' +
                '<input type="text" name="names[]" id="name' + i + '" class="form-control" required placeholder="Player Name">' +
                '</div>' +
                '<div class="col-6">' +
                '<input type="text" name="usernames[]" id="username' + i + '" class="form-control" required placeholder="Username">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            $("#players").append(html)
        }
    </script>

@endsection
