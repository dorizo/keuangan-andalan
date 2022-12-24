
function hapus($a){
    Swal.fire({
        title: 'Apakah kamu Yakin?',
        text: "Data Akan Di hapus Permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        window.location.href= $a;
        }
    })
}
    