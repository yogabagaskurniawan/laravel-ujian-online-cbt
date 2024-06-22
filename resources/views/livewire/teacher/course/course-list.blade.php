<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Kelas</a></li>
            </ol>
        </nav>
    </div>

    <div class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="filtered-list-search mb-2 w-50">
                    <form class="form-inline my-2 my-lg-0 justify-content-center">
                        <div class="w-100">
                            <input wire:model.live="search" type="text" class="py-2 w-100 form-control product-search br-30" id="input-search" placeholder="Cari kelas wajib di halaman satu...">
                        </div>
                    </form>
                </div>
                <div class="table-responsive pb-5">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Tanggal Dibuat</th>
                                <th scope="col">Kategori</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = ($courses->currentPage() - 1) * $courses->perPage(); ?>
                            @forelse ($courses as $course)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->created_at }}</td>
                                <td>{{ $course->getCategory->name }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Menu
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="{{ route('manageList', $course->uid) }}">Manage</a></li>
                                            <li><a class="dropdown-item" href="/">Siswa</a></li>
                                            <li><a class="dropdown-item" href="{{ route('courseEdit', $course->uid) }}">Edit Kelas</a></li>
                                            <li><a class="dropdown-item" wire:confirm="Apakah anda yakin ingin menghapus?" wire:click="deleteCourse({{ $course->id }})"><span class="text-danger">Hapus</span></a></li>
                                        </ul>
                                    </div>

                                    {{-- <div class="action-btns">
                                        <a wire:navigate href="{{ route('courseEdit', $course->uid) }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a wire:confirm="Apakah anda yakin ingin menghapus?" wire:click="deleteCourse({{ $course->id }})" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div> --}}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">Tidak ada list kelas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pb-2 mb-5"></div>
                </div>
                {{ $courses->links() }}

            </div>
        </div>
    </div>
</div>
