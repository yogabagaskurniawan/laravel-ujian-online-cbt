<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Manage Kelas</a></li>
                <li class="breadcrumb-item"><a href="{{ route('manageList', $question->getCourse->uid) }}">Kelas Detail</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Soal</li>
            </ol>
        </nav>
    </div>

    <div class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="mb-0">{{ $question->getCourse->name }}</h4>
                            <p class="">{{ $question->getCourse->getCategory->name }}</p>
                            <p>
                                <svg class="mb-1 me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                {{ $question->getCourse->created_at }}  
                                <svg class="mb-1 me-1 ms-3" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                {{ $studentCount }} Murid
                            </p>
                        </div>
                    </div>
                </div>
                <h5 class="mt-3">Edit Pertanyaan</h5>
                <form wire:submit.prevent="editQuestion">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="question">Pertanyaan</label>
                            <input type="text" class="form-control" wire:model="questionForm" placeholder="Tulis pertanyaan di sini">
                            @error('question') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12">
                            <label for="answers" class="mb-0 mt-3">Jawaban</label>
                            @for ($i = 1; $i <= 4; $i++)
                                <div class="d-flex align-items-center mt-3">
                                    <input type="text" class="form-control me-2" wire:model="answers.{{ $i }}" wire:loading.attr="disabled" placeholder="tulis opsi jawaban disini">
                                    <div class="form-check form-check-info w-full">
                                        <input class="form-check-input" wire:model="correctAnswer" type="radio" value="{{ $i }}" id="form-check-info{{ $i }}">
                                        <label class="form-check-label" for="form-check-info{{ $i }}">
                                            benar
                                        </label>
                                    </div>
                                </div>
                                @error('answers.' . $i) <span class="text-danger">{{ $message }}</span> @enderror
                            @endfor
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary _effect--ripple waves-effect waves-light">Edit Soal</button>
                </form>
            </div>
        </div>
    </div>
</div>