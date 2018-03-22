$(document).ready(function(){
    $('.boutonVote').click(function () {
        let id_dessin = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "vote/addVote",
            data: {id_dessin: id_dessin},
            success: function (resp)
            {
                if(resp.noCo == "noCo")
                {
                    alert("vous devez vous conecter pour voter")
                }else
                {
                    $("#pouce"+id_dessin).text(resp.nbr);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: '+ errorThrown);
            }
        })
    });

    function addVote(id_article) {
        $.post('/vote', {id_article:id_article}, function (data)
        {
            alert(data);
        })
    }

});