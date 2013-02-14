### under development

BtnSettings
===========

Install:
```json
"require": {
    "friendsofsymfony/user-bundle"      : "1.*",
    "bitnoise/user-bundle": "dev-master"
},
"repositories": [
    {
        "type": "vcs",
        "url":  "git@github.com:Bitnoise/BtnUserBundle.git"
    }
],
```

AppKernel

```php
//Bitnoise
new Btn\UserBundle\BtnUserBundle(),

//FOS
new FOS\UserBundle\FOSUserBundle(),
```

config.yml:

```yaml
fos_user:
    db_driver:     orm #other valid values are 'mongodb', 'couchdb' and 'propel'
    firewall_name: main
    user_class:    Btn\UserBundle\Entity\User
    from_email:
        address:        noreply@bitnoise.pl
        sender_name:    Btn App
    resetting:
        email:
            template:   BtnAppBundle:Mail:resetting.email.twig
    registration:
        form:
            type:       btn_user_registration
        confirmation:
            enabled:    true
            template:   BtnAppBundle:Mail:register.email.twig
```

routing.yml:

```yaml
BtnUserBundle:
    resource: "@BtnUserBundle/Controller/"
    type:     annotation
    prefix:   /

fos_user_security:
    resource: "@FOSUserBundle/Resources/config/routing/security.xml"

fos_user_profile:
    resource: "@FOSUserBundle/Resources/config/routing/profile.xml"
    prefix: /profile

fos_user_register:
    resource: "@FOSUserBundle/Resources/config/routing/registration.xml"
    prefix: /register

fos_user_resetting:
    resource: "@FOSUserBundle/Resources/config/routing/resetting.xml"
    prefix: /resetting

fos_user_change_password:
    resource: "@FOSUserBundle/Resources/config/routing/change_password.xml"
    prefix: /profile

control:
    resource: "@AcmeControlBundle/Controller/"
    type:     annotation
    prefix:   /control
```

app/config/security.yml:

```yaml
security:
    providers:
        custom:
            id: btn_user.btn_user_provider
        fos_userbundle:
            id: fos_user.user_manager

    encoders:
        FOS\UserBundle\Model\UserInterface: sha512

    firewalls:
        main:
            pattern: ^/
            form_login:
                provider:      custom
                csrf_provider: form.csrf_provider
                login_path:    /auth
            logout:       true
            anonymous:    true

    access_control:
        - { path: ^/login$,    role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/login_check$,    role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/register,  role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/profile,   role: IS_AUTHENTICATED_REMEMBERED }
        - { path: ^/seller,    role: IS_AUTHENTICATED_REMEMBERED }
        - { path: ^/control/,  role: ROLE_ADMIN }

    role_hierarchy:
        ROLE_ADMIN:       ROLE_USER
        ROLE_SUPER_ADMIN: ROLE_ADMIN
```
