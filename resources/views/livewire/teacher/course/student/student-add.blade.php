<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Manage Kelas</a></li>
                <li class="breadcrumb-item"><a href="{{ route('studentList', $course->uid) }}">Kelas Murid</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Murid</li>
            </ol>
        </nav>
    </div>

    <div class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="mb-0">{{ $course->name }}</h4>
                            <p class="">{{ $course->getCategory->name }}</p>
                            <p>
                                <svg class="mb-1 me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                {{ $course->created_at }}  
                                <svg class="mb-1 me-1 ms-3" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                {{ $studentCount }} Murid
                            </p>
                        </div>
                    </div>
                </div>
                <h5 class="mt-3">Menambahkan Murid Baru</h5>
                <form class="" wire:submit="addStudent">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="fullName">Email Murid</label>
                            <input type="text" class="form-control" wire:model="email" wire:loading.attr="disabled" placeholder="tambahkan email murid disini...">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button class="btn btn-info btn-lg mb-2 me-4 _effect--ripple waves-effect waves-light" wire:loading><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin me-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>  Loading</button>
                    <button type="submit" class="btn btn-primary _effect--ripple waves-effect waves-light " wire:loading.remove>Tambah Murid</button>
                </form>
            </div>
        </div>
    </div>
</div>