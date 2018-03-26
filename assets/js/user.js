$(document).ready(function(){
    $('.dessin-danger').click(function () {
        let id_dessin = $(this).attr('id');
        let nom_dessin = $('.nom_dessin_'+id_dessin).attr('id');
        let chemin = window.location.pathname;
        chemin = chemin.substring(6);
        result = confirm("Attention!! es-tu sur de bien vouloir suprimer le dessin "+nom_dessin+' ???');
        if(result){
            $.ajax({
                type: "POST",
                url: chemin+"/removeDessin",
                data: {id_dessin: id_dessin},
                success: function (resp)
                {
                        alert(resp.resp)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error: '+ errorThrown);
                }
            })
        }

    });

    $(".flash-notice").delay(4000).hide(500);


});