<!-- Modal of pages -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <input type="search" class="form-control border-0 rounded-0 ps-0 form-focus-none" id="globalSearchInput"
                    placeholder="Search any word..." aria-label="Search" aria-describedby="search-addon" />
                <button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal" aria-label="Close">Esc</button>
            </div>

        </div>
    </div>
</div>
<!-- container -->
<div class="custom-container">
    <!-- row -->
    <!-- <div class="row mb-6 g-6">
        <div class="col-xl-12 col-lg-12">
            <div class="bg-gradient-mixed p-8 py-10 rounded-3 p-lg-7">
                <h1 class="fs-3">👋 Hello,</h1>
                <p class="mb-0">Welcome to your E-commerce Dashboard! Monitor your sales,</p>
                <p>track your progress, and gain valuable insights.</p>
                <a href="#!" class="btn btn-dark">Start AI</a>
            </div>
        </div>
    </div> -->
    <!-- row -->
    <div class="row row-cols-1 row-cols-xl-3 row-cols-md-3 mb-6 g-6">
        <div class="col">
            <!-- card -->
            <div class="card card-lg">
                <!-- card body -->
                <div class="card-body d-flex flex-column gap-8">
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
                        <div>Cucian Hari Ini</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center lh-1">
                        <div class="fs-3 fw-bold"><?= $orderan_hari_ini ?></div>
                        <!-- <div class="text-success small">
                            <span>2.29%</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trending-up">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 17l6 -6l4 4l8 -8" />
                                    <path d="M14 7l7 0l0 7" />
                                </svg>
                            </span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <!-- card -->
            <div class="card card-lg">
                <!-- card body -->
                <div class="card-body d-flex flex-column gap-8">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-shape icon-lg rounded-circle bg-info-darker text-info-lighter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 12l5 5l10 -10" />
                                <path d="M2 12l5 5m5 -5l5 -5" />
                            </svg>
                        </div>
                        <div>Cucian Di Ambil</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center lh-1">
                        <div class="fs-3 fw-bold"><?= $diambil ?></div>
                        <!-- <div class="text-danger small">
                            <span>3.19%</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trending-down">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 7l6 6l4 -4l8 8" />
                                    <path d="M21 10l0 7l-7 0" />
                                </svg>
                            </span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <!-- card -->
            <div class="card card-lg">
                <!-- card body -->
                <div class="card-body d-flex flex-column gap-8">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-shape icon-lg rounded-circle bg-success-darker text-success-lighter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-coin">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                <path d="M12 7v10" />
                            </svg>
                        </div>
                        <div>Penghasilan Hari Ini</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center lh-1">
                        <div class="fs-3 fw-bold">Rp. <?= number_format($penghasilan, 0, ',', '.') ?></div>
                        <!-- <div class="text-warning small">
                            <span>2.19%</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trending-up">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 17l6 -6l4 4l8 -8" />
                                    <path d="M14 7l7 0l0 7" />
                                </svg>
                            </span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row g-6 mb-6">
        <div class="col-xl-8 col-12">
            <!-- card -->
            <div class="card card-lg">
                <!--  card body -->
                <div class="card-body d-flex flex-column gap-5">
                    <div class="mb-4">
                        <!-- heading -->
                        <h5 class="mb-0">Penghasilan Berdasarkan Diambil</h5>
                        <span>Debit : Sudah dibayar</span>
                        <br>
                        <span>Kredit : Belum dibayar</span>
                    </div>
                    <div class="bg-gray-100 p-3 rounded-3">
                        <ul class="nav nav-pills-white nav-fill" id="chartTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="current-week-tab" data-bs-toggle="pill"
                                    data-bs-target="#current-week" type="button" role="tab" aria-controls="current-week"
                                    aria-selected="true">
                                    <span class="d-flex flex-column">
                                        <span class="d-flex align-items-center gap-2">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-primary">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                                </svg></span><span>Total Debit</span>
                                        </span>
                                        <span class="text-start fs-3 fw-semibold mt-2">Rp. <?= number_format($debit, 0, ',', '.') ?></span>
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="past-week-tab" data-bs-toggle="pill" data-bs-target="#past-week"
                                    type="button" role="tab" aria-controls="past-week" aria-selected="false">
                                    <span class="d-flex flex-column">
                                        <span class="d-flex align-items-center gap-2">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-warning">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                                </svg></span><span>Total Credit</span>
                                        </span>
                                        <span class="text-start fs-3 fw-semibold mt-2">Rp. <?= number_format($credit, 0, ',', '.') ?></span>
                                    </span>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="chartTabsContent">
                        <div class="tab-pane fade show active" id="current-week" role="tabpanel"
                            aria-labelledby="current-week-tab">
                            <div id="totalIncomeChart"></div>
                        </div>
                        <div class="tab-pane fade" id="past-week" role="tabpanel" aria-labelledby="past-week-tab">
                            <div id="totalExpensesChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-12">
            <!-- card -->
            <div class="card card-lg">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <h5 class="mb-6">Layanan</h5>
                    <div id="totalSale" class="d-flex justify-content-center"></div>
                    <!-- table -->
                    <table class="table table-sm table-borderless mb-0 mt-5">
                        <tbody>
                            <?php
                            $chartColors = [
                                'var(--ds-primary)',
                                'var(--ds-warning)',
                                'var(--ds-info)',
                                'var(--ds-danger)',
                                'var(--ds-success)',
                                'var(--ds-secondary)',
                            ];
                            $i = 0;
                            foreach ($layanan as $l):
                            ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    style="color: <?= $chartColors[$i % count($chartColors)] ?>">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                                </svg>
                                            </span>
                                            <span class="ms-1"><?= $l->nama_layanan ?></span>
                                        </div>
                                    </td>
                                    <td class="d-flex justify-content-end gap-2">
                                        <span><?= $l->total ?></span>
                                        <span class="text-secondary"><?= $l->persen ?>%</span>
                                    </td>
                                </tr>
                            <?php $i++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <!-- <div class="row g-6 mb-6">
        <div class="col-xl-12">
            <div class="card card-lg">
                
                <div class="card-header border-bottom-0">
                    <div>
                        <h5 class="mb-0">Orders</h5>
                    </div>
                </div>
               
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 table-centered table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Amount</th>
                                <th>Shipping Method</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#DU005</td>
                                <td>$150</td>
                                <td>Standard</td>
                                <td>Jan 20, 2025</td>
                                <td><span class="badge text-info-emphasis bg-info-subtle">Shipped</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td>#DU004</td>
                                <td>$200</td>
                                <td>Express</td>
                                <td>Jan 22, 2025</td>
                                <td><span class="badge text-warning-emphasis bg-warning-subtle">Pending</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td>#DU003</td>
                                <td>$300</td>
                                <td>Overnight</td>
                                <td>Jan 18, 2025</td>
                                <td><span class="badge text-danger-emphasis bg-danger-subtle">Cancel</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td>#DU002</td>
                                <td>$560</td>
                                <td>Overnight</td>
                                <td>Jan 13, 2025</td>
                                <td><span class="badge text-success-emphasis bg-success-subtle">Completed</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td>#DU002</td>
                                <td>$560</td>
                                <td>Overnight</td>
                                <td>Jan 11, 2025</td>
                                <td><span class="badge text-success-emphasis bg-success-subtle">Completed</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-6 mb-6">
        <div class="col-xl-12">
            <div class="card card-lg">
                <div class="card-header border-bottom-0">
                    <div>
                        <h5 class="mb-0">Top Selling Products</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 table-centered table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Sale</th>
                                <th>Revenue</th>
                                <th>Rating</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div>
                                        <a href="#!" class="d-flex align-items-center gap-2 text-inherit">
                                            <img src="assets/images/ecommerce/product-1.jpg" alt="product" class="rounded" width="40" />
                                            <span class="text-truncate">Transparent Sunglasses</span>
                                        </a>
                                    </div>
                                </td>
                                <td>454</td>
                                <td>$50,000</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-star text-warning">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                                            </svg>
                                        </span>
                                        <span>5/5</span>
                                    </div>
                                </td>
                                <td><span class="badge text-info-emphasis bg-info-subtle">In Stock</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <a href="#!" class="d-flex align-items-center gap-2 text-inherit">
                                            <img src="assets/images/ecommerce/product-2.jpg" alt="product" class="rounded" width="40" />
                                            <span class="text-truncate">Frames Still Life Glasses</span>
                                        </a>
                                    </div>
                                </td>
                                <td>454</td>
                                <td>$50,000</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-star text-warning">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                                            </svg>
                                        </span>
                                        <span>5/5</span>
                                    </div>
                                </td>
                                <td><span class="badge text-info-emphasis bg-info-subtle">In Stock</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <a href="#!" class="d-flex align-items-center gap-2 text-inherit">
                                            <img src="assets/images/ecommerce/product-3.jpg" alt="product" class="rounded" width="40" />
                                            <span>Slightly Rounded Frame</span>
                                        </a>
                                    </div>
                                </td>
                                <td>124</td>
                                <td>$30,000</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-star-half text-warning">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 1a.993 .993 0 0 1 .823 .443l.067 .116l2.852 5.781l6.38 .925c.741 .108 1.08 .94 .703 1.526l-.07 .095l-.078 .086l-4.624 4.499l1.09 6.355a1.001 1.001 0 0 1 -1.249 1.135l-.101 -.035l-.101 -.046l-5.693 -3l-5.706 3c-.105 .055 -.212 .09 -.32 .106l-.106 .01a1.003 1.003 0 0 1 -1.038 -1.06l.013 -.11l1.09 -6.355l-4.623 -4.5a1.001 1.001 0 0 1 .328 -1.647l.113 -.036l.114 -.023l6.379 -.925l2.853 -5.78a.968 .968 0 0 1 .904 -.56zm0 3.274v12.476a1 1 0 0 1 .239 .029l.115 .036l.112 .05l4.363 2.299l-.836 -4.873a1 1 0 0 1 .136 -.696l.07 -.099l.082 -.09l3.546 -3.453l-4.891 -.708a1 1 0 0 1 -.62 -.344l-.073 -.097l-.06 -.106l-2.183 -4.424z" />
                                            </svg>
                                        </span>
                                        <span>4.0/5</span>
                                    </div>
                                </td>
                                <td><span class="badge text-warning-emphasis bg-warning-subtle">Low Stock</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <a href="#!" class="d-flex align-items-center gap-2 text-inherit">
                                            <img src="assets/images/ecommerce/product-4.jpg" alt="product" class="rounded" width="40" />
                                            <span>Colored-Transparent Sunglasses</span>
                                        </a>
                                    </div>
                                </td>
                                <td>124</td>
                                <td>$30,000</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-star-half text-warning">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 1a.993 .993 0 0 1 .823 .443l.067 .116l2.852 5.781l6.38 .925c.741 .108 1.08 .94 .703 1.526l-.07 .095l-.078 .086l-4.624 4.499l1.09 6.355a1.001 1.001 0 0 1 -1.249 1.135l-.101 -.035l-.101 -.046l-5.693 -3l-5.706 3c-.105 .055 -.212 .09 -.32 .106l-.106 .01a1.003 1.003 0 0 1 -1.038 -1.06l.013 -.11l1.09 -6.355l-4.623 -4.5a1.001 1.001 0 0 1 .328 -1.647l.113 -.036l.114 -.023l6.379 -.925l2.853 -5.78a.968 .968 0 0 1 .904 -.56zm0 3.274v12.476a1 1 0 0 1 .239 .029l.115 .036l.112 .05l4.363 2.299l-.836 -4.873a1 1 0 0 1 .136 -.696l.07 -.099l.082 -.09l3.546 -3.453l-4.891 -.708a1 1 0 0 1 -.62 -.344l-.073 -.097l-.06 -.106l-2.183 -4.424z" />
                                            </svg>
                                        </span>
                                        <span>4.0/5</span>
                                    </div>
                                </td>
                                <td><span class="badge text-warning-emphasis bg-warning-subtle">Low Stock</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <a href="#!" class="d-flex align-items-center gap-2 text-inherit">
                                            <img src="assets/images/ecommerce/product-5.jpg" alt="product" class="rounded" width="40" />
                                            <span>Sun Glasses Table</span>
                                        </a>
                                    </div>
                                </td>
                                <td>124</td>
                                <td>$30,000</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-star-half text-warning">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 1a.993 .993 0 0 1 .823 .443l.067 .116l2.852 5.781l6.38 .925c.741 .108 1.08 .94 .703 1.526l-.07 .095l-.078 .086l-4.624 4.499l1.09 6.355a1.001 1.001 0 0 1 -1.249 1.135l-.101 -.035l-.101 -.046l-5.693 -3l-5.706 3c-.105 .055 -.212 .09 -.32 .106l-.106 .01a1.003 1.003 0 0 1 -1.038 -1.06l.013 -.11l1.09 -6.355l-4.623 -4.5a1.001 1.001 0 0 1 .328 -1.647l.113 -.036l.114 -.023l6.379 -.925l2.853 -5.78a.968 .968 0 0 1 .904 -.56zm0 3.274v12.476a1 1 0 0 1 .239 .029l.115 .036l.112 .05l4.363 2.299l-.836 -4.873a1 1 0 0 1 .136 -.696l.07 -.099l.082 -.09l3.546 -3.453l-4.891 -.708a1 1 0 0 1 -.62 -.344l-.073 -.097l-.06 -.106l-2.183 -4.424z" />
                                            </svg>
                                        </span>
                                        <span>4.0/5</span>
                                    </div>
                                </td>
                                <td><span class="badge text-warning-emphasis bg-warning-subtle">Low Stock</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <a href="#!" class="d-flex align-items-center gap-2 text-inherit">
                                            <img src="assets/images/ecommerce/product-6.jpg" alt="product" class="rounded" width="40" />
                                            <span>Rounded Frames Glasses</span>
                                        </a>
                                    </div>
                                </td>
                                <td>124</td>
                                <td>$30,000</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-star-half text-warning">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 1a.993 .993 0 0 1 .823 .443l.067 .116l2.852 5.781l6.38 .925c.741 .108 1.08 .94 .703 1.526l-.07 .095l-.078 .086l-4.624 4.499l1.09 6.355a1.001 1.001 0 0 1 -1.249 1.135l-.101 -.035l-.101 -.046l-5.693 -3l-5.706 3c-.105 .055 -.212 .09 -.32 .106l-.106 .01a1.003 1.003 0 0 1 -1.038 -1.06l.013 -.11l1.09 -6.355l-4.623 -4.5a1.001 1.001 0 0 1 .328 -1.647l.113 -.036l.114 -.023l6.379 -.925l2.853 -5.78a.968 .968 0 0 1 .904 -.56zm0 3.274v12.476a1 1 0 0 1 .239 .029l.115 .036l.112 .05l4.363 2.299l-.836 -4.873a1 1 0 0 1 .136 -.696l.07 -.099l.082 -.09l3.546 -3.453l-4.891 -.708a1 1 0 0 1 -.62 -.344l-.073 -.097l-.06 -.106l-2.183 -4.424z" />
                                            </svg>
                                        </span>
                                        <span>4.8/5</span>
                                    </div>
                                </td>
                                <td><span class="badge text-danger-emphasis bg-danger-subtle">Out of Stock</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@4.7.0/dist/apexcharts.min.js"></script>

