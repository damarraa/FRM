{{-- <x-layouts.header />
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ form-element ] start -->
        <div class="col-sm-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="mb-4 font-weight-bold">Edit Profil - {{ $user->name }}</h5>
                    <hr class="mb-4">
                    <!-- Form Edit Profil -->
                    <form id="edit-profile-form" action="{{ route('profile.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukkan Nama Lengkap" value="{{ old('name', $user->name) }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Masukkan Email" value="{{ old('email', $user->email) }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukkan Alamat">{{ old('alamat', $user->alamat) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No Handphone</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        placeholder="Masukkan No Handphone" value="{{ old('no_hp', $user->no_hp) }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Masukkan Password Baru">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah
                                        password</small>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Konfirmasi Password Baru">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Signature Section -->
                        <div class="mt-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold">Tanda Tangan Digital</label>
                                <button type="button" id="open-signature-modal" class="btn btn-primary btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#signatureModal">
                                    <i class="bi bi-pen-fill me-1"></i> Buat Tanda Tangan
                                </button>
                            </div>

                            <!-- Signature Preview -->
                            <div class="signature-preview-container border rounded p-3 bg-light">
                                <div id="no-signature-alert" class="alert alert-info py-2 mb-0"
                                    style="{{ $user->signature ? 'display: none;' : 'display: block;' }}">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada tanda tangan
                                </div>
                                <img id="signature-image" class="img-fluid d-block mx-auto signature-image"
                                    src="{{ $user->signature ? $user->signature : '#' }}"
                                    style="{{ $user->signature ? 'display: block; max-height: 100px;' : 'display: none;' }}" />
                            </div>
                            <input type="hidden" name="signature" id="signature" value="{{ $user->signature }}">
                        </div>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- [ form-element ] end -->
    </div>
</section>

<!-- Modal untuk Tanda Tangan -->
<div class="modal fade" id="signatureModal" tabindex="-1" aria-labelledby="signatureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="signatureModalLabel">
                    <i class="bi bi-pen-fill me-2"></i> Buat Tanda Tangan Digital
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="signature-instructions mb-3">
                    <p class="text-muted mb-2">
                        <i class="bi bi-info-circle me-1"></i>
                        Silahkan buat tanda tangan Anda di area berikut:
                    </p>
                </div>

                <div class="signature-wrapper border rounded mb-3">
                    <canvas id="signatureCanvas" class="w-100" style="height: 200px; touch-action: none;"></canvas>
                </div>

                <div class="signature-footer text-end">
                    <button type="button" id="clear-signature" class="btn btn-outline-danger me-2">
                        <i class="bi bi-eraser-fill me-1"></i> Hapus
                    </button>
                    <button type="button" id="save-signature" class="btn btn-primary" data-bs-dismiss="modal">
                        <i class="bi bi-check-circle-fill me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<!-- Signature Pad JS -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "3000"
    };

    // Toast Notification untuk Submit Sukses
    document.getElementById('edit-profile-form').addEventListener('submit', function(e) {
        // Jika form valid, tampilkan toast sukses
        const submitButton = this.querySelector('button[type="submit"]');
        if (submitButton) {
            // Tampilkan toast sukses
            toastr.success('Data berhasil disimpan!');
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Toggle Password Visibility
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');
        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('.input-group').querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });

        // Initialize Signature Pad
        const canvas = document.getElementById('signatureCanvas');
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: '#000000',
            minWidth: 1,
            maxWidth: 3,
            throttle: 16
        });

        // Resize canvas function
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext('2d').scale(ratio, ratio);
            signaturePad.clear();
        }

        // Initialize canvas when modal is shown
        const signatureModal = document.getElementById('signatureModal');
        signatureModal.addEventListener('shown.bs.modal', function() {
            resizeCanvas();
        });

        // Clear signature
        document.getElementById('clear-signature').addEventListener('click', function() {
            signaturePad.clear();
        });

        // Save signature
        document.getElementById('save-signature').addEventListener('click', function() {
            if (!signaturePad.isEmpty()) {
                const dataURL = signaturePad.toDataURL('image/png');
                document.getElementById('signature').value = dataURL;
                document.getElementById('signature-image').src = dataURL;
                document.getElementById('signature-image').style.display = 'block';
                document.getElementById('no-signature-alert').style.display = 'none';

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Tanda tangan telah disimpan.',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Silahkan buat tanda tangan terlebih dahulu!',
                });
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if ($('#signatureModal').hasClass('show')) {
                resizeCanvas();
            }
        });

        // Prevent scrolling when drawing on canvas (for mobile)
        canvas.addEventListener('touchmove', function(e) {
            e.preventDefault();
        }, {
            passive: false
        });

        // Submit Form
        document.getElementById('edit-profile-form').addEventListener('submit', function(e) {
            e.preventDefault();
            this.submit();
        });
    });
