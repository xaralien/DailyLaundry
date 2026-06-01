<body>
    <!-- Vertical Sidebar -->
    <div>
        <div id="miniSidebar">
            <div class="brand-logo">
                <a class="d-flex align-items-center gap-2" href="<?= base_url(); ?>">
                    <img src="<?= base_url(); ?>/assets/images/brand/logo/daily_laundry_icon.png" width="38" height="38" alt="" />
                    <div class="d-flex flex-column lh-1">
                        <span class="fw-bold fs-4 site-logo-text">Daily Laundry</span>
                        <span class="fw-bold site-logo-text" style="font-size: 0.75rem; letter-spacing: 3px;">INERBANG</span>
                    </div>
                </a>
            </div>
            <ul class="navbar-nav flex-column  ">



                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>"><span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                                <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                            </svg></span> <span class="text">Home</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>/laundry"><span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wash-machine">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 5a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2l0 -14" />
                                <path d="M8 14a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M8 6h.01" />
                                <path d="M11 6h.01" />
                                <path d="M14 6h2" />
                                <path d="M8 14c1.333 -.667 2.667 -.667 4 0c1.333 .667 2.667 .667 4 0" />
                            </svg></span> <span class="text">Laundry</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>/layanan"><span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" class="icon icon-tabler icons-tabler-outline icon-tabler-hanger-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 9l-7.971 4.428a2 2 0 0 0 -1.029 1.749v.823a2 2 0 0 0 2 2h1" />
                                <path d="M18 18h1a2 2 0 0 0 2 -2v-.823a2 2 0 0 0 -1.029 -1.749l-7.971 -4.428c-1.457 -.81 -1.993 -2.333 -2 -4a2 2 0 1 1 4 0" />
                                <path d="M6 18a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2l0 -1" />
                            </svg>
                        </span>
                        <span class="text">Layanan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>/notaconfig"><span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
                            </svg>
                        </span>
                        <span class="text">Setting Nota</span></a>
                </li>
                <!-- <li class="nav-item">
                    <div class="nav-heading">Pages</div>
                    <hr class="mx-5 nav-line mb-1" />
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            </svg>
                        </span>
                        <span class="text">Pages</span>
                    </a>
                    <ul class="dropdown-menu flex-column">



                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/pages/error/maintenance.html">Maintenance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/pages/error/404-error.html">404 Error</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-lock">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                            </svg>
                        </span>
                        <span class="text">Authentication</span>
                    </a>
                    <ul class="dropdown-menu flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/pages/authentication/sign-in.html">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/pages/authentication/sign-up.html">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/pages/authentication/forget-password.html">Forget Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/pages/authentication/reset-password.html">Reset Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/pages/authentication/otp-varification.html">Otp Varification </a>
                        </li>
                    </ul>
                </li>








                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-menu-deep">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 6h16" />
                                <path d="M7 12h13" />
                                <path d="M10 18h10" />
                            </svg>
                        </span>
                        <span class="text">Menu Level</span>
                    </a>
                    <ul class="dropdown-menu flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#!">Level 1a</a>
                        </li>

                        <li class="dropdown-submenu">
                            <a class="nav-link dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Level 1b</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="#!">Level 2a</a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="nav-link dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">Level 2b</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#!">Level 3a</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#!">Level 3b</a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link disabled text-gray-400" href="#!" aria-disabled="true" style="cursor:not-allowed">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-circle-off">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M20.042 16.045a9 9 0 0 0 -12.087 -12.087m-2.318 1.677a9 9 0 1 0 12.725 12.73" />
                                <path d="M3 3l18 18" />
                            </svg>
                        </span>
                        <span class="text">Disabled</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link position-relative " href="#!">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-tag">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path
                                    d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                            </svg>
                        </span>
                        <span class="text">Label
                            <span class="badge bg-info-subtle text-info-emphasis position-absolute end-0 me-2">New</span></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link position-relative " href="#!" aria-label="External Link">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                <path d="M11 13l9 -9" />
                                <path d="M15 4h5v5" />
                            </svg>
                        </span>
                        <span class="text">External Link </span>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link position-relative " href="<?= base_url(); ?>/pages/blank.html"
                        aria-label="External Link">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            </svg>
                        </span>
                        <span class="text">Blank </span>

                    </a>
                </li>

                <li>
                    <div class="text-center py-5 upgrade-ui ">
                        <div>
                            <img src="<?= base_url(); ?>/assets/images/avatar/avatar_x.png" alt="" class="avatar avatar-md rounded-circle">
                            <div class="my-3">
                                <h5 class="mb-1 fs-6">Jitu Chauhan</h5>
                                <span class="text-secondary">Free Version - 1 Month</span>
                            </div>
                            <a href="#!"
                                class="btn btn-primary d-none">Buy Pro</a>

                        </div>

                    </div>
                </li> -->

            </ul>

        </div>


        <div class="offcanvasNav offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">

                <a class="d-flex align-items-center gap-2" href="<?= base_url(); ?>">
                    <img src="<?= base_url(); ?>/assets/images/brand/logo/daily_laundry_icon.png" width="38" height="38" alt="" />
                    <div class="d-flex flex-column lh-1">
                        <span class="fw-bold fs-4 site-logo-text">Daily Laundry</span>
                        <span class="fw-bold site-logo-text" style="font-size: 0.75rem; letter-spacing: 3px;">INERBANG</span>
                    </div>
                </a>

                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <ul class="navbar-nav flex-column  ">

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>"><span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                    <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                </svg> <span class="text">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>/laundry"><span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wash-machine">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 5a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2l0 -14" />
                                    <path d="M8 14a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M8 6h.01" />
                                    <path d="M11 6h.01" />
                                    <path d="M14 6h2" />
                                    <path d="M8 14c1.333 -.667 2.667 -.667 4 0c1.333 .667 2.667 .667 4 0" />
                                </svg></span> <span class="text">Laundry</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>/layanan"><span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" class="icon icon-tabler icons-tabler-outline icon-tabler-hanger-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 9l-7.971 4.428a2 2 0 0 0 -1.029 1.749v.823a2 2 0 0 0 2 2h1" />
                                    <path d="M18 18h1a2 2 0 0 0 2 -2v-.823a2 2 0 0 0 -1.029 -1.749l-7.971 -4.428c-1.457 -.81 -1.993 -2.333 -2 -4a2 2 0 1 1 4 0" />
                                    <path d="M6 18a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2l0 -1" />
                                </svg>
                            </span>
                            <span class="text">Layanan</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>/notaconfig"><span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                    <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
                                </svg>
                            </span>
                            <span class="text">Setting Nota</span></a>
                    </li>
                    <li>
                        <div class="text-center py-5 upgrade-ui ">
                            <div>
                                <img src="<?= base_url(); ?>/assets/images/avatar/avatar_x.png" alt="" class="avatar avatar-md rounded-circle">
                                <div class="my-3">
                                    <span class="text-secondary">Made By</span>
                                    <h5 class="mb-1 fs-6">Xaralien</h5>
                                </div>
                                <!-- <a href="#!" class="btn btn-primary">Upgrade</a> -->

                            </div>

                        </div>
                    </li>

                </ul>
            </div>
        </div>