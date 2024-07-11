<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('rapportList', ['uid' => $detailTestResult->getTestResult->getCourse->uid, 'studentId' => $detailTestResult->getTestResult->getUser->id]) }}">List Rapport</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hasil test</li>
            </ol>
        </nav>
    </div>
    <div class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="mb-0">{{ $detailTestResult->getTestResult->getCourse->name }}</h4>
                            <p class="">{{ $detailTestResult->getTestResult->getCourse->getCategory->name }}</p>
                            <p>
                                <svg class="mb-1 me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                benar {{ $detailTestResult->correctAnswers }} dari {{ $totalQuestions ?? 0 }} soal
                            </p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="mt-2 d-flex align-items-center">
                        @if ($detailTestResult->status  == "fail")
                            Hasil Test <span class="badge badge-light-danger ms-3">Gagal</span>
                        @elseif ($detailTestResult->status  == "succeed")
                            Hasil Test <span class="badge badge-light-success ms-3">Lolos</span>
                        @endif
                    </h5>
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
                                @forelse ($answerStudents as $index => $answerStdt)
                                    <tr class="">
                                        <td style="width: 50px; text-align: center;">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body align-self-center">
                                                    <span>Pertanyaan</span>
                                                    <h6 class="mb-0">{{ $answerStdt->getQuestion->ask }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if ($answerStdt->is_correct == 0)
                                                <span class="badge badge-light-danger">Salah</span>
                                            @elseif ($answerStdt->is_correct == 1)
                                                <span class="badge badge-light-success">Benar</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Kelas belum memiliki test</td>
                                    </tr>
                                @endforelse
                            </tbody>                                
                        </table>
                        @if (count($answerStudents) >= $limitData)
                            <a wire:click.prevent="addLimitData" class="mt-2 btn btn-sm p-1 btn-info btn-sm">Selanjutnya</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
