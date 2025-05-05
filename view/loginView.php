<head>  
    <link rel="stylesheet" href="/style/login.css">
    <!-- Ajout de Ionicons pour les icônes -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
<form action="login/log" method="POST" id="loginForm">
<div class="screen-1">
  <img class="logo" src="/img/Charbonneaux.png" alt="Logo Charbonneaux"/>

  <div class="email">
    <label for="email">Email Address</label>
    <div class="sec-2">
      <ion-icon name="mail-outline"></ion-icon>
      <input type="email" id="email" name="email" placeholder="Username@gmail.com" required/>
    </div>
  </div>

  <div class="password">
    <label for="password">Password</label>
    <div class="sec-2">
      <ion-icon name="lock-closed-outline"></ion-icon>
      <input class="pas" type="password" id="password" name="password" placeholder="············" required/>
      <ion-icon class="show-hide" name="eye-outline"></ion-icon>
    </div>
  </div>

  <div id="error" style="color:red; text-align:center; display:none; margin:10px 0;"></div>

  <button type="submit" class="login">Login</button>
</div>
</form>

<!-- SCRIPT -->
<script>
// Gestion du formulaire
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const errorDiv = document.getElementById('error');

    if (!email || !password) {
        e.preventDefault();
        errorDiv.innerText = "Veuillez remplir les deux champs.";
        errorDiv.style.display = "block";
        return;
    }
    errorDiv.style.display = "none";
});

// Afficher / cacher le mot de passe
const showHideIcon = document.querySelector('.show-hide');
const passwordInput = document.getElementById('password');

showHideIcon.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        showHideIcon.setAttribute('name', 'eye-off-outline');
    } else {
        passwordInput.type = 'password';
        showHideIcon.setAttribute('name', 'eye-outline');
    }
});
</script>

</body>
