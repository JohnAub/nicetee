$(document).ready(function(){
    $('.boutonVote').click(function () {
        let id_dessin = $(this).attr('title');
        $.ajax({
            type: "POST",
            url: "vote/addVote",
            data: {id_dessin: id_dessin},
            success: function (data)
            {
                console.log(data.nbr);
                console.log(data.dejaVote);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: '+ errorThrown);
            }
        })
/*        $.post('showVotes',{id_article:id_article}, function (data) {
            if(data == "ok")
            {
                addVote(id_article);
            }

        })*/
    });

    function addVote(id_article) {
        $.post('/vote', {id_article:id_article}, function (data)
        {
            alert(data);
        })
    }

});