<x-guest-layout>
    <div class="container" style="padding: 20px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Enable Two-Factor Authentication</div>
                    <span class="login100-form-title p-b-20">
                        <img src="{{ asset('assets/imgs/meet-logo.png') }}" class="wid-img" style="width:80px">
                    </span>
                    <div class="card-body">
                        <p>Scan the QR code below with your Google Authenticator app:</p>
                        <div class="text-center">
                            {{-- <img src="{{ $qrCodeUrl }}" > --}}
                            {{-- {!! QrCode::size(200)->generate($qrCodeUrl); !!} --}}
                            {{-- <img src="{{ $qrCodeUrl }}" alt="QR Code"> --}}
                            {!! $qrCodeUrl !!}

                        </div>
                        <p>Or enter this secret key manually: <strong>{{ $secret }}</strong></p>
                        <p style="font-size: 25px;"> 
                            <input type="checkbox" id="confirmCheckbox" required>
                            <b><strong>{{ "It will not be registered again , Make Sure to Add on Authenticator applicaiton" }}</b></strong>
                        </p>

                        {{-- <a type="submit" id="proceedButton" href={{ route("admin.2fa.verify") }} class="btn btn-primary" disabled>Proceed </a> --}}
                        <form method="POST" action="{{ route('admin.2fa.register') }}">
                            @csrf
                            <div class="form-group">
                                {{-- <label for="2fa_code">Enter the 2FA code:</label> --}}
                                <input type="text" name="secret" value="{{ $secret }}" class="form-control" required hidden>
                            </div>
                            <button type="submit" id="proceedButton" class="btn btn-primary" disabled>Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // JavaScript to enable/disable the "Proceed" button based on checkbox state
        document.getElementById('confirmCheckbox').addEventListener('change', function() {
            const proceedButton = document.getElementById('proceedButton');
            proceedButton.disabled = !this.checked;
        });
    </script>
</x-guest-layout>