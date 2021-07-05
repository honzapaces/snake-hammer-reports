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

## How to get there

web browser - http://localhost 

currently hosting example API

## API

GET /admin/entity?name=ENTITY_NAME - all 
GET /admin/entity?name=ENTITY_NAME&id=X - specific

POST /admin/entity/new?name=ENTITY_NAME

```
    request body json for sector
    {
        "name" : "Segmentum Ultimus"
    }
    request body json for sub sector
    {
    "name" : "Hexos",
        "sector_id": 1
    }
```

GET (could be DELETE) /admin/entity/delete?name=ENTITY_NAME&id=X