</script>

<x-layouts.footer /> --}}


<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ form-element ] start -->
        <div class="col-sm-12">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Edit Profil</h5>
                        <hr class="mb-3">
                        <!-- Form Start -->
                        <form id="edit-profile-form" action="{{ route('profile.update') }}" method="POST"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PATCH')

                            <!-- Profile Header -->
                            <div class="text-center mb-5">
                                <div class="position-relative d-inline-block">
                                    <label for="profile_picture" style="cursor: pointer; position: relative;">
                                        <img id="profile-picture-preview" src="{{ $profilePictureUrl }}"
                                            alt="Foto Profil" class="rounded-circle border border-4 border-cyan shadow"
                                            style="width: 140px; height: 140px; object-fit: cover;">
                                        <div
                                            class="position-absolute bottom-0 end-0 bg-cyan rounded-circle p-2 shadow-sm">
                                            <i class="bi bi-pen-fill text-white"></i>
                                        </div>
                                    </label>
                                    {{-- <label for="profile_picture" style="cursor: pointer;">
                                        <img id="profile-picture-preview"
                                            src="{{ $user->profile_picture ? asset('profile_pictures/' . $user->profile_picture) : asset('icons/user.png') }}"
                                            alt="Foto Profil" class="rounded-circle border border-4 border-cyan shadow"
                                            style="width: 140px; height: 140px; object-fit: cover;">
                                        <div
                                            class="position-absolute bottom-0 end-0 bg-cyan rounded-circle p-2 shadow-sm">
                                            <i class="bi bi-pen-fill text-white"></i>
                                        </div>
                                    </label> --}}
                                    <input type="file" id="profile_picture" name="profile_picture" class="d-none"
                                        accept="image/jpeg,image/png,image/jpg,image/gif">
                                </div>
                                <h3 class="mt-4 mb-0 fw-bold text-cyan-dark">{{ $user->name }}</h3>
                                <span class="badge bg-cyan-light text-cyan-dark fw-normal fs-6 mt-2 px-3 py-1 d-inline-block">
                                    <i class="bi bi-person-badge me-1"></i>
                                    {{ auth()->user()->roles->first()->desc ?? 'Tidak ada role' }}
                                    @if (auth()->user()->hasRole('PIC_Gudang') && auth()->user()->gudang)
                                        <span class="d-block mt-1">- {{ auth()->user()->gudang->nama_gudang }}</span>
                                    @endif
                                </span>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-cyan alert-dismissible fade show">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="row g-4">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control bg-light" id="name"
                                            value="{{ $user->name }}" readonly>
                                        <label for="name" class="text-muted">
                                            <i class="bi bi-person-fill me-1"></i> Nama Lengkap
                                        </label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control bg-light" id="email"
                                            value="{{ $user->email }}" readonly>
                                        <label for="email" class="text-muted">
                                            <i class="bi bi-envelope-fill me-1"></i> Alamat Email
                                        </label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="alamat" name="alamat" style="height: 100px">{{ old('alamat', $user->alamat) }}</textarea>
                                        <label for="alamat">
                                            <i class="bi bi-house-fill me-1"></i> Alamat
                                        </label>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                                            value="{{ old('no_hp', $user->no_hp) }}" required pattern="[0-9]{10,13}">
                                        <label for="no_hp">
                                            <i class="bi bi-phone-fill me-1"></i> Nomor Handphone
                                        </label>
                                        <div class="invalid-feedback">
                                            Harap masukkan nomor handphone yang valid (10-13 digit angka)
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Masukkan Password Baru" minlength="8">
                                            <button class="btn btn-outline-cyan toggle-password" type="button">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>

                                        <small class="text-muted ms-1">
                                            <i class="bi bi-info-circle me-1"></i> Kosongkan jika tidak ingin mengubah
                                            password (minimal 8 karakter)
                                        </small>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" placeholder="Konfirmasi Password Baru"
                                                minlength="8">
                                            <button class="btn btn-outline-cyan toggle-password" type="button">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Digital Signature Section -->
                            <div class="mt-5 pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-cyan-dark mb-0">
                                        <i class="bi bi-pen-fill me-2"></i>Tanda Tangan Digital
                                    </h5>
                                    <button type="button" id="open-signature-modal"
                                        class="btn btn-cyan btn-sm rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#signatureModal">
                                        <i class="bi bi-pen-fill me-1"></i> Buat Tanda Tangan
                                    </button>
                                </div>

                                <div class="signature-preview-container border rounded p-4 bg-cyan-lightest text-center"
                                    style="border-style: dashed !important;">
                                    <div id="no-signature-alert"
                                        class="alert alert-cyan py-2 mb-0 d-flex align-items-center justify-content-center"
                                        style="{{ $user->signature ? 'display: none;' : 'display: flex;' }}">
                                        <i class="bi bi-info-circle-fill me-2"></i> Belum ada tanda tangan
                                    </div>
                                    <img id="signature-image" class="img-fluid d-block mx-auto signature-image"
                                        src="{{ $user->signature ? $user->signature : '#' }}"
                                        style="{{ $user->signature ? 'display: block; max-height: 100px;' : 'display: none;' }}" />
                                </div>
                                <input type="hidden" name="signature" id="signature"
                                    value="{{ $user->signature }}">
                            </div>

                            <!-- Save Button -->
                            <div class="mt-5 text-center">
                                <button type="submit" class="btn btn-cyan btn-lg px-5 rounded-pill shadow">
                                    <i class="bi bi-save-fill me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ form-element ] end -->
    </div>
