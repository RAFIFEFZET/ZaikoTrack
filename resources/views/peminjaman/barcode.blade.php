@extends('layouts.demo')
@section('title', 'Tambah Peminjaman')
@section('css')
<link rel="stylesheet" href="{{asset('css\style.css')}}">
<link rel="stylesheet" href="{{asset('css\kamera.css')}}">
<link rel="stylesheet" href="{{asset('dist\css\selectize.bootstrap5.css')}}">

@endsection
@section('breadcrumb-name')
Tambah Peminjaman
@endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card mb-2">
                <div class="card-header pb-0">
                    <h1 class="content__title content__title--m-sm">Form Peminjaman</h1>
                </div>
                <div class="card-body m-0">
                    <!--multisteps-form-->

                    <div class="container overflow-hidden">
                        <!--multisteps-form-->
                        <div class="multisteps-form">
                            <!--progress bar-->
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-8 ml-auto mr-auto mb-2">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type=" button"
                                            title="Address">Data
                                            Peminjam</button>
                                        <button class="multisteps-form__progress-btn " type="button"
                                            title="User Info">Barang Peminjaman
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <!--form panels-->
                            <div class="row">
                                <div class="multisteps-form__form">
                                    <form id='formPeminjaman' action="{{route('peminjaman.store') }}" method="post">
                                        @csrf
                                        <div class="multisteps-form__panel js-active" data-animation="scaleIn">
                                            <h4 class="multisteps-form__title">Data Diri</h4>
                                            <div class="multisteps-form__content">
                                                <div class="form-row mt-3">
                                                    @if($id_users->level == "siswa")
                                                        <input type="hidden" name="id_users" value={{ Auth::user()->id_users }}>
                                                        <input type="hidden" name="status" value="siswa">
                                                        @else
                                                        <div class="form-group">
                                                            <label for="exampleInputstatus">Status</label>
                                                            <select
                                                                class="form-select @error('status') is-invalid @enderror selectpicker"
                                                                data-live-search="true" id="exampleInputstatus"
                                                                name="status">
                                                                <option value="siswa" @if( old('status')=='siswa' )selected
                                                                    @endif>Siswa
                                                                </option>
                                                                <option value="guru" @if( old('status')=='guru' )selected
                                                                    @endif>
                                                                    Guru
                                                                </option>
                                                                <option value="karyawan" @if( old('status')=='karyawan'
                                                                    )selected @endif>Karyawan
                                                                </option>
                                                            </select>
                                                            @error('status')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div id="siswaForm" style="display: block;">
                                                        <div class="form-group" >
                                                            <label for="id_users">Nama Siswa</label>
                                                            <select id="normalize"  name="id_users"  >                                                            <option selected>Select an option</option>
                                                                <option value="" selected disabled>Pilih Nama</option>
                                                                @foreach($users as $user)
                                                                @if($user->level == 'siswa')
                                                                <option value="{{ $user->id_users }}">{{ $user->name }}
                                                                </option>
                                                                @endif
                                                                @endforeach
                                                              </select>
                                                            @error('id_users')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="kelas" class="form-label">Kelas</label>
                                                                        <input type="text" name="kelas" id="kelas" class="form-control" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="nis" class="form-label">NIS</label>
                                                                        <input type="text" name="nis" id="nis" class="form-control" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                                        <div  id="guruForm" style="display: none;">
                                                            <div class="form-group">
                                                                <label for="id_guru">Nama Guru</label>
                                                                <select name="id_guru" id="normalize1">
                                                                    <option value="" selected disabled>Pilih Nama</option>
                                                                    @foreach($guru as $key => $g)
                                                                    <option value="{{ $g->id_guru }}">
                                                                        {{ $g->nama_guru }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_guru')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="row">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="nip" class="form-label">NIP</label>
                                                                                <input type="text" name="nip" id="nip" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="jurusan" class="form-label">Jurusan</label>
                                                                                <input type="text" name="jurusan" id="jurusan" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                  
                                          
    
                                                        <div class="form-group" id="karyawanForm" style="display: none;">
                                                            <label for="id_karyawan">Nama Karyawan</label>
                                                            <select  name="id_karyawan" id="normalize2">
                                                                <option value="" selected disabled>Pilih Nama</option>
                                                                @foreach($karyawan as $key => $k)
                                                                <option value="{{ $k->id_karyawan }}">
                                                                     {{ $k->nama_karyawan }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @error('id_karyawan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        @endif
                                                       
                                              
    
                                                        <div class="form-group mt-2">
                                                            <label for="keterangan_pemakaian">Keterangan
                                                                Pemakaian</label>
                                                            <input type="text" name="keterangan_pemakaian"
                                                                id="keterangan_pemakaian" class="form-control" required>
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="tgl_kembali" class="form-label">Tanggal
                                                                Kembali</label>
                                                            <input type="date" name="tgl_kembali" id="tgl_kembali"
                                                                class="form-control" required>
                                                        </div>
                                                <div class="button-row d-flex justify-content-end mt-4">
                                                    <button class="btn btn-danger mybtn remove">Batal</button>
                                                    <button class="btn btn-primary ml-auto js-btn-simpan mybtn"
                                                        title="Selanjutnya">Selanjutnya</button>
                                                </div>
                                    </form>
                                </div>
                            </div>
                            <div class="multisteps-form__panel  rounded bg-white " data-animation="scaleIn"
                                id="table_id">
                                <h4 class="multisteps-form__title">Barang Peminjaman</h4>
                                <div class="multisteps-form__content">
                                    <div class="form-row mt-3">
                                        <div id="cart-container">
                                            <div class="table-container">
                                                <div class="table-responsive">
                                                    <div class="mb-2">
                                                        <button class="btn btn-primary ml-auto js-btn-add" type="button"
                                                            title="Selanjutnya" id="tambahButton">Tambah</button>
                                                    </div>
                                                    <table id="myTable2"
                                                        class="table table-bordered table-striped align-items-center mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Nama Barang</th>
                                                                <th>Ruangan</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id='button-new' class="d-flex justify-content-end mt-4 button-row">
                                        <button class="btn btn-secondary js-btn-prev mybtn" type="button"
                                            title="Prev">Kembali</button>
                                        <a href="{{route('peminjaman.index')}}" class="btn btn-primary">
                                            Simpan
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--single form panel-->

                        </div>
                        <!-- tambah barang -->
                        <div id="additionalFormContainer" style="display: none;">
                            <form class="addForm" action="{{ route('detailPeminjaman.AddBarcode') }}" method="post">
                                @csrf

                                <div class="form-row mt-3">
                                    <div class="form-group">
                                        <div class="responsive-video-wrapper">
                                            <video id="previewKamera" style="width: 100%; height: auto;"></video>
                                        </div>
                                        <br>
                                        <select id="pilihKamera" class="form-select">
                                        </select>
                                        <br>
                                        <label for="ket_barang">Kode Barang</label>
                                        <input type="text" id="hasilscan" name="kode_barang"  class="form-control" readonly>
                                    </div>
                                   
                                    <div class="form-group mt-2">
                                        <label for="ket_barang">Keterangan Barang</label>
                                        <input type="text" name="ket_barang" id="ket_barang" class="form-control">
                                        <small class="form-text text-muted">*wajib diisi ketika
                                            barang tidak lengkap/rusak. </small>
                                        @error('ket_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="button-row d-flex justify-content-end mt-4 ">
                                    <button class="btn btn-secondary js-btn-kembali mybtn" type="button"
                                        title="Prev">Kembali</button>
                                    <button class="btn btn-primary js-btn-back mybtn" type="button"
                                        title="Prev">Selanjutnya</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
</div>
</div>


@stop

@push('js')

<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script src="../dist/js/selectize.js"></script>
<script src="../js/script.js"></script>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('js/barcode-scanner.js') }}"></script>
<script>
$(document).ready(function() {
    $('#myTable1').DataTable({
        "responsive": true,
        "language": {
            "paginate": {
                "previous": "<",
                "next": ">"
            }
        }
    });
});

$('#normalize').selectize({

});
$('#normalize1').selectize({

});
$('#normalize2').selectize({

});

$(document).ready(function() {
    var idPeminjaman;
    $("#formPeminjaman").on('click', '.js-btn-simpan', function(e) {
        e.preventDefault();

        // Get the active form
        var form = $(this).closest('form');

        // Get the URL and method of the form
        var url = form.attr('action');
        var method = form.attr('method');

        // Serialize form data
        var data = form.serialize();

        // Append the CSRF token to the data
        data += '&_token=' + $('meta[name="csrf-token"]').attr('content');
        if (idPeminjaman) {
            data += '&id_peminjaman=' + idPeminjaman;
        }

        // Kirim data ke server menggunakan AJAX
        $.ajax({
                type: method,
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })

            .done(function(response) {

                idPeminjaman = response.id_peminjaman;


                // Perbarui action form dengan ID peminjaman yang baru jika sudah ada
                if (idPeminjaman) {
                    form.attr('action', '/peminjaman/create/' + idPeminjaman);
                    form.attr('method', 'PUT'); // Set method form menjadi PUT
                }

                console.log('Form submitted!', response);
                // form[0].reset();
                const eventTarget = e.target;
                e.preventDefault();
                if (eventTarget.classList.contains(`${DOMstrings.stepSimpanBtnClass}`)) {

                    const panelOrderList = document.getElementById('table_id');
                    let panelOrderListIndex = Array.from(DOMstrings.stepFormPanels).indexOf(
                        panelOrderList);

                    setActiveStep(panelOrderListIndex);
                    setActivePanel(panelOrderListIndex);
                    return;
                }

            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                let errorMessage;
                try {
                    const responseJson = JSON.parse(jqXHR.responseText);
                    errorMessage = responseJson.error || 'An error occurred.';
                } catch (error) {
                    errorMessage = 'Data Belum Terisi.';
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage,
                });
            });
    });


    $("#additionalFormContainer").on('click', '.js-btn-back', function(e) {
        e.preventDefault();

        // Dapatkan formulir yang sedang aktif
        var form = $(this).closest('form');

        // Dapatkan URL dan metode formulir
        var url = form.attr('action');
        var method = form.attr('method');

        // Serialize data formulir
        var data = form.serialize();

        if (idPeminjaman) {
            data += '&id_peminjaman=' + idPeminjaman;

            $.ajax({
                    type: method,
                    url: url,
                    data: data,
                })
                .done(function(response) {
                    console.log('Additional form submitted!', response);

                    // Check if the expected properties exist in the response
                    if (response.nama_barang && response.nama_ruangan) {
                        const progressButtons = document.querySelectorAll(
                            '.multisteps-form__progress-btn');
                        progressButtons.forEach(button => {
                            button.disabled = false;
                        });
                        DOMstrings.stepsForm.style.display = 'block';
                        DOMstrings.additionalFormContainer.style.display = 'none';
                        var existingRowCount = $('#myTable2 tbody tr').length;
                        var newRowNumber = existingRowCount + 1;
                        var formContainer = $(
                            '#button-new'
                        );
                        // Reload or update the content within the container

                        // Create the new row HTML
                        var newRow = '<tr>' +
                            '<td>' + newRowNumber + '</td>' +
                            '<td>' + response.nama_barang + '</td>' +
                            '<td>' + response.nama_ruangan + '</td>' +
                            '<td><button class="btn btn-danger btn-sm removeBtn" data-id_detail_peminjaman="' +
                            response.id_detail_peminjaman + '">Hapus</button></td>'
                        '</tr>';

                        // Append the new row to the table
                        $('#myTable2 tbody').append(newRow);
                        $('#myTable2').addClass('table-responsive');
                        formHeight(getActivePanel());
                        form[0].reset();
                    } else {
                        let errorMessage;
                        try {
                            const responseJson = JSON.parse(jqXHR.responseText);
                            errorMessage = responseJson.error || 'An error occurred.';
                        } catch (error) {
                            errorMessage = 'Data Belum Terisi.';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                        });
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    let errorMessage;
                    try {
                        const responseJson = JSON.parse(jqXHR.responseText);
                        errorMessage = responseJson.error || 'An error occurred.';
                    } catch (error) {
                        errorMessage = 'Data Belum Terisi.';
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                    });
                });
        } else {
            // Handle the case where idPeminjaman is not defined or empty
            console.error('Error: idPeminjaman is not defined or empty');
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Data Diri Belum Lengkap Terisi ',
            });
        }
    });


    $('#myTable2 tbody').on('click', '.removeBtn', function(e) {
        e.preventDefault();

        let id_detail_peminjaman = $(this).data('id_detail_peminjaman');
        var rowToRemove = $(this).closest('tr');
        var idToRemove = $(this).data('id_detail_peminjaman');
        // Ambil token CSRF dari tag meta
        let token = $('meta[name="csrf-token"]').attr('content');
        $(this).prop('disabled', true);

        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/peminjaman/detailPeminjaman/${id_detail_peminjaman}`,
                    type: "DELETE",
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Response id_detail_peminjaman:',
                                response
                                .id_detail_peminjaman);
                            console.log('Successfully deleted data.');

                            // Remove the corresponding row from the DOM
                            if (rowToRemove) {
                                rowToRemove.remove();
                            }

                            // Optionally, update row numbers or perform other necessary tasks
                            updateRowNumbers();
                            formHeight(getActivePanel());
                        } else {
                            console.log('Gagal menghapus data.');
                        }
                    },

                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON && xhr
                            .responseJSON
                            .message ? xhr.responseJSON.message :
                            'An error occurred.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                        });
                    },
                    complete: function() {
                        // Re-enable the button after the request is complete
                        $('.removeBtn').prop('disabled', false);
                    }

                });
            } else {
                // Re-enable the button if the user cancels the action
                $('.removeBtn').prop('disabled', false);
            }

        });
    });

    function updateRowNumbers() {
        $('#myTable2 tbody tr').each(function(index) {
            // Update the content of the first <td> in each row with the new row number
            $(this).find('td:first').text(index + 1);
        });
    }

    $('#formPeminjaman').on('click', '.remove', function(e) {
        e.preventDefault();
        if (!idPeminjaman) {
            console.error('Error: idPeminjaman is not defined');
            return;
        }
        let id_peminjaman =
            idPeminjaman;

        // Ambil token CSRF dari tag meta
        let token = $('meta[name="csrf-token"]').attr('content');

        // Tambahkan id_peminjaman ke dalam data yang akan dikirimkan
        let data = {
            id_peminjaman: id_peminjaman,
            _token: token
        };
        $(this).prop('disabled', true);

        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/peminjaman/create/${id_peminjaman}`,
                    type: "DELETE",
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Response id_peminjaman:', response
                                .id_peminjaman);
                            console.log('Successfully deleted data.');
                            window.location.href =
                                "{{ route('peminjaman.index') }}";

                        } else {
                            console.log('Gagal menghapus data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON && xhr.responseJSON
                            .message ? xhr.responseJSON.message :
                            'An error occurred.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                        });
                    },
                });
            } else {
                // Re-enable the button if the user cancels the action
                $('.remove').prop('disabled', false);
            }
        });
    });
});
~




document.getElementById('exampleInputstatus').addEventListener('click', function() {
    const selectedStatus = this.value;
    const siswaElement = document.getElementById('siswaForm');
    const guruElement = document.getElementById('guruForm');
    const karyawanElement = document.getElementById('karyawanForm');
    const kelasInput = siswaElement.querySelector('#kelas');
    const nisInput = siswaElement.querySelector('#nis');
    const nipInput = guruElement.querySelector('#nip');
    const jurusanInput = guruElement.querySelector('#jurusan');
    
    kelasInput.value = '';
    nisInput.value = '';
    nipInput.value = '';
    jurusanInput.value = '';

  
    // Hide all forms
    siswaElement.style.display = 'block';
    guruElement.style.display = 'none';
    karyawanElement.style.display = 'none';
    // NamaElement.style.display = 'block';
   

    // Show the selected form
    if (selectedStatus === 'siswa') {
        siswaElement.style.display = 'block';

    } else if (selectedStatus === 'guru') {
        guruElement.style.display = 'block';
        siswaElement.style.display = 'none';
      
    } else if (selectedStatus === 'karyawan') {
        karyawanElement.style.display = 'block';
        siswaElement.style.display = 'none';
      
    }

    
});

document.querySelectorAll('select[name=id_barang]').forEach(select => select.addEventListener('click',
    function() {
        const id_barangSelect = this.closest('.form-group').nextElementSibling.querySelector(
            'select[name=id_ruangan]');
        const selectedIdRuangan = this.value;

        // Fetch id_barang options for the selected id_ruangan
        fetch(`/fetch-id-barang/${selectedIdRuangan}`)
            .then(response => response.json())
            .then(data => {
                // Clear existing options
                id_barangSelect.innerHTML = '';

                // Populate options based on the received data
                data.forEach(option => {
                    const newOption = document.createElement('option');
                    newOption.value = option.ruangan.id_ruangan;
                    newOption.text =
                        option.ruangan.nama_ruangan;
                    id_barangSelect.add(newOption);
                });

                // Show or hide the id_barang select based on whether options are available
                id_barangSelect.style.display = data.length > 0 ? 'block' : 'none';
                id_barangSelect.setAttribute('required', data.length > 0 ? 'true' : 'false');

                const event = new Event('change');
                id_barangSelect.dispatchEvent(event);
            })
            .catch(error => console.error('Error:', error));

    }));
document.querySelectorAll('select[name=id_ruangan], select[name=id_barang]').forEach(select => select
    .addEventListener(
        'change',
        function() {
            const id_ruanganSelect = document.querySelector('select[name=id_ruangan]');
            const id_barangSelect = document.querySelector('select[name=id_barang]');

            const selectedIdRuangan = id_ruanganSelect.value;
            const selectedIdBarang = id_barangSelect.value;
            const kondisiSelect = this.closest('.form-group').nextElementSibling.querySelector(
                'select[name=kondisi_barang]');

            // Fetch kondisi barang for the selected id_ruangan and id_barang
            fetch(`/fetch-kondisi-barang/${selectedIdRuangan}/${selectedIdBarang}`)
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    kondisiSelect.innerHTML = '';

                    // Populate options based on the received data
                    data.forEach(option => {
                        const newOption = document.createElement('option');
                        newOption.value = option.kondisi_barang;
                        newOption.text = option.kondisi_barang + (option.ket_barang ?
                            ' - ' +
                            option
                            .ket_barang : '');
                        kondisiSelect.add(newOption);
                    });

                    // Show or hide the kondisi_barang select based on whether options are available
                    kondisiSelect.style.display = data.length > 0 ? 'block' : 'none';
                    kondisiSelect.setAttribute('required', data.length > 0 ? 'true' : 'false');
                })
                .catch(error => console.error('Error:', error));
        }));
</script>



@endpush