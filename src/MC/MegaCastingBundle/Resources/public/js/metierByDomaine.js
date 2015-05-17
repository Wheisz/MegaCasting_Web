
$("document").ready(function(){
   $(".domaine").change(function(){
        $.ajax({
            type: 'get',
            url: Routing.generate('mc_mega_casting_MetiersByDomaine', {id_domaine: $(this).val() }),
            beforeSend: function(){
                // On vide les options du select
                $(".metier option").remove();
            },
            success: function(data){
                // On parcours les objets contenus dans data
                $.each(data.metiers, function(index,value){
                    //On ajoute les différents objets ( les métiers ) dans la liste
                    $(".metier").append($('<option>',{ value : index + 1 , text: value }));
                });
            }
        });
   }); 
});