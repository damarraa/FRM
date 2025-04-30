<!-- Required Js -->
<script src="{{ asset('templatev2/src/assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('templatev2/dist/assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('templatev2/src/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('templatev2/dist/assets/js/plugins/apexcharts.min.js') }}"></script>
<!-- Apex Chart -->
<script src="{{ asset('templatev2/dist/assets/js/plugins/apexcharts.min.js') }}"></script>
<!-- custom-chart js -->
<script src="{{ asset('templatev2/dist/assets/js/pages/dashboard-main.js') }}"></script>

<script src="{{ asset('/sw.js') }}"></script>

<!-- Add this before your closing </body> tag if not already included -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

<script>
    const formInspeksi = document.getElementById("formInspeksi");

    if (formInspeksi) {
        // Fungsi untuk menyimpan data ke local storage
        function simpanDataForm() {
            const formData = new FormData(formInspeksi);
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });
            localStorage.setItem("formInspeksiData", JSON.stringify(formObject));
        }

        // Fungsi untuk memuat data dari local storage
        function muatDataForm() {
            const savedData = localStorage.getItem("formInspeksiData");
            if (savedData) {
                const formObject = JSON.parse(savedData);
                for (const key in formObject) {
                    const inputElement = formInspeksi.querySelector([name = "${key}"]);
                    if (inputElement && inputElement.type !== "file") {
                        inputElement.value = formObject[key];
                    }
                }
                // Trigger change event untuk Select2
                setTimeout(() => {
                    $(".select2").trigger("change");
                }, 100);
            }
        }
    }

    // Fungsi untuk menghapus data dari local storage
    function hapusDataForm() {
        localStorage.removeItem("formInspeksiData");
    }

    // Event listener untuk input dan change
    formInspeksi.querySelectorAll("input, select, textarea").forEach(element => {
        element.addEventListener("input", simpanDataForm);
        element.addEventListener("change", simpanDataForm);
    });

    // Event listener untuk form reset
    formInspeksi.addEventListener("reset", function() {
        hapusDataForm();
    });

    // Muat data saat halaman dimuat
    muatDataForm();
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const formInspeksi = document.getElementById("formInspeksi");

        if (formInspeksi) {
            // 🔹 Fungsi untuk menyimpan data ke local storage
            function simpanDataForm() {
                const formData = new FormData(formInspeksi);
                const formObject = {};

                formData.forEach((value, key) => {
                    formObject[key] = value;
                });

                localStorage.setItem("formInspeksiData", JSON.stringify(formObject));
            }

            // 🔹 Fungsi untuk memuat data dari local storage
            function muatDataForm() {
                const savedData = localStorage.getItem("formInspeksiData");

                if (savedData) {
                    const formObject = JSON.parse(savedData);
                    for (const key in formObject) {
                        const inputElement = formInspeksi.querySelector([name = "${key}"]);

                        if (inputElement) {
                            if (inputElement.type === "checkbox" || inputElement.type === "radio") {
                                inputElement.checked = formObject[key] === "on";
                            } else {
                                inputElement.value = formObject[key];
                            }
                        }
                    }
                    // 🔹 Trigger event agar Select2 diperbarui
                    setTimeout(() => {
                        $(".select2").trigger("change");
                    }, 100);
                }
            }

            // 🔹 Fungsi untuk menghapus data dari local storage
            function hapusDataForm() {
                localStorage.removeItem("formInspeksiData");
            }

            // 🔹 Event listener untuk input, select, dan textarea
            formInspeksi.querySelectorAll("input, select, textarea").forEach(element => {
                element.addEventListener("input", simpanDataForm);
                element.addEventListener("change", simpanDataForm);
            });

            // 🔹 Event listener untuk reset form
            formInspeksi.addEventListener("reset", function() {
                hapusDataForm();
            });

            // 🔹 Muat data saat halaman dimuat
            muatDataForm();
        } else {
            console.error("⚠ Form dengan ID 'formInspeksi' tidak ditemukan.");
        }
    });
</script>

<script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded:", registration);
            },
            (error) => {
                console.error(`Service worker registration failed: ${error}`);
            },
        );
    } else {
        console.error("Service workers are not supported.");
    }
</script>

