@extends('layouts.dashboard')

@section('title')
    QR Page
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('masterQR') }}
@endsection

@section('content')
    <!-- Begin Page Content -->
    @php
        $hasil = session('ambil_nama');
        $hasil1 = session('ambil_nama_mesin');
        $ceks1 = session('terisi_M');
        
    @endphp
    <script>
        console.log("Hasil: ", {!! json_encode($hasil) !!});
        console.log("Hasil: 1", {!! json_encode($hasil1) !!});
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="cardQR">
                    <!-- <form action="" method="post"> -->
                    @csrf
                    <div class="form-group">
                        <label class="label" for="disabledTextInput">Nama Operator</label>
                        <div class="row">
                            <div class="col-11">
                                <div class="input-group">
                                    <?php
                                    
                                    //if ($masterOperator!=null)
                                    //echo $masterOperator->nama;
                                    //else {
                                    //echo "Qr code salah";
                                    //}
                                    ?>
                                    <select value="{{ old('nama_operator') }}" placeholder="Masukkan Nama Operator"
                                        aria-label="nama operator" aria-describedby="basic-addon2"
                                        class="custom-select form-control @error('nama_operator') is-invalid @enderror js-example-basic-multiple"
                                        id="nama_operator" name="nama_operator" style="width: 100%; line-height:38px">
                                        <option value="-">Masukkan Nama Operator</option>
                                        <?php
                                            for ($i=0;$i<count($operator);$i++)
                                            {
                                                $selected="";
                                                if ($selectedOperator!=null && $operator[$i]->nama==$selectedOperator->nama)
                                                {
                                                    $selected="selected";
                                                }

                                                ?>
                                        <option <?php echo $selected; ?> value="<?php echo $operator[$i]->nama; ?>">
                                            <?php
                                            echo $operator[$i]->nama;
                                            $nama_operator = $operator[$i]->nama;
                                            ?>

                                        </option>
                                        <?php
                                            }
                                           
                                           ?>
                                    </select>

                                    @error('nama_operator')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" button
                                        onclick="window.location.href='scanQR';"
                                        style="width:100%; min-width:31px; align-items:left"><i
                                            class="fas fa-qrcode"></i></button>
                                </div>
                            </div>
                        </div>

                        <label class="label" for="disabledTextInput">Nama Mesin</label>
                        <div class="row">
                            <div class="col-11">
                                <div class="input-group">

                                    <select value="{{ old('nama_mesin') }}" placeholder="Masukkan Nama Mesin"
                                        aria-label="nama mesin" aria-describedby="basic-addon2"
                                        class="custom-select form-control @error('nama_mesin') is-invalid @enderror js-example-basic-multiple"
                                        id="nama_mesin" name="nama_mesin" style="width: 100%; line-height:38px">
                                        <option value="-">Masukkan Nama Mesin</option>
                                        <?php
                                         for ($i=0;$i<count($mesin);$i++)
                                         {
                                             $selected="";
                                             if ($selectedMesin!=null && $mesin[$i]->nama==$selectedMesin->nama)
                                             {
                                                 $selected="selected";
                                             }

                                             ?>
                                        <option <?php echo $selected; ?> value="<?php echo $mesin[$i]->nama; ?>">
                                            <?php
                                            echo $mesin[$i]->nama;
                                            ?>
                                        </option>
                                        <?php
                                         }
                                        
                                        ?>
                                    </select>

                                    @error('nama_mesin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" <button
                                        class="btn btn-outline-secondary" type="button"button
                                        onclick="window.location.href='scanmesin';" style="width:100%; min-width:31px"><i
                                            class="fas fa-qrcode"></i></button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" style="float: right" id="SubmitQR">Submit</button>
                    </div>
                    <br>
                    <hr>
                    <!-- <form action="" method="post"> -->
                    @csrf
                    <div class="form-group">
                        <label class="label" for="disabledTextInput">Surat Order</label>
                        <div class="row">
                            <div class="col-11">
                                <select value="{{ old('surat_order') }}" placeholder="Masukkan Surat Order"
                                    aria-label="Surat Order" aria-describedby="basic-addon2"
                                    class="custom-select form-control @error('surat_order') is-invalid @enderror js-example-basic-multiple"
                                    id="surat_order" name="surat_order" style="width: 100%; line-height:38px" onchange="changeSuratOrder(this)" disabled>
                                    <option value="-">Masukkan Surat</option>
                                    <?php
                                 for ($i=0;$i<count($surat);$i++)
                                 {
                                     $selected="";
                                     if ($selectedsurat!=null && $surat[$i]->nomor==$selectedsurat->nomor)
                                     {
                                         $selected="selected";
                                     }

                                     ?>
                                    <option <?php echo $selected; ?> value="<?php echo $surat[$i]->nomor; ?>" data-customer='<?= $surat[$i]->customer ?>' data-barang='<?= $surat[$i]->nama_barang ?>' data-qty='<?= $surat[$i]->quantity ?>'>
                                        <?php
                                        echo $surat[$i]->nomor;
                                        ?>
                                    </option>
                                    <?php
                                 }
                                
                                ?>
                                </select>


                                @error('nama_mesin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"button
                                        onclick="window.location.href='scansuratorder';"
                                        style="width:100%; min-width:31px" id="btn-scan-qr-surat" disabled><i class="fas fa-qrcode"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">



                        </div>

                        <br>

                        <div class="card d-none" id="card-surat-order">
                            <div class="card-body">
                                <p style="font-weight: bold;">Nama Customer : <span id="nama-customer"></span></p>
                                <p style="font-weight: bold;">Nama Barang : <span id="nama-barang"></span> </p>
                                <p style="font-weight: bold; margin-bottom: 0;">Total Qty : <span id="total-qty"></span> </p>
                            </div>
                        </div>

                        <br>

                        <input type="checkbox" class="" id="get_point" name="get_point" checked disabled></input>
                        <label class="label">Dapat Point</label>
                        <br>

                        <label class="label">Actual Qty</label>
                        <input type="number" min="1" class="form-control" id="actual_qty" name="actual_qty" disabled></input>

                        <label class="label">Keterangan Proses</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
                        <input type="hidden" name="picture" id="picture" />
                        <br>
                        <div>
                            <label class="label" for="disabledTextInput">Upload Photo</label>
                            <div class="input-group">
                                <input type="file" name="photo" id="upload-photo" multiple class="form-control">
                            </div>
                            <br>
                            <div class="input-group">
                                <div class="custom-file">
                                    <button id="start-camera">Start Camera</button>
                                    <button id="click-photo">Click Photo</button>
                                    <button id="reverse-camera">Reverse Camera</button>
                                </div>
                            </div>

                            <video id="video" width="100%" height="100%" autoplay></video>
                        </div>

                        <div>
                            <label class="label" for="disabledTextInput">Captured Photo</label>
                            <div id="captured" class="row">

                            </div>
                        </div>

                        <br>

                        <button type="submit" class="btn btn-primary" style="float: right"
                            id="tambah">Tambah</button>


                    </div>
                    <!-- </form> -->
                    <br>
                    <hr>
                    <div class="table-responsive">
                        <table id="tabelQR" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>Nama Operator</th>
                                    <th>Nama Mesin</th>
                                    <th>No. Order</th>
                                    <th>Tanggal</th>
                                    <th>Actual Qty</th>
                                    <th>Keterangan Proses</th>
                                    <th style="min-width: 350px;">Foto</th>
                                    <th style="min-width: 50px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="BodyQR">
                                <!-- <tr>
                                                                                                                <td>1</td>
                                                                                                                <td>Andi</td>
                                                                                                                <td>ABCD-1234</td>
                                                                                                                <td>10</td>
                                                                                                                <td>10-03-2023</td>
                                                                                                                <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum </td>
                                                                                                                <td>
                                                                                                                    <button type="button" class="btn btn-danger"><i
                                                                                                                            class="fas fa-trash"></i></button>
                                                                                                                </td>
                                                                                                            </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary" style="float: right" id="SubmitDB">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@push('javascript-internal')
    <script src="sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var surat = <?php echo json_encode($surat); ?>;
        var operator = <?php echo json_encode($operator); ?>;
        $(document).ready(function() {
            var Index = 1;
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();

            // today = dd + '-' + mm + '-' + yyyy;
            today = yyyy + '-' + mm + '-' + dd;

            $('.js-example-basic-multiple').select2();
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: $(this).attr('alert-title'),
                    text: $(this).attr('alert-text'),
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: $(this).attr('alert-btn-cancel'),
                    reverseButtons: true,
                    confirmButtonText: $(this).attr('alert-btn-yes'),
                }).then((result) => {
                    if (result.isConfirmed) {
                        alert("Proses Menghapus Data dari Kategori");
                        event.target.submit();
                    }
                });
            });
            $('#SubmitQR').click(function(e) {
                var namaOperator = $('#nama_operator').val();
                var namaMesin = $('#nama_mesin').val();
                if (namaOperator != '' && namaMesin != '') {

                    var history = "";
                    for (var i = 0; i < operator.length; i++) {
                        if (operator[i].nama == namaOperator) {
                            history = operator[i].surat;
                        }
                    }
                    var pesan = "Nama: " + namaOperator + " Mesin: " + namaMesin;
                    if (history != "") {
                        pesan = "Nama: " + namaOperator + " (" + history + ")  Mesin: " + namaMesin;
                    }
                    Swal.fire({
                        title: 'Input Sudah Benar?',
                        text: pesan,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Benar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#surat_order').prop('disabled', false)
                            $('#btn-scan-qr-surat').prop('disabled', false)
                            $('#inputGroupFile04').prop('disabled', false)
                            $('#exampleFormControlTextarea1').prop('disabled', false)
                            $('#actual_qty').prop('disabled', false)
                            $('#nama_operator').prop('disabled', true)
                            $('#nama_mesin').prop('disabled', true)
                        } else {
                            $('#surat_order').prop('disabled', true)
                            $('#btn-scan-qr-surat').prop('disabled', true)
                            $('#inputGroupFile04').prop('disabled', true)
                            $('#exampleFormControlTextarea1').prop('disabled', true)
                            $('#actual_qty').prop('disabled', true)
                            $('#nama_operator').prop('disabled', false)
                            $('#nama_mesin').prop('disabled', false)
                        }
                    })
                } else {
                    Swal.fire(
                        'Lupa Input?',
                        'Nama Operator atau Mesin masih Kosong',
                        'question'
                    )
                    // alert("ada yang kosong")
                }
            });

            var surat

            $('#tambah').click(function(e) {
                if ($('#surat_order').val() != '' && $('#actual_qty').val() != '' && $('#exampleFormControlTextarea1').val() != '') {

                    var get_point = $('#get_point').is(':checked');
                    var actual_qty = parseInt($('#actual_qty').val());
                    var max_qty = parseInt($('#actual_qty').attr('max'));

                    console.log(get_point);

                    if(actual_qty > max_qty)
                    {
                        return Swal.fire(
                            'Error',
                            'Actual qty tidak boleh melebihi total qty !',
                            'error'
                        );
                    }
                    else if(actual_qty < 1)
                    {
                        return Swal.fire(
                            'Error',
                            'Actual qty tidak boleh kurang dari 1 !',
                            'error'
                        );
                    }

                    var duplicate = false;

                    $("table > tbody > tr").each(function() {
                        if($(this).find('td').eq(2).text() == $('#surat_order')
                        .val()){
                            duplicate = true;
                            return false
                        }
                    });

                    const canvasElements = document.querySelectorAll('#captured canvas');

                    var images = "";

                    canvasElements.forEach((canvas) => {
                        const dataURL = canvas.toDataURL();
                        images += `
                        <img class="mb-2" style="object-fit: initial;" width="100px" height="100px" src="${dataURL}">
                        <input type="hidden" name="photo_${Index}[]" value="${dataURL}">
                        `;
                    });

                    if(!duplicate)
                    {
                        $('#BodyQR').append('<tr id=' + "IDX" + Index + '> <td>' + $('#nama_operator')
                            .val() +
                            '</td> <td>' + $('#nama_mesin').val() + '</td> <td>' + $('#surat_order')
                            .val() +
                            '</td> <td>' + today + '</td><td>' + actual_qty +'</td><td>' + $(
                                '#exampleFormControlTextarea1').val() +
                            '</td> <td>' + images  + '</td> <td> <input type="hidden" value="' +  get_point +'"> <button type="button" class="btn btn-danger" onclick="DeleteRow(' +
                            "IDX" + Index++ + ')"><i class="fas fa-trash"></i></button> </td></tr>');

                        $('#captured').html("");
                        $('#exampleFormControlTextarea1').val("");
                        $('#get_point').prop("checked", true);
                        $('#actual_qty').val("");
                    }else{
                        Swal.fire(
                            'Error',
                            'Nomor order ini sudah ditambahkan',
                            'error'
                        )
                    }

                } else {
                    Swal.fire(
                        'Lupa Input?',
                        'Ada Salah Satu Bagian Masih Kosong',
                        'question'
                    )
                    // alert("ada yang kosong")
                }
            });


            $('#SubmitDB').click(function(e) {
                var _token = $("input[name='_token']").val();
                var N_OP = []
                var N_MSN = []
                var N_ORD = []
                var Ket_P = []
                var Act_Q = []
                var Get_P = []
                var picture = [];
                
                $("table > tbody > tr").each(function() {
                    // alert($(this).find('td').eq(0).text() + " " + $(this).find('td').eq(1).text() );
                    N_OP.push($(this).find('td').eq(0).text())
                    N_MSN.push($(this).find('td').eq(1).text())
                    N_ORD.push($(this).find('td').eq(2).text())
                    Act_Q.push($(this).find('td').eq(4).text())
                    Ket_P.push($(this).find('td').eq(5).text())
                    Get_P.push($(this).find('td:eq(7) input').val())
                });

                const photoArrays = {};

                const inputElements = document.querySelectorAll('input[name^="photo_"]');

                inputElements.forEach((input) => {
                    const name = input.getAttribute("name");
                    const value = input.value;

                    if (!photoArrays[name]) {
                        photoArrays[name] = [];
                    }

                    photoArrays[name].push(value);
                });

                var image=$("#picture").val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('SubmitQR') }}",
                    data: {
                        _token: _token,
                        N_OP: N_OP,
                        N_MSN: N_MSN,
                        N_ORD: N_ORD,
                        Ket_P: Ket_P,
                        Act_Q: Act_Q,
                        Get_P: Get_P,
                        operator: $("#nama_operator").val(),
                        photos: JSON.stringify(photoArrays)
                    },
                }).done(function(msg) {
                    //location.reload();
                    Swal.fire(
                        'Success !',
                        msg,
                        'success'
                    ).then((result) => {
                        location.reload();
                    });
                })
            });
        });

        function DeleteRow(Row) {
            Row.remove();
        }

        function changeSuratOrder(suratOrder)
        {
            $('#card-surat-order').removeClass('d-none');

            var selectedValue = $(suratOrder).val();
            var namaCustomer = "-";
            var namaBarang = "-";
            var totalQty = "0";

            if(selectedValue != "-")
            {
                var selectedOption = $(suratOrder).find(':selected');
            
                namaCustomer = selectedOption.data("customer");
                namaBarang = selectedOption.data("barang");
                totalQty = selectedOption.data("qty");
            }else{
                $('#card-surat-order').addClass('d-none');
            }

            $('#nama-customer').html(namaCustomer);
            $('#nama-barang').html(namaBarang);
            $('#total-qty').html(totalQty);
            $('#get_point').attr('disabled', false);
            $('#actual_qty').attr('max', totalQty);
        }


        //awal
        let camera_button = document.querySelector("#start-camera");
        let reverse_camera = document.querySelector("#reverse-camera");
        let video = document.querySelector("#video");
        let click_button = document.querySelector("#click-photo");
        var currentFacing = { exact : 'environment' };

        camera_button.addEventListener('click', async function() {
            let stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: currentFacing
                },
                audio: false,
            });
            video.srcObject = stream;
        });

        reverse_camera.addEventListener('click', async function(){
            var mode = currentFacing.exact == 'user' ? 'environment' : 'user';
            currentFacing.exact = mode;

            let stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: currentFacing
                },
                audio: false,
            });
            video.srcObject = stream;
        });

        click_button.addEventListener('click', function() {
            drawToCanvas(video);
        });

        let upload_photo = document.getElementById("upload-photo");

        upload_photo.addEventListener('change', function(e){
            if (e.target.files) {
                for(var i = 0; i < e.target.files.length; i++)
                {
                    let imageFile = e.target.files[i];
                    var reader = new FileReader();
                    reader.readAsDataURL(imageFile);
                    reader.onloadend = function (e) {
                        var myImage = new Image();
                        myImage.src = e.target.result;
                        myImage.onload = function(ev) {
                            drawToCanvas(myImage);
                        }
                    }
                }
            }
            upload_photo.value = "";
        });

        function drawToCanvas(image)
        {
            var dcanvas = document.createElement('canvas');
            dcanvas.width = "225";
            dcanvas.height = "300";
            dcanvas.style.width = "225px";
            dcanvas.style.height = "300px";

            var ctx = dcanvas.getContext("2d");
            ctx.drawImage(image, 0, 0, dcanvas.width, dcanvas.height);

            var canvasContainer = document.createElement('div');
            canvasContainer.classList.add('w-100', 'mb-2');
            canvasContainer.append(dcanvas);

            var container = document.createElement('div');
            container.classList.add('mb-2', 'col');
            container.append(canvasContainer);

            var deleteButton = document.createElement('button');
            deleteButton.classList.add('btn', 'btn-danger');
            deleteButton.textContent = 'Delete';
            container.appendChild(deleteButton);

            deleteButton.addEventListener('click', function() {
                container.parentNode.removeChild(container);
            });

            $('#captured').append(container);
        }
        //akhir
    </script>
@endpush
