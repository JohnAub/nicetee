$(document).ready(function(){
    let tailleSex;
    let qty;
    let button = 0;
    $('.commander').prop('disabled', true);

    $('.typeHomme').click(function () {
        $('.opacityFemme').addClass('opacity'),
        $('.opacityHomme').removeClass('opacity');
        $('.btnTailleHomme').addClass('displayBlock').removeClass('displayNone');
        $('.btnTailleFemme').addClass('displayNone').removeClass('displayBlock');
        $('.modal-footer').removeClass('displayNone');
    });
    $('.typeFemme').click(function () {
        $('.opacityHomme').addClass('opacity')
        $('.opacityFemme').removeClass('opacity');
        $('.btnTailleFemme').addClass('displayBlock').removeClass('displayNone');
        $('.btnTailleHomme').addClass('displayNone').removeClass('displayBlock');
        $('.modal-footer').removeClass('displayNone');

    });
    $(".tailleSex").click(function () {
        tailleSex = $(this).attr('id');
        $('.ts').removeClass('borderSelect')
        $(this).addClass('borderSelect');
        ++button;
        buttonEnable()
    })
    $(".qty").click(function () {
        qty = $(this).attr('id');
        $('ts').removeClass('borderSelect')
        $(this).addClass('borderSelect');
        ++button;
        buttonEnable()
    })

    $('.qty_produit', this).change(function () {
        let id = $(this).attr('id');
        let taille = $('.taille_produit_'+id).attr('id');
        let sex = $('.sex_produit_'+id).attr('id');
        let qty = $(this).val();
        let chemin = window.location.pathname;
        $.ajax({
            type:"POST",
            url: '/product/'+id+'/panier',
            data: {
                "ajouter" : 1,
                "taille" : taille,
                "sex" : sex,
                "qty" : qty,
            },
            success: function (resp) {
                location.reload();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: '+ errorThrown);
            }
        })
    })



    $('.commander').click(function () {
        let chemin = window.location.pathname;
        $.ajax({
            type: "POST",
            url: chemin+"/panier",
            data: {
                "ajouter" : 0,
                taille_sex: tailleSex,
                qty: qty
            },
            success: function (resp)
            {
                $('#modalAjout').addClass('displayNone');
                $('#modalAjoutOk').removeClass('displayNone');
                $('#retourName').text('"'+resp.productName+'"');
                $('#retourQty').text(resp.qtys);
                if(resp.sex == "H")
                {
                    $('#retourSex').text("Homme");
                }else
                {
                    $('#retourSex').text("Femme");
                }
                $('#retourTaille').text(resp.taille);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: '+ errorThrown);
            }
        })
    });


    function buttonEnable() {
        if(button >= 2){
            $('.commander').prop('disabled', false);
        }
    }
});