document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function() {
        // On récupère les infos stockées dans le HTML
        const userId = this.getAttribute('data-id');
        const userName = this.getAttribute('data-name');

        Swal.fire({
            title: 'Supprimer ce collaborateur ?',
            text: `Voulez-vous vraiment supprimer ${userName} ? Cette action est définitive.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33', // Rouge pour la suppression
            cancelButtonColor: '#3085d6', // Bleu pour l'annulation
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Si confirmé, on redirige vers ton fichier PHP de suppression
                window.location.href = `../actions/suppresionUtilisateur.php?id=${userId}`;
            }
        });
    });
});
