<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>
    var save_method;
    console.log('test');

    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>portal/regis_pengunjung/addData';

        sweetAlert({
                title: "Apakah anda sudah yakin ?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                cancelButtonText: "Kembali",
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: $('#daftar').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#daftar input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#daftar")[0].reset();
                            setInterval(() => {
                                window.location = "<?php echo base_url('portal/pemesanan_tiket'); ?>"
                            }, 500);
                        } else {
                            $.each(data['messages'], function(key, value) {
                                var element = $('#' + key);
                                element.closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('#text-error')
                                    .remove();
                                element.after(value);
                            });
                        }
                        swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    }

                });
            });
    }
</script>
<div class="banner header-text">
</div>
<div class="send-message tab1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h4>Pendaftaran Akun Pengunjung</h4>
                    <p>Silahkan melakukan pendaftaran untuk login sistem.</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="contact-form">
                    <form id="daftar" action="" method="post">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                    <input name="username" type="text" class="form-control" id="username" placeholder="Username" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="Password" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="LK">Laki-laki</option>
                                        <option value="PR">Perempuan</option>

                                    </select>
                                    <br>
                                    <!-- <input name="jenis_kelamin" type="text" class="form-control" id="jenis_kelamin" placeholder="Jenis Kelamin" required=""> -->
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                    <input name="email" type="text" class="form-control" id="email" placeholder="Email" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                    <input name="no_hp" type="text" class="form-control" id="no_hp" placeholder="No Hp" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="button" onclick="history.back(-1)" id="form-submit" class=" btn btn-danger" style="font-size: 12px;">Batal</button>
                                    <button type="button" onclick="simpan()" class=" btn btn-primary" style="font-size: 12px;">Kirim Pendaftaran</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="accordion">

                    <li>
                        <a>Pendaftaran Akun</a>
                        <div class="content">
                            <p>Silahkan masukkan username yang telah terdaftar pada sistem. Apabila username belum terdaftar silahkan klik tombol daftar terlebih dahulu</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>