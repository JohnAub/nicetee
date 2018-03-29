$(document).ready(function(){
    let tailleSex;
    let qty;
    let selected;
    $('.typeHomme').click(function () {
        $('.opacityFemme').addClass('opacity'),
        $('.opacityHomme').removeClass('opacity');
        $('.btnTailleHomme').addClass('displayBlock').removeClass('displayNone');
        $('.btnTailleFemme').addClass('displayNone').removeClass('displayBlock');
    });
    $('.typeFemme').click(function () {
        $('.opacityHomme').addClass('opacity')
        $('.opacityFemme').removeClass('opacity');
        $('.btnTailleFemme').addClass('displayBlock').removeClass('displayNone');
        $('.btnTailleHomme').addClass('displayNone').removeClass('displayBlock');
    });
    $(".tailleSex").click(function () {
        tailleSex = $(this).attr('id');
        $('.ts').removeClass('borderSelect')
        $(this).addClass('borderSelect');

    })
    $(".qty").click(function () {
        qty = $(this).attr('id');
        $('ts').removeClass('borderSelect')
        $(this).addClass('borderSelect');
    })

    $('.commander').click(function () {
        let chemin = window.location.pathname;
        $.ajax({
            type: "POST",
            url: chemin+"/panier",
            data: {
                taille_sex: tailleSex,
                qty: qty

            },
            success: function (resp)
            {
                alert("vous avez commandé de taille "+resp.taille+" pour un sex "+resp.sex+" pour une quantite de "+resp.qtys)
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: '+ errorThrown);
            }
        })
    });
});