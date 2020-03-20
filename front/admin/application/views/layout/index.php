<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>">
    <title>SPIN2WIN Admin</title>
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <!--begin::Page Vendors -->
    <link href="<?= base_url('assets/plugin/fullcalendar/fullcalendar.bundle.css') ?>" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors -->
    <link href="<?= base_url('assets/css/vendors.bundle.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/plugin/simplePagination/simplePagination.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css"/>
    <!--begin::Base Scripts -->
    <script src="<?= base_url('assets/js/vendors.bundle.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/scripts.bundle.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/plugin/simplePagination/jquery.simplePagination.js') ?>"></script>
    <script src="<?= base_url('assets/plugin/moment/moment.js') ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        var site_url = '<?=site_url()?>';
        var baseURL = '<?=base_url()?>';
    </script>
</head>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    <?php $this->load->view('layout/header') ?>
    <!-- END: Header -->
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <!-- BEGIN: Aside Menu -->
            <div
                    id="m_ver_menu"
                    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                    data-menu-vertical="true"
                    data-menu-scrollable="false" data-menu-dropdown-timeout="500"
            >
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    <?php foreach ($menus as $menu) {
                        new_render_menu($menu, $cur_menu, true);
                    } ?>
                </ul>
            </div>
            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">
                            <?=$title?>
                        </h3>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <?php
                $this->load->view($content_path, $content_data);
                ?>
            </div>
        </div>
    </div>
    <!-- end:: Body -->
    <!-- begin::Footer -->
    <?php $this->load->view('layout/footer') ?>
    <!-- end::Footer -->
</div>
<!-- end:: Page -->
<!-- begin::Quick Sidebar -->
<?php //$this->load->view('layout/quick_sidebar')?>
<!-- end::Quick Sidebar -->
<!-- begin::Scroll Top -->
<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
     data-scroll-speed="300">
    <i class="la la-arrow-up"></i>
</div>
<!-- begin::Quick Nav -->

<!--end::Base Scripts -->
<!--begin::Page Vendors -->
<script src="<?= base_url('assets/plugin/fullcalendar/fullcalendar.bundle.js') ?>" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Snippets -->
<script src="<?= base_url('assets/app/js/dashboard.js') ?>" type="text/javascript"></script>
<!--end::Page Snippets -->
<script src="<?= base_url('assets/js/sweetalert2.js') ?>" type="text/javascript"></script>
<!--morris JavaScript -->
<script src="<?=base_url('assets/plugin/jquery-sparkline/jquery.sparkline.min.js')?>"></script>
<script src="<?=base_url('assets/js/dashboard.js')?>"></script>
<script src="<?= base_url('assets/js/common.js') ?>" type="text/javascript"></script>
</body>

</html>