</section>

<!-- Signature Modal -->
<div class="modal fade" id="signatureModal" tabindex="-1" aria-labelledby="signatureModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <div class="modal-header bg-cyan text-white" style="border-radius: 15px 15px 0 0;">
                <h5 class="modal-title" id="signatureModalLabel">
                    <i class="bi bi-pen-fill me-2"></i> Buat Tanda Tangan Digital
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="signature-instructions mb-4">
                    <div class="alert alert-cyan-light d-flex align-items-center">
                        <i class="bi bi-info-circle-fill me-3 fs-4 text-cyan"></i>
                        <div>
                            <h6 class="mb-1 text-cyan-dark">Petunjuk Tanda Tangan</h6>
                            <p class="small mb-0 text-muted">Gunakan mouse atau jari (di perangkat layar sentuh) untuk
                                membuat tanda tangan di area berikut.</p>
                        </div>
                    </div>
                </div>

                <div class="signature-wrapper border rounded mb-4" style="background-color: #f8fafc;">
                    <canvas id="signatureCanvas" class="w-100" style="height: 250px; touch-action: none;"></canvas>
                </div>

                <div class="signature-footer d-flex justify-content-between align-items-center">
                    <button type="button" id="clear-signature" class="btn btn-outline-danger rounded-pill">
                        <i class="bi bi-eraser-fill me-1"></i> Hapus
                    </button>
                    <div>
                        <button type="button" class="btn btn-outline-secondary rounded-pill me-2"
                            data-bs-dismiss="modal">
                            <i class="bi bi-x-circle-fill me-1"></i> Batal
                        </button>
                        <button type="button" id="save-signature" class="btn btn-cyan rounded-pill">
                            <i class="bi bi-check-circle-fill me-1"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS for Cyan Theme -->
