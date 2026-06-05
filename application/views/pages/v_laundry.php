<style>
    /* Paksa tabel tidak overflow */
    #orderTable {
        width: 100% !important;
    }

    /* Child row full width */
    #orderTable tbody tr.child td {
        padding: 0 !important;
    }

    #orderTable tbody tr.child ul.dtr-details {
        width: 100%;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    #orderTable tbody tr.child ul.dtr-details li {
        display: flex;
        justify-content: space-between;
        padding: 8px 16px;
        border-bottom: 1px solid rgba(128, 128, 128, .15);
    }

    #orderTable tbody tr.child ul.dtr-details li:last-child {
        border-bottom: none;
    }

    #orderTable tbody tr.child ul.dtr-details li span.dtr-title {
        font-weight: 600;
        min-width: 130px;
    }

    #orderTable tbody tr.child ul.dtr-details li span.dtr-data {
        text-align: right;
    }

    #orderTable_wrapper {
        /* padding-top: 1.25rem; */
        padding-right: 1.25rem;
        padding-bottom: 1.25rem;
        padding-left: 1.25rem;
    }

    @media (max-width: 576px) {
        #orderTable_wrapper {
            padding: 0;
        }
    }
</style>

<!-- Modal Tambah Order -->
<div class="modal fade" id="tambahOrderModal" tabindex="-1" aria-labelledby="tambahOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahOrderModalLabel">Tambah Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-y-auto">
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">No Nota</label>
                        <input type="text" class="form-control" name="no_nota" placeholder="Contoh: 1335" value="<?= $nextNota ?>">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Nama Customer</label>
                        <input type="text" class="form-control" name="nama_customer" placeholder="Nama customer">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tgl_masuk" id="tglMasuk">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tgl_selesai">
                    </div>
                    <!-- Hapus col-6 Layanan dan col-6 Berat yang lama, ganti dengan ini -->
                    <div class="col-12">
                        <label class="form-label">Layanan & Quantity</label>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-2" id="tblLayanan">
                                <thead>
                                    <tr>
                                        <th>Layanan</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>Harga/Satuan</th>
                                        <th>Subtotal</th>
                                        <th>Catatan</th> <!-- tambah -->
                                        <th>
                                            <button type="button" class="btn btn-success btn-sm" id="btnAddLayanan">
                                                <i class="ti ti-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="bodyLayanan">
                                    <!-- row dinamis -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Total</td>
                                        <td colspan="2" class="fw-bold text-primary" id="totalLayanan">Rp 0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- Tambahkan ini -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Delivery</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="switchDelivery" name="is_delivery" value="1">
                            <label class="form-check-label" for="switchDelivery">Gunakan Delivery</label>
                        </div>
                    </div>
                    <div class="col-12" id="fieldDelivery" style="display:none;">
                        <label class="form-label">Biaya Delivery</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="inputDelivery" name="biaya_delivery" placeholder="0" min="0">
                        </div>
                        <small class="text-muted" id="previewDelivery"></small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Detail Item</label>
                        <input type="text" class="form-control" name="detail_item" placeholder="Contoh: BC 3, Sprei 3Set, Selimut 1">
                    </div>
                    <div class="col-4">
                        <label class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="inputHarga" name="harga" placeholder="0" min="0">
                        </div>
                        <small class="text-muted" id="previewHarga"></small>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Dibayar</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="inputDebit" name="debit" placeholder="0" min="0">
                        </div>
                        <small class="text-muted" id="previewDebit"></small>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Sisa</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="inputKredit" name="kredit" placeholder="0" min="0" readonly>
                        </div>
                        <small class="text-muted" id="previewKredit"></small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="2" placeholder="Catatan tambahan..."></textarea>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="proses" selected>Proses</option>
                            <option value="cuci">Cuci</option>
                            <option value="kering">Kering</option>
                            <option value="belum_diambil">Belum Diambil</option>
                            <option value="diambil">Diambil</option>
                            <option value="batal">Batal</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white w-100 w-md-auto" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary w-100 w-md-auto" id="btnSimpan">
                    <i class="ti ti-device-floppy me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Order -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel">
                    <i class="ti ti-pencil me-2"></i>Edit Order
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-y-auto">
                <input type="hidden" id="editOrderId">
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">No Nota</label>
                        <input type="text" class="form-control" id="editNoNota" placeholder="Contoh: 1335">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Nama Customer</label>
                        <input type="text" class="form-control" id="editNamaCustomer" placeholder="Nama customer">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="editTglMasuk">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="editTglSelesai">
                    </div>

                    <!-- Tabel Multi Layanan -->
                    <div class="col-12">
                        <label class="form-label">Layanan & Quantity</label>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-2" id="tblEditLayanan">
                                <thead>
                                    <tr>
                                        <th>Layanan</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>Harga/Satuan</th>
                                        <th>Subtotal</th>
                                        <th>Catatan</th> <!-- tambah -->
                                        <th>
                                            <button type="button" class="btn btn-success btn-sm" id="btnEditAddLayanan">
                                                <i class="ti ti-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="editBodyLayanan"></tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Total</td>
                                        <td colspan="2" class="fw-bold text-primary" id="editTotalLayanan">Rp 0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Delivery -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Delivery</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="editSwitchDelivery">
                            <label class="form-check-label" for="editSwitchDelivery">Gunakan Delivery</label>
                        </div>
                    </div>
                    <div class="col-12" id="editFieldDelivery" style="display:none;">
                        <label class="form-label">Biaya Delivery</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="editInputDelivery" placeholder="0" min="0">
                        </div>
                        <small class="text-muted" id="editPreviewDelivery"></small>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Detail Item</label>
                        <input type="text" class="form-control" id="editDetailItem" placeholder="Contoh: BC 3, Sprei 3Set, Selimut 1">
                    </div>
                    <div class="col-4">
                        <label class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="editInputHarga" placeholder="0" min="0" readonly>
                        </div>
                        <small class="text-muted" id="editPreviewHarga"></small>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Dibayar</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="editInputDebit" placeholder="0" min="0">
                        </div>
                        <small class="text-muted" id="editPreviewDebit"></small>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Sisa</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="editInputKredit" placeholder="0" min="0" readonly>
                        </div>
                        <small class="text-muted" id="editPreviewKredit"></small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control" id="editCatatan" rows="2" placeholder="Catatan tambahan..."></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="editStatus">
                            <option value="proses">Proses</option>
                            <option value="cuci">Cuci</option>
                            <option value="kering">Kering</option>
                            <option value="belum_diambil">Belum Diambil</option>
                            <option value="diambil">Diambil</option>
                            <option value="batal">Batal</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white w-100 w-md-auto" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary w-100 w-md-auto" id="btnUpdate">
                    <i class="ti ti-device-floppy me-1"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Detail Order -->
