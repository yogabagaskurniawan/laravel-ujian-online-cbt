{{-- <form wire:submit.prevent="submitAnswers">
    @foreach($questions as $question)
        <div class="question">
            <h5>{{ $question->ask }}</h5>
            @foreach($question->getQuestionChoice as $choice)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question{{ $question->id }}" id="choice{{ $choice->id }}" wire:model="answers.{{ $question->id }}" value="{{ $choice->id }}">
                    <label class="form-check-label" for="choice{{ $choice->id }}">
                        {{ $choice->choice }}
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach
    <button type="submit" class="btn btn-primary">Submit</button>
</form> --}}
<div class="middle-content container-xxl p-0">
    <div class="faq">
        <div class="faq-layouting layout-spacing">
            <div class="fq-tab-section">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <h2><span class="me-2">1.</span> Frequently Asked Questions</h2>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                    </div>
                    <div class="col-md-12 mt-4">
                        <h2><span class="me-2">1.</span> Frequently Asked Questions</h2>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                    </div>
                    <div class="col-md-12 mt-4">
                        <h2><span class="me-2">1.</span> Frequently Asked Questions</h2>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                        <p class="mt-4 mb-0 ms-5">Search instant answers &amp; questions asked by popular users</p>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
</div>

