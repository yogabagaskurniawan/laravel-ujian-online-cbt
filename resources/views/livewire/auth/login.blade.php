<div>
    <div class="auth-container d-flex">
 
        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="text-center">
                        {{-- <img src="{{ ('/assets/logo-icon/logo.png') }}" width="200px" alt=""> --}}

                    </div>
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <form action="" wire:submit="loginCurrentUser">
                                <div class="row">
                                    <div class="col-md-12 mb-3">

                                        <h2>Login</h2>
                                        <p>lanjutkan untuk masuk ke akun Anda</p>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" wire:model="email">
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control"  wire:model="password">

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-secondary w-100">Login</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="col-12">
                                <div class="text-center">
                                    <p class="mb-0">Belum punya akun? <a href="register" class="text-warning">Register</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
