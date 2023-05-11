let dataFilter;

function chooseRating(selectRating) {
    if($(selectRating)[0].className.includes('active') !== -1) {
        $('.rating').removeClass('active')
        $(selectRating).addClass('active')
    }
}

function checkDeliveryValue(selectorGenre) {
    if($(selectorGenre).prop('checked')) {
        let genreList = $('input[name="delivery"]')
        genreList.prop('checked', false)
        $(selectorGenre).prop('checked', true)
    } else {
        $(selectorGenre).prop('checked', false)
    }
}

function getFilterProduct() {

    let checkedGenre = $('input[name="genre[]"]:checked').toArray()

    let genreList = []

    if(checkedGenre.length > 0) {
        checkedGenre.forEach((genre) => {
            genreList.push(genre.value)
        })
    }

    genreList = genreList.sort()

    let deliveryFrom = $('input[name="delivery"]:checked').val()
        ? [$('input[name="delivery"]:checked').val()] : ['1', '2']
    let min_price = $('input[name="min_price"]').val()
        ? $('input[name="min_price"]').val() : 0
    let max_price = $('input[name="max_price"]').val()
        ? $('input[name="max_price"]').val() : 0


    dataFilter = {
        genreList: genreList,
        deliveryFrom: deliveryFrom,
        min_price: min_price,
        max_price: max_price
    }

    $.ajax({
        type: 'POST',
        url: routeFilterProduct(),
        headers: {'X-CSRF-TOKEN': getCSRFToken()},
        data: {
            data: JSON.stringify(dataFilter),
            clear: 0
        },
        success: function (response) {
            if(response.result) {
                $('#product_result').html(response.data)
            }
        }
    })
}

function clearFilter() {
    $('input[type="checkbox"]:checked').prop('checked', false)
    $('input[type="text"]').val('')
    $('.rating').removeClass('active');

    $.ajax({
        type: 'POST',
        url: routeFilterProduct(),
        headers: {'X-CSRF-TOKEN': getCSRFToken()},
        data: {
            data: '',
            clear: 1
        },
        success: function (response) {
            if(response.result) {
                $('#product_result').html(response.data)
            }
        }
    })
}


