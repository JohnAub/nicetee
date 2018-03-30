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