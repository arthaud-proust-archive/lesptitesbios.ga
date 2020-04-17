# Les p'tites bios

## Site
### Utilisation
> Le contenu est régulièrement mis à jour
- Recherchez des biographies d'auteurs, découvrez leurs oeuvres
- Révisez votre oral de français avec les fiches de révisions

### Contribution
Vous pouvez nous aider à la rédaction du site en vous [inscrivant](https://lesptitesbios.ga/register). 

### Caractéristiques
- [Badges](https://lesptitesbios.ga/badges) informatifs sur les fiches
- Possibilité d'imprimer les fiches avec plusieurs options différentes
- Recherche de fiches par nom ou date


# Api
Vous pouvez utiliser notre Api pour récupérer les fiches du site, avec des requêtes Json.
> Le contenu ('content','bio','notes', 'text') des fiches est formatté en **markdown** à l'aide de [toast-ui.vue-editor](https://github.com/nhn/toast-ui.vue-editor) (ancienne version)

## Auteurs: 
- GET https://lesptitesbios.ga/api/persons
- GET https://lesptitesbios.ga/api/person/{slug|name}
```json
GET https://lesptitesbios.ga/api/person/charles-baudelaire
=> {
    "id": 1,
    "slug": "charles-baudelaire",
    "name": "Charles Baudelaire",
    "state": "certif",
    "img": "data:image/jpeg;base64:...",
    "date": "1821-1867",
    "bio": "...",
    "notes": null,
}
```

## Oeuvres: 
- GET https://lesptitesbios.ga/api/artworks
- GET https://lesptitesbios.ga/api/person/{slug|name}/artworks
- GET https://lesptitesbios.ga/api/artwork/{slug}
```json
GET https://lesptitesbios.ga/api/artwork/une-charogne
=> {
    "id": 1,
    "slug": "une-charogne",
    "name": "LA n°1 - Une Charogne",
    "state": "certif",
    "person": "Charles Baudelaire",
    "date": "1857",
    "content": "...",
    "notes": null,
    "text": null,
}
```
