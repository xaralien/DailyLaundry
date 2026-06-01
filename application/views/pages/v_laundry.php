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
                    <div class="col-6">
                        <label class="form-label">Layanan</label>
                        <select class="form-select" name="layanan_id">
                            <option value="" disabled selected>Pilih layanan</option>
                            <?php foreach ($layanan as $l): ?>
                                <option value="<?= $l->id ?>"><?= $l->nama_layanan ?> - <?= 'Rp ' . number_format($l->harga_per_kg, 0, ',', '.') ?></option>
                            <?php endforeach; ?>
                        </select>
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
                    <div class="col-6">
                        <label class="form-label">Berat (kg)</label>
                        <input type="number" class="form-control" name="berat_kg" placeholder="0.00" step="0.01" min="0">
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
                    <div class="col-6">
                        <label class="form-label">Layanan</label>
                        <select class="form-select" id="editLayananId">
                            <option value="" disabled>Pilih layanan</option>
                            <?php foreach ($layanan as $l): ?>
                                <option value="<?= $l->id ?>"><?= $l->nama_layanan ?> - <?= 'Rp ' . number_format($l->harga_per_kg, 0, ',', '.') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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
                    <div class="col-6">
                        <label class="form-label">Berat (kg)</label>
                        <input type="number" class="form-control" id="editBeratKg" placeholder="0.00" step="0.01" min="0">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Detail Item</label>
                        <input type="text" class="form-control" id="editDetailItem" placeholder="Contoh: BC 3, Sprei 3Set, Selimut 1">
                    </div>
                    <div class="col-4">
                        <label class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="editInputHarga" placeholder="0" min="0">
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
                    <a href="#!" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahOrderModal">
                        <i class="ti ti-plus me-1"></i> Tambah
                    </a>
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
                                <th>Layanan</th>
                                <th>Berat</th>
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

        // DataTable
        $('#orderTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,

            ajax: {
                url: '<?= base_url("laundry/getData") ?>',
                type: 'POST'
            },
            columnDefs: [ // Delivery   ← tambah
                {
                    orderable: false,
                    targets: [13]
                },
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
                }
            }
        });

        // Auto tanggal masuk hari ini
        const today = new Date().toISOString().split('T')[0];
        $('#tglMasuk').val(today);

        // Format Rupiah
        const formatRp = (angka) => angka ? 'Rp ' + parseInt(angka).toLocaleString('id-ID') : '';

        // Simpan harga per kg saat layanan dipilih
        let hargaPerKg = 0;

        $('[name="layanan_id"]').on('change', function() {
            const id = $(this).val();
            if (!id) return;

            $.ajax({
                url: '<?= base_url("laundry/getHargaLayanan") ?>',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    hargaPerKg = parseFloat(res.harga_per_kg) || 0;
                    hitungHarga();
                }
            });
        });

        // Toggle field biaya delivery
        $('#switchDelivery').on('change', function() {
            if ($(this).is(':checked')) {
                $('#fieldDelivery').slideDown();
            } else {
                $('#fieldDelivery').slideUp();
                $('#inputDelivery').val('');
                $('#previewDelivery').text('');
                hitungHarga();
            }
        });

        // Hitung harga saat biaya delivery berubah
        $('#inputDelivery').on('blur', function() {
            $('#previewDelivery').text(formatRp($(this).val()));
            hitungHarga();
        });

        // Hitung harga saat berat berubah
        $('[name="berat_kg"]').on('input', function() {
            hitungHarga();
        });

        function hitungHarga() {
            const berat = parseFloat($('[name="berat_kg"]').val()) || 0;
            const harga = berat * hargaPerKg;

            $('#inputHarga').val(harga);
            $('#previewHarga').text(harga ? formatRp(harga) : '');

            // Trigger hitung kredit
            const debit = parseFloat($('#inputDebit').val()) || 0;
            const kredit = Math.max(0, harga - debit);
            $('#inputKredit').val(kredit);
            $('#previewKredit').text(kredit ? formatRp(kredit) : '');
        }

        const hitungKredit = () => {
            const harga = parseFloat($('#inputHarga').val()) || 0;
            const debit = parseFloat($('#inputDebit').val()) || 0;
            const kredit = Math.max(0, harga - debit);
            $('#inputKredit').val(kredit);
            $('#previewKredit').text(kredit ? formatRp(kredit) : '');
        };

        $('#inputHarga').on('blur', function() {
            $('#previewHarga').text(formatRp($(this).val()));
            hitungKredit();
        });

        $('#inputDebit').on('blur', function() {
            $('#previewDebit').text(formatRp($(this).val()));
            hitungKredit();
        });

        // Reset saat modal dibuka
        $('#tambahOrderModal').on('show.bs.modal', function() {
            $('#previewHarga, #previewDebit, #previewKredit').text('');
        });

        $('#btnSimpan').on('click', function() {

            // Validasi field wajib
            const requiredFields = [{
                    selector: '[name="no_nota"]',
                    label: 'No Nota'
                },
                {
                    selector: '[name="nama_customer"]',
                    label: 'Nama Customer'
                },
                {
                    selector: '[name="layanan_id"]',
                    label: 'Layanan'
                },
                {
                    selector: '[name="tgl_masuk"]',
                    label: 'Tanggal Masuk'
                },
                {
                    selector: '[name="berat_kg"]',
                    label: 'Berat'
                },
                {
                    selector: '[name="harga"]',
                    label: 'Harga'
                },
            ];

            for (const field of requiredFields) {
                if (!$(field.selector).val()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: field.label + ' wajib diisi!',
                        confirmButtonColor: '#378ADD',
                    });
                    return;
                }
            }

            // Konfirmasi sebelum simpan
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

                // Loading
                Swal.fire({
                    title: 'Menyimpan...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => Swal.showLoading(),
                });

                const formData = {
                    no_nota: $('[name="no_nota"]').val(),
                    nama_customer: $('[name="nama_customer"]').val(),
                    layanan_id: $('[name="layanan_id"]').val(),
                    is_delivery: $('#switchDelivery').is(':checked') ? 1 : 0,
                    biaya_delivery: $('#inputDelivery').val() || 0,
                    tgl_masuk: $('[name="tgl_masuk"]').val(),
                    tgl_selesai: $('[name="tgl_selesai"]').val(),
                    berat_kg: $('[name="berat_kg"]').val(),
                    detail_item: $('[name="detail_item"]').val(),
                    harga: $('#inputHarga').val(),
                    debit: $('#inputDebit').val(),
                    kredit: $('#inputKredit').val(),
                    catatan: $('[name="catatan"]').val(),
                    status: $('[name="status"]').val(),
                };

                $.ajax({
                    url: '<?= base_url("laundry/simpan") ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
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
                                timerProgressBar: true,
                            });

                            // Reset form
                            resetForm();

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: res.message,
                                confirmButtonColor: '#378ADD',
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server. Silakan coba lagi.',
                            confirmButtonColor: '#378ADD',
                        });
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        // Reset form setelah simpan
        function resetForm() {
            $('[name="no_nota"]').val(''); // akan diisi ulang dari server
            $('[name="nama_customer"]').val('');
            $('[name="layanan_id"]').val('').trigger('change');
            $('#switchDelivery').prop('checked', false);
            $('#fieldDelivery').hide();
            $('#inputDelivery').val('');
            $('#previewDelivery').text('');
            $('[name="tgl_selesai"]').val('');
            $('[name="berat_kg"]').val('');
            $('[name="detail_item"]').val('');
            $('#inputHarga').val('');
            $('#inputDebit').val('');
            $('#inputKredit').val('');
            $('[name="catatan"]').val('');
            $('[name="status"]').val('proses');
            $('#previewHarga, #previewDebit, #previewKredit').text('');

            // Refresh no nota dari server
            $.get('<?= base_url("laundry/getNextNota") ?>', function(res) {
                $('[name="no_nota"]').val(res.nota);
            }, 'json');
        }

        // Reset form saat modal dibuka
        $('#tambahOrderModal').on('show.bs.modal', function() {
            resetForm();
            const today = new Date().toISOString().split('T')[0];
            $('#tglMasuk').val(today);
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
                        didOpen: () => Swal.showLoading(),
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
                    $('#editLayananId').val(order.layanan_id);
                    $('#editBeratKg').val(order.berat_kg);
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

                    $('#editOrderModal').modal('show');
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal memuat data',
                        text: 'Silakan coba lagi.',
                        confirmButtonColor: '#378ADD'
                    });
                }
            });
        };

        // Toggle delivery di modal edit
        $('#editSwitchDelivery').on('change', function() {
            if ($(this).is(':checked')) {
                $('#editFieldDelivery').slideDown();
            } else {
                $('#editFieldDelivery').slideUp();
                $('#editInputDelivery').val('');
                $('#editPreviewDelivery').text('');
            }
        });

        $('#editInputDelivery').on('blur', function() {
            $('#editPreviewDelivery').text(formatRp($(this).val()));
        });

        $('#editInputHarga').on('blur', function() {
            $('#editPreviewHarga').text(formatRp($(this).val()));
            hitungKreditEdit();
        });

        $('#editInputDebit').on('blur', function() {
            $('#editPreviewDebit').text(formatRp($(this).val()));
            hitungKreditEdit();
        });

        function hitungKreditEdit() {
            const harga = parseFloat($('#editInputHarga').val()) || 0;
            const debit = parseFloat($('#editInputDebit').val()) || 0;
            const kredit = Math.max(0, harga - debit);
            $('#editInputKredit').val(kredit);
            $('#editPreviewKredit').text(kredit ? formatRp(kredit) : '');
        }

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
                    selector: '#editLayananId',
                    label: 'Layanan'
                },
                {
                    selector: '#editTglMasuk',
                    label: 'Tanggal Masuk'
                },
                {
                    selector: '#editBeratKg',
                    label: 'Berat'
                },
                {
                    selector: '#editInputHarga',
                    label: 'Harga'
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

            Swal.fire({
                title: 'Simpan Perubahan?',
                text: 'Pastikan data yang diubah sudah benar.',
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
                    data: {
                        id: $('#editOrderId').val(),
                        no_nota: $('#editNoNota').val(),
                        nama_customer: $('#editNamaCustomer').val(),
                        layanan_id: $('#editLayananId').val(),
                        is_delivery: $('#editSwitchDelivery').is(':checked') ? 1 : 0,
                        biaya_delivery: $('#editInputDelivery').val() || 0,
                        tgl_masuk: $('#editTglMasuk').val(),
                        tgl_selesai: $('#editTglSelesai').val(),
                        berat_kg: $('#editBeratKg').val(),
                        detail_item: $('#editDetailItem').val(),
                        harga: $('#editInputHarga').val(),
                        debit: $('#editInputDebit').val(),
                        kredit: $('#editInputKredit').val(),
                        catatan: $('#editCatatan').val(),
                        status: $('#editStatus').val(),
                    },
                    dataType: 'json',
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
                        id: id
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
                    id: id
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

                    // Set radio sesuai status saat ini
                    $('input[name="processStatus"]').prop('checked', false);
                    $('input[name="processStatus"][value="' + order.status + '"]').prop('checked', true);

                    // Highlight label yang aktif
                    updateStatusHighlight();

                    $('#processOrderModal').modal('show');
                }
            });
        };

        // Highlight border label radio status yang dipilih
        function updateStatusHighlight() {
            $('.status-option-label').removeClass('border-primary bg-primary bg-opacity-10');
            $('input[name="processStatus"]:checked').closest('.status-option-label')
                .addClass('border-primary bg-primary bg-opacity-10');
        }

        $(document).on('change', 'input[name="processStatus"]', function() {
            updateStatusHighlight();
        });

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

            Swal.fire({
                title: 'Memperbarui status...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: '<?= base_url("laundry/processOrder") ?>',
                type: 'POST',
                data: {
                    id: $('#processOrderId').val(),
                    status: status
                },
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

    });
</script>