## Traduction et Locale

### Traduction

#### Fichiers de traduction

Dans le dossier `translations`, créer des fichiers **yaml**.

```
Hello, this message need to be translated: Bonjour, ce message a bien besoin d'une traduction
Please sign in: Identifiez-vous
Movies: Films
Login: Connexion
Artists: Artistes
List: Lister
Add: Ajouter
Sign in: Se connecter
Home: Accueil
Username: Nom d'utilisateur
Password: Mot de passe
```

#### Appel des traductions dans TWIG

```
{% trans %}Artists{% endtrans %}
```

### Locale

#### Locale de traduction par défaut

Dans `config/packages/translation.yaml`:
(priorité)

```
framework:
    default_locale: de
```

ou dans `config/packages/framework.yaml`:

```
framework:
    default_locale: fr
```

***

#### Configuration au niveau global

Dans `config/services.yaml`:

```
parameters:
    # Locale
    app.default_locale: 'fr'
    app.supported_locales: 'fr|gb|de'
services:
    _defaults:
        autowire: true
        autoconfigure: true 
        bind:
            $supported_locales: '%app.supported_locales%'
            $default_locale: '%app.default_locale%'
```

Utilisation de la locale dans les **routes** grâce aux **annotations**:

Dans `config/routes/annotations.yaml`, on ajoute un préfixe avant toutes les routes:

```
controllers:
    resource: ../../src/Controller/
    type: annotation
    prefix: 
        # La locale est obligatoire dans la route
        #/{_locale}

        # Ci dessous, on peut définir manuellement un préfixe pour les locales
        fr: ''
        gb: '/gb'
        de: '/de'
    requirements:
        _locale: '%app.supported_locales%'
    defaults:
        _locale: '%app.default_locale%'
```

** Attention, il faudra peut être modifier les chemins de contrôle d'accès!**

Dans `config/packages/security.yaml`:

```
access_control:
    - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
    - { path: ^/(%app.supported_locales%)/admin, roles: ROLE_ADMIN }
```

Et enfin, pour y avoir accès dans les twig, dans `config\twig.yaml':

```
twig:
    globals:
        # Locale
        default_locale: '%app.default_locale%'
        supported_locales: '%app.supported_locales%'
```

***

#### Locale Switcher

Création d'un template fragment `templates/_locale_switcher.html.twig`:

```
{# Récupération de la route en cours #}
{% set route = app.request.attributes.get('_route') %}

{# Récupération des paramètres de la route en cours #}
{% set route_params = app.request.attributes.get('_route_params') %}
{% set params = route_params|merge(app.request.query.all) %}

{% set applocales = supported_locales|split('|') %}

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="localeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="flag flag-{{ app.request.locale }}"> </span>
    </a>
    <div class="dropdown-menu" aria-labelledby="localeDropdown">
        {% for locale in applocales %}
            {% if locale != app.request.locale %}
                <a class="dropdown-item" href="{{ path(route, params|merge({ _locale: locale })) }}">
                    <span class="flag flag-{{ locale }}"> </span>  {{ locale }}
                </a>
            {% endif %}
        {% endfor %}
    </div>
</li>
```

Et on l'incluera dans nos templates:

```
{% include '_locale_switcher.html.twig' %}
```