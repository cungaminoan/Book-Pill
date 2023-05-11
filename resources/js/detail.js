function changeMainImage(srcImage) {
    $('#main_image_detail').attr('src', srcImage)
}

$('.add_to_cart').on('click', function () {
    if (checkLogin()) {
        $.ajax({
            type: 'POST',
            url: routeAddProductToCart(),
            headers: {'X-CSRF-TOKEN': getCSRFToken()},
            data: {
                id_product: this.value
            },
            success: function (response) {
                if(response.result) {
                    getCartList()
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        width: '400px',
                        height: '100px',
                        title: 'Add product to cart successfully',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            }
        })
    } else {
        Swal.fire('You must login first!', '', 'error')
    }

})

function chooseRating(selectRating) {
    if($(selectRating)[0].className.includes('active') !== -1) {
        $('.rating').removeClass('active')
        $(selectRating).addClass('active')
    }

    $.ajax({
        type: 'POST',
        url: routeGetComment(),
        headers: {'X-CSRF-TOKEN': getCSRFToken()},
        data: {
            rating: $(selectRating).attr('value'),
            idProduct: productID()
        },
        success: function (response) {
            if(response.result) {
                $('.rating_product_comment').html(response.data)
            } else {
                Swal.fire(response.message, '', 'error')
            }
        }
    })
}
