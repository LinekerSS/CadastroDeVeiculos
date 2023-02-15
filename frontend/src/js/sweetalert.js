import Swal from "sweetalert2";

const toast = Swal.mixin({
    toast: true,
    timer: 5000,
    timerProgressBar: true,
    showConfirmButton: false,
    position: "top",
})

const loading = Swal.mixin({
    title: 'Carregando...',
    timer: 30000,
    showConfirmButton: false,
    allowOutsideClick: false,
    didOpen: () => {
        Swal.showLoading()
    }
})

window.loading = loading
window.toast = toast
window.swal = Swal