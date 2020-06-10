<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation d'un créneau</title>
</head>
<body>
    <header></header>
    <main>
        <form action="reservation-form.php" method="POST">
            <p>
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" required>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Décrivez un peu votre évènement..."></textarea>
                <label for="debut">Date du début de l'évènement:</label>
                <input type="date" name="debut" id="debut" required>
                <label for="fin">Date de fin de l'évènement</label>
                <input type="date" name="fin" id="fin" required>
                <button type="submit" name="creer" class="bouton">Créer</button>
            </p>
        </form>
    </main>
    <footer></footer>
</body>
</html>