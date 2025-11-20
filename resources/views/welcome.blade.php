<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ACEM — Agence de Communication Événementielle et Marketing | Baguineda</title>
  <meta name="description" content="ACEM, agence de communication événementielle et marketing à Baguineda. Organisation d'événements mémorables, stratégies de communication percutantes et marketing digital innovant.">
  <meta name="keywords" content="agence événementielle, communication marketing, Baguineda, Mali, organisation événements, stratégie digitale, branding">
  <link rel="canonical" href="https://acem-event.duckdns.org/">

  <!-- Open Graph / Social -->
  <meta property="og:title" content="ACEM — Agence de Communication Événementielle et Marketing">
  <meta property="og:description" content="Agence événementielle à Baguineda spécialisée en organisation d'événements, stratégies de communication et marketing digital.">
  <meta property="og:url" content="https://acem-event.duckdns.org/">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://acem-event.duckdns.org/assets/og-image.jpg">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ACEM — Agence de Communication Événementielle et Marketing">
  <meta name="twitter:description" content="Votre partenaire pour des événements mémorables et des stratégies de communication efficaces.">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico">

  <!-- Structured data (Organization) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "ACEM",
    "alternateName": "ACEM Event",
    "url": "https://acem-event.duckdns.org/",
    "logo": "https://acem-event.duckdns.org/assets/logo.png",
    "description": "Agence de communication événementielle et marketing à Baguineda spécialisée en organisation d'événements, stratégies de communication et marketing digital.",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Baguineda",
      "addressCountry": "ML"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+223-00-00-00-00",
      "contactType": "customer service",
      "email": "contact@acem-event.duckdns.org"
    },
    "sameAs": []
  }
  </script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      /* Palette de couleurs inspirée du logo ACEM */
      --primary: #1A56DB; /* Bleu professionnel */
      --primary-dark: #1E40AF; /* Bleu foncé */
      --primary-light: #3B82F6; /* Bleu clair */
      --secondary: #DC2626; /* Rouge accent */
      --accent: #059669; /* Vert succès */
      --accent-dark: #047857; /* Vert foncé */
      --dark: #111827; /* Noir charbon */
      --darker: #0F172A; /* Noir profond */
      --light: #F8FAFC; /* Blanc cassé */
      --lighter: #F1F5F9; /* Gris très clair */
      --gray: #64748B; /* Gris moyen */
      --gray-light: #CBD5E1; /* Gris clair */
      --white: #FFFFFF; /* Blanc pur */
      --gradient: linear-gradient(135deg, var(--primary), var(--primary-dark));
      --gradient-light: linear-gradient(135deg, var(--primary-light), var(--primary));
      --shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
      --shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.12);
      --shadow-large: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      scroll-behavior: smooth;
      scroll-padding-top: 100px;
    }

    body {
      font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;
      line-height: 1.6;
      color: var(--dark);
      background-color: var(--light);
      overflow-x: hidden;
    }

    /* Header */
    header {
      padding: 1.5rem 1.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      box-shadow: var(--shadow);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      transition: all 0.4s ease;
    }

    header.scrolled {
      padding: 1rem 1.5rem;
      background-color: rgba(255, 255, 255, 0.98);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo img {
      /* height: 50px; */
      /* width: auto; */
      border-radius: 8px;
      transition: transform 0.4s ease;
    }

    .logo:hover img {
      transform: scale(1.05);
    }

    .logo-text {
      display: flex;
      flex-direction: column;
    }

    .logo-text strong {
      font-size: 1.5rem;
      font-weight: 800;
      color: var(--primary-dark);
    }

    .logo-text .tagline {
      font-size: 0.75rem;
      color: var(--gray);
      font-weight: 500;
    }

    nav {
      display: flex;
      gap: 2rem;
    }

    nav a {
      text-decoration: none;
      color: var(--dark);
      font-weight: 600;
      position: relative;
      padding: 0.5rem 0;
      transition: color 0.3s ease;
    }

    nav a:hover {
      color: var(--primary);
    }

    nav a::after {
      content: '';
      position: absolute;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--gradient);
      bottom: 0;
      transform: scaleX(0);
      transform-origin: center;
      transition: transform 0.4s ease;
    }

    nav a:hover::after {
      transform: scaleX(1);
    }

    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--dark);
      z-index: 1001;
    }

    /* Hero Section */
    .hero {
      padding: 10rem 1.5rem 6rem;
      max-width: 1400px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr;
      gap: 4rem;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 800px;
      height: 800px;
      background: radial-gradient(circle, rgba(26, 86, 219, 0.1) 0%, rgba(26, 86, 219, 0) 70%);
      z-index: -1;
    }

    @media (min-width: 992px) {
      .hero {
        grid-template-columns: 1.2fr 1fr;
        padding: 12rem 1.5rem 8rem;
      }
    }

    .hero-content {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .kicker {
      display: inline-block;
      padding: 0.6rem 1.2rem;
      border-radius: 50px;
      background: rgba(26, 86, 219, 0.1);
      color: var(--primary);
      font-weight: 700;
      font-size: 0.875rem;
      letter-spacing: 0.5px;
      border: 1px solid rgba(26, 86, 219, 0.2);
      animation: fadeInUp 0.8s ease;
    }

    h1 {
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 800;
      line-height: 1.1;
      margin: 0;
      animation: fadeInUp 0.8s ease 0.2s both;
    }

    .highlight {
      color: var(--primary);
      position: relative;
    }

    .lead {
      font-size: 1.25rem;
      color: var(--gray);
      max-width: 600px;
      animation: fadeInUp 0.8s ease 0.4s both;
    }

    .cta {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      animation: fadeInUp 0.8s ease 0.6s both;
    }

    .btn {
      padding: 1rem 2rem;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.4s ease;
      cursor: pointer;
      border: none;
      font-size: 1rem;
      position: relative;
      overflow: hidden;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }

    .btn:hover::before {
      left: 100%;
    }

    .btn-primary {
      background: var(--gradient);
      color: var(--white);
      box-shadow: var(--shadow);
    }

    .btn-primary:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-hover);
    }

    .btn-secondary {
      background: var(--white);
      color: var(--primary);
      border: 2px solid var(--primary-light);
      box-shadow: var(--shadow);
    }

    .btn-secondary:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-hover);
      background: var(--primary);
      color: var(--white);
    }

    .features-list {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-top: 2rem;
      animation: fadeInUp 0.8s ease 0.8s both;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      color: var(--gray);
      padding: 0.5rem 0;
    }

    .feature-icon {
      width: 24px;
      height: 24px;
      background: var(--accent);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 0.75rem;
      flex-shrink: 0;
    }

    /* Hero Visual */
    .hero-visual {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: fadeInRight 1s ease 0.5s both;
    }

    .floating-card {
      width: 100%;
      max-width: 450px;
      background: var(--white);
      border-radius: 20px;
      padding: 2.5rem;
      box-shadow: var(--shadow-large);
      position: relative;
      overflow: hidden;
      animation: float 8s ease-in-out infinite;
    }

    .floating-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: var(--gradient);
    }

    .card-content {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .card-header {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .card-icon {
      width: 60px;
      height: 60px;
      border-radius: 16px;
      background: rgba(26, 86, 219, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      font-size: 1.75rem;
    }

    .card-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
    }

    .card-subtitle {
      color: var(--gray);
      font-size: 0.9rem;
    }

    .rotating-text {
      height: 70px;
      overflow: hidden;
      position: relative;
    }

    .rotating-text span {
      display: block;
      position: absolute;
      left: 0;
      right: 0;
      opacity: 0;
      transform: translateY(100%);
      animation: slide 9s linear infinite;
      font-weight: 600;
      font-size: 1.1rem;
    }

    .rotating-text span:nth-child(1) {
      animation-delay: 0s;
    }

    .rotating-text span:nth-child(2) {
      animation-delay: 3s;
    }

    .rotating-text span:nth-child(3) {
      animation-delay: 6s;
    }

    @keyframes slide {
      0% {
        opacity: 0;
        transform: translateY(100%);
      }
      10% {
        opacity: 1;
        transform: translateY(0);
      }
      30% {
        opacity: 1;
        transform: translateY(0);
      }
      40% {
        opacity: 0;
        transform: translateY(-100%);
      }
      100% {
        opacity: 0;
      }
    }

    @keyframes float {
      0% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-15px);
      }
      100% {
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Services Section */
    .section {
      padding: 6rem 1.5rem;
      scroll-margin-top: 100px;
    }

    .section-title {
      text-align: center;
      margin-bottom: 4rem;
    }

    .section-title h2 {
      font-size: 2.75rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
      color: var(--primary-dark);
    }

    .section-title p {
      color: var(--gray);
      max-width: 700px;
      margin: 0 auto;
      font-size: 1.2rem;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 2.5rem;
      max-width: 1300px;
      margin: 0 auto;
    }

    .service-card {
      background: var(--white);
      border-radius: 20px;
      padding: 2.5rem;
      box-shadow: var(--shadow);
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
      border: 1px solid rgba(26, 86, 219, 0.1);
    }

    .service-card:hover {
      transform: translateY(-15px);
      box-shadow: var(--shadow-large);
    }

    .service-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: var(--gradient);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.5s ease;
    }

    .service-card:hover::before {
      transform: scaleX(1);
    }

    .service-icon {
      width: 80px;
      height: 80px;
      border-radius: 20px;
      background: rgba(26, 86, 219, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 2rem;
      color: var(--primary);
      font-size: 2rem;
      transition: all 0.4s ease;
    }

    .service-card:hover .service-icon {
      transform: scale(1.1);
      background: var(--gradient);
      color: var(--white);
    }

    .service-card h3 {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
    }

    .service-card p {
      color: var(--gray);
      margin-bottom: 2rem;
      line-height: 1.7;
    }

    .service-features {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .service-features li {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      color: var(--gray);
      font-size: 0.95rem;
    }

    .service-features li::before {
      content: '✓';
      color: var(--accent);
      font-weight: bold;
      font-size: 1.1rem;
    }

    /* Stats Section */
    .stats {
      background: var(--darker);
      color: var(--white);
      padding: 5rem 1.5rem;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .stat-item {
      text-align: center;
      padding: 2rem;
    }

    .stat-number {
      font-size: 3rem;
      font-weight: 800;
      color: var(--primary-light);
      margin-bottom: 0.5rem;
    }

    .stat-label {
      color: var(--gray-light);
      font-size: 1.1rem;
    }

    /* About Section */
    .about {
      background: var(--white);
    }

    .about-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 4rem;
      max-width: 1300px;
      margin: 0 auto;
      align-items: center;
    }

    @media (min-width: 992px) {
      .about-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .about-content {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .about-content h2 {
      font-size: 2.75rem;
      font-weight: 800;
      line-height: 1.2;
      color: var(--primary-dark);
    }

    .about-content p {
      color: var(--gray);
      font-size: 1.1rem;
      line-height: 1.7;
    }

    .about-features {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      margin-top: 1rem;
    }

    .about-feature {
      display: flex;
      align-items: flex-start;
      gap: 1.5rem;
      padding: 1.5rem;
      border-radius: 16px;
      background: var(--lighter);
      transition: all 0.3s ease;
    }

    .about-feature:hover {
      transform: translateX(10px);
      background: rgba(26, 86, 219, 0.05);
    }

    .about-feature-icon {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      background: rgba(5, 150, 105, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent);
      font-size: 1.5rem;
      flex-shrink: 0;
    }

    .about-feature-text h4 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .about-feature-text p {
      font-size: 1rem;
      color: var(--gray);
    }

    .about-visual {
      position: relative;
    }

    .about-image {
      width: 100%;
      border-radius: 20px;
      box-shadow: var(--shadow-large);
      transition: transform 0.4s ease;
    }

    .about-image:hover {
      transform: scale(1.02);
    }

    .floating-badge {
      position: absolute;
      bottom: -20px;
      right: -20px;
      background: var(--gradient);
      color: white;
      padding: 1.5rem 2rem;
      border-radius: 16px;
      box-shadow: var(--shadow-large);
      animation: pulse 2s infinite;
    }

    .floating-badge strong {
      font-size: 1.5rem;
      display: block;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
      100% {
        transform: scale(1);
      }
    }

    /* Testimonials */
    .testimonials {
      background: var(--lighter);
    }

    .testimonials-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .testimonial-card {
      background: var(--white);
      border-radius: 20px;
      padding: 2.5rem;
      box-shadow: var(--shadow);
      position: relative;
    }

    .testimonial-card::before {
      content: """;
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 4rem;
      color: rgba(26, 86, 219, 0.1);
      font-family: Georgia, serif;
    }

    .testimonial-content {
      margin-bottom: 2rem;
      font-style: italic;
      color: var(--gray);
      line-height: 1.7;
    }

    .testimonial-author {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .author-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: var(--gradient);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
    }

    .author-info h4 {
      font-weight: 700;
      margin-bottom: 0.25rem;
    }

    .author-info p {
      color: var(--gray);
      font-size: 0.9rem;
    }

    /* Contact Section */
    .contact {
      background: var(--darker);
      color: var(--white);
    }

    .contact-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 4rem;
      max-width: 1300px;
      margin: 0 auto;
    }

    @media (min-width: 768px) {
      .contact-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .contact-info {
      display: flex;
      flex-direction: column;
      gap: 2.5rem;
    }

    .contact-info h2 {
      font-size: 2.75rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
    }

    .contact-info p {
      color: rgba(255, 255, 255, 0.8);
      font-size: 1.1rem;
      line-height: 1.7;
    }

    .contact-details {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .contact-item {
      display: flex;
      align-items: flex-start;
      gap: 1.5rem;
    }

    .contact-icon {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent);
      font-size: 1.2rem;
      flex-shrink: 0;
    }

    .contact-text h4 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .contact-text p, .contact-text a {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .contact-text a:hover {
      color: var(--accent);
    }

    .contact-form {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 20px;
      padding: 3rem;
      backdrop-filter: blur(10px);
    }

    .form-group {
      margin-bottom: 2rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.75rem;
      font-weight: 600;
    }

    .form-control {
      width: 100%;
      padding: 1rem 1.5rem;
      border-radius: 12px;
      border: 2px solid rgba(255, 255, 255, 0.1);
      background: rgba(255, 255, 255, 0.05);
      color: var(--white);
      font-family: inherit;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.2);
      background: rgba(255, 255, 255, 0.08);
    }

    textarea.form-control {
      min-height: 150px;
      resize: vertical;
    }

    /* Footer */
    footer {
      padding: 4rem 1.5rem 2rem;
      background: var(--darker);
      color: var(--white);
    }

    .footer-content {
      max-width: 1300px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr;
      gap: 3rem;
    }

    @media (min-width: 768px) {
      .footer-content {
        grid-template-columns: 2fr 1fr 1fr 1fr;
      }
    }

    .footer-logo {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .footer-logo .logo-text {
      align-items: flex-start;
    }

    .footer-logo p {
      color: rgba(255, 255, 255, 0.7);
      max-width: 350px;
      line-height: 1.7;
    }

    .footer-links h4 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
    }

    .footer-links ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .footer-links a {
      color: rgba(255, 255, 255, 0.7);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: var(--accent);
    }

    .footer-bottom {
      max-width: 1300px;
      margin: 0 auto;
      padding-top: 3rem;
      margin-top: 3rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      align-items: center;
      text-align: center;
    }

    @media (min-width: 768px) {
      .footer-bottom {
        flex-direction: row;
        justify-content: space-between;
      }
    }

    .footer-bottom p {
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.9rem;
    }

    .social-links {
      display: flex;
      gap: 1rem;
    }

    .social-link {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .social-link:hover {
      background: var(--gradient);
      transform: translateY(-3px);
    }

    /* Animations */
    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .mobile-menu-btn {
        display: block;
      }

      nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--white);
        flex-direction: column;
        padding: 6rem 2rem 2rem;
        transform: translateX(-100%);
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
        justify-content: flex-start;
        gap: 0;
      }

      nav.active {
        transform: translateX(0);
        opacity: 1;
        visibility: visible;
      }

      nav a {
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--gray-light);
        font-size: 1.2rem;
        width: 100%;
      }

      nav a:last-child {
        border-bottom: none;
      }

      .cta {
        justify-content: center;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }

      .hero {
        padding: 8rem 1.5rem 4rem;
      }

      .section {
        padding: 4rem 1.5rem;
      }

      .section-title h2 {
        font-size: 2.25rem;
      }

      .contact-form {
        padding: 2rem;
      }
    }
  </style>
</head>
<body>
  <header id="header">
    <div class="logo">
      <!-- Remplacer assets/logo.png par votre logo -->
      <a href="https://acem-event.duckdns.org/"><img src="{{ asset('assets/img/logo/logo.png') }}" alt="ACEM - Agence de Communication Événementielle et Marketing" width="100"></a>
      {{-- <div class="logo-text">
        <strong>ACEM</strong>
        <div class="tagline">Agence de Communication Événementielle et Marketing</div>
      </div> --}}
    </div>
    <nav id="nav">
      <a href="#services">Services</a>
      <a href="#about">À propos</a>
      <a href="#testimonials">Témoignages</a>
      <a href="#contact">Contact</a>
      <a href="{{route('login')}}">Connexion</a>
    </nav>
    <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Menu mobile">☰</button>
  </header>

  <main>
    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content">
        <div class="kicker">Agence Premium — Baguineda</div>
        <h1>Créons ensemble des <span class="highlight">expériences exceptionnelles</span></h1>
        <p class="lead">ACEM transforme vos idées en réalités mémorables. Notre équipe d'experts allie créativité, stratégie et innovation pour concevoir des événements uniques et des campagnes percutantes.</p>
        
        <div class="cta">
          <a class="btn btn-primary" href="#contact">Démarrer mon projet</a>
          <a class="btn btn-secondary" href="#services">Découvrir nos services</a>
        </div>

        <div class="features-list">
          <div class="feature-item">
            <div class="feature-icon">✓</div>
            <span>Organisation complète d'événements sur-mesure</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon">✓</div>
            <span>Stratégies de communication innovantes et résultats mesurables</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon">✓</div>
            <span>Expertise en marketing digital et formation professionnelle</span>
          </div>
        </div>
      </div>

      <div class="hero-visual">
        <div class="floating-card">
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">🎯</div>
              <div>
                <h3 class="card-title">Excellence & Innovation</h3>
                <p class="card-subtitle">Votre succès, notre priorité</p>
              </div>
            </div>
            
            <div class="rotating-text" role="status" aria-live="polite">
              <span>Événements corporatifs qui renforcent votre image de marque</span>
              <span>Stratégies digitales qui amplifient votre présence en ligne</span>
              <span>Solutions créatives qui engagent et convertissent votre audience</span>
            </div>
            
            <div class="cta">
              <a class="btn btn-primary" href="#contact">Obtenir une consultation gratuite</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
      <div class="stats-grid">
        <div class="stat-item fade-in">
          <div class="stat-number" data-count="150">0</div>
          <div class="stat-label">Événements réalisés</div>
        </div>
        <div class="stat-item fade-in">
          <div class="stat-number" data-count="98">0</div>
          <div class="stat-label">Clients satisfaits</div>
        </div>
        <div class="stat-item fade-in">
          <div class="stat-number" data-count="5">0</div>
          <div class="stat-label">Ans d'expérience</div>
        </div>
        <div class="stat-item fade-in">
          <div class="stat-number" data-count="12">0</div>
          <div class="stat-label">Prix remportés</div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section">
      <div class="section-title fade-in">
        <h2>Nos services premium</h2>
        <p>Découvrez notre gamme complète de services conçus pour répondre à tous vos besoins événementiels, de communication et marketing avec excellence.</p>
      </div>

      <div class="services-grid">
        <div class="service-card fade-in">
          <div class="service-icon">🎪</div>
          <h3>Événementiel Sur-Mesure</h3>
          <p>Nous concevons et organisons des événements mémorables qui marquent les esprits, de la planification stratégique à l'exécution impeccable.</p>
          <ul class="service-features">
            <li>Planification et logistique avancée</li>
            <li>Gestion technique et coordination fournisseurs</li>
            <li>Animation et expérience immersive</li>
            <li>Reporting post-événement détaillé</li>
            <li>Solutions éco-responsables</li>
          </ul>
        </div>

        <div class="service-card fade-in">
          <div class="service-icon">📢</div>
          <h3>Stratégie de Communication</h3>
          <p>Nous développons des stratégies de communication percutantes qui renforcent votre image et amplifient votre notoriété.</p>
          <ul class="service-features">
            <li>Identité visuelle et branding stratégique</li>
            <li>Création de contenus engageants et viral</li>
            <li>Relations presse et influenceurs</li>
            <li>Community management expert</li>
            <li>Analyse de performance et optimisation</li>
          </ul>
        </div>

        <div class="service-card fade-in">
          <div class="service-icon">📈</div>
          <h3>Marketing Digital Avancé</h3>
          <p>Nous concevons des campagnes marketing performantes qui génèrent des résultats concrets et mesurables.</p>
          <ul class="service-features">
            <li>Stratégies digitales personnalisées</li>
            <li>Campagnes publicitaires multi-canaux</li>
            <li>Optimisation SEO/SEA avancée</li>
            <li>Analytics et intelligence data</li>
            <li>Formation et accompagnement</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about">
      <div class="about-grid">
        <div class="about-content">
          <div class="kicker">Notre ADN</div>
          <h2>L'excellence au service de votre réussite</h2>
          <p>ACEM est née de la passion pour créer des expériences uniques et mémorables. Basés à Baguineda, nous combinons expertise technique, créativité et innovation pour transformer vos visions en réalités exceptionnelles.</p>
          
          <p>Notre mission est de devenir le partenaire de référence en alliant excellence opérationnelle, innovation constante et accompagnement personnalisé. Chaque projet est unique et bénéficie de notre engagement total pour garantir son succès.</p>

          <div class="about-features">
            <div class="about-feature">
              <div class="about-feature-icon">🚀</div>
              <div class="about-feature-text">
                <h4>Innovation Continue</h4>
                <p>Nous intégrons les dernières technologies et tendances pour des solutions toujours plus performantes et créatives.</p>
              </div>
            </div>
            <div class="about-feature">
              <div class="about-feature-icon">🤝</div>
              <div class="about-feature-text">
                <h4>Partenariat Durable</h4>
                <p>Nous établissons des relations de confiance basées sur la transparence, la fiabilité et l'excellence du service.</p>
              </div>
            </div>
            <div class="about-feature">
              <div class="about-feature-icon">🎓</div>
              <div class="about-feature-text">
                <h4>Expertise Certifiée</h4>
                <p>Notre équipe se forme continuellement pour maîtriser les meilleures pratiques et technologies du marché.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="about-visual">
          <img src="assets/agency-team.jpg" alt="Équipe ACEM - Experts en événementiel" class="about-image">
          <div class="floating-badge">
            <strong>+150 projets</strong>
            <p>livrés avec excellence</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="section testimonials">
      <div class="section-title fade-in">
        <h2>Ils nous font confiance</h2>
        <p>Découvrez les retours d'expérience de nos clients satisfaits qui ont transformé leurs projets en succès avec ACEM.</p>
      </div>

      <div class="testimonials-grid">
        <div class="testimonial-card fade-in">
          <div class="testimonial-content">
            "ACEM a transformé notre séminaire d'entreprise en une expérience mémorable. Leur professionnalisme et leur attention aux détails ont dépassé nos attentes. Un partenaire de confiance !"
          </div>
          <div class="testimonial-author">
            <div class="author-avatar">SD</div>
            <div class="author-info">
              <h4>Souleymane Diallo</h4>
              <p>Directeur Marketing, Entreprise XYZ</p>
            </div>
          </div>
        </div>

        <div class="testimonial-card fade-in">
          <div class="testimonial-content">
            "La stratégie de communication développée par ACEM a considérablement boosté notre visibilité. Leurs conseils avisés et leur créativité ont fait toute la différence pour notre marque."
          </div>
          <div class="testimonial-author">
            <div class="author-avatar">AK</div>
            <div class="author-info">
              <h4>Aminata Keita</h4>
              <p>Fondatrice, Belle Afrique</p>
            </div>
          </div>
        </div>

        <div class="testimonial-card fade-in">
          <div class="testimonial-content">
            "Excellente collaboration avec ACEM pour notre lancement de produit. Leur maîtrise de l'événementiel et du digital a créé un buzz remarquable. Résultats au-delà de nos objectifs !"
          </div>
          <div class="testimonial-author">
            <div class="author-avatar">MT</div>
            <div class="author-info">
              <h4>Moussa Traoré</h4>
              <p>CEO, InnovTech Solutions</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact">
      <div class="contact-grid">
        <div class="contact-info">
          <h2>Prêt à transformer votre projet ?</h2>
          <p>Notre équipe d'experts est à votre écoute pour discuter de vos ambitions et vous proposer des solutions sur-mesure. Contactez-nous pour une consultation gratuite et sans engagement.</p>
          
          <div class="contact-details">
            <div class="contact-item">
              <div class="contact-icon">📍</div>
              <div class="contact-text">
                <h4>Notre agence</h4>
                <p>Baguineda, Mali</p>
              </div>
            </div>
            <div class="contact-item">
              <div class="contact-icon">📧</div>
              <div class="contact-text">
                <h4>Email professionnel</h4>
                <p><a href="mailto:contact@acem-event.duckdns.org">contact@acem-event.duckdns.org</a></p>
              </div>
            </div>
            <div class="contact-item">
              <div class="contact-icon">📞</div>
              <div class="contact-text">
                <h4>Téléphone</h4>
                <p><a href="tel:+22300000000">+223 00 00 00 00</a></p>
              </div>
            </div>
            <div class="contact-item">
              <div class="contact-icon">🕒</div>
              <div class="contact-text">
                <h4>Horaires</h4>
                <p>Lun - Ven: 8h - 18h</p>
              </div>
            </div>
          </div>
        </div>

        <div class="contact-form">
          <form id="contact-form" action="https://formspree.io/f/your-form-id" method="POST">
            <div class="form-group">
              <label for="name">Votre nom complet *</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">Votre email professionnel *</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="company">Votre entreprise/organisation</label>
              <input type="text" id="company" name="company" class="form-control">
            </div>
            <div class="form-group">
              <label for="service">Service intéressé</label>
              <select id="service" name="service" class="form-control">
                <option value="">Sélectionnez un service</option>
                <option value="evenementiel">Événementiel</option>
                <option value="communication">Communication</option>
                <option value="marketing">Marketing Digital</option>
                <option value="formation">Formation</option>
                <option value="multiple">Plusieurs services</option>
              </select>
            </div>
            <div class="form-group">
              <label for="message">Décrivez votre projet *</label>
              <textarea id="message" name="message" class="form-control" required placeholder="Parlez-nous de votre vision, vos objectifs, votre budget et vos délais..."></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Envoyer ma demande</button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="footer-content">
      <div class="footer-logo">
        <div class="logo">
          <div class="logo-text">
            <strong>ACEM</strong>
            <div class="tagline">Agence de Communication Événementielle et Marketing</div>
          </div>
        </div>
        <p>Votre partenaire premium pour des expériences mémorables et des stratégies de communication qui transforment. Excellence, innovation et résultats garantis.</p>
        <div class="social-links">
          <a href="#" class="social-link" aria-label="Facebook">f</a>
          <a href="#" class="social-link" aria-label="LinkedIn">in</a>
          <a href="#" class="social-link" aria-label="Instagram">ig</a>
          <a href="#" class="social-link" aria-label="Twitter">tw</a>
        </div>
      </div>

      <div class="footer-links">
        <h4>Nos services</h4>
        <ul>
          <li><a href="#services">Événementiel</a></li>
          <li><a href="#services">Communication</a></li>
          <li><a href="#services">Marketing Digital</a></li>
          <li><a href="#services">Formation</a></li>
        </ul>
      </div>

      <div class="footer-links">
        <h4>Navigation</h4>
        <ul>
          <li><a href="#services">Services</a></li>
          <li><a href="#about">À propos</a></li>
          <li><a href="#testimonials">Témoignages</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>

      <div class="footer-links">
        <h4>Légal</h4>
        <ul>
          <li><a href="#">Mentions légales</a></li>
          <li><a href="#">Politique de confidentialité</a></li>
          <li><a href="#">Conditions d'utilisation</a></li>
          <li><a href="#">Cookies</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© <span id="year"></span> ACEM. Tous droits réservés.</p>
      <p>Site conçu avec ❤️ à Baguineda | <a href="https://acem-event.duckdns.org/" style="color: rgba(255,255,255,0.7);">acem-event.duckdns.org</a></p>
    </div>
  </footer>

  <script>
    // année dynamique
    document.getElementById('year').textContent = new Date().getFullYear();

    // Menu mobile
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const nav = document.getElementById('nav');
    
    mobileMenuBtn.addEventListener('click', () => {
      nav.classList.toggle('active');
      mobileMenuBtn.textContent = nav.classList.contains('active') ? '✕' : '☰';
    });

    // Header scroll effect
    const header = document.getElementById('header');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Animation au scroll
    const fadeElements = document.querySelectorAll('.fade-in');
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, {
      threshold: 0.1
    });

    fadeElements.forEach(el => {
      observer.observe(el);
    });

    // Animation des statistiques
    const statNumbers = document.querySelectorAll('.stat-number');
    
    const countUp = (element) => {
      const target = parseInt(element.getAttribute('data-count'));
      const duration = 2000;
      const step = target / (duration / 16);
      let current = 0;
      
      const timer = setInterval(() => {
        current += step;
        if (current >= target) {
          element.textContent = target;
          clearInterval(timer);
        } else {
          element.textContent = Math.floor(current);
        }
      }, 16);
    };
    
    const statsObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          countUp(entry.target);
          statsObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.5
    });
    
    statNumbers.forEach(el => {
      statsObserver.observe(el);
    });

    // Gestion du formulaire de contact
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
      contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Animation de succès
        const submitBtn = contactForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        submitBtn.textContent = 'Envoi en cours...';
        submitBtn.disabled = true;
        
        // Simulation d'envoi (remplacer par votre logique d'envoi réelle)
        setTimeout(() => {
          submitBtn.textContent = 'Message envoyé !';
          submitBtn.style.background = 'var(--accent)';
          
          setTimeout(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            submitBtn.style.background = '';
            contactForm.reset();
          }, 3000);
        }, 1500);
      });
    }

    // progressive enhancement: if assets/logo.png n'existe pas on remplace par un texte
    (function(){
      var img = document.querySelector('.logo img');
      img.onerror = function(){
        var parent = img.parentNode;
        var span = document.createElement('div');
        span.innerHTML = '<strong style="font-size:18px;color:#1A56DB">ACEM</strong><div style="font-size:12px;color:#6b7280">Agence de Communication Événementielle et Marketing</div>';
        parent.replaceChild(span,img);
      }
    })();
  </script>
</body>
</html>