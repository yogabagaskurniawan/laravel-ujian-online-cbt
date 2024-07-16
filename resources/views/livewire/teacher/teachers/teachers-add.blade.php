<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>List Guru</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Guru</li>
            </ol>
        </nav>
    </div>
    
    <div class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <form class="" wire:submit="addTeacher">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="fullName">Nama</label>
                            <input type="text" class="form-control" wire:model="name" wire:loading.attr="disabled">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label for="fullName">Nomer HP</label>
                            <input type="number" class="form-control" wire:model="phone" wire:loading.attr="disabled">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label for="fullName">Alamat</label>
                            <input type="text" class="form-control" wire:model="address" wire:loading.attr="disabled">
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label for="fullName">Email</label>
                            <input type="email" class="form-control" wire:model="email" wire:loading.attr="disabled">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label>Password</label>
                            <input type="password" class="form-control"  wire:model="password">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control"  wire:model="confirm_password">
                        </div>
                    </div>
                    <button class="btn btn-info btn-lg mb-2 me-4 _effect--ripple waves-effect waves-light" wire:loading><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin me-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>  Loading</button>
                    <button type="submit" class="btn btn-primary _effect--ripple waves-effect waves-light " wire:loading.remove>Tambah Guru</button>
                </form>

            </div>
        </div>
    </div>
</div>
