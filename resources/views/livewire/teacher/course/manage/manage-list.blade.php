<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Manage Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kelas Detail</li>
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
                <h5 class="mt-3">Kelas Test</h5>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('manageAdd', $course->uid) }}" class="btn btn-secondary mb-4 _effect--ripple waves-effect waves-light" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-1" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                        Tambah soal
                    </a>
                    <div class="filtered-list-search mb-2 w-50">
                        <form class="form-inline my-lg-0 justify-content-center">
                            <div class="w-100">
                                <input wire:model.live="search" type="text" class="py-2 w-100 form-control product-search br-30" id="input-search" placeholder="Cari soal...">
                            </div>
                        </form>
                    </div>
                </div>
                <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                @forelse ($questions as $question)
                                    <tr class="">
                                        <td>
                                            <div class="media">
                                                <div class="media-body align-self-center">
                                                    <span>Pertanyaan</span>
                                                    <h6 class="mb-0">{{ $question->ask }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns">
                                                <a href="{{ route('manageEdit', $question->uid) }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                </a>
                                                <a wire:confirm="Apakah anda yakin ingin menghapus?" wire:click="deleteQuestion({{ $question->id }})" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <p>kelas belum memiliki test</p>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($questions) >= $limitData)
                            <a wire:click.prevent="addLimitData" class="mt-2 btn btn-sm p-1 btn-info btn-sm">Selanjutnya</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>