<x-guest-layout>
    <div class="container" style="padding: 20px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verify Two-Factor Authentication</div>
                    <span class="login100-form-title p-b-20">
                        <img src="{{ asset('assets/imgs/meet-logo.png') }}" class="wid-img" style="width:80px">
                    </span>
                    <form method="POST" action="{{ route('admin.2fa.verify') }}">
                        @csrf
                        <div class="form-group col-md-4" style="padding: 15px;">
                            <label for="2fa_code">Enter 2FA Code:</label>
                            <input type="text" class="form-control"  name="2fa_code" id="2fa_code" required>
                            <br>
                            <button class="btn btn-primary" type="submit">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>