<style>
    :root {
        --cyan: #00bcd4;
        --cyan-light: #80deea;
        --cyan-dark: #008ba3;
        --cyan-lightest: #e0f7fa;
        --cyan-gradient: linear-gradient(135deg, #00bcd4 0%, #4dd0e1 100%);
    }

    .bg-cyan {
        background-color: var(--cyan) !important;
    }

    .bg-cyan-light {
        background-color: var(--cyan-light) !important;
    }

    .bg-cyan-dark {
        background-color: var(--cyan-dark) !important;
    }

    .bg-cyan-lightest {
        background-color: var(--cyan-lightest) !important;
    }

    .bg-cyan-gradient {
        background-image: var(--cyan-gradient) !important;
    }

    .text-cyan {
        color: var(--cyan) !important;
    }

    .text-cyan-light {
        color: var(--cyan-light) !important;
    }

    .text-cyan-dark {
        color: var(--cyan-dark) !important;
    }

    .btn-cyan {
        background-color: var(--cyan);
        border-color: var(--cyan);
        color: white;
    }

    .btn-cyan:hover,
    .btn-cyan:focus {
        background-color: var(--cyan-dark);
        border-color: var(--cyan-dark);
        color: white;
    }

    .btn-outline-cyan {
        color: var(--cyan);
        border-color: var(--cyan);
    }

    .btn-outline-cyan:hover {
        background-color: var(--cyan);
        color: white;
    }

    .alert-cyan {
        background-color: var(--cyan-lightest);
        border-color: var(--cyan-light);
        color: var(--cyan-dark);
    }

    .border-cyan {
        border-color: var(--cyan-light) !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--cyan-light);
        box-shadow: 0 0 0 0.25rem rgba(0, 188, 212, 0.25);
    }

    .signature-preview-container {
        transition: all 0.3s ease;
    }

    .signature-preview-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 188, 212, 0.1);
    }

    /* New CSS for Profile Picture */
    #profile-picture-preview {
        transition: all 0.3s ease;
        object-fit: cover;
    }

    #profile-picture-preview:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 188, 212, 0.3);
    }

    label[for="profile_picture"] {
        display: inline-block;
        position: relative;
    }

    label[for="profile_picture"]:hover .position-absolute {
        background-color: var(--cyan-dark) !important;
        transform: scale(1.1);
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<!-- Signature Pad JS -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Form Validation
        (function() {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()

        // Toggle Password Visibility
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');
        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('.input-group').querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye-fill');
                    icon.classList.add('bi-eye-slash-fill');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash-fill');
                    icon.classList.add('bi-eye-fill');
                }
            });
        });

        // Initialize Signature Pad
        const canvas = document.getElementById('signatureCanvas');
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: '#008ba3',
            minWidth: 1.5,
            maxWidth: 3.5,
            throttle: 16,
            velocityFilterWeight: 0.7
        });

        // Resize canvas function
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext('2d').scale(ratio, ratio);
            signaturePad.clear();
        }

        // Initialize canvas when modal is shown
        const signatureModal = document.getElementById('signatureModal');
        signatureModal.addEventListener('shown.bs.modal', function() {
            resizeCanvas();
        });

        // Clear signature
        document.getElementById('clear-signature').addEventListener('click', function() {
            signaturePad.clear();
        });

        // Save signature
        document.getElementById('save-signature').addEventListener('click', function() {
            if (!signaturePad.isEmpty()) {
                const dataURL = signaturePad.toDataURL('image/png');
                document.getElementById('signature').value = dataURL;
                document.getElementById('signature-image').src = dataURL;
                document.getElementById('signature-image').style.display = 'block';
                document.getElementById('no-signature-alert').style.display = 'none';

                Swal.fire({
                    icon: 'success',
                    title: 'Tanda Tangan Tersimpan!',
                    text: 'Tanda tangan Anda telah berhasil disimpan.',
                    showConfirmButton: false,
                    timer: 1500,
                    background: 'white',
                    iconColor: '#00bcd4'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Silahkan buat tanda tangan terlebih dahulu!',
                    confirmButtonColor: '#00bcd4',
                    background: 'white'
                });
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if ($('#signatureModal').hasClass('show')) {
                resizeCanvas();
            }
        });

        // Prevent scrolling when drawing on canvas (for mobile)
        canvas.addEventListener('touchmove', function(e) {
            e.preventDefault();
        }, {
            passive: false
        });

        // Preview profile picture before upload
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                const preview = document.getElementById('profile-picture-preview');

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(this.files[0]);

                // Tampilkan notifikasi bahwa gambar baru akan diupload
                Swal.fire({
                    icon: 'info',
                    title: 'Gambar Profil Baru',
                    text: 'Gambar profil baru akan disimpan saat Anda mengklik "Simpan Perubahan"',
                    showConfirmButton: false,
                    timer: 2000,
                    background: 'white',
                    iconColor: '#00bcd4'
                });
            }
        });

        // Submit Form
        document.getElementById('edit-profile-form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const profilePicture = document.getElementById('profile_picture').files[0];

            // Validasi password
            if (password && password !== confirmPassword) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Cocok',
                    text: 'Password dan konfirmasi password harus sama',
                    confirmButtonColor: '#00bcd4',
                    background: 'white'
                });
                return;
            }

            // Validasi ukuran gambar (jika ada gambar yang diupload)
            if (profilePicture && profilePicture.size > 2048 * 1024) { // 2MB in bytes
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran Gambar Terlalu Besar',
                    text: 'Ukuran gambar profil maksimal 2MB',
                    confirmButtonColor: '#00bcd4',
                    background: 'white'
                });
            }
        });
    });
</script>

<x-layouts.footer />
