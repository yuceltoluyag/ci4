<?= $this->extend('includes/admin_template') ?>

<?= $this->section('extra-css') ?>
<!-- SummerNote -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet"
      href="<?php echo base_url(); ?>/assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/plugins/select2/css/select2.min.css">
<link rel="stylesheet"
      href="<?php echo base_url(); ?>/assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Service Arrangement Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url("index.php") ?>">Homepage</a></li>
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

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Switcher -->
<script src="<?php echo base_url(); ?>/assets/admin/plugins/switchery/dist/switchery.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>/assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- bootstrap-input-spinner -->
<script src="<?php echo base_url(); ?>/assets/admin/js/bootstrap-input-spinner.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>/assets/admin/plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url(); ?>/assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>/assets/admin/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(document).ready(function () {

        $('#summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link','picture','video']],
                ['height', ['height']]
            ],
            height: 200,
            minHeight: 150,
            maxHeight: null,
            focus: true,
            airMode: false,
            lang: 'tr-TR',
            callbacks: {
                onImageUpload: function (files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                },
                onMediaDelete: function (target) {
                    deleteImage(target[0].src);
                }
            }
        });

        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: 'POST',
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
                    return myXhr;
                },
                url: "<?php echo base_url('service/upload_image')?>",
                cache: false,
                contentType: false,
                processData: false,
                success: function (url) {
                    $('#summernote').summernote('editor.insertImage', url);
                }
            });
        }

        function progressHandlingFunction(e) {
            if (e.lengthComputable) {
                $('progress').attr({value: e.loaded, max: e.total});
                // reset progress on complete
                if (e.loaded == e.total) {
                    $('progress').attr('value', '0.0');
                }
            }
        }

        function deleteImage(src) {
            $.ajax({
                data: {src: src},
                type: "POST",
                url: "<?php echo base_url('service/delete_image')?>",
                cache: false,
                success: function (response) {
                    console.log(response);
                }
            });
        }

        $("#templateButtonsRight").inputSpinner({
            template:
                '<div class="input-group ${groupClass}">' +
                '<div class="input-group-prepend"></div>' +
                '<input type="text" inputmode="decimal" style="text-align: ${textAlign}" class="form-control"/>' +
                '<div class="input-group-append">' +
                '<button style="min-width: ${buttonsWidth}" class="btn btn-decrement ${buttonsClass}" type="button">${decrementButton}</button>' +
                '<button style="min-width: ${buttonsWidth}" class="btn btn-increment ${buttonsClass}" type="button">${incrementButton}</button>' +
                '</div></div>'
        })

        $('.btn-number').click(function (e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function () {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }

        });
    });

    function previewImg() {
        const minel = document.querySelector('#minel');
        const minelLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        minelLabel.textContent = minel.files[0].name;
        const fileMinel = new FileReader();
        fileMinel.readAsDataURL(minel.files[0]);
        fileMinel.onload = function (e) {
            imgPreview.src = e.target.result;
        }
    }

</script>
<?= $this->endSection() ?>
