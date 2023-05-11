function progressOrder(handle, idOrder) {
    let handleOrder = handle === 'accept' ? 1 : 0;

    Swal.fire({
        title: `Do you want to ${handle} this order?`,
        showCancelButton: true,
        confirmButtonText: 'Yes',
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: routeHandleOrder(),
                headers: {'X-CSRF-TOKEN': getCSRFToken()},
                data: {
                    id_order: idOrder,
                    status_order: handleOrder ? 2 : 3
                },
                success: function (response) {
                    if(response.result) {
                        $('.btn-handle').remove()
                        let statusOrder = $('#status_order')
                        statusOrder.addClass(handleOrder ? 'text-[green]' : 'text-[red]');
                        statusOrder.html(handleOrder ? 'accept' : 'deny');
                        Swal.fire(response.message, '', 'success')
                    } else {
                        Swal.fire(response.message, '', 'error')
                    }
                }
            })
        }
    })
}