<div class="modal fade" id="detailOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ti ti-list-details me-2"></i>Detail Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3" id="detailOrderInfo"></div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Layanan</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                                <th>Harga/Satuan</th>
                                <th>Subtotal</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody id="detailOrderBody"></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Total</td>
                                <td colspan="2" class="fw-bold text-primary" id="detailOrderTotal"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Process Order -->
<div class="modal fade" id="processOrderModal" tabindex="-1" aria-labelledby="processOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="processOrderModalLabel">
                    <i class="ti ti-refresh me-2"></i>Proses Order
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="processOrderId">
                <div class="mb-3">
                    <p class="text-muted mb-1">Order</p>
                    <p class="fw-semibold mb-0" id="processOrderInfo">—</p>
                </div>
                <div class="mb-1">
                    <label class="form-label fw-semibold">Ubah Status</label>
                    <div class="d-flex flex-column gap-2 mt-2" id="statusOptions">
                        <?php
                        $statuses = [
                            'proses'        => ['label' => 'Proses',        'class' => 'text-info-emphasis bg-info-subtle',        'icon' => 'ti-loader'],
                            'cuci'          => ['label' => 'Cuci',          'class' => 'text-primary-emphasis bg-primary-subtle',  'icon' => 'ti-droplet'],
                            'kering'        => ['label' => 'Kering',        'class' => 'text-warning-emphasis bg-warning-subtle',  'icon' => 'ti-sun'],
                            'belum_diambil' => ['label' => 'Belum Diambil', 'class' => 'text-danger-emphasis bg-danger-subtle',    'icon' => 'ti-clock'],
                            'diambil'       => ['label' => 'Diambil',       'class' => 'text-success-emphasis bg-success-subtle',  'icon' => 'ti-check'],
                            'batal'         => ['label' => 'Batal',         'class' => 'text-secondary-emphasis bg-secondary-subtle', 'icon' => 'ti-x'],
                        ];
                        foreach ($statuses as $val => $s): ?>
                            <label class="d-flex align-items-center gap-3 p-3 rounded-3 border cursor-pointer status-option-label"
                                style="cursor:pointer;" data-value="<?= $val ?>">
                                <input type="radio" name="processStatus" value="<?= $val ?>"
                                    class="form-check-input mt-0 flex-shrink-0" style="width:1.1rem;height:1.1rem;">
                                <span class="badge <?= $s['class'] ?> px-2 py-1" style="font-size:.8rem;">
                                    <i class="ti <?= $s['icon'] ?> me-1"></i><?= $s['label'] ?>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Section Pembayaran — muncul hanya saat status "diambil" -->
                <div id="sectionPembayaran" style="display:none;" class="mt-3">
                    <hr>
                    <label class="form-label fw-semibold">Pembayaran</label>

                    <!-- Info sisa tagihan -->
                    <div class="alert alert-warning py-2 px-3 mb-3 d-flex justify-content-between align-items-center">
                        <span class="small">Sisa Tagihan</span>
                        <span class="fw-bold" id="processOrderSisa">Rp 0</span>
                    </div>

                    <!-- Toggle Lunas -->
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="switchLunas">
                        <label class="form-check-label fw-semibold" for="switchLunas">Lunas</label>
                    </div>

                    <!-- Input Nominal — tersembunyi jika Lunas -->
                    <div id="fieldNominalBayar">
                        <label class="form-label">Nominal Dibayar</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="inputNominalBayar" placeholder="0" min="0">
                        </div>
                        <small class="text-muted" id="previewNominalBayar"></small>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white w-100 w-md-auto" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary w-100 w-md-auto" id="btnProcessOrder">
                    <i class="ti ti-check me-1"></i> Terapkan Status
                </button>
            </div>
        </div>
    </div>
</div>

