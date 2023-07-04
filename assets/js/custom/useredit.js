const flashUserEditData = $('.flash-useredit-data').data('flashdata')

if (flashUserEditData) {
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'User berhasil ' + flashUserEditData
    })
}
