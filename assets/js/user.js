$(document).ready(function(){
    $('.dessin-danger').click(function () {
        let id_dessin = $(this).attr('id');
        let nom_dessin = $('.nom_dessin_'+id_dessin).attr('id');
        let chemin = window.location.pathname;
        let id_user = chemin.substring(6);
        console.log(id_user);
        result = confirm("Attention!! es-tu sur de bien vouloir suprimer le dessin "+nom_dessin+' ???');
        if(result){
            $.ajax({
                type: "POST",
                url: id_user+"/removeDessin",
                data: {id_dessin: id_dessin},
                success: function (resp)
                {
                    alert(resp.resp)
                    location.reload();
                },
                error: function (XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error: '+ errorThrown);
                }
            })
        }

    });
    $(".flash-notice").delay(4000).hide(500);

    let url = window.location.pathname;
    let divHidden = getLastPartOfUrl(url);
    function getLastPartOfUrl(url) {
        var urlsplit = url.split("/");
        var lastpart = urlsplit[urlsplit.length-1];
        if($.isNumeric(lastpart)) {
            lastpart = 'dessin';
        }
        return lastpart;
    }
    $('.'+divHidden+'').addClass('displayNone');

});