$(document).ready(function() {
    let result;
    $('form[name="material"]').submit(function(e) {
        result = checkForm();
        e.preventDefault();
        if (result === false) {
            this.submit();
        }
    });
});

function checkForm()
{
    check = false;
    var material_name = $('#material_name').val();
    var material_description = $('#material_description').val();
    var material_price = $("#material_price").val();
    var validatePrice = function(price) {
        return /^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(price);
    }
    $(".error").remove();

    if (material_name.length < 1) {
        check = true;
        $('#material_name').after('<span class="error text-danger">Ce champ est obligatoire</span>');
    }
    if (material_description.length < 1) {
        check = true;
        $('#material_description').after('<span class="error text-danger">Ce champ est obligatoire</span>');
    }
    if (validatePrice(material_price) === false) {
        check = true;
        $('#material_price').after('<span class="error text-danger">Veuillez ajouter un prix valide</span>');
    }
    if( $('#material_client').has('option').length < 0 ) {
        check = true;
        $('#material_client').after('<span class="error text-danger">Veuillez selectionner un client</span>');
    }
    return check;
}