<script>
    var incomeData = <?= $chart_income ?>;
    var kreditData = <?= $chart_kredit ?>;
    var layananLabel = <?= $chart_layanan_label ?>;
    var layananSeries = <?= $chart_layanan_series ?>;

    var theme = {
        primary: 'var(--ds-primary)',
        secondary: 'var(--ds-secondary)',
        success: 'var(--ds-success)',
        info: 'var(--ds-info)',
        warning: 'var(--ds-warning)',
        danger: 'var(--ds-danger)',
        dark: 'var(--ds-dark)',
        light: 'var(--ds-light)',
        white: 'var(--ds-white)',
        infoDark: '#006C9C',
        successLight: '#77ED8B',
        gray100: 'var(--ds-gray-100)',
        gray200: 'var(--ds-gray-200)',
        gray300: 'var(--ds-gray-300)',
        gray400: 'var(--ds-gray-400)',
        gray500: 'var(--ds-gray-500)',
        gray600: 'var(--ds-gray-600)',
        gray700: 'var(--ds-gray-700)',
        gray800: 'var(--ds-gray-800)',
        gray900: 'var(--ds-gray-900)',
        black: 'var(--ds-black)',
        transparent: 'transparent',
    };

    window.theme = theme;

    (function() {

        // Total Income Chart (Pendapatan per bulan)
        if (document.getElementById('totalIncomeChart')) {
            var options = {
                series: [{
                    name: 'Pendapatan',
                    data: incomeData,
                }],
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Public Sans, serif',
                },
                dataLabels: {
                    enabled: false
                },
                markers: {
                    size: 5,
                    hover: {
                        size: 6,
                        sizeOffset: 3
                    },
                },
                colors: ['#378ADD'],
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                grid: {
                    show: true,
                    borderColor: window.theme.gray300,
                    strokeDashArray: 2,
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    labels: {
                        show: true,
                        style: {
                            fontSize: '12px',
                            fontWeight: 400,
                            colors: window.theme.gray600,
                            fontFamily: 'Public Sans, serif',
                        },
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                },
                legend: {
                    show: false
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            if (val >= 1000000) return 'Rp ' + (val / 1000000).toFixed(1) + 'jt';
                            if (val >= 1000) return 'Rp ' + (val / 1000).toFixed(0) + 'rb';
                            return 'Rp ' + val;
                        },
                        style: {
                            fontSize: '12px',
                            fontWeight: 400,
                            colors: window.theme.gray600,
                            fontFamily: 'Public Sans, serif',
                        },
                    },
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                },
            };
            var chart = new ApexCharts(document.querySelector('#totalIncomeChart'), options);
            chart.render();
        }

        // Total Expenses Chart (Piutang/Sisa per bulan)
        if (document.getElementById('totalExpensesChart')) {
            var options = {
                series: [{
                    name: 'Piutang',
                    data: kreditData,
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Public Sans, serif',
                },
                grid: {
                    show: true,
                    borderColor: window.theme.gray300,
                    strokeDashArray: 2,
                },
                dataLabels: {
                    enabled: false
                },
                markers: {
                    size: 5,
                    hover: {
                        size: 6,
                        sizeOffset: 3
                    },
                },
                colors: [window.theme.warning],
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    labels: {
                        show: true,
                        style: {
                            fontSize: '12px',
                            fontWeight: 400,
                            colors: window.theme.gray600,
                            fontFamily: 'Public Sans, serif',
                        },
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                },
                legend: {
                    show: false
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            if (val >= 1000000) return 'Rp ' + (val / 1000000).toFixed(1) + 'jt';
                            if (val >= 1000) return 'Rp ' + (val / 1000).toFixed(0) + 'rb';
                            return 'Rp ' + val;
                        },
                        style: {
                            fontSize: '12px',
                            fontWeight: 400,
                            colors: window.theme.gray600,
                            fontFamily: 'Public Sans, serif',
                        },
                    },
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                },
            };
            var chart = new ApexCharts(document.querySelector('#totalExpensesChart'), options);
            chart.render();
        }

        // Total Sale Donut Chart (Order per Layanan)
        if (document.getElementById('totalSale')) {
            var options = {
                series: layananSeries,
                labels: layananLabel,
                colors: [
                    window.theme.primary,
                    window.theme.warning,
                    window.theme.info,
                    window.theme.danger,
                    window.theme.success,
                    window.theme.secondary,
                ],
                chart: {
                    type: 'donut',
                    height: 377,
                    fontFamily: 'Public Sans, serif',
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: true,
                    dropShadow: {
                        blur: 0,
                        opacity: 0
                    },
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%'
                        },
                    },
                },
                stroke: {
                    width: 0
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' order';
                        }
                    }
                },
                responsive: [{
                    breakpoint: 1400,
                    options: {
                        chart: {
                            type: 'donut',
                            width: 290,
                            height: 330
                        },
                    },
                }],
            };
            var chart = new ApexCharts(document.querySelector('#totalSale'), options);
            chart.render();
        }

    })();
</script>