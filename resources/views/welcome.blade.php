<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jouan-Stock - Solution Complète de Gestion de Stock et Ventes pour PME</title>
  <meta name="description" content="Découvrez Jouan-Stock, une solution intuitive et sécurisée pour gérer vos stocks, ventes et inventaires. Simple, efficace et adaptée aux PME africaines. Achetez votre licence dès aujourd’hui et boostez votre productivité !">
  <meta name="keywords" content="Jouan-Stock, gestion de stock, ventes, inventaire, logiciel PME, ERP Afrique, boutique, supermarché, solution de gestion, application commerciale, licence logicielle, digitalisation">
  <meta name="author" content="Jouan-Stock">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {--primary: #2c5aa0;--secondary: #ffb703;--dark: #212529;--light: #f8f9fa;}
    body {font-family: 'Roboto', sans-serif; line-height: 1.6; color: #333; background: #fff;}
    h1, h2, h3, h4 {font-family: 'Poppins', sans-serif; font-weight: 700;}
    .navbar {background: var(--primary); padding: 15px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1);} 
    .navbar-brand img {height: 50px; margin-right: 10px;}
    .hero {background: linear-gradient(135deg, var(--primary), #1a3a6e); color: white; text-align: center; padding: 160px 0;}
    .hero h1 {font-size: 3.2rem; font-weight: 700;}
    .hero p {font-size: 1.2rem; max-width: 700px; margin: 15px auto;}
    .btn-custom {background-color: var(--secondary); color: #fff; border-radius: 50px; padding: 12px 35px; font-weight: 600; transition: 0.3s;}
    .btn-custom:hover {background-color: #e0a800; transform: translateY(-3px);}
    .section {padding: 90px 0;}
    .section-title {text-align: center; font-size: 2.2rem; margin-bottom: 60px; position: relative;}
    .section-title:after {content: ''; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background: var(--secondary);}
    .step {text-align: center; padding: 30px; transition: 0.3s; background: #fff; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);}
    .step:hover {transform: translateY(-10px);}
    .step-icon {font-size: 3rem; color: var(--primary); margin-bottom: 20px;}
    .feature-card {background: #fff; border-radius: 15px; padding: 40px 30px; box-shadow: 0 8px 25px rgba(0,0,0,0.05); text-align: center; transition: 0.3s;}
    .feature-card:hover {transform: translateY(-10px);}
    .feature-icon {font-size: 2.8rem; color: var(--primary); margin-bottom: 15px;}
    .pricing-card {border-radius: 15px; border: 2px solid var(--secondary); padding: 40px; text-align: center; box-shadow: 0 5px 25px rgba(0,0,0,0.05);}
    footer {background: var(--dark); color: white; padding: 60px 0 30px;}
    .footer-links a {color: #adb5bd; text-decoration: none; display: block; margin-bottom: 10px;}
    .footer-links a:hover {color: var(--secondary);}
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <img src="{{ asset('assets/img/logo/Copilot_20250913_130221.png') }}" alt="Logo Jouan-Stock" width="80">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#about">À propos</a></li>
          <li class="nav-item"><a class="nav-link" href="#steps">Comment ça marche</a></li>
          <li class="nav-item"><a class="nav-link" href="#features">Fonctionnalités</a></li>
          <li class="nav-item"><a class="nav-link" href="#pricing">Tarifs</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        </ul>
      </div>
      @if (Route::has('login'))
                  @auth
                      <a href="{{ url('/dashboard') }}" class="btn btn-outline-warning me-2">Tableau de bord</a>
                  @else
                      <a href="{{ route('login') }}" class="btn btn-outline-warning me-2">Connexion</a>
                      @if (Route::has('register'))
                          <a href="{{ route('register') }}" class="btn btn-warning">S'inscrire</a>
                      @endif
                  @endauth
              @endif
    </div>

  </nav>

  <section class="hero">
    <div class="container">
      <h1>Optimisez la gestion de votre entreprise avec Jouan-Stock</h1>
      <p>Une application intelligente qui centralise la gestion de vos stocks, ventes et rapports. Gagnez du temps et augmentez vos profits.</p>
      <a href="#pricing" class="btn btn-custom">Acheter la licence</a>
    </div>
  </section>

  <section id="about" class="section">
    <div class="container">
      <h2 class="section-title">Pourquoi Choisir Jouan-Stock ?</h2>
      <p class="text-center mx-auto" style="max-width:800px;">Jouan-Stock offre aux PME africaines une solution de gestion moderne, performante et adaptée. Grâce à ses fonctionnalités puissantes, son interface fluide et sa sécurité avancée, elle simplifie la gestion de vos activités commerciales.</p>
    </div>
  </section>

  <section id="steps" class="section bg-light">
    <div class="container">
      <h2 class="section-title">Comment Commencer avec Jouan-Stock ?</h2>
      <div class="row g-4">
        <div class="col-md-3"><div class="step"><div class="step-icon"><i class="fas fa-user-plus"></i></div><h5>1. Créez votre compte</h5><p>Inscrivez-vous sur notre plateforme et créez votre espace entreprise.</p></div></div>
        <div class="col-md-3"><div class="step"><div class="step-icon"><i class="fas fa-credit-card"></i></div><h5>2. Achetez votre licence</h5><p>Souscrivez à la licence complète pour débloquer toutes les fonctionnalités professionnelles.</p></div></div>
        <div class="col-md-3"><div class="step"><div class="step-icon"><i class="fas fa-database"></i></div><h5>3. Configurez vos informations</h5><p>Ajoutez vos produits, utilisateurs, fournisseurs et paramètres de stock personnalisés.</p></div></div>
        <div class="col-md-3"><div class="step"><div class="step-icon"><i class="fas fa-chart-line"></i></div><h5>4. Commencez à vendre</h5><p>Suivez vos ventes, gérez vos stocks et consultez vos statistiques en temps réel.</p></div></div>
      </div>
    </div>
  </section>

  <section id="features" class="section">
    <div class="container">
      <h2 class="section-title">Fonctionnalités Clés</h2>
      <div class="row g-4">
        <div class="col-md-4"><div class="feature-card"><div class="feature-icon"><i class="fas fa-box"></i></div><h5>Gestion de Stock</h5><p>Suivi automatique des entrées et sorties de produits avec alertes de seuil critique.</p></div></div>
        <div class="col-md-4"><div class="feature-card"><div class="feature-icon"><i class="fas fa-cash-register"></i></div><h5>Gestion des Ventes</h5><p>Suivi des ventes quotidiennes et génération de rapports détaillés.</p></div></div>
        <div class="col-md-4"><div class="feature-card"><div class="feature-icon"><i class="fas fa-user-shield"></i></div><h5>Sécurité et Licence</h5><p>Licence sécurisée et gestion des accès pour protéger vos données commerciales.</p></div></div>
      </div>
    </div>
  </section>

  <section id="pricing" class="section bg-light">
    <div class="container text-center">
      <h2 class="section-title">Achetez votre Licence</h2>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="pricing-card">
            <h3>Licence Complète</h3>
            <p>Accédez à toutes les fonctionnalités sans abonnement mensuel.</p>
            <div class="display-4 text-primary fw-bold">500 000 FCFA</div>
            <ul class="list-unstyled mt-3 mb-4">
              <li>✔ Accès illimité</li>
              <li>✔ Mises à jour gratuites 12 mois</li>
              <li>✔ Assistance technique 7j/7</li>
              <li>✔ Activation immédiate</li>
            </ul>
            <a href="#contact" class="btn btn-custom w-100">Acheter Maintenant</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact" class="section">
    <div class="container">
      <h2 class="section-title">Contactez-Nous</h2>
      <form class="mx-auto" style="max-width:600px;">
        <div class="mb-3"><input type="text" class="form-control" placeholder="Nom complet" required></div>
        <div class="mb-3"><input type="email" class="form-control" placeholder="Adresse email" required></div>
        <div class="mb-3"><textarea class="form-control" rows="4" placeholder="Votre message" required></textarea></div>
        <button type="submit" class="btn btn-custom w-100">Envoyer</button>
      </form>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-6"><h5>Jouan-Stock</h5><p>Solution complète de gestion de stock et ventes conçue pour les PME africaines. Simplifiez vos opérations et boostez vos profits.</p></div>
        <div class="col-md-3"><h5>Liens</h5><div class="footer-links"><a href="#home">Accueil</a><a href="#steps">Comment ça marche</a><a href="#features">Fonctionnalités</a><a href="#pricing">Tarifs</a></div></div>
        <div class="col-md-3"><h5>Contact</h5><p>Email : contact@jouan-stock.com<br>Tél : +223 77 00 00 00<br>Bamako, Mali</p></div>
      </div>
      <hr style="border-color:rgba(255,255,255,0.1);">
      <p class="text-center">&copy; 2025 Jouan-Stock. Tous droits réservés.</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
