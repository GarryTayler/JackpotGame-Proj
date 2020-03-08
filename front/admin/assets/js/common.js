function deleteConfirmMsg (cb) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then(function(result) {
        if (result.value) {
            return cb();
        }
    });
}

/**
 * @param ts ; seconds unit
 */
function getFullTimeFormat(ts) {
    return moment(ts * 1000).format('YYYY-MM-DD HH:mm');
}