<!-- container -->
<div class="custom-container">
    <!-- row -->
    <div class="row row-cols-1 row-cols-md-3 mb-6 g-4">

        <!-- Card 1: Cucian Hari Ini -->
        <div class="col">
            <div class="card card-lg h-100">
                <div class="card-body d-flex flex-column gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-shape icon-lg rounded-circle bg-warning-darker text-warning-lighter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-wash-machine">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 5a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2l0 -14" />
                                <path d="M8 14a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M8 6h.01" />
                                <path d="M11 6h.01" />
                                <path d="M14 6h2" />
                                <path d="M8 14c1.333 -.667 2.667 -.667 4 0c1.333 .667 2.667 .667 4 0" />
                            </svg>
                        </div>
                        <div><b>Cucian</b></div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted small">Orderan</span>
                            <span class="fs-5 fw-bold" id="cnt-orderan-hari-ini"><?= $orderan_hari_ini ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <span class="text-muted small">Belum Diporsess</span>
                            <span class="fs-5 fw-bold text-success" id="cnt-belum-diproses"><?= $belum_diproses ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Proses -->
        <div class="col">
            <div class="card card-lg h-100">
                <div class="card-body d-flex flex-column gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-shape icon-lg rounded-circle bg-info-darker text-info-lighter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-wash-temperature-5">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 15h.01" />
                                <path d="M3 6l1.721 10.329a2 2 0 0 0 1.973 1.671h10.612a2 2 0 0 0 1.973 -1.671l1.721 -10.329" />
                                <path d="M14 15h.01" />
                                <path d="M15 12h.01" />
                                <path d="M12 12h.01" />
                                <path d="M9 12h.01" />
                                <path d="M3.486 8.965c.168 .02 .34 .033 .514 .035c.79 .009 1.539 -.178 2 -.5c.461 -.32 1.21 -.507 2 -.5c.79 -.007 1.539 .18 2 .5c.461 .322 1.21 .509 2 .5c.79 .009 1.539 -.178 2 -.5c.461 -.32 1.21 -.507 2 -.5c.79 -.007 1.539 .18 2 .5c.461 .322 1.21 .509 2 .5c.17 0 .339 -.014 .503 -.034" />
                            </svg>
                        </div>
                        <div><b>Proses</b></div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted small">Cuci</span>
                            <span class="fs-5 fw-bold text-info" id="cnt-cuci"><?= $cnt_cuci ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <span class="text-muted small">Kering</span>
                            <span class="fs-5 fw-bold text-warning" id="cnt-kering"><?= $cnt_kering ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Status Pengambilan -->
        <div class="col">
            <div class="card card-lg h-100">
                <div class="card-body d-flex flex-column gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-shape icon-lg rounded-circle bg-success-darker text-success-lighter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 12l5 5l10 -10" />
                                <path d="M2 12l5 5m5 -5l5 -5" />
                            </svg>
                        </div>
                        <div><b>Status Pengambilan</b></div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted small">Belum Diambil</span>
                            <span class="fs-5 fw-bold text-danger" id="cnt-belum-diambil"><?= $belum_diambil ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <span class="text-muted small">Diambil</span>
                            <span class="fs-5 fw-bold text-success" id="cnt-diambil"><?= $diambil ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row g-6 mb-6">
        <div class="col-xl-12">
            <!-- card -->
            <div class="card card-lg">
                <!-- card header -->
                <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Cucian</h5>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <!-- Filter tanggal -->
                        <input type="date" class="form-control form-control-sm" id="exportTglDari" style="max-width:150px">
                        <span class="text-muted small">s/d</span>
                        <input type="date" class="form-control form-control-sm" id="exportTglSampai" style="max-width:150px">
                        <button type="button" class="btn btn-success btn-sm" id="btnExport">
                            <i class="ti ti-file-spreadsheet me-1"></i> Export
                        </button>
                        <a href="#!" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahOrderModal">
                            <i class="ti ti-plus me-1"></i> Tambah
                        </a>
                    </div>
                    <!-- <a href="#!" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahOrderModal">
                        <i class="ti ti-plus me-1"></i> Tambah
                    </a> -->
                </div>
                <!-- table -->
                <!-- <div class="table-responsive"> -->
                <div>
                    <!-- <table id="orderTable" class="table text-nowrap mb-0 table-centered table-hover"> -->
                    <table id="orderTable" class="table mb-0 table-centered table-hover w-100">
                        <thead>
                            <tr>
                                <!-- <th></th> -->
                                <th>Order ID</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Selesai</th>
                                <th>No Nota</th>
                                <th>Nama Cust</th>
                                <th>Layanan & Qty</th>
                                <th>Total Qty</th>
                                <th>Detail</th>
                                <th>Harga</th>
                                <th>Dibayar</th>
                                <th>Sisa</th>
                                <th>Delivery</th> <!-- tambah -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <td></td> --> <!-- kolom kontrol -->
                                <td>#DU005</td>
                                <td>Jan 15, 2025</td>
                                <td>Jan 20, 2025</td>
                                <td>NOT-001</td>
                                <td>Budi Santoso</td>
                                <td>Cuci + Kering</td>
                                <td>5 kg</td>
                                <td>Kemeja</td>
                                <td>Rp 50.000</td>
                                <td>Rp 50.000</td>
                                <td>Rp 0</td>
                                <td><span class="badge text-info-emphasis bg-info-subtle">Shipped</span></td>
                            </tr>
                            <tr>
                                <!-- <td></td> -->
                                <td>#DU004</td>
                                <td>Jan 18, 2025</td>
                                <td>Jan 22, 2025</td>
                                <td>NOT-002</td>
                                <td>Siti Rahayu</td>
                                <td>Cuci Kering Setrika</td>
                                <td>10 kg</td>
                                <td>Baju</td>
                                <td>Rp 120.000</td>
                                <td>Rp 60.000</td>
                                <td>Rp 60.000</td>
                                <td><span class="badge text-warning-emphasis bg-warning-subtle">Pending</span></td>
                            </tr>
                            <tr>
                                <!-- <td></td> -->
                                <td>#DU003</td>
                                <td>Jan 10, 2025</td>
                                <td>Jan 18, 2025</td>
                                <td>NOT-003</td>
                                <td>Ahmad Fauzi</td>
                                <td>Cuci Kering</td>
                                <td>15 kg</td>
                                <td>Sempak</td>
                                <td>Rp 150.000</td>
                                <td>Rp 0</td>
                                <td>Rp 150.000</td>
                                <td><span class="badge text-danger-emphasis bg-danger-subtle">Cancel</span></td>
                            </tr>
                            <tr>
                                <!-- <td></td> -->
                                <td>#DU002</td>
                                <td>Jan 05, 2025</td>
                                <td>Jan 13, 2025</td>
                                <td>NOT-004</td>
                                <td>Dewi Lestari</td>
                                <td>Setrika</td>
                                <td>20 kg</td>
                                <td>Beha</td>
                                <td>Rp 200.000</td>
                                <td>Rp 200.000</td>
                                <td>Rp 0</td>
                                <td><span class="badge text-success-emphasis bg-success-subtle">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.jsdelivr.net/npm/datatables.net@2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@2.1.8/js/dataTables.bootstrap5.min.js"></script>
