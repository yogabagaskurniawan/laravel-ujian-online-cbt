<div class="maintanence text-center layout-boxed mt-5">
    <div class="container-fluid maintanence-content">
        <div class="">
            {{-- <div class="maintanence-hero-img mx-auto">
                <a class="d-flex justify-content-center">
                    <img alt="logo" src="/admin/src/assets/img/logo2.svg" class="light-element theme-logo">
                </a>
            </div> --}}
            <h5 class="error-title mt-3">Selamat! <br> telah menyelesaikan tes</h5>
            <p class="error-text">Semoga Anda mendapatkan hasil yang lebih baik untuk segera mempersiapkan <br> karir masa depan Anda yang hebat</p>
            <a href="{{ route('rapportDetail', $course->uid) }}" class="btn btn-dark mt-4">Lihat Hasil Test</a>
        </div>
    </div>
</div>
