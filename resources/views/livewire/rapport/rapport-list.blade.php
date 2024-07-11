<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">List Rapport</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $testResult->getUser->getDetailUser->name }}</li>
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
                            </p>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->role == 'teacher')
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('studentList', $course->uid) }}" class="btn btn-secondary mb-4 _effect--ripple waves-effect waves-light" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            List Murid
                        </a>
                        <div class="filtered-list-search mb-2 w-50">
                        </div>
                    </div>
                @endif
                <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Pengerjaan</th>
                                    <th scope="col" class="text-center">Hasil Test</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ $detailTestResults }} --}}
                                @forelse ($detailTestResults as $index => $dtlTestResult)
                                    <tr class="">
                                        <td style="width: 50px; text-align: center;">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body align-self-center">
                                                    <span>Pengerjaan Ke - {{ $index + 1 }}</span>
                                                    <h6 class="mb-0">
                                                        <svg class="mb-1 me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                        benar {{ $dtlTestResult->correctAnswers }} dari {{ $totalQuestions ?? 0 }} soal
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td  class="text-center">
                                            @if ($dtlTestResult->status  == "fail")
                                                <span class="badge badge-light-danger ms-3">Gagal</span>
                                            @elseif ($dtlTestResult->status  == "succeed")
                                                <span class="badge badge-light-success ms-3">Lolos</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('rapportDetail', ['uid' => $dtlTestResult->uid, 'studentId' => $testResult->getUser->id]) }}" class="btn btn-sm btn-primary" aria-expanded="false">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Belum memiliki riwayat test</td>
                                    </tr>
                                @endforelse
                            </tbody>                                
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
