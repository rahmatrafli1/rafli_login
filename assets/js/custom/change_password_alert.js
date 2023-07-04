const flashChangePasswordData = $('.flash-changepassword-data').data('flashdata')
const flashFailChangePasswordData = $('.flash-failchangepassword-data').data('flashdata')

if (flashChangePasswordData) {
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Password anda ' + flashChangePasswordData
    })
}

if (flashFailChangePasswordData) {
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Password anda ' + flashFailChangePasswordData
    })
}