<!-- Responsive -->
<script src="https://cdn.jsdelivr.net/npm/datatables.net-responsive@3.0.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-responsive-bs5@3.0.3/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {

        // =============================================
        // FORMAT RUPIAH
        // =============================================
        const formatRp = (angka) => angka ? 'Rp ' + parseInt(angka).toLocaleString('id-ID') : '';

        const formatRbK = (angka) => {
            if (!angka) return 'Rp 0';
            const ribu = Math.round(parseInt(angka) / 1000);
            return 'Rp ' + ribu + 'k';
        };

        function bulatkan(val) {
            return Math.round(val / 1000) * 1000;
        }

        // =============================================
        // DATATABLE
        // =============================================
        $('#orderTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {
                url: '<?= base_url("laundry/getData") ?>',
                type: 'POST'
            },
            columnDefs: [{
                orderable: false,
                targets: [7, 13]
            }, ],
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
                }
            }
        });

        // =============================================
        // DATA LAYANAN UNTUK JS
        // =============================================
        const dataLayanan = <?= json_encode($layanan) ?>;
        let rowCount = 0;

        function addRowLayanan(layananId = '', qty = '', catatan = '', hargaCustom = '') {
            rowCount++;
            const id = 'row_' + rowCount;

            let optionsHtml = '<option value="" disabled selected>Pilih layanan</option>';
            dataLayanan.forEach(l => {
                const selected = l.id == layananId ? 'selected' : '';
                optionsHtml += `<option value="${l.id}" data-harga="${l.harga_per_kg}" data-satuan="${l.satuan}" ${selected}>${l.nama_layanan}</option>`;
            });

            const row = `
    <tr id="${id}">
        <td>
            <select class="form-select form-select-sm layanan-select" data-row="${id}">
                ${optionsHtml}
            </select>
        </td>
        <td>
            <input type="number" class="form-control form-control-sm layanan-qty"
                data-row="${id}" value="${qty}" placeholder="0" min="0" step="0.01" style="min-width:80px">
        </td>
        <td>
            <span class="badge bg-secondary layanan-satuan" id="satuan_${id}">-</span>
        </td>
        <td>
            <div class="input-group input-group-sm" style="min-width:130px">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm layanan-harga"
                    id="harga_${id}" data-row="${id}" value="${hargaCustom || 0}" min="0">
            </div>
        </td>
        <td>
            <span class="layanan-subtotal fw-bold text-nowrap" id="subtotal_${id}">Rp 0</span>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm layanan-catatan"
                data-row="${id}" placeholder="Catatan..." style="min-width:120px">
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm btnRemoveRow" data-row="${id}">
                <i class="ti ti-trash"></i>
            </button>
        </td>
    </tr>`;

            $('#bodyLayanan').append(row);
            if (layananId) $(`#${id} .layanan-select`).trigger('change');
            if (hargaCustom) $(`#harga_${id}`).val(hargaCustom);
        }

        // Tambah baris
        $('#btnAddLayanan').on('click', function() {
            addRowLayanan();
        });

        // Hapus baris
        $(document).on('click', '.btnRemoveRow', function() {
            $('#' + $(this).data('row')).remove();
            hitungTotal();
        });

        // Saat layanan dipilih — set harga default dari layanan
        $(document).on('change', '.layanan-select', function() {
            const rowId = $(this).data('row');
            const sel = $(this).find(':selected');
            const harga = parseFloat(sel.data('harga')) || 0;
            const satuan = sel.data('satuan') || '-';

            $(`#satuan_${rowId}`).text(satuan);
            $(`#harga_${rowId}`).val(harga); // set ke input, bisa diubah manual
            hitungSubtotal(rowId);
        });

        // Saat qty berubah
        $(document).on('input', '.layanan-qty', function() {
            hitungSubtotal($(this).data('row'));
        });

        // Saat harga diubah manual
        $(document).on('input', '.layanan-harga', function() {
            hitungSubtotal($(this).data('row'));
        });

        function hitungSubtotal(rowId) {
            const harga = parseFloat($(`#harga_${rowId}`).val()) || 0;
            const qty = parseFloat($(`#${rowId} .layanan-qty`).val()) || 0;
            const subtotal = bulatkan(harga * qty); // bulatkan per subtotal
            $(`#subtotal_${rowId}`).text(formatRp(subtotal));
            // Simpan subtotal yang sudah dibulatkan ke data attribute
            $(`#subtotal_${rowId}`).data('val', subtotal);
            hitungTotal();
        }

        // function hitungTotal() {
        //     let total = 0;
        //     $('#bodyLayanan tr').each(function() {
        //         const rowId = $(this).attr('id');
        //         const harga = parseFloat($(`#${rowId} .layanan-select`).find(':selected').data('harga')) || 0;
        //         const qty = parseFloat($(`#${rowId} .layanan-qty`).val()) || 0;
        //         total += harga * qty;
        //     });

        //     const delivery = $('#switchDelivery').is(':checked') ?
        //         parseFloat($('#inputDelivery').val()) || 0 : 0;
        //     total += delivery;

        //     $('#inputHarga').val(total);
        //     $('#previewHarga').text(total ? formatRp(total) : '');
        //     $('#totalLayanan').text(formatRp(total));

        //     const debit = parseFloat($('#inputDebit').val()) || 0;
        //     const kredit = Math.max(0, total - debit);
        //     $('#inputKredit').val(kredit);
        //     $('#previewKredit').text(kredit ? formatRp(kredit) : '');
        // }
        function hitungTotal() {
            let total = 0;
            $('#bodyLayanan tr').each(function() {
                const rowId = $(this).attr('id');
                // Ambil dari data attribute yang sudah dibulatkan
                const subtotal = parseFloat($(`#subtotal_${rowId}`).data('val')) || 0;
                total += subtotal;
            });

            const delivery = $('#switchDelivery').is(':checked') ?
                parseFloat($('#inputDelivery').val()) || 0 : 0;
            total += delivery;
            // Tidak perlu bulatkan lagi karena subtotal sudah dibulatkan

            $('#inputHarga').val(total);
            $('#previewHarga').text(total ? formatRp(total) : '');
            $('#totalLayanan').text(formatRp(total));

            const debit = parseFloat($('#inputDebit').val()) || 0;
            const kredit = Math.max(0, total - debit);
            $('#inputKredit').val(kredit);
            $('#previewKredit').text(kredit ? formatRp(kredit) : '');
        }

        // =============================================
        // DELIVERY
        // =============================================
        $('#switchDelivery').on('change', function() {
            if ($(this).is(':checked')) {
                $('#fieldDelivery').slideDown();
            } else {
                $('#fieldDelivery').slideUp();
                $('#inputDelivery').val('');
                $('#previewDelivery').text('');
                hitungTotal();
            }
        });

        $('#inputDelivery').on('input', function() {
            $('#previewDelivery').text(formatRp($(this).val()));
            hitungTotal();
        });

        // =============================================
        // DEBIT / KREDIT
        // =============================================
        $('#inputDebit').on('input', function() {
            hitungTotal();
        });

        $('#inputDebit').on('blur', function() {
            $('#previewDebit').text(formatRp($(this).val()));
        });

        // =============================================
        // RESET FORM
        // =============================================
        function resetForm() {
            $('[name="no_nota"]').val('');
            $('[name="nama_customer"]').val('');
            $('[name="tgl_selesai"]').val('');
            $('[name="detail_item"]').val('');
            $('#inputHarga, #inputDebit, #inputKredit').val('');
            $('#inputDelivery').val('');
            $('[name="catatan"]').val('');
            $('[name="status"]').val('proses');
            $('#previewHarga, #previewDebit, #previewKredit, #previewDelivery').text('');
            $('#switchDelivery').prop('checked', false);
            $('#fieldDelivery').hide();
            $('#totalLayanan').text('Rp 0');
            $('#bodyLayanan').empty();
            rowCount = 0;
            addRowLayanan();

            $.get('<?= base_url("laundry/getNextNota") ?>', function(res) {
                $('[name="no_nota"]').val(res.nota);
            }, 'json');
        }

        // Reset saat modal dibuka
        $('#tambahOrderModal').on('show.bs.modal', function() {
            resetForm();
            const today = new Date().toISOString().split('T')[0];
            $('#tglMasuk').val(today);
        });

        // =============================================
        // SIMPAN ORDER
        // =============================================
        $('#btnSimpan').on('click', function() {

            // Validasi wajib
            const requiredFields = [{
                    selector: '[name="no_nota"]',
                    label: 'No Nota'
                },
                {
                    selector: '[name="nama_customer"]',
                    label: 'Nama Customer'
                },
                {
                    selector: '[name="tgl_masuk"]',
                    label: 'Tanggal Masuk'
                },
            ];

            for (const field of requiredFields) {
                if (!$(field.selector).val()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: field.label + ' wajib diisi!',
                        confirmButtonColor: '#378ADD'
                    });
                    return;
                }
            }

            // Validasi detail layanan
            const detailLayanan = [];
            let validLayanan = true;

            $('#bodyLayanan tr').each(function() {
                const rowId = $(this).attr('id');
                const layananId = $(`#${rowId} .layanan-select`).val();
                const harga = parseFloat($(`#${rowId} .layanan-select`).find(':selected').data('harga')) || 0;
                const qty = parseFloat($(`#${rowId} .layanan-qty`).val()) || 0;

                if (!layananId || qty <= 0) {
                    validLayanan = false;
                    return false;
                }

                detailLayanan.push({
                    layanan_id: layananId,
                    qty: qty,
                    harga_satuan: parseFloat($(`#harga_${rowId}`).val()) || 0, // dari input
                    subtotal: (parseFloat($(`#harga_${rowId}`).val()) || 0) * qty,
                    catatan: $(`#${rowId} .layanan-catatan`).val() || '',
                });
            });

            if (!validLayanan || detailLayanan.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Isi layanan dan quantity dengan benar!',
                    confirmButtonColor: '#378ADD'
                });
                return;
            }

            Swal.fire({
                title: 'Simpan Order?',
                text: 'Pastikan data yang dimasukkan sudah benar.',
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
                    allowEscapeKey: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url("laundry/simpan") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        no_nota: $('[name="no_nota"]').val(),
                        nama_customer: $('[name="nama_customer"]').val(),
                        tgl_masuk: $('[name="tgl_masuk"]').val(),
                        tgl_selesai: $('[name="tgl_selesai"]').val(),
                        detail_item: $('[name="detail_item"]').val(),
                        harga: $('#inputHarga').val(),
                        debit: $('#inputDebit').val(),
                        kredit: $('#inputKredit').val(),
                        catatan: $('[name="catatan"]').val(),
                        status: $('[name="status"]').val(),
                        is_delivery: $('#switchDelivery').is(':checked') ? 1 : 0,
                        biaya_delivery: $('#inputDelivery').val() || 0,
                        detail_layanan: JSON.stringify(detailLayanan),
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#tambahOrderModal').modal('hide');
                            $('#orderTable').DataTable().ajax.reload(null, false);
                            refreshSummary();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                confirmButtonColor: '#378ADD',
                                timer: 2000,
                                timerProgressBar: true
                            });
                            resetForm();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: res.message,
                                confirmButtonColor: '#378ADD'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server.',
                            confirmButtonColor: '#378ADD'
                        });
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        // =============================================
        // REFRESH COUNTER CARD
        // =============================================
        function refreshSummary() {
            $.getJSON('<?= base_url("laundry/getSummary") ?>', function(s) {
                $('#cnt-orderan-hari-ini').text(s.orderan_hari_ini);
                $('#cnt-belum-diproses').text(s.belum_diproses);
                $('#cnt-cuci').text(s.cuci);
                $('#cnt-kering').text(s.kering);
                $('#cnt-belum-diambil').text(s.belum_diambil);
                $('#cnt-diambil').text(s.diambil);
            });
        }

        // =============================================
        // EDIT ORDER
        // =============================================
        window.editOrder = function(id) {
            $.ajax({
                url: '<?= base_url("laundry/getOrder") ?>',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Memuat data...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(order) {
                    Swal.close();
                    if (!order) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data tidak ditemukan',
                            confirmButtonColor: '#378ADD'
                        });
                        return;
                    }

                    $('#editOrderId').val(order.id);
                    $('#editNoNota').val(order.no_nota);
                    $('#editNamaCustomer').val(order.nama_customer);
                    $('#editTglMasuk').val(order.tgl_masuk);
                    $('#editTglSelesai').val(order.tgl_selesai ?? '');
                    $('#editDetailItem').val(order.detail_item);
                    $('#editInputHarga').val(order.harga);
                    $('#editInputDebit').val(order.debit);
                    $('#editInputKredit').val(order.kredit);
                    $('#editCatatan').val(order.catatan);
                    $('#editStatus').val(order.status);

                    $('#editPreviewHarga').text(formatRp(order.harga));
                    $('#editPreviewDebit').text(formatRp(order.debit));
                    $('#editPreviewKredit').text(formatRp(order.kredit));

                    // Delivery
                    if (parseInt(order.is_delivery)) {
                        $('#editSwitchDelivery').prop('checked', true);
                        $('#editFieldDelivery').show();
                        $('#editInputDelivery').val(order.biaya_delivery);
                        $('#editPreviewDelivery').text(formatRp(order.biaya_delivery));
                    } else {
                        $('#editSwitchDelivery').prop('checked', false);
                        $('#editFieldDelivery').hide();
                        $('#editInputDelivery').val('');
                        $('#editPreviewDelivery').text('');
                    }

                    // Load detail layanan ke tabel edit
                    $('#editBodyLayanan').empty();
                    if (order.details && order.details.length > 0) {
                        order.details.forEach(d => addRowEditLayanan(d.layanan_id, d.qty, d.catatan));
                    } else {
                        addRowEditLayanan();
                    }

                    $('#editOrderModal').modal('show');
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

        // Row layanan untuk modal EDIT
        let editRowCount = 0;

        function addRowEditLayanan(layananId = '', qty = '', catatan = '', hargaCustom = '') {
            editRowCount++;
            const id = 'editrow_' + editRowCount;

            let optionsHtml = '<option value="" disabled selected>Pilih layanan</option>';
            dataLayanan.forEach(l => {
                const selected = l.id == layananId ? 'selected' : '';
                optionsHtml += `<option value="${l.id}" data-harga="${l.harga_per_kg}" data-satuan="${l.satuan}" ${selected}>${l.nama_layanan}</option>`;
            });

            const row = `
    <tr id="${id}">
        <td><select class="form-select form-select-sm edit-layanan-select" data-row="${id}">${optionsHtml}</select></td>
        <td><input type="number" class="form-control form-control-sm edit-layanan-qty" data-row="${id}" value="${qty}" placeholder="0" min="0" step="0.01" style="min-width:80px"></td>
        <td><span class="badge bg-secondary edit-layanan-satuan" id="esatuan_${id}">-</span></td>
        <td>
            <div class="input-group input-group-sm" style="min-width:130px">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm edit-layanan-harga"
                    id="eharga_${id}" data-row="${id}" value="${hargaCustom || 0}" min="0">
            </div>
        </td>
        <td><span class="fw-bold text-nowrap" id="esubtotal_${id}">Rp 0</span></td>
        <td><input type="text" class="form-control form-control-sm edit-layanan-catatan" data-row="${id}" placeholder="Catatan..." style="min-width:120px"></td>
        <td><button type="button" class="btn btn-danger btn-sm btnEditRemoveRow" data-row="${id}"><i class="ti ti-trash"></i></button></td>
    </tr>`;

            $('#editBodyLayanan').append(row);
            if (layananId) $(`#${id} .edit-layanan-select`).trigger('change');
            if (hargaCustom) $(`#eharga_${id}`).val(hargaCustom);
            if (catatan) $(`#${id} .edit-layanan-catatan`).val(catatan);
        }

        $('#btnEditAddLayanan').on('click', function() {
            addRowEditLayanan();
        });

        $(document).on('click', '.btnEditRemoveRow', function() {
            $('#' + $(this).data('row')).remove();
            hitungEditTotal();
        });

        // Edit modal
        $(document).on('change', '.edit-layanan-select', function() {
            const rowId = $(this).data('row');
            const sel = $(this).find(':selected');
            $(`#esatuan_${rowId}`).text(sel.data('satuan') || '-');
            $(`#eharga_${rowId}`).val(parseFloat(sel.data('harga')) || 0);
            hitungEditSubtotal(rowId);
        });

        $(document).on('input', '.edit-layanan-qty', function() {
            hitungEditSubtotal($(this).data('row'));
        });

        $(document).on('input', '.edit-layanan-harga', function() {
            hitungEditSubtotal($(this).data('row'));
        });

        function hitungEditSubtotal(rowId) {
            const harga = parseFloat($(`#eharga_${rowId}`).val()) || 0;
            const qty = parseFloat($(`#${rowId} .edit-layanan-qty`).val()) || 0;
            const subtotal = bulatkan(harga * qty);
            $(`#esubtotal_${rowId}`).text(formatRp(subtotal));
            $(`#esubtotal_${rowId}`).data('val', subtotal);
            hitungEditTotal();
        }

        // function hitungEditTotal() {
        //     let total = 0;
        //     $('#editBodyLayanan tr').each(function() {
        //         const rowId = $(this).attr('id');
        //         const harga = parseFloat($(`#${rowId} .edit-layanan-select`).find(':selected').data('harga')) || 0;
        //         const qty = parseFloat($(`#${rowId} .edit-layanan-qty`).val()) || 0;
        //         total += harga * qty;
        //     });

        //     const delivery = $('#editSwitchDelivery').is(':checked') ?
        //         parseFloat($('#editInputDelivery').val()) || 0 : 0;
        //     total += delivery;

        //     $('#editInputHarga').val(total);
        //     $('#editPreviewHarga').text(total ? formatRp(total) : '');
        //     $('#editTotalLayanan').text(formatRp(total));

        //     const debit = parseFloat($('#editInputDebit').val()) || 0;
        //     const kredit = Math.max(0, total - debit);
        //     $('#editInputKredit').val(kredit);
        //     $('#editPreviewKredit').text(kredit ? formatRp(kredit) : '');
        // }

        function hitungEditTotal() {
            let total = 0;
            $('#editBodyLayanan tr').each(function() {
                const rowId = $(this).attr('id');
                const subtotal = parseFloat($(`#esubtotal_${rowId}`).data('val')) || 0;
                total += subtotal;
            });

            const delivery = $('#editSwitchDelivery').is(':checked') ?
                parseFloat($('#editInputDelivery').val()) || 0 : 0;
            total += delivery;

            $('#editInputHarga').val(total);
            $('#editPreviewHarga').text(total ? formatRp(total) : '');
            $('#editTotalLayanan').text(formatRp(total));

            const debit = parseFloat($('#editInputDebit').val()) || 0;
            const kredit = Math.max(0, total - debit);
            $('#editInputKredit').val(kredit);
            $('#editPreviewKredit').text(kredit ? formatRp(kredit) : '');
        }

        // Toggle delivery edit
        $('#editSwitchDelivery').on('change', function() {
            if ($(this).is(':checked')) {
                $('#editFieldDelivery').slideDown();
            } else {
                $('#editFieldDelivery').slideUp();
                $('#editInputDelivery').val('');
                $('#editPreviewDelivery').text('');
                hitungEditTotal();
            }
        });

        $('#editInputDelivery').on('input', function() {
            $('#editPreviewDelivery').text(formatRp($(this).val()));
            hitungEditTotal();
        });

        $('#editInputDebit').on('input', function() {
            hitungEditTotal();
        });
        $('#editInputDebit').on('blur', function() {
            $('#editPreviewDebit').text(formatRp($(this).val()));
        });

        // =============================================
        // UPDATE ORDER
        // =============================================
        $('#btnUpdate').on('click', function() {
            const requiredFields = [{
                    selector: '#editNoNota',
                    label: 'No Nota'
                },
                {
                    selector: '#editNamaCustomer',
                    label: 'Nama Customer'
                },
                {
                    selector: '#editTglMasuk',
                    label: 'Tanggal Masuk'
                },
            ];

            for (const field of requiredFields) {
                if (!$(field.selector).val()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: field.label + ' wajib diisi!',
                        confirmButtonColor: '#378ADD'
                    });
                    return;
                }
            }

            const editDetailLayanan = [];
            let validEdit = true;

            $('#editBodyLayanan tr').each(function() {
                const rowId = $(this).attr('id');
                const layananId = $(`#${rowId} .edit-layanan-select`).val();
                const harga = parseFloat($(`#${rowId} .edit-layanan-select`).find(':selected').data('harga')) || 0;
                const qty = parseFloat($(`#${rowId} .edit-layanan-qty`).val()) || 0;

                if (!layananId || qty <= 0) {
                    validEdit = false;
                    return false;
                }
                editDetailLayanan.push({
                    layanan_id: layananId,
                    qty,
                    harga_satuan: parseFloat($(`#eharga_${rowId}`).val()) || 0, // dari input
                    subtotal: (parseFloat($(`#eharga_${rowId}`).val()) || 0) * qty,
                    catatan: $(`#${rowId} .edit-layanan-catatan`).val() || '',
                });
            });

            if (!validEdit || editDetailLayanan.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Isi layanan dan quantity dengan benar!',
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
                    allowEscapeKey: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url("laundry/update") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: $('#editOrderId').val(),
                        no_nota: $('#editNoNota').val(),
                        nama_customer: $('#editNamaCustomer').val(),
                        tgl_masuk: $('#editTglMasuk').val(),
                        tgl_selesai: $('#editTglSelesai').val(),
                        detail_item: $('#editDetailItem').val(),
                        harga: $('#editInputHarga').val(),
                        debit: $('#editInputDebit').val(),
                        kredit: $('#editInputKredit').val(),
                        catatan: $('#editCatatan').val(),
                        status: $('#editStatus').val(),
                        is_delivery: $('#editSwitchDelivery').is(':checked') ? 1 : 0,
                        biaya_delivery: $('#editInputDelivery').val() || 0,
                        detail_layanan: JSON.stringify(editDetailLayanan),
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#editOrderModal').modal('hide');
                            $('#orderTable').DataTable().ajax.reload(null, false);
                            refreshSummary();
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
        // DELETE ORDER
        // =============================================
        window.deleteOrder = function(id) {
            Swal.fire({
                title: 'Hapus Order?',
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
                    allowEscapeKey: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url("laundry/delete") ?>',
                    type: 'POST',
                    data: {
                        id
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#orderTable').DataTable().ajax.reload(null, false);
                            refreshSummary();
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

        // =============================================
        // PROCESS ORDER (Update Status)
        // =============================================
        window.processOrder = function(id) {
            $.ajax({
                url: '<?= base_url("laundry/getOrder") ?>',
                type: 'POST',
                data: {
                    id
                },
                dataType: 'json',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Memuat...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(order) {
                    Swal.close();
                    if (!order) return;

                    $('#processOrderId').val(order.id);
                    $('#processOrderInfo').text('#' + String(order.id).padStart(3, '0') + ' — ' + order.nama_customer + ' (' + order.no_nota + ')');

                    // Simpan sisa tagihan (kredit) ke data attr
                    const sisa = parseFloat(order.kredit) || 0;
                    $('#processOrderModal').data('kredit', sisa);
                    $('#processOrderModal').data('harga', parseFloat(order.harga) || 0);
                    $('#processOrderModal').data('debit', parseFloat(order.debit) || 0);
                    $('#processOrderSisa').text(formatRp(sisa));

                    // Reset section pembayaran
                    $('#sectionPembayaran').hide();
                    $('#switchLunas').prop('checked', false);
                    $('#fieldNominalBayar').show();
                    $('#inputNominalBayar').val('');
                    $('#previewNominalBayar').text('');

                    $('input[name="processStatus"]').prop('checked', false);
                    $('input[name="processStatus"][value="' + order.status + '"]').prop('checked', true);
                    updateStatusHighlight();
                    $('#processOrderModal').modal('show');
                }
            });
        };

        // Tampilkan/sembunyikan section pembayaran saat pilih status
        $(document).on('change', 'input[name="processStatus"]', function() {
            updateStatusHighlight();
            const sisa = $('#processOrderModal').data('kredit') || 0;
            if ($(this).val() === 'diambil' && sisa > 0) {
                $('#sectionPembayaran').slideDown();
            } else {
                $('#sectionPembayaran').slideUp();
                $('#switchLunas').prop('checked', false);
                $('#fieldNominalBayar').show();
                $('#inputNominalBayar').val('');
                $('#previewNominalBayar').text('');
            }
        });

        // Toggle Lunas — sembunyikan input nominal, isi otomatis dengan sisa
        $('#switchLunas').on('change', function() {
            if ($(this).is(':checked')) {
                $('#fieldNominalBayar').slideUp();
                $('#inputNominalBayar').val($('#processOrderModal').data('kredit') || 0);
            } else {
                $('#fieldNominalBayar').slideDown();
                $('#inputNominalBayar').val('');
                $('#previewNominalBayar').text('');
            }
        });

        $('#inputNominalBayar').on('input', function() {
            const val = parseFloat($(this).val()) || 0;
            $('#previewNominalBayar').text(val ? formatRp(val) : '');
        });

        function updateStatusHighlight() {
            $('.status-option-label').removeClass('border-primary bg-primary bg-opacity-10');
            $('input[name="processStatus"]:checked').closest('.status-option-label').addClass('border-primary bg-primary bg-opacity-10');
        }

        $('#btnProcessOrder').on('click', function() {
            const status = $('input[name="processStatus"]:checked').val();
            if (!status) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Status',
                    text: 'Silakan pilih status terlebih dahulu.',
                    confirmButtonColor: '#378ADD'
                });
                return;
            }

            // Hitung debit & kredit baru jika status diambil
            let extraData = {};
            if (status === 'diambil') {
                const sisa = parseFloat($('#processOrderModal').data('kredit')) || 0;
                const debitLama = parseFloat($('#processOrderModal').data('debit')) || 0;
                const isLunas = $('#switchLunas').is(':checked');
                const nominal = isLunas ? sisa : (parseFloat($('#inputNominalBayar').val()) || 0);

                if (sisa > 0 && !isLunas && nominal <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Masukkan nominal pembayaran atau centang Lunas.',
                        confirmButtonColor: '#378ADD'
                    });
                    return;
                }

                const sisaBaru = Math.max(0, sisa - nominal);
                extraData = {
                    tambah_debit: nominal,
                    kredit_baru: sisaBaru,
                };
            }

            Swal.fire({
                title: 'Memperbarui status...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: '<?= base_url("laundry/processOrder") ?>',
                type: 'POST',
                data: Object.assign({
                    id: $('#processOrderId').val(),
                    status
                }, extraData),
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        $('#processOrderModal').modal('hide');
                        $('#orderTable').DataTable().ajax.reload(null, false);
                        refreshSummary();
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

        window.detailOrder = function(id) {
            $.ajax({
                url: '<?= base_url("laundry/getOrder") ?>',
                type: 'POST',
                data: {
                    id
                },
                dataType: 'json',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Memuat...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(order) {
                    Swal.close();
                    if (!order) return;

                    // Info order
                    $('#detailOrderInfo').html(`
                <div class="row g-2">
                    <div class="col-6 col-md-3">
                        <small class="text-muted d-block">No Nota</small>
                        <span class="fw-semibold">${order.no_nota}</span>
                    </div>
                    <div class="col-6 col-md-3">
                        <small class="text-muted d-block">Customer</small>
                        <span class="fw-semibold">${order.nama_customer}</span>
                    </div>
                    <div class="col-6 col-md-3">
                        <small class="text-muted d-block">Tgl Masuk</small>
                        <span class="fw-semibold">${order.tgl_masuk}</span>
                    </div>
                    <div class="col-6 col-md-3">
                        <small class="text-muted d-block">Status</small>
                        <span class="fw-semibold">${order.status}</span>
                    </div>
                </div>
                <hr class="my-2">
            `);

                    // Tabel detail
                    let html = '';
                    let total = 0;

                    if (order.details && order.details.length > 0) {
                        order.details.forEach((d, i) => {
                            total += parseFloat(d.subtotal);
                            html += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${d.nama_layanan}</td>
                        <td>${d.qty}</td>
                        <td><span class="badge bg-secondary">${d.satuan}</span></td>
                        <td>${formatRp(d.harga_satuan)}</td>
                        <td class="fw-bold">${formatRp(d.subtotal)}</td>
                        <td><small class="text-muted">${d.catatan || '-'}</small></td>
                    </tr>`;
                        });
                    } else {
                        html = '<tr><td colspan="7" class="text-center text-muted">Tidak ada detail</td></tr>';
                    }

                    $('#detailOrderBody').html(html);
                    $('#detailOrderTotal').text(formatRp(total));
                    $('#detailOrderModal').modal('show');
                }
            });
        };

        // Set default tanggal export = hari ini
        const today = new Date().toISOString().split('T')[0];
        $('#exportTglDari').val(today);
        $('#exportTglSampai').val(today);

        $('#btnExport').on('click', function() {
            const dari = $('#exportTglDari').val();
            const sampai = $('#exportTglSampai').val();

            if (!dari || !sampai) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Pilih tanggal terlebih dahulu!',
                    confirmButtonColor: '#378ADD'
                });
                return;
            }

            if (dari > sampai) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Tanggal dari tidak boleh lebih besar dari tanggal sampai!',
                    confirmButtonColor: '#378ADD'
                });
                return;
            }

            // Buka URL export di tab baru
            window.open('<?= base_url("laundry/export") ?>?dari=' + dari + '&sampai=' + sampai, '_blank');
        });

    });
</script>