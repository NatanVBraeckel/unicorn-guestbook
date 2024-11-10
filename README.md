# Unicorn Guestbook opdracht

## Environment

### Containers
Ik heb naast de symfony app een paar containers gebruikt:

- PostgreSQL als database (postgres)
- Mailhog voor de emails (mailhog/mailhog)
- Adminer voor makkelijk de data te bekijken (adminer)

### Variabelen

Mijn env.local heeft twee variabelen:

DATABASE_URL="postgresql://postgres:unicorn@127.0.0.1:5432/postgres?serverVersion=16&charset=utf8"

MAILER_DSN=smtp://localhost:1025

### Fixture

Ik heb ook een fixture gemaakt om wat data toe te voegen om de API te testen. Dit kan met het commando:

```bash
php bin/console doctrine:fixtures:load
```

## De API

De API documentatie is beschikbaar op de /api uri, hier kan je ook de endpoints uittesten. 
Ik heb gebruik gemaakt van API Platform.

## Uitbreidingen

Het zou nuttig kunnen zijn om een *purchased* boolean toe te voegen aan de Unicorn entiteit om deze dan naar true te zetten als de Unicorn gekocht wordt zodat die dan niet meerdere keren kan gekocht worden.\ Omdat het niet in de opdracht beschreven stond heb ik dit maar weggelaten.