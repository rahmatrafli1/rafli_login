const flashRoleData = $('.flash-role-data').data('flashdata')
const flashAccessData = $('.flash-accessmenu-data').data('flashdata')

if (flashRoleData) {
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Role berhasil ' + flashRoleData
    })
}

if (flashAccessData) {
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Akses Menu berhasil ' + flashAccessData
    })
}
