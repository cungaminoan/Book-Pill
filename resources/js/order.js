let placeOrder = $('#order')

placeOrder.on('click', function () {
    let orderInfo = []
    let productIDList = []
    let productList = $('.product_order').toArray()
    productList.forEach((product) => {
        productIDList.push(product.id)
        orderInfo.push({
            id_product: product.id,
            unit_price: getNumberValue($(`#unitPrice${product.id}`).html()),
            quantity: getNumberValue($(`#quantity${product.id}`).html()),
            subTotal: getNumberValue($(`#subTotal${product.id}`).html()),
            status: false
        })
    })

    $.ajax({
        type: 'POST',
        url: routeCreateOrder(),
        headers: {'X-CSRF-TOKEN': getCSRFToken()},
        data: {
            productIDList: JSON.stringify(productIDList),
            orderInfo: JSON.stringify(orderInfo),
            priceOrder: getNumberValue($('#totalOrder').html()),
            address: $('#address').val(),
        },
        success: function (response) {
            if (!response.result) {
                if (response.data) {
                    let target = JSON.parse(response.data)
                    if (target.target === 'address') {
                        $('#address').addClass('error_input')
                        $(window).scrollTop(0);
                    }
                } else {
                    Swal.fire(`${response.message}`, '', 'error').then((res) => {
                        window.location.href = routeCart()
                    })
                }
            } else {
                Swal.fire(`${response.message}`, '', 'success').then((res) => {
                    window.location.href = routeOrder()
                })
            }
        }
    })

    console.log(orderInfo)
})

function getNumberValue(value) {
    return Number.parseInt(value)
}