<script>
    function handleFormSubmit(event) {
        event.preventDefault(); // Mencegah form submit default

        if (this.checkValidity()) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengirimkan formulir ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Berhasil!',
                        'Formulir berhasil dikirim.',
                        'success'
                    ).then(() => {
                        this.submit(); // Submit form setelah menampilkan pesan sukses
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Harap isi semua field yang diperlukan!',
            });
        }
    }

    // Inisialisasi Select2
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        $('.select2').select2();
    });

    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
        document.getElementById("tgl_inspeksi").value = today; // Set nilai input
    });

    //  JS untuk hitung tahun produksi - masa pakai 
    // Mendapatkan elemen select dan input masa pakai
    const selectTahun = document.getElementById("tahun_produksi");
    const inputMasaPakai = document.getElementById("masa_pakai");

    // Mendapatkan tahun saat ini
    const tahunSekarang = new Date().getFullYear();

    // Loop untuk menambahkan opsi dari tahun 2000 hingga sekarang
    for (let tahun = tahunSekarang; tahun >= 2000; tahun--) {
        let option = document.createElement("option");
        option.value = tahun; // Tetap angka (number), walaupun secara default select menyimpan sebagai string
        option.textContent = tahun;
        selectTahun.appendChild(option);
    }

    // Event listener untuk menghitung masa pakai saat tahun produksi berubah
    selectTahun.addEventListener("change", function() {
        const tahunProduksi = parseInt(this.value); // Konversi ke number
        if (!isNaN(tahunProduksi)) {
            inputMasaPakai.value = tahunSekarang - tahunProduksi; // Hanya angka tanpa teks "tahun"
        } else {
            inputMasaPakai.value = "";
        }
    });
</script>

{{-- Date otomatis --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const today = new Date().toISOString().split('T')[0]; // Format: YYYY-MM-DD
        document.getElementById("tgl_inspeksi").value = today;
    });
</script>

{{-- AJAX ULP --}}
<script>
    $(document).ready(function() {
        $('#up3_id').change(function() {
            var up3_id = $(this).val();
            // console.log("UNIT yang dipilih: " + up3_id); // Debugging

            $('#ulp_id').html('<option value="">-- Pilih ULP --</option>');

            if (up3_id) {
                $.ajax({
                    url: '/get-ulps',
                    type: 'GET',
                    data: {
                        up3_id: up3_id
                    },
                    success: function(data) {
                        // console.log("Data ULP dari server:", data); // Debugging

                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                $('#ulp_id').append('<option value="' + value.id +
                                    '">' + value.daerah + '</option>');
                            });
                        } else {
                            // console.log("Tidak ada ULP untuk UNIT ini.");
                        }
                    },
                    error: function(xhr) {
                        // console.log("Terjadi kesalahan: ", xhr.responseText);
                    }
                });
            }
        });
    });
</script>

{{-- AJAX Gudang --}}
<script>
    $(document).ready(function() {
        $('#up3_id').change(function() {
            var up3_id = $(this).val();
            // console.log("UNIT yang dipilih: " + up3_id); // Debugging

            $('#gudang_id').html('<option value="">-- Pilih Gudang Retur --</option>');

            if (up3_id) {
                $.ajax({
                    url: '/get-gudangs',
                    type: 'GET',
                    data: {
                        up3_id: up3_id
                    },
                    success: function(data) {
                        // console.log("Data ULP dari server:", data); // Debugging

                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                $('#gudang_id').append('<option value="' + value
                                    .id +
                                    '">' + value.nama_gudang + '</option>');
                            });
                        } else {
                            // console.log("Tidak ada ULP untuk UNIT ini.");
                        }
                    },
                    error: function(xhr) {
                        // console.log("Terjadi kesalahan: ", xhr.responseText);
                    }
                });
            }
        });
    });
</script>

<!-- {{-- AJAX Kelas Pengujian --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('/kelas-pengujians') // Ambil data dari route web
            .then(response => response.json())
            .then(data => {
                let select = document.getElementById('kelas_pengujian');
                data.forEach(item => {
                    let option = document.createElement('option');
                    option.value = item.kelas_pengujian;
                    option.textContent = item.kelas_pengujian;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    });
</script> -->

{{-- AJAX Logout --}}
<script>
    function logoutUser() {
        fetch("{{ route('logout') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        }).then(() => {
            window.location.href = "{{ route('login') }}"; // Redirect ke login setelah logout
        });
    }
</script>
<script>
    feather.replace();
</script>

</body>

</html>
