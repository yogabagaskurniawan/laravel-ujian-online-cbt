<div class="middle-content container-xxl p-0">
    <div class="faq">
        <div class="faq-layouting layout-spacing">
            <div style="display: flex; justify-content: center; align-items: center;">
                <div style="max-width: 700px">
                    <form wire:submit.prevent="submitAnswers">
                        @forelse ($questions as $index => $question)
                            <div class="mt-4 d-flex">
                                <h3 class="me-2">{{ $index + 1 }}.</h3>
                                <div>
                                    <h3 class="mb-3">{{ $question->ask }}</h3>
                                    @foreach ($question->getQuestionChoice as $choice)
                                        <div class="form-check form-check-info w-full">
                                            <input class="form-check-input mt-1" type="radio" name="question{{ $question->id }}" id="choice{{ $choice->id }}" wire:model="answers.{{ $question->id }}" value="{{ $choice->id }}">
                                            <label class="form-check-label ms-2 mb-3" for="choice{{ $choice->id }}">
                                                {{ $choice->choice }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('answers.' . $question->id) <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @empty
                            <div class="mt-4 d-flex">
                                <h5>Soal test belum ada</h5>
                            </div>
                        @endforelse
                        @if ($questions->isNotEmpty())
                            <div class="text-center">
                                @if (count($questions) < $limitData)
                                    <button class="btn btn-info btn-lg mb-2 mt-5 _effect--ripple waves-effect waves-light" wire:loading>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin me-2">
                                            <line x1="12" y1="2" x2="12" y2="6"></line>
                                            <line x1="12" y1="18" x2="12" y2="22"></line>
                                            <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                                            <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                                            <line x1="2" y1="12" x2="6" y2="12"></line>
                                            <line x1="18" y1="12" x2="22" y2="12"></line>
                                            <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                                            <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                                        </svg>
                                        Loading
                                    </button>
                                    <button type="submit" class="mt-5 btn btn-primary _effect--ripple waves-effect waves-light" wire:loading.remove>Simpan jawaban</button>
                                @endif
                            </div>
                        @endif
                    </form>
                    @if (count($questions) >= $limitData)
                        <div class="text-center">
                            <button class="btn btn-info btn-lg mb-2 mt-5 _effect--ripple waves-effect waves-light" wire:loading>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin me-2">
                                    <line x1="12" y1="2" x2="12" y2="6"></line>
                                    <line x1="12" y1="18" x2="12" y2="22"></line>
                                    <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                                    <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                                    <line x1="2" y1="12" x2="6" y2="12"></line>
                                    <line x1="18" y1="12" x2="22" y2="12"></line>
                                    <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                                    <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                                </svg>
                                Loading
                            </button>
                            <a wire:click.prevent="addLimitData" class="mt-5 btn btn-info" wire:loading.remove>Soal selanjutnya</a>
                        </div>
                    @endif                   
                </div>                            
            </div>
        </div>
    </div>
</div>

