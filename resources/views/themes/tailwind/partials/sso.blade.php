<div class="container mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="mt-6 text-2xl font-extra bold leading-9 text-center text-gray-900 lg:text-2xl">
        <h2>Se connecter avec un compte social</h2>
    </div>
    <div class="flex justify-center mt-6">
        <!-- Lien de redirection vers Google -->
        <div class="mx-2">
            <a href="{{ route('sso.redirect', 'google') }}" title="Connexion avec Google" class="btn btn-link">
                <img src="{{ asset('img/google.png') }}" alt="Google Logo" class="icon">
            </a>
        </div>
        <!-- Lien de redirection vers Github -->
        <div class="mx-2">
            <a href="{{ route('sso.redirect', 'github') }}" title="Connexion avec Github" class="btn btn-link">
                <img src="{{ asset('img/github.png') }}" alt="Github Logo" class="icon">
            </a>
        </div>
        <!-- Lien de redirection vers Facebook -->
        <div class="mx-2">
            <a href="{{ route('sso.redirect', 'facebook') }}" title="Connexion avec Facebook" class="btn btn-link">
                <img src="{{ asset('img/facebook.png') }}" alt="Facebook Logo" class="icon">
            </a>
        </div>
        <!-- Lien de redirection vers Linkedin -->
        <div class="mx-2">
            <a href="{{ route('sso.redirect', 'linkedin') }}" title="Connexion avec Linkedin" class="btn btn-link">
                <img src="{{ asset('img/linkedin.png') }}" alt="Linkedin Logo" class="icon">
            </a>
        </div>
    </div>
</div>
