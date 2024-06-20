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
                            <form action="" wire:submit="registerCurrentUser">
                                <div class="row">
                                    <div class="col-md-12 mb-3">

                                        <h2>Register</h2>
                                        <p>lanjutkan untuk daftar akun Anda</p>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">nama</label>
                                            <input type="text" class="form-control" wire:model="name">
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">No HP</label>
                                            <input type="number" class="form-control" wire:model="phone">
                                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <input type="text" class="form-control" wire:model="address">
                                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
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
                                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Konfirmasi Password</label>
                                            <input type="password" class="form-control"  wire:model="confirm_password">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-secondary w-100">Register</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="col-12">
                                <div class="text-center">
                                    <p class="mb-0">Sudah punya akun? <a href="login" class="text-warning">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>