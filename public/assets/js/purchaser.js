
function uploadRating(idProduct, idOrder) {
    let commentInput = $(`#comment${idProduct}`).val()
    let rating = $('.rating.active').attr('value')

    $.ajax({
        type: 'POST',
        url: routeAddComment(),
        headers: {'X-CSRF-TOKEN': getCSRFToken()},
        data: {
            id_product: idProduct,
            comment: commentInput,
            rating: rating,
            idOrder: idOrder
        },
        success: function (response) {
            if(response.result) {
                $(`#${idProduct}`).remove()
                Swal.fire(response.message, '', 'success')
            } else {
                Swal.fire(response.message, '', 'error')
            }
        }
    })
}

function chooseRating(selectRating) {
    if($(selectRating)[0].className.includes('active') !== -1) {
        $('.rating').removeClass('active')
        $(selectRating).addClass('active')
    }
}
