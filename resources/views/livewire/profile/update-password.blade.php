<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
            </ol>
        </nav>
    </div>
    <div class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                    <div class="form">
                        <form wire:submit="updatePassword({{ $user->id }})">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullName">Password Lama</label>
                                        <input wire:model="passwordOld" type="password" class="form-control mb-3" id="fullName">
                                        @error('passwordOld') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Password Baru</label>
                                        <input wire:model="passwordNew" type="password" class="form-control mb-3" id="email">
                                        @error('passwordNew') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>   
                                <div class="col-md-12 mt-1">
                                    <div class="form-group text-start">
                                        <button class="btn btn-info btn-lg mb-2 me-4 _effect--ripple waves-effect waves-light" wire:loading><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin me-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>  Loading</button>
                                        <button type="submit" class="btn btn-primary _effect--ripple waves-effect waves-light" wire:loading.remove>
                                            Update Password
                                        </button>                                    
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
