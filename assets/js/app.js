/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

class BasketSession
{
    constructor()
    {
        // Contenu du panier.
        this.items = null;

        this.load();
    }

    add(mealId, name, quantity, salePrice)
    {
        const alert = $("#alert");

        if(!isInteger(quantity)) {
            alert.text(" La quantité doit être un nombre entier");
            return;
        }
        if(quantity <= 0) {
            alert.text(" La quantité minimale est de 1 unité");
            return;
        }

        //effacer le message d'erreur s'il y en a
        alert.empty();
        // Conversion explicite des valeurs spécifiées en nombres.
        mealId    = parseInt(mealId);
        quantity  = parseInt(quantity);
        salePrice = parseFloat(salePrice);

        // Recherche de l'aliment spécifié.
        for(let index = 0; index < this.items.length; index++)
        {
            if(this.items[index].mealId == mealId)
            {
                // L'aliment spécifié a été trouvé, mise à jour de la quantité commandée.
                this.items[index].quantity += quantity;

                this.save();

                return;
            }
        }

        // L'aliment spécifié n'a pas été trouvé, ajout au panier.
        this.items.push(
            {
                mealId    : mealId,
                name      : name,
                quantity  : quantity,
                salePrice : salePrice
            });

        this.save();
    }

    clear()
    {
        // Destruction du panier dans le DOM storage.
        saveDataToDomStorage('panier', null);
    }

    isEmpty()
    {
        return this.items.length == 0;
    }

    load()
    {
        // Chargement du panier depuis le DOM storage.
        this.items = loadDataFromDomStorage('panier');

        if(this.items == null)
        {
            this.items = new Array();
        }
    }

    remove(mealId)
    {
        // Recherche de l'aliment spécifié.
        for(let index = 0; index < this.items.length; index++)
        {
            if(this.items[index].mealId == mealId)
            {
                // L'aliment spécifié a été trouvé, suppression.
                this.items.splice(index, 1);

                this.save();

                return true;
            }
        }

        return false;
    }

    save()
    {
        // Enregistrement du panier dans le DOM storage.
        saveDataToDomStorage('panier', this.items);
    }
}




/////////////////////////////////////////////////////////////////////////////////////////
// Class validateur de form apartir de fction de main.js                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////


class FormValidator
{

    //constructor <= les variables golbal de main.js
    constructor()
    {
        this.form  = $('form[data-validation]');
        this.errorMessage = this.form.find('.error-message');
        this.totalErrorCount = this.form.find('#total-error-count');
        this.totalErrors = null;
    }

    checkDataTypes ()
    {
        let error = [];
        this.form.find('[data-type]').each( function()

            {
                let value = $(this).val().trim();
                if( $(this).data('type') == 'number' )
                {
                    if (isNumber(value) == false )
                    {
                        error.push(
                            {
                                fieldName : $(this).data('name'),
                                message : 'doit etre un entier'
                            }

                        );
                    }

                } else {


                    if( isInteger(value) == false || value < 0 )
                    {
                        error.push(
                            {
                                fieldName : $(this).data('name'),
                                message : 'doit etre un nombre positif'
                            }
                        );
                    }
                }


            }
        );
        $.merge(this.totalErrors, error);

    }

    checkMinimumLength ()
    {
        let error = [];
        this.form.find('[data-length]').each( function()
            {
                let value = $(this).val().trim();
                if (value.length < $(this).data('length') )
                {
                    error.push(
                        {
                            fieldName : $(this).data('name'),
                            message : ` doit contenir au moins ${$(this).data('length')} caractères`
                        }
                    );
                }
            }



        );

        $.merge(this.totalErrors, error);
    }

    checkRequiredFields()
    {
        let error = [];
        this.form.find('[data-required]').each(function()
        {
            let value = $(this).val().trim();

            if(value.length == 0)
            {
                error.push(
                    {
                        fieldName : $(this).data('name'),
                        message   : 'est requis'

                    });
            }
        });


        $.merge(this.totalErrors, error);

    }


    onSubmitForm(event)
    {
        let errorList = this.errorMessage.children('p');
        errorList.empty();

        this.totalErrors = [];
        this.checkRequiredFields();
        this.checkDataTypes();
        this.checkMinimumLength();


        if(this.totalErrors.length > 0)
        {
            event.preventDefault();

            // Boucle d'affichage de toutes les erreurs trouvées.
            this.totalErrors.forEach(function(error)
            {
                // Construction du message d'erreur final.
                let message =
                    'Le champ <em><strong>' + error.fieldName +
                    '</strong></em> ' + error.message + '.<br>';

                // Ajout du message d'erreur final à la fin de la balise HTML <p>.
                errorList.append(message);
            });

            // Mise à jour du compteur du nombre total d'erreurs trouvées.
            this.totalErrorCount.text(this.totalErrors.length);

            // Affichage de la boite de messages.
            this.errorMessage.fadeIn('slow');
        }

    }
    run()
    {
        // Installation d'un gestionnaire d'évènement sur la soumission du formulaire.

        //ajouter bind(this) pour la method onSubmitForm pou referencé au this de l'input (l'element qui declenche l'evenement) et non de class
        this.form.on('submit', this.onSubmitForm.bind(this));

        // Est-ce qu'il y a déjà des messages d'erreurs dans la boite de messages ?
        if(this.errorMessage.children('p').text().length > 0)
        {
            // Oui, affichage de la boite de messages.
            this.errorMessage.fadeIn('slow');
        }
    }






}