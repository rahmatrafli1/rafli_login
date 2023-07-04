const flashMenuData = $('.flash-menu-data').data('flashdata')
const flashSubMenuData = $('.flash-submenu-data').data('flashdata')

if (flashMenuData) {
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Menu berhasil ' + flashMenuData
    })
}

if (flashSubMenuData) {
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Sub Menu berhasil ' + flashSubMenuData
    })
}
