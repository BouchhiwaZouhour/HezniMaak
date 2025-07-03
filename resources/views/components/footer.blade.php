<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer - Taxi Réservation</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #3a86ff;
            --secondary-color: #8338ec;
            --accent-color: #ff006e;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
        }
        
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 60px 0 30px;
            position: relative;
            overflow: hidden;
        }
        
        .footer:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color));
        }
        
        .footer h3 {
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
        }
        
        .footer h3:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
        }
        
        .footer p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.8;
            margin-bottom: 20px;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
            display: block;
        }
        
        .footer-links a:hover {
            color: white;
            padding-left: 8px;
        }
        
        .footer-links i {
            color: var(--primary-color);
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background: var(--accent-color);
            transform: translateY(-5px);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 40px;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
        }
        
        .footer-btn {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            margin-top: 15px;
            display: inline-block;
        }
        
        .footer-btn:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }
        
        .footer-btn i {
            margin-right: 8px;
        }
        
        .newsletter-form {
            position: relative;
            margin-top: 20px;
        }
        
        .newsletter-form input {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            padding: 12px 15px;
            border-radius: 30px;
            width: 100%;
        }
        
        .newsletter-form button {
            position: absolute;
            right: 5px;
            top: 5px;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
        }
        
        @media (max-width: 767px) {
            .footer {
                text-align: center;
            }
            
            .footer h3:after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .footer-links a {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- About Column -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h3>A PROPOS</h3>
                    <p>HEZNI MAAK est dédiée à vous fournir un service de transport de qualité supérieure. Chaque déplacement est unique, et nous nous engageons à vous offrir une expérience sécurisée et agréable.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links Column -->
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h3>LIENS RAPIDES</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('welcome') }}"><i class="fas fa-chevron-right"></i> Accueil</a></li>
                        <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> À propos</a></li>
                        <li><a href="#services"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="#contact"><i class="fas fa-chevron-right"></i> Contact</a></li>
                        <li><a href="{{ route('register') }}"><i class="fas fa-chevron-right"></i> Devenir chauffeur</a></li>
                    </ul>
                </div>
                
                <!-- Contact Column -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h3>CONTACT</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt"></i> Route de Djerba, Zarzis</li>
                        <li><i class="fas fa-phone-alt"></i> 51025256</li>
                        <li><i class="fas fa-envelope"></i> Heznimaak@gmail.com</li>
                    </ul>
                </div>
                
                <!-- Newsletter Column -->
                <div class="col-lg-3 col-md-6">
                    <h3>NEWSLETTER</h3>
                    <p>Abonnez-vous pour recevoir nos dernières offres et actualités.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Votre email">
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                    <a href="#reservation" class="footer-btn"><i class="fas fa-taxi"></i> Réserver maintenant</a>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-12">
                        <p>&copy; 2023 Taxi Réservation. Tous droits réservés.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>