<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Réservation</title>
    <!-- Inclure Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        /* Footer styling */
        footer {
            color: #fff; /* Texte blanc */
            background-color: #343a40; /* Couleur sombre */
            padding: 50px 0;
        }

        .footer-merged {
            background-image: url('/images/footer.png'); /* Chemin vers votre image */
            background-size: cover;
            background-position: center;
            color: white; /* Texte blanc pour la visibilité */
            position: relative;
        }

        .footer-info h3, .footer-follow h3 {
            color: #ff8200; /* Couleur orange */
            margin-bottom: 15px;
        }

        .footer-info p {
            font-size: 14px;
            line-height: 1.6;
        }

        .footer-follow img {
            width: 30px;
            margin: 0 10px;
            transition: transform 0.3s ease;
        }

        .footer-follow img:hover {
            transform: scale(1.2); /* Agrandir légèrement au survol */
        }

        .footer-buttons a {
            display: inline-block;
            margin: 10px 10px 0 0;
            padding: 10px 20px;
            background-color: #ff8200;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .footer-buttons a:hover {
            background-color: #cc6a00; /* Couleur plus sombre au survol */
        }
    </style>
</head>
<body>

<!-- Footer -->
<footer class="footer-merged text-center py-5">
    <div class="container">
        <div class="row">
            <!-- A PROPOS Section -->
            <div class="col-md-6 footer-info">
                <h3>A PROPOS</h3>
                <p>HEZNI MAAK est dédiée à vous fournir un service de transport de qualité supérieure. Chaque déplacement est unique, et nous nous engageons à vous offrir une expérience sécurisée et agréable.</p>
            </div>

            <!-- FOLLOW US Section -->
            <div class="col-md-6 footer-follow">
                <h3>FOLLOW US</h3>
                
                    <a href="https://facebook.com" target="_blank" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com" target="_blank" class="text-light mx-2"><i class="fab fa-twitter"></i></a>
                
                <!-- Footer Buttons -->
                <div class="footer-buttons mt-3">
                    <a href="#">Réserver maintenant</a>
                    <a href="{{ route('register') }}">Devenir un chauffeur</a>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
