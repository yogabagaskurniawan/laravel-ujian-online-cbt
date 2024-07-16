<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>List Guru</a></li>
            </ol>
        </nav>
    </div>
    <div class="col-lg-12 layout-spacing layout-top-spacing">

        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="filtered-list-search mb-2 w-50">
                    <form class="form-inline my-2 my-lg-0 justify-content-center">
                        <div class="w-100">
                            <input wire:model.live="search" type="text" class="py-2 w-100 form-control product-search br-30" id="input-search" placeholder="Cari...">
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Nama</th>
                                <th scope="col" class="text-center">Nomer HP</th>
                                <th scope="col" class="text-center">Alamat</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teachers as $index => $teacher)
                                <tr>
                                    <td style="width: 50px; text-align: center;">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="media">
                                            <div class="media-body align-self-center">
                                                <h6 class="mb-0">{{ $teacher->getDetailUser->name }}</h6>
                                                <span>{{ $teacher->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $teacher->getDetailUser->phone }}</td>
                                    <td class="text-center">{{ $teacher->getDetailUser->address }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <div class="action-btns ms-3">
                                            {{-- <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            </a> --}}
                                            <a wire:confirm="Apakah anda yakin ingin menghapus?" wire:click="deleteStudent({{ $teacher->id }})" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>belum ada guru</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if (count($teachers) >= $limitData)
                        <a wire:click.prevent="addLimitData" class="mt-2 btn btn-sm p-1 btn-info btn-sm">Selanjutnya</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
