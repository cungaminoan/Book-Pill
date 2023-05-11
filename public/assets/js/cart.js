let currentTotalCart = $('#totalOrder')
let totalItems = $('#totalNumber')
let checkoutButton = $('#check_out')

function removeProductFromCart(selector) {

    let productEle = $(selector).parent().parent()

    $.ajax({
        type: 'POST',
        url: routeRemoveProductFromCart(),
        headers: {'X-CSRF-TOKEN': getCSRFToken()},
        data: {
            id_product: productEle.get(0).id
        },
        success: function (response) {
            if(response.result) {
                let price = $('#totalPrice' + productEle.get(0).id).get(0).innerHTML
                calculateProduct(0, price)
                totalItems.get(0).innerHTML =  Number.parseInt(totalItems.get(0).innerHTML) - 1
                $('#' + productEle.get(0).id).remove()
                checkProductInCart()
            } else {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    width: '400px',
                    title: 'Remove product from cart not successfully',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        }
    })
}

function checkProductInCart() {
    let productCart = $('.product_cart')

    if(productCart.length <= 2) {
        $('#cart').html(`<img src=${imageNoProductFound()}>`)
    }
}

// function checkAll(selector) {
//
//     let checkBoxAll = $(selector).attr('checked')
//
//     if(!checkBoxAll) {
//         $('input[type=checkbox]').attr('checked', 'checked')
//     } else {
//         $('input[type=checkbox]').attr('checked', false)
//     }
//
// }

function quantityNumberProduct(selector) {
    let quantityInput = $(selector)
    let buttonChange = quantityInput.siblings()
    if(quantityInput.val() < 1) {
        quantityInput.val(1)
    }
    if(quantityInput.val() > 1) {
        enableButton($(buttonChange.get(0)))
    }

    if(quantityInput.val() < 2) {
        disableButton($(buttonChange.get(0)))
    }

    let priceProduct = calculateProductEle($(selector), quantityInput.val())

    // let checkbox = $(`input[type="checkbox"][value=${priceProduct.id}]`)
    // if(checkbox.prop('checked')) {
    //     calculateProduct(1, priceProduct.priceProduct)
    // }
}

function increaseQuantity(selector) {
    let quantityInput = $($(selector).siblings().get(1))
    let currentValue = Number.parseInt(quantityInput.val())
    quantityInput.val(++ currentValue)
    if(quantityInput.val() > 1) {
        enableButton($($(selector).siblings().get(0)))
    }

    let priceProduct = calculateProductEle($(selector), quantityInput.val())

    let checkbox = $(`input[type="checkbox"][value=${priceProduct.id}]`)
    if(checkbox.prop('checked')) {
        calculateProduct(1, priceProduct.priceProduct)
    }
}

function decreaseQuantity(selector) {
    let quantityInput = $($(selector).siblings().get(0))
    let currentValue = Number.parseInt(quantityInput.val())
    quantityInput.val(-- currentValue)
    if(quantityInput.val() < 2) {
        disableButton($(selector))
    }

    let priceProduct = calculateProductEle($(selector), quantityInput.val())

    let checkbox = $(`input[type="checkbox"][value=${priceProduct.id}]`)
    if(checkbox.prop('checked')) {
        calculateProduct(0, priceProduct.priceProduct)
    }
}

function enableButton(buttonSelector) {
    buttonSelector.removeClass('disabled_button')
    buttonSelector.prop('disabled', false)
}

function disableButton(buttonSelector) {
    buttonSelector.addClass('disabled_button')
    buttonSelector.prop('disabled', true)
}

function calculateProductEle(selectorEle, value) {
    let id = selectorEle.parents().get(1).id
    let priceProduct = Number.parseInt($('#priceProduct' + id).get(0).innerHTML)
    $('#totalPrice' + id).get(0).innerHTML = priceProduct * value
    return {
        id: id,
        priceProduct: priceProduct
    };
}

function getItem(value, checkbox) {
    let price = $('#totalPrice' + value).get(0).innerHTML
    if($(checkbox).prop('checked')) {
        calculateProduct(1, price)
        totalItems.get(0).innerHTML =  Number.parseInt(totalItems.get(0).innerHTML) + 1
        enableButton(checkoutButton)
    } else {
        calculateProduct(0, price)
        totalItems.get(0).innerHTML =  Number.parseInt(totalItems.get(0).innerHTML) - 1
        if(totalItems.get(0).innerHTML === '0') {
            disableButton(checkoutButton)
        }
    }
}

function calculateProduct(change, price) {
    change ?
        currentTotalCart.get(0).innerHTML = Number.parseInt(currentTotalCart.get(0).innerHTML) + Number.parseInt(price)
        : currentTotalCart.get(0).innerHTML = Number.parseInt(currentTotalCart.get(0).innerHTML) - Number.parseInt(price)
}

checkoutButton.on('click', function () {
    let orderInfo = []
    let checkList = $('input[type=checkbox]:checked').toArray()

    checkList.forEach(check => {
        orderInfo.push({
            idProduct: $(check).val(),
            quantity: Number.parseInt($(`#quantityProduct` + $(check).val()).val()),
        })
    })

    $.ajax({
        type: 'POST',
        url: routeOrderTmp(),
        headers: {'X-CSRF-TOKEN': getCSRFToken()},
        data: {
            id_user: getUserID(),
            order_info: JSON.stringify(orderInfo),
            phone_number: getUserPhoneNumber()
        },
        success: function (response) {
            if (response.result) {
                $('#cart').html(response.data)
            }
        }
    })
})


