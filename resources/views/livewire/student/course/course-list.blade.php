<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Kelas Saya</a></li>
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
                <div class="table-responsive">
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
                            <?php $no = ($myCourses->currentPage() - 1) * $myCourses->perPage(); ?>
                            @forelse ($myCourses as $myCourse)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $myCourse->getCourse->name }}</td>
                                <td>{{ $myCourse->created_at }}</td>
                                <td>{{ $myCourse->getCourse->getCategory->name }}</td>
                                {{-- <td class="text-center">
                                </td> --}}
                                <td class="text-center">
                                    <a href="{{ route('rapportDetail', $myCourse->getCourse->uid) }}" class="btn btn-sm btn-success" aria-expanded="false">
                                        Hasil test
                                    </a>
                                    <a href="{{ route('courseTest', $myCourse->getCourse->uid) }}" class="btn btn-sm btn-secondary" aria-expanded="false">
                                        Mulai test
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">Tidak ada list kelas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $myCourses->links() }}
            </div>
        </div>
    </div>
</div>