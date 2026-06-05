<style>
    /* Paksa tabel tidak overflow */
    #layananTable {
        width: 100% !important;
    }

    /* Child row full width */
    #layananTable tbody tr.child td {
        padding: 0 !important;
    }

    #layananTable tbody tr.child ul.dtr-details {
        width: 100%;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    #layananTable tbody tr.child ul.dtr-details li {
        display: flex;
        justify-content: space-between;
        padding: 8px 16px;
        border-bottom: 1px solid rgba(128, 128, 128, .15);
    }

    #layananTable tbody tr.child ul.dtr-details li:last-child {
        border-bottom: none;
    }

    #layananTable tbody tr.child ul.dtr-details li span.dtr-title {
        font-weight: 600;
        min-width: 130px;
    }

    #layananTable tbody tr.child ul.dtr-details li span.dtr-data {
        text-align: right;
    }


    #layananTable_wrapper {
        /* padding-top: 1.25rem; */
        padding-right: 1.25rem;
        padding-bottom: 1.25rem;
        padding-left: 1.25rem;
    }

    @media (max-width: 576px) {
        #layananTable_wrapper {
            padding: 0;
        }
    }
</style>
<!-- Modal Tambah Layanan -->
<div class="modal fade" id="tambahLayananModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ti ti-plus me-2"></i>Tambah Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="addNamaLayanan" placeholder="Contoh: Reguler">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Harga per Satuan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="addHargaPerKg" placeholder="0" min="0">
                        </div>
                        <small class="text-muted" id="addPreviewHarga"></small>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Satuan</label>
                        <select class="form-select" id="addSatuan">
                            <option value="kg">kg</option>
                            <option value="pcs">pcs</option>
                            <option value="item">item</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="addIsActive">
                            <option value="1" selected>Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white w-100 w-md-auto" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary w-100 w-md-auto" id="btnSimpanLayanan">
                    <i class="ti ti-device-floppy me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Layanan -->
<div class="modal fade" id="editLayananModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ti ti-pencil me-2"></i>Edit Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editLayananId">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="editNamaLayanan" placeholder="Contoh: Reguler">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Harga per Satuan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="editHargaPerKg" placeholder="0" min="0">
                        </div>
                        <small class="text-muted" id="editPreviewHarga"></small>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Satuan</label>
                        <select class="form-select" id="editSatuan">
                            <option value="kg">kg</option>
                            <option value="pcs">pcs</option>
                            <option value="item">item</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="editIsActive">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white w-100 w-md-auto" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary w-100 w-md-auto" id="btnUpdateLayanan">
                    <i class="ti ti-device-floppy me-1"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Container -->
