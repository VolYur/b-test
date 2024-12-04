<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>

    <title>Game page</title>
    <script>
        window.config = {
            "token": "{{ $linkToken }}",
            "urls": {
                "deactivateLink": "{{ route('deactivateLink') }}",
                "regenerateLink": "{{ route('regenerateLink') }}",
                "playGame": "{{ route('playGame') }}",
                "gameHistory": "{{ route('gameHistory') }}",
            }
        };
        $(document).ready(function () {
            const token = window.config.token;

            $('#regenerate').on('click', function () {
                $.ajax({
                    url: window.config.urls.regenerateLink,
                    method: 'POST',
                    headers: {
                        'token': `${token}`,
                        'Content-Type': 'application/json'
                    },
                    success: function (response) {
                        if (response.result) {
                            window.location.href
                                = '{{ route('gamePage', '###') }}'.replace('###', response.data.linkToken);
                        }
                    },
                });
            });
            $('#deactivete').on('click', function () {
                $.ajax({
                    url: window.config.urls.deactivateLink,
                    method: 'POST',
                    headers: {
                        'token': `${token}`,
                        'Content-Type': 'application/json'
                    },
                    success: function (response) {
                        if (response.result) {
                            window.location.href
                                = '{{ route('showRegistrationForm') }}';
                        }
                    },
                });
            });
            $('#imfeelinglucky').on('click', function () {
                $.ajax({
                    url: window.config.urls.playGame,
                    method: 'POST',
                    headers: {
                        'token': `${token}`,
                        'Content-Type': 'application/json'
                    },
                    success: function (response) {
                        if (response.result) {
                            $('#gameresult').html(`<p><br>Number: ${response.data.number} <br>Result: ${response.data.result ? 'Win' : 'Lose'} <br>Win amount: ${response.data.sum}</p>`);
                        }
                    },
                });
            });
            $('#history').on('click', function () {
                $.ajax({
                    url: window.config.urls.gameHistory,
                    method: 'GET',
                    headers: {
                        'token': `${token}`,
                        'Content-Type': 'application/json'
                    },
                    success: function (response) {
                        if (response.result) {
                            const table = $('#tablebody');
                            table.show();
                            table.empty();
                            response.data.forEach((item) => {
                                const row = `
                                    <tr>
                                        <td>${item.number}</td>
                                        <td>${item.result ? 'Win' : 'Lose'}</td>
                                        <td>${item.sum}</td>
                                    </tr>
                                `;
                                table.append(row);
                            });
                        }
                    },
                });
            });

        });
    </script>
</head>
<body>
    <h1 class="col-9 col-md-9 col-xl-6 py-md-3 bd-content">Game page</h1>
    <div class="col-9 col-md-9 col-xl-6 py-md-3 bd-content">
        <a href="#" class="link-primary">Active link: {{ route('gamePage', $linkToken) }}</a>
        <br>
        <button type="button" class="btn btn-primary" id="regenerate">Regenerate</button>
        <button type="button" class="btn btn-primary" id="deactivete">Deactivete</button>
    </div>
    <div class="col-9 col-md-9 col-xl-6 py-md-3 bd-content">
        <button type="button" class="btn btn-primary" id="imfeelinglucky">Imfeelinglucky</button>
        <span id="gameresult"></span>
    </div>
    <div class="col-9 col-md-9 col-xl-6 py-md-3 bd-content">
        <button type="button" class="btn btn-primary" id="history">History</button>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Number</th>
                <th scope="col">Result</th>
                <th scope="col">Win amount</th>
            </tr>
            </thead>
            <tbody id="tablebody" style="display:none">
            <tr>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
