//JQUERY = Libraire = une boite à outils

$(document).ready(function() {
    console.log('1: jquery ready');

    
    $('button#btn').on('click', function() {
        $('#product-list td').css('font-weight', 600);
        $('input[type="submit"]').val('A');
        $(this).text('DONT');
    });


    $('.user-btn').on('click',function () {
        location.href = 'userView.php';
    });
    

    $('.delete-btn').on('click', function() {
        if (!confirm('Etes-vous sur de vouloir supprimer cet item ?')) {
            return;
        }

        let button = $(this);
        let pk = button.attr('data-id'); // $(this) = bouton delete courant -> on récupère la pk

        // on fait une requête HTTP de type POST vers index.php en donnant la PK
        $.post(
            'index.php',
            {pk: pk, type: 'delete'} // données de la requête
        ).done(function(valeurServeur) { // data contient "true" ou "false" d'index.php
            if (valeurServeur === 'true') {
                button.closest('tr').detach(); // supprime la ligne du tableau
            } else {
                alert('Impossible de supprimer l\'élément');
            }
        });
    });

    $('.reset-btn').on('click', function() {
        let button = $(this); // récupère le bouton reset
        let tr = button.closest('tr');

        // on cherche toutes les inputs dans le tr
        tr.find('input').each(function() {
            let input = $(this); // récupère l'input (l'élément html)
            let resetVal = input.attr('data-reset-val'); // on récupère la valeur de l'attribut data-reset-val
            input.val(resetVal); // on remet la valeur de reset dans l'input
        });
    });

    $('.edit-btn').on('click', function() {
        if (!confirm('Etes-vous sur de vouloir éditer cet article ?')) {
            return;
        }

        let button = $(this);
        let tr = button.closest('tr');
        let pk = button.attr('data-id'); // $(this) = bouton delete courant -> on récupère la pk

        let inputName = tr.find("input[name=name]"); //on récupère l'élément HTML à savoir l'input donc pas la valeur
        let inputQuantity = tr.find("input[name=quantity]");
        let inputPrice = tr.find("input[name=price]");
        let inputVat = tr.find("input[name=vat]");

        let name = inputName.val(); // on récupère la valeur du champs name = de l'input au dessus
        let quantity = inputQuantity.val();
        let price = inputPrice.val();
        let vat = inputVat.val();

        // on fait une requête HTTP de type POST vers index.php en donnant la PK et les données
        $.post(
            'index.php',
            {pk: pk, name: name, quantity: quantity, price: price, vat: vat,  type: 'edit'} // données de la requête
        ).done(function(valeurServeur) { // data contient "true" ou le message d'index.php qui est la réponse du serveur
            if (valeurServeur === 'true') {
                inputName.attr('data-reset-val', name);
                inputQuantity.attr('data-reset-val', quantity);
                inputPrice.attr('data-reset-val', price);
                inputVat.attr('data-reset-val', vat);

                alert('Élément édité avec succès');
            } else {
                alert(valeurServeur);
            }
        });
    });
    
    $('#search-form').on('submit', function(event) {
        
        event.preventDefault();
        $.get(
            'ajax.php',
            {pk: $('#pk-search').val()}
        )
        .done(function(data) {
           $('#ajax-rsp').html(data);  
        });
        
    });

    $('#user-search-form').on('submit', function(event) {

        event.preventDefault();
        $.get(
            'ajaxUser.php',
            {pk: $('#pk-search').val()}
        )
            .done(function(data) {
                $('#ajaxUser').html(data);
            });

    });



    $('.user-delete-btn').on('click', function() {
        if (!confirm('Etes-vous sur de vouloir supprimer cet utilisateur ?')) {
            return;
        }

        let button = $(this);
        let pk = button.attr('data-id'); // $(this) = bouton delete courant -> on récupère la pk

        // on fait une requête HTTP de type POST vers index.php en donnant la PK
        $.post(
            'userView.php',
            {pk: pk, type: 'delete'} // données de la requête
        ).done(function(valeurServeur) { // data contient "true" ou "false" d'index.php
            if (valeurServeur === 'true') {
                button.closest('tr').detach(); // supprime la ligne du tableau
            } else {
                alert('Impossible de supprimer l\'élément');
            }
        });
    });



    $('.user-edit-btn').on('click', function() {
        if (!confirm('Etes-vous sur de vouloir éditer cet utilisateur ?')) {
            return;
        }

        let button = $(this);
        let pk = button.attr('data-id'); // $(this) = bouton delete courant -> on récupère la pk
        let username = button.closest('tr').find("input[name=username]").val(); // on récupère la valeur du champs name
        let password = button.closest('tr').find("input[name=password]").val();


        // on fait une requête HTTP de type POST vers index.php en donnant la PK et les données
        $.post(
            'userView.php',
            {pk: pk, username: username, password: password, type: 'edit'} // données de la requête
        ).done(function(valeurServeur) { // data contient "true" ou le message d'userView.php qui est la réponse du serveur
            if (valeurServeur === 'true') {
                alert('Élément édité avec succès')
            } else {
                alert(valeurServeur);
            }
        });
    });

});