<div class="custom-container">
    <div class="row g-6 mb-6">
        <div class="col-xl-12">
            <div class="card card-lg">
                <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Daftar Layanan</h5>
                        <small class="text-muted">Kelola layanan laundry</small>
                    </div>
                    <a href="#!" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahLayananModal">
                        <i class="ti ti-plus me-1"></i> Tambah
                    </a>
                </div>
                <div>
                    <table id="layananTable" class="table mb-0 table-centered table-hover w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Layanan</th>
                                <th>Satuan</th> <!-- tambah -->
                                <th>Harga / Satuan</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net@2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@2.1.8/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {

        const formatRp = (val) => val ? 'Rp ' + parseInt(val).toLocaleString('id-ID') : '';

        // DataTable
        $('#layananTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,

            ajax: {
                url: '<?= base_url("layanan/getData") ?>',
                type: 'POST',
            },
            columnDefs: [{
                    orderable: false,
                    targets: [0, 6]
                }, // 5 -> 6
                {
                    width: '5%',
                    targets: 0
                },
                {
                    width: '30%',
                    targets: 1
                },
                {
                    width: '10%',
                    targets: 2
                }, // Satuan baru
                {
                    width: '20%',
                    targets: 3
                }, // Harga
                {
                    width: '10%',
                    targets: 4
                }, // Status
                {
                    width: '15%',
                    targets: 5
                }, // Dibuat
                {
                    width: '10%',
                    targets: 6
                }, // Aksi
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                zeroRecords: "Data tidak ditemukan",
                processing: "Memuat data...",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Selanjutnya"
                },
            },
        });

        // Preview harga format rupiah
        $('#addHargaPerKg').on('blur', function() {
            $('#addPreviewHarga').text(formatRp($(this).val()));
        });
        $('#editHargaPerKg').on('blur', function() {
            $('#editPreviewHarga').text(formatRp($(this).val()));
        });

        // Reset modal tambah saat dibuka
        $('#tambahLayananModal').on('show.bs.modal', function() {
            $('#addNamaLayanan').val('');
            $('#addHargaPerKg').val('');
            $('#addPreviewHarga').text('');
            $('#addSatuan').val('kg'); // tambah
            $('#addIsActive').val('1');
        });

        // =============================================
        // SIMPAN
        // =============================================
        $('#btnSimpanLayanan').on('click', function() {
            if (!$('#addNamaLayanan').val()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Nama layanan wajib diisi!',
                    confirmButtonColor: '#378ADD'
                });
                return;
            }

            Swal.fire({
                title: 'Simpan Layanan?',
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
                    url: '<?= base_url("layanan/simpan") ?>',
                    type: 'POST',
                    data: {
                        nama_layanan: $('#addNamaLayanan').val(),
                        harga_per_kg: $('#addHargaPerKg').val() || 0,
                        satuan: $('#addSatuan').val(), // tambah
                        is_active: $('#addIsActive').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#tambahLayananModal').modal('hide');
                            $('#layananTable').DataTable().ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                confirmButtonColor: '#378ADD',
                                timer: 2000,
                                timerProgressBar: true
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: res.message,
                                confirmButtonColor: '#378ADD'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server.',
                            confirmButtonColor: '#378ADD'
                        });
                    }
                });
            });
        });

        // =============================================
        // EDIT
        // =============================================
        window.editLayanan = function(id) {
            $.ajax({
                url: '<?= base_url("layanan/getLayanan") ?>',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Memuat data...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(data) {
                    Swal.close();
                    if (!data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data tidak ditemukan',
                            confirmButtonColor: '#378ADD'
                        });
                        return;
                    }
                    $('#editLayananId').val(data.id);
                    $('#editNamaLayanan').val(data.nama_layanan);
                    $('#editHargaPerKg').val(data.harga_per_kg);
                    $('#editPreviewHarga').text(formatRp(data.harga_per_kg));
                    $('#editSatuan').val(data.satuan); // tambah
                    $('#editIsActive').val(data.is_active);
                    $('#editLayananModal').modal('show');
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal memuat data',
                        confirmButtonColor: '#378ADD'
                    });
                }
            });
        };

        $('#btnUpdateLayanan').on('click', function() {
            if (!$('#editNamaLayanan').val()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Nama layanan wajib diisi!',
                    confirmButtonColor: '#378ADD'
                });
                return;
            }

            Swal.fire({
                title: 'Simpan Perubahan?',
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
                    url: '<?= base_url("layanan/update") ?>',
                    type: 'POST',
                    data: {
                        id: $('#editLayananId').val(),
                        nama_layanan: $('#editNamaLayanan').val(),
                        harga_per_kg: $('#editHargaPerKg').val() || 0,
                        satuan: $('#editSatuan').val(), // tambah
                        is_active: $('#editIsActive').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#editLayananModal').modal('hide');
                            $('#layananTable').DataTable().ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                confirmButtonColor: '#378ADD',
                                timer: 2000,
                                timerProgressBar: true
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: res.message,
                                confirmButtonColor: '#378ADD'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server.',
                            confirmButtonColor: '#378ADD'
                        });
                    }
                });
            });
        });

        // =============================================
        // DELETE
        // =============================================
        window.deleteLayanan = function(id) {
            Swal.fire({
                title: 'Hapus Layanan?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="ti ti-trash me-1"></i> Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (!result.isConfirmed) return;

                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url("layanan/delete") ?>',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#layananTable').DataTable().ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: res.message,
                                confirmButtonColor: '#378ADD',
                                timer: 2000,
                                timerProgressBar: true
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: res.message,
                                confirmButtonColor: '#378ADD'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server.',
                            confirmButtonColor: '#378ADD'
                        });
                    }
                });
            });
        };

    });
</script>