
$(document).ready(function(){

    $('.btnAdresse').click(function () {
        let value = $('#selectedAdress input:radio:checked').val();
        var originUrl = window.location.origin;
        url = originUrl + '/panier/payement/' + value;
        window.location.assign(url);
    })

});