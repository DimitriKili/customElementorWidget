
//Elementor gebruikt een javascript library wij extenden/uitbreiden op de library zodat de info van het bericht meteen wordt laten zien 
var postSelectControl = elementor.modules.controls.BaseData.extend({ 

    onReady: function() {
        //deze twee lijnen komen ook voor in post_select.php hier wordt het gebruikt
        this.control_select = this.$el.find('.post-select');
        this.save_input = this.$el.find('.post-select-save-value');
       //de url haalt alle posts op die we hebben aangemaakt in wordpress en stoppen we de titel in de control2 select.
        this.control_select.select2({
            ajax: {
                url: 'http://localhost/websites/dimitri-website-test/wp-admin/admin-ajax.php?action=get_posts',
                dataType: 'json',
        //it wants it to be in a oboject with the key of results
        //Elementor wilt de ID en titel van de post in een object hebben door processResults stoppen we de info van de berichten in results 
                processResults: function(data){
                    return {
                        results: data
                    }
                }
            }
        });
        //wanneer we iets in de control2 select bewerken wordt dit opgeslagen en automatsch laten zien
        this.control_select.on('change', () => {
            this.saveValue();
        } )

    },
    // geven van een waarde aan een variabele
    saveValue: function() {
        this.setValue(this.control_select.val());
    },
    //deze functie kijk of je uit de widget gaat zo ja slaat hij de gegevens op 
    //ik had hier eerst problemen mee dat ik de aanpassigen niet opsla en bijvoorbeeld naar het tab geavanseerd ga en de informatie verdwijnt
    //door deze functie zou dat opgelost zijn maar gebeurt het nog steeds.
    //als ik de functie uit zet komt dit probleem niet meer omhoog dus werkt de functie niet?
    //this.saveValue() komt voor in lijn 28

    onBeforeDestroy: function() {

       // this.saveValue();

    }

});

elementor.addControlView( 'wpc-post-select', postSelectControl );