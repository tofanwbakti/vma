const flashDt = $('.flash-data').data('flashdata');
if(flashDt){
	Swal.fire({
		icon: 'success',
		title: 'Berhasil',
		text: 'Data sudah ' + flashDt,
		showConfirmButton: false,
		timer: 1500
	})
}

const flashDtErr = $('.flashErr').data('flashdata');
if(flashDtErr){
	Swal.fire({
		icon: 'error',
		title: 'Oops...',
		text: 'Data gagal ' + flashDtErr,
		showConfirmButton: false,
		timer: 1500
	})
}



// Material untuk KONFIRMASI
    /*MENGGANTI DATA*/
    $('.switch').on('click', function(e){
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Kamu Yakin?',
            text: "Data akan diubah!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Setuju'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
    });

    /*MENGHAPUS DATA*/
    $('.hapus').on('click', function(e){
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Data akan dihapus!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Setuju'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });

    /*MENGGANTI DATA*/
    $('.return').on('click', function(e){
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Kamu Yakin?',
            text: "Pastikan aset sudah diperiksa!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Setuju'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
    });

    /*Logout*/
    $('.logout').on('click', function(e){
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Kamu Yakin?',
            text: "Sesi akan diakhiri !",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Setuju'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
    });