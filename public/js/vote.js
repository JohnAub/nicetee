$(document).ready(function(){
    //on détecte le click sur le lien j'aime
   /* $('.new .like a').click(function(e){
        //on regarde à quelle new le lien appartient, et on récupère l'id de la new
        var id = $(this).parents('.new').attr('id');


        //on envoie la requête ajax au serveur (à toi de voir la structure de l'url
        $.post("index.php?ref=news&action=like&id="+id,{}, function(data){
            //le serveur renvoie la réponse qui contient le nombre de personne qui aime
            //donc on va l'afficher à la place du lien


            //on vide la div like, donc plus de lien j'aime
            $("#"id +".like").empty();
            //et on affiche la réponse à la place
            $("#"id +".like").append(data);
        });
        //désactive l'exécution du lien pour le navigateur
        return false;
    });*/
});