let inputFile = $('#inputFile')
let imageProduct = $('#imageArea')
let index = 1;

inputFile.on('change', function (event) {
    const file = this.files[0];
    if(file) {
        let reader = new FileReader();
        reader.onload = function (e) {
            imageProduct.html(imageProduct.html() + `<div class="flex flex-row justify-between" >
                        <img class="image_border w-1/2" src="${e.target.result}" alt="" id="img${index}">
                        <input type="text" hidden name="inputImageUpload[]" value="${e.target.result}">
                        ${index === 1 ? `<span class="w-[49%] text-[red]">*This image will show as the main image of product</span>` : ``}
                    </div>`)
            index++
        }
        reader.readAsDataURL(file)
    }

    if(index > 4) {
        $('.custom-file-input.custom-file-input-add').hide()
    }
})

function uploadImage(id, imageUpload) {
    const file = imageUpload.files[0];
    if(file) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $(`#img${id}`).attr('src', e.target.result)
            $(`#image${id}`).val(e.target.result)
        }
        reader.readAsDataURL(file)

    }
}
