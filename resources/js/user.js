function changeUser() {
    let userObject = {
        full_name: $('#full_name').val(),
        date_of_birth: $('#dateOfBirth').val(),
        gender: $('input[type=radio]:checked').val()
    }

    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': getCSRFToken()},
        url: routeChangeUser(),
        data: userObject,
        success: function (res) {
            if(res.result) {
                Swal.fire(res.message, '', 'success')
            } else {
                Swal.fire(res.message, '', 'error')
            }
        }
    })
}
