# snake-hammer-reports

## Useful commands

docker compose up - start ( require latest docker with docker compose )

docker compose exec php sh - get in container

vendor/bin/doctrine-migrations migrations:migrate - run database migrations

vendor/bin/doctrine-migrations migrations:diff - create database migration from entity changes

***
#### create config/config.secret.neon containing connection to database

dev example

```
parameters:
    db:
        name: db
        host: db
        port: 3306
        user: user
        pass: pass
```
***