function changeStatusUser(id, status) {
    let title = status === 1 ? `Do you want to active user ${id}?` : `Do you want to disable user ${id}?`
    Swal.fire({
        title: title,
        showCancelButton: true,
        confirmButtonText: 'Yes',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: routeChangeStatusUser(),
                headers: {'X-CSRF-TOKEN': getCSRFToken()},
                data: {
                    id: id,
                    status: status
                },
                success: function (response) {
                    if (response.result) {
                        Swal.fire('Change status user successfully', '', 'success')
                        let statusValue = status === 1 ? 2 : 1
                        let statusUser = status === 1 ? 'active' : 'disable'
                        let buttonAction = `<button class="btn ${status === 1 ? `btn-danger` : `btn-edit`}"
                        onclick="changeStatusUser(${id}, ${statusValue})">
                        <span> ${status === 1 ? `Disable` : `Active`} </span> </button>`
                        $('#status_user').html(statusUser)

                        $('#change_status_user').html(buttonAction)
                    } else {
                        Swal.fire('Can not change status user', '', 'error')
                    }
                }
            })
        }
    })
}
