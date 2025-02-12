<section class="how-it-works py-5 bg-light">
    <div class="container">
        <div class="card shadow-sm" style="width: 100%;">
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                {{-- <img src="assets/imgs/team10.png" alt="User Profile" class="rounded-circle me-3" style="width: 10%;"> --}}
                <i class="fa-solid fa-user"></i>
                <div style="padding-left:10px;">
                    <h5 class="mb-0">
                        {{ Auth::user()->name }}
                    </h5>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>
              </div>
              @if (session()->has('error'))
              <div class=" text-red p-2 mb-4" style="background-color:red">
                  {{ session('error') }}
              </div>
              @endif
              @if (session()->has('success'))
              <div class="d-flex justify-content-center">
                <div class="col-md-4 bg-green-500 text-black p-2 mb-1  rounded shadow" style="background-color: green;">
                  {{ session('success') }}
                </div>
              </div>
              @endif

              <form wire:submit.prevent="updatePassword" id="profileForm" class="row g-3">
                <div class="col-md-6">
                  <label for="old_password" class="form-label">Old Password</label>
                  <input type="password" id="password"  wire:model.defer="old_password" class="form-control" placeholder="Your Old Password">
                  @error('old_password') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                  @enderror

                </div>

                <div class="col-md-6">
                  <label for="new_password" class="form-label">New Password</label>
                  <input type="password" id="password"  wire:model.defer="password" class="form-control" placeholder="Your New Password">
                  @error('password') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                  @enderror
                </div>

                {{-- <div class="col-md-6">
                  <label for="gender" class="form-label">Gender</label>
                  <select id="gender" class="form-select">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="country" class="form-label">Country</label>
                  <input type="text" id="country" class="form-control" placeholder="Your Country">
                </div>

                <div class="col-md-6">
                  <label for="language" class="form-label">Language</label>
                  <input type="text" id="language" class="form-control" placeholder="Your Language">
                </div>

                <div class="col-md-6">
                  <label for="timeZone" class="form-label">Time Zone</label>
                  <input type="text" id="timeZone" class="form-control" placeholder="Your Time Zone">
                </div> --}}
                <div class="mt-4">
                  <button id="addEmail" type="submit" class="btn btn-outline-primary mt-2"  style="float: inline-end;">Update Changes</button>
                </div>
  
              </form>

            </div>
          </div>
    </div>
</section>
