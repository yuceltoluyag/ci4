<?=$this->extend('includes/admin_template')?>
<?=$this->section('extra-css')?>
    <!-- Switcher -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/plugins/switchery/dist/switchery.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/css/custom.css">
<?=$this->endSection()?>
<?=$this->section('content')?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Services</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=base_url("index.php")?>">Homepage</a></li>
                    <li class="breadcrumb-item active">Services</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<?php echo view($viewFolder . '/' . $subViewFolder . '/content'); ?>
<!-- /.content -->

<?=$this->endSection()?>
<?=$this->section('extra-js')?>
    <!-- Switcher -->
    <script src="<?php echo base_url(); ?>/assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/admin/plugins/switchery/dist/switchery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function () {

            "use strict";
            $(".content-container, .card-body").on('change', '.isActive', function () {
                    var $data = $(this).prop("checked");
                    var $data_url = $(this).data("url");

        if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
            $.post($data_url, {data: $data}, function (response) {});}})

             $(".content-container, .card-body").on('click', '.demoSwal', function () {
                     var $data_url = $(this).data("url");
                     var id = $(this).data("id");

                        Swal.fire({
                            title: 'Emin misiniz?',
                            text: "Bu işlem geri alınamaz!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Evet, Sil',
                            cancelButtonText: 'Hayır'
                        }).then((result) => {
                            if (result.value) {
                                $.get($data_url, function (response) {
                                    console.log(response);
                                    if (response) {
                                        $('#ord-' + id).remove();
                                        Swal.fire(
                                            'Silindi!',
                                            'Kayıt başarıyla silindi.',
                                            'success',
                                            setTimeout(function () {
                                                window.location.href = $data_url;
                                            }, 1500)
                                        )

                                    } else {
                                        Swal.fire(
                                            'Hata!',
                                            'Kayıt silinirken bir hata oluştu.',
                                            'error',
                                            setTimeout(function () {
                                                window.location.href = $data_url;
                                            }, 1500)
                                        )
                                    }
                                });
                            }
                        })
                    });

                        });
    </script>
<?=$this->endSection()?>