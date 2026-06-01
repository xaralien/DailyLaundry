<style>
    #notaConfigWrapper {
        padding: var(--ds-card-spacer-y) var(--ds-card-spacer-x);
    }
</style>

<!-- Container -->
<div class="custom-container">
    <div class="row g-6 mb-6">
        <div class="col-xl-8 col-12">
            <div class="card card-lg">
                <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Konfigurasi Nomor Nota</h5>
                        <small class="text-muted">Atur format penomoran nota laundry</small>
                    </div>
                </div>
                <div class="card-body" id="notaConfigWrapper">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Prefix <small class="text-muted">(contoh: DU, INB)</small></label>
                            <input type="text" class="form-control" id="cfgPrefix" value="<?= $config->prefix ?>" maxlength="20">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Separator <small class="text-muted">(contoh: - / kosongkan)</small></label>
                            <input type="text" class="form-control" id="cfgSep" value="<?= $config->sep ?>" maxlength="5">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tampilkan Tahun?</label>
                            <select class="form-select" id="cfgUseYear">
                                <option value="1" <?= $config->use_year  == 1 ? 'selected' : '' ?>>Ya</option>
                                <option value="0" <?= $config->use_year  == 0 ? 'selected' : '' ?>>Tidak</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tampilkan Bulan?</label>
                            <select class="form-select" id="cfgUseMonth">
                                <option value="1" <?= $config->use_month == 1 ? 'selected' : '' ?>>Ya</option>
                                <option value="0" <?= $config->use_month == 0 ? 'selected' : '' ?>>Tidak</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Panjang Angka <small class="text-muted">(padding, contoh: 5 = 00001)</small></label>
                            <input type="number" class="form-control" id="cfgPadding" value="<?= $config->padding ?>" min="1" max="10">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Counter Saat Ini</label>
                            <input type="number" class="form-control" id="cfgCounter" value="<?= $config->counter ?>" min="1">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Auto Reset</label>
                            <select class="form-select" id="cfgAutoReset">
                                <option value="none" <?= $config->auto_reset === 'none'    ? 'selected' : '' ?>>Tidak Reset</option>
                                <option value="monthly" <?= $config->auto_reset === 'monthly' ? 'selected' : '' ?>>Setiap Bulan</option>
                                <option value="yearly" <?= $config->auto_reset === 'yearly'  ? 'selected' : '' ?>>Setiap Tahun</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Preview Nota</label>
                            <div class="form-control bg-body-secondary fw-bold text-primary" id="previewNota">
                                <?= $config->prefix . $config->sep ?>
                                <?= $config->use_year  ? date('Y') . $config->sep : '' ?>
                                <?= $config->use_month ? date('m') . $config->sep : '' ?>
                                <?= str_pad($config->counter, $config->padding, '0', STR_PAD_LEFT) ?>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <button type="button" class="btn btn-white" id="btnResetConfig">
                            <i class="ti ti-refresh me-1"></i> Reset
                        </button>
                        <button type="button" class="btn btn-primary" id="btnSimpanConfig">
                            <i class="ti ti-device-floppy me-1"></i> Simpan Konfigurasi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info card kanan -->
        <div class="col-xl-4 col-12">
            <div class="card card-lg h-100">
                <div class="card-header border-bottom-0">
                    <h5 class="mb-0">Info</h5>
                </div>
                <div class="card-body d-flex flex-column gap-3">
                    <div class="d-flex align-items-start gap-2">
                        <i class="ti ti-info-circle text-primary mt-1"></i>
                        <small>Nota hanya memiliki <b>1 konfigurasi</b>. Perubahan langsung berlaku untuk nota berikutnya.</small>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="ti ti-info-circle text-primary mt-1"></i>
                        <small><b>Counter</b> bisa diatur manual jika ingin melanjutkan dari nomor tertentu.</small>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="ti ti-info-circle text-warning mt-1"></i>
                        <small><b>Auto Reset</b> akan mereset counter ke 1 secara otomatis setiap bulan atau tahun baru.</small>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="ti ti-info-circle text-info mt-1"></i>
                        <small>Contoh format: <b>DU-2026-00213</b> (prefix=DU, sep=-, tahun=Ya, bulan=Tidak, padding=5)</small>
                    </div>
                    <hr>
                    <div>
                        <small class="text-muted">Terakhir diperbarui</small>
                        <div class="fw-bold"><?= date('d M Y H:i', strtotime($config->updated_at)) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {

        // Update preview realtime
        function updatePreview() {
            const prefix = $('#cfgPrefix').val();
            const sep = $('#cfgSep').val();
            const useYear = $('#cfgUseYear').val() == '1';
            const useMonth = $('#cfgUseMonth').val() == '1';
            const padding = parseInt($('#cfgPadding').val()) || 5;
            const counter = parseInt($('#cfgCounter').val()) || 1;

            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const num = String(counter).padStart(padding, '0');

            let preview = prefix;
            if (prefix) preview += sep;
            if (useYear) preview += year + sep;
            if (useMonth) preview += month + sep;
            preview += num;

            $('#previewNota').text(preview);
        }

        // Trigger preview saat ada perubahan
        $('#cfgPrefix, #cfgSep, #cfgUseYear, #cfgUseMonth, #cfgPadding, #cfgCounter').on('input change', updatePreview);

        // Simpan
        $('#btnSimpanConfig').on('click', function() {
            Swal.fire({
                title: 'Simpan Konfigurasi?',
                text: 'Perubahan akan langsung berlaku untuk nota berikutnya.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#378ADD',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (!result.isConfirmed) return;

                Swal.fire({
                    title: 'Menyimpan...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url("notaconfig/update") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        prefix: $('#cfgPrefix').val(),
                        sep: $('#cfgSep').val(),
                        use_year: $('#cfgUseYear').val(),
                        use_month: $('#cfgUseMonth').val(),
                        padding: $('#cfgPadding').val(),
                        counter: $('#cfgCounter').val(),
                        auto_reset: $('#cfgAutoReset').val(),
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            confirmButtonColor: '#378ADD',
                            timer: 2000,
                            timerProgressBar: true,
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server.',
                            confirmButtonColor: '#378ADD',
                        });
                    }
                });
            });
        });

        // Reset ke nilai awal (reload page)
        $('#btnResetConfig').on('click', function() {
            Swal.fire({
                title: 'Reset form?',
                text: 'Nilai akan kembali ke konfigurasi tersimpan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Reset!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) location.reload();
            });
        });

    });
</script>