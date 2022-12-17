$(document).ready(function() {
    let result;
    $('form[name="material"]').submit(function(e) {
        result = checkFormMaterial();
        e.preventDefault();
        if (result === false) {
            this.submit();
        }
    });
    $('form[name="client"]').submit(function(e) {
        result = checkFormClient();
        e.preventDefault();
        if (result === false) {
            this.submit();
        }
    });
});
function checkFormMaterial()
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
    return check;
}

function checkFormClient()
{
    check = false;
    var client_firstName = $('#client_firstName').val();
    var client_lastName = $('#client_lastName').val();
    var client_email = $('#client_email').val();
    $(".error").remove();

    if (client_firstName.length < 1) {
        check = true;
        $('#client_firstName').after('<span class="error text-danger">Ce champ est obligatoire</span>');
    }
    if (client_lastName.length < 1) {
        check = true;
        $('#client_lastName').after('<span class="error text-danger">Ce champ est obligatoire</span>');
    }
    if (client_email.length < 1 || !isEmail(client_email)) {
        check = true;
        $('#client_email').after('<span class="error text-danger">Merci d\'ajouter un email valide</span>');
    }
    return check;
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}