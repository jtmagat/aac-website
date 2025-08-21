<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AAC Empower – Home</title>
<style>
  /* Global Styles */
  body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #fff; 
    color: #111; 
    line-height: 1.6;
    transition: background-color 0.3s, color 0.3s;
  }
  a { text-decoration: none; color: inherit; }

  /* Navbar */
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #111; 
    padding: 1rem 2rem;
    color: white;
    position: sticky;
    top: 0;
    z-index: 1000;
    transition: background-color 0.3s;
  }
  .nav-links { list-style: none; display: flex; gap: 2rem; }
  .nav-links a { color: white; font-weight: 600; position: relative; transition: color 0.3s; }
  .nav-links a::after {
    content: '';
    position: absolute;
    width: 0%;
    height: 2px;
    bottom: -4px;
    left: 0;
    background-color: white;
    transition: width 0.3s;
  }
  .nav-links a:hover { color: #999; }
  .nav-links a:hover::after { width: 100%; }
  .logo { font-weight: bold; font-size: 1.5rem; color: white; transition: color 0.3s; }
  .logo:hover { color: #999; }

  /* Logo Animation */
.logo img {
  height: 50px;
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}


  /* Hero Section */
  .hero {
    padding: 6rem 2rem;
    text-align: center;
    background: linear-gradient(135deg, #fff 0%, #eee 100%);
    color: #111;
    transition: background 0.5s;
  }
  .hero h1 { font-size: 3rem; margin-bottom: 1rem; animation: fadeInDown 1s ease forwards; opacity: 0; }
  .hero p { font-size: 1.3rem; margin-bottom: 2rem; animation: fadeInUp 1s ease forwards; opacity: 0; animation-delay: 0.5s; }
  .hero .btn {
    padding: 1rem 2rem;
    background: #111;
    color: white;
    border: none;
    border-radius: 30px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  .hero .btn:hover { background: #333; transform: scale(1.05); }

  /* Solutions Section */
  .solutions-section { padding: 4rem 2rem; text-align: center; background-color: #f9f9f9; }
  .solutions-section h2 { font-size: 2.5rem; margin-bottom: 3rem; color: #111; position: relative; display: inline-block; }
  .solutions-section h2::after {
    content: '';
    width: 50px;
    height: 3px;
    background: #111;
    display: block;
    margin: 8px auto 0;
    border-radius: 2px;
    animation: slideIn 1s ease forwards;
    opacity: 0;
  }
  .card-container { display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap; }
  .card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    padding: 2rem;
    width: 320px;
    text-align: center;
    transition: transform 0.5s ease, box-shadow 0.5s ease;
  }
  .card:hover { transform: translateY(-15px) scale(1.05); box-shadow: 0 15px 35px rgba(0,0,0,0.2); }
  .card h3 { margin-top: 0; color: #111; font-size: 1.5rem; }
  .card p { font-size: 1rem; margin: 1.2rem 0; color: #333; }
  .btn-link {
    display: inline-block;
    margin-top: 1rem;
    padding: 0.8rem 1.8rem;
    background-color: #111;
    color: white;
    border-radius: 30px;
    font-weight: bold;
    transition: all 0.3s ease;
  }
  .btn-link:hover { background-color: #333; transform: scale(1.05); }

  /* FAQ Accordion */
  .faq-container { max-width: 800px; margin: 2rem auto; text-align: left; }
  .faq-item { margin-bottom: 1rem; border-bottom: 1px solid #ccc; }
  .faq-question {
    width: 100%;
    background: #111;
    color: #fff;
    padding: 1rem;
    border: none;
    cursor: pointer;
    text-align: left;
    font-weight: bold;
    border-radius: 5px;
    transition: background 0.3s;
  }
  .faq-question:hover { background: #333; }
  .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.5s ease; padding-left: 1rem; }
  .faq-answer p { margin: 0.5rem 0; }

  /* Back-to-Top Button */
  #backToTop {
    display: none;
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 100;
    font-size: 1.5rem;
    border: none;
    background: #111;
    color: white;
    padding: 0.7rem 1rem;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
  }
  #backToTop:hover { background: #333; transform: scale(1.1); }

  /* Footer */
  footer {
    background: #111;
    color: white;
    text-align: center;
    padding: 1.5rem;
    margin-top: 3rem;
    font-size: 0.9rem;
    transition: background-color 0.3s;
  }
  footer:hover { background-color: #333; }

  /* Animations */
  @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-30px); } 100% { opacity: 1; transform: translateY(0); } }
  @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(30px); } 100% { opacity: 1; transform: translateY(0); } }
  @keyframes slideIn { 0% { opacity: 0; transform: translateX(-50px); } 100% { opacity: 1; transform: translateX(0); } }
</style>
</head>
<body>

<!-- Navbar -->
<header>
  <nav class="navbar">
    <div class="logo">
      <img src="assets/commbridge.png" alt="CommBridge Logo">
    </div>
    <ul class="nav-links">
      <li><a href="#solutions">Solutions</a></li>
      <li><a href="aac.php">AAC App</a></li>
      <li><a href="sld.php">Sign Dictionary</a></li>
      <li><a href="cbg.php">Board Generator</a></li>
      <li><a href="#faq">FAQ</a></li>
    </ul>
  </nav>
</header>

  <!-- Hero -->
  <section class="hero">
    <h1>Breaking Communication Barriers</h1>
    <p>Helping individuals with disabilities express themselves through innovative digital tools.</p>
    <a href="#solutions" class="btn">Explore Solutions</a>
  </section>

  <!-- Solutions -->
  <section id="solutions" class="solutions-section">
    <h2>Our Solutions</h2>
    <div class="card-container">
      <div class="card">
        <h3>AAC App</h3>
        <p>Assistive tool using images and voice output to help non-verbal users communicate.</p>
        <a href="aac.php" class="btn-link">Open App</a>
      </div>
      <div class="card">
        <h3>Sign Language Dictionary</h3>
        <p>A searchable, visual-based tool for learning and referencing sign language easily.</p>
        <a href="sld.php" class="btn-link">View Dictionary</a>
      </div>
      <div class="card">
        <h3>Communication Board Generator</h3>
        <p>Create printable or digital boards for structured, personalized communication.</p>
        <a href="cbg.php" class="btn-link">Generate Board</a>
      </div>
    </div>
  </section>

<!-- FAQ Section -->
<section id="faq" class="solutions-section">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-container">
    <div class="faq-item">
      <button class="faq-question">What is CommBridge?</button>
      <div class="faq-answer">
        <p>CommBridge is a platform that provides digital tools to help individuals overcome communication barriers and express themselves effectively.</p>
      </div>
    </div>
    <div class="faq-item">
      <button class="faq-question">How does the AAC App help?</button>
      <div class="faq-answer">
        <p>The AAC App assists non-verbal users by allowing them to communicate using images, symbols, and voice output tailored to their needs.</p>
      </div>
    </div>
    <div class="faq-item">
      <button class="faq-question">What is the Sign Language Dictionary?</button>
      <div class="faq-answer">
        <p>The Sign Language Dictionary is a visual tool where users can learn, reference, and practice signs with clear illustrations and videos.</p>
      </div>
    </div>
    <div class="faq-item">
      <button class="faq-question">How does the Board Generator work?</button>
      <div class="faq-answer">
        <p>The Board Generator helps create customized communication boards, either printable or digital, making it easier for users to convey their thoughts.</p>
      </div>
    </div>
  </div>
</section>


  <!-- Back-to-Top Button -->
  <button id="backToTop" title="Go to top">↑</button>


  <!-- Footer -->
  <footer>
    <p>&copy; 2025 CommBridge. All rights reserved.</p>
    <div class="credits">
      Website created by Clarenz Dimazana, Jamel Magat, Beatriz Solis, and Jalen Vidallo
    </div>
  </footer> 

<script>
  // FAQ Accordion
  const faqButtons = document.querySelectorAll('.faq-question');
  faqButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const answer = btn.nextElementSibling;
      answer.style.maxHeight = answer.style.maxHeight ? null : answer.scrollHeight + "px";
    });
  });

  // Back-to-Top Button
  const backToTop = document.getElementById("backToTop");
  window.onscroll = () => {
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
      backToTop.style.display = "block";
    } else {
      backToTop.style.display = "none";
    }
  };
  backToTop.onclick = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };
</script>

</body>
</html>
