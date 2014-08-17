$(function(){

/* Permet d'afficher le tableau d'options */
    $('a.opt-hide').on('click', function(){

        var publication = $(this).attr('rel');

        $('#options-box-'+publication).toggle(function(){

            //Fermeture de la pop-up et du fond
            $('body').on('click', function() { //Au clic sur le bouton ou sur le calque...
                $('.options-box').fadeOut();
            });
            return false;
        });
        return false;
    });

/* Permet de supprimer les publications */
    $('a.options-list').click(function(){

        var parent      = $(this).parent().parent().parent().parent().parent();
        var publication = $(this).attr('rel');

        $.ajax({
            type: "GET",
            url: Routing.generate('award_me_remove_publication', { 'id': publication }),
            cache: false,
            success: function(){
                parent.slideUp('slow');
            }
        });
        return false;
    });

//La fonction s'active sur l'évènement keydown dans la zone de texte
    $("textarea#awardme_awardmebundle_publication_content").keyup(function(limit) {

        //Définir la limite à atteindre
        var limit = "2";

        //Récupérer le nombre de caractères dans la zone de texte
        var currlength = $(this).val().length;

        //Afficher un texte de légende en fonction du nombre de caractères
        if(currlength >= limit){
            $("#legende_popup").removeClass("insuffisant").addClass("suffisant").html("Votre message peut être validé.");
            $('#popup_publication_ctt .submit-pub').attr('disabled', false).css({ backgroundColor: '#f2b540', 'opacity': '1' });

        }
        else{
            $("#legende_popup").removeClass("suffisant").addClass("insuffisant").html("Vous avez saisi " + currlength + " caractères sur " + limit + ", c'est encore trop peu.");
            $("#popup_publication_ctt .submit-pub").attr('disabled', true).css({ backgroundColor: '#f2b540', 'opacity': '0.20' });
        }

    });

// La fonction qui passe à l'ajout de photo

    $("#changeforpic").click(function(){
       $("#changeforpub-box").hide();
       $("#changeforpic-box").show();
       $("li#changeforpic").removeClass("unselected").addClass("selected");
       $("li#changeforpub").removeClass("selected").addClass("unselected");
       $("textarea.add-pic").focus();

    });

    $("#changeforpub").click(function(){
        $("#changeforpic-box").hide();
        $("#changeforpub-box").show();
        $("textarea#awardme_awardmebundle_publication_content").focus();
        $("li#changeforpub").removeClass("unselected").addClass("selected");
        $("li#changeforpic").removeClass("selected").addClass("unselected");

    });

});