window.toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
});

$(document).on('click', 'a[delete-btn]', function (e) {
    e.preventDefault();

    const _self = $(this);
    const url = _self.attr('href');
    const dt = _self.data('datatable');
    const reload = _self.data('reload');

    window.swal.fire({
        title: 'Are you sure?',
        text: 'You want to delete this record',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#e85347',
        cancelButtonColor: '#eeeeee',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (!result.value) return;

        window.swal.fire({
            title: '',
            text: 'Please wait...',
            showConfirmButton: false,
            backdrop: true
        });

        window.axios.delete(url).then(response => {
            if (dt !== '') $(dt).DataTable().ajax.reload();

            if (typeof response.data.message !== 'undefined') {
                toastMessage(response.data.message, 'success');
            } else {
                toastMessage(response.data, 'success');
            }

            if (reload) window.location.reload();
        }).catch(error => {
            window.swal.close();
            toastMessage(error.response.data.message, 'error');
        });
    });
});

function toastMessage(message = '', status = 'error', isToast = true) {
    status = status == 'error' ? status : 'success';

    if (message == '') message = status == 'error' ?
        'Something went wrong.' :
        'The action was successful.';

    let options = isToast
        ? {
            icon: status,
            title: message,
            showConfirmButton: false,
            confirmButtonColor: '#6576ff',
            toast: true,
            position: 'bottom-end',
            timer: 5000,
            timerProgressBar: true,
        }
        : {
            icon: status,
            title: message,
            position: 'center',
        }

    window.swal.fire(options);
}