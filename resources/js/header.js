const modal_download = $('#modal_download')
const cart_user = $('#cart_user')
const cart = $('.cart')
const profile = $('#profile_name')
const profile_expand = $('.profile')
const searchProduct = $('#search_product')
const searchResult = $('.search_result')
const searchDropDown = $('.search_dropdown')

$('#text_header_download').hover(
    function () {
        if (modal_download.css('display') === 'none') {
            modal_download.css('display', 'block')
        }
        $('.modal_download').hover(
            function () {
                modal_download.css('display', 'block')
            },
            function () {
                modal_download.css('display', 'none')
            }
        )
    },
    function () {
        $('#modal_download').css('display', 'none')
    }
)

$(document).on('click', function () {

})

cart_user.hover(
    function () {
        if (cart.css('display') === 'none') {
            cart.css('display', 'block')
            cart.hover(
                function () {
                    cart.css('display', 'block')
                },
                function () {
                    cart.css('display', 'none')
                }
            )
        }
    },
    function () {
        cart.css('display', 'none')
    }
)

profile.hover(
    function () {
        if(profile_expand.css('display') === 'none') {
            profile_expand.css('display', 'block')

            profile_expand.hover(
                function () {
                    profile_expand.css('display', 'block')
                },
                function () {
                    profile_expand.css('display', 'none')
                }
            )
        }
    },
    function () {
        profile_expand.css('display', 'none')
    })

searchProduct.on('keyup', function () {
    let searchKey = this.value.trim()
    if(searchKey) {
        $.ajax({
            type: 'POST',
            url: routeSearchTitleProduct(),
            headers: {'X-CSRF-TOKEN': getCSRFToken()},
            data: {
                searchKey: searchKey
            },
            success: function (response) {
                if(response.result) {
                    searchResult.html(response.data)
                    searchDropDown.show()
                }
            }
        })
    } else {
        searchDropDown.hide()
    }
})

function getCartList() {
    $.ajax({
        type: 'GET',
        url: routeCartList(),
        headers: {'X-CSRF-TOKEN': getCSRFToken()},
        success: function (response) {
            if(response.result) {
                $('#cart_detail').html(response.data)
            }
        }
    })
}

getCartList()



