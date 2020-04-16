# API Documentation
> V.1

# User Controller:

## Connexion of user
	`/api/login`
> Request type : Json
	
>Method : POST

#### Fields :
- **"name"**  `required|max:255`
- **"password"**  `required`
#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'token' : [user_token]`
- `'user' : [user_info] :`
	- `id`
	- `name`



## Create user (middleware)
	`/api/register`
> Request type : Json
	
>Method : POST

### Require bearer toker
#### Fields :
- **"name"**  `required|max:255|unique`
- **"password"**  `required`
#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'token' : [user_token]`
- `'user' : [user_info] :`
	- `id`
	- `name`



# Persons Controller (middleware):

## Create person
	`/api/person/new`
> Request type : Json
	
>Method : POST


### Require bearer toker
#### Fields :
- **"slug"**  `required|max:255`
- **"name"**  `required|max:255`
- **"img"** `optionnal|url`
- **"date"** `optionnal`
- **"bio"** `optionnal`
- **"notes"** `optionnal`


#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'person' : [person_info] :`
	- `id`
	- `slug`
	- `name`
	- `img`
	- `date`
	- `bio`
	- `notes`

## Get all persons
	`/api/persons`
> Request type : Json
	
>Method : GET

#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'persons' : [persons_info] :`
	- `'person' : [person_info]` :
		- `id`
		- `slug`
		- `name`
		- `img`
		- `date`
		- `bio`
		- `notes`
        


## Get specific person
	`/api/person/{slug}`
> Request type : Json
	
>Method : GET

#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'person' : [person_info]` :
	- `id`
	- `slug`
	- `name`
	- `img`
	- `date`
	- `bio`
	- `notes`


## Get artworks of specific person
	`/api/person/{slug}/artworks`
> Request type : Json
	
>Method : GET

#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'artworks' : [artworks_info] :`
	- `'artwork' : [artwork_info]` :
		- `id`
		- `slug`
		- `name`
		- `person`
		- `date`
		- `content`
		- `text`
		- `notes`
        




## Edit person
	`/api/person/{slug}/edit`
> Request type : Json
	
>Method : POST

### Require bearer toker
#### Fields :
- **"name"**  `required|max:255`
- **"img"** `optionnal|url`
- **"date"** `optionnal`
- **"bio"** `optionnal`

#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'person' : [person_info] :`
	- `id`
	- `slug`
	- `name`
	- `img`
	- `date`
	- `bio`
	- `notes`
  
## Delete person
	`/api/person/{slug}/delete`
> Request type : Json
	
>Method : POST


### Require bearer toker
#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`




# Artwork Controller (middleware):

## Create artwork
	`/api/artwork/new`
> Request type : Json
	
>Method : POST


### Require bearer toker
#### Fields :
- **"slug"**  `required|max:255`
- **"name"**  `required|max:255`
- **"person"** `optionnal`
- **"date"** `optionnal`
- **"content"** `optionnal`
- **"text"** `optionnal`
- **"notes"** `optionnal`

#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'artwork' : [artwork_info] :`
	- `id`
	- `slug`
	- `name`
	- `person`
	- `date`
	- `content`
	- `text`
	- `notes`

## Get all artworks
	`/api/artworks`
> Request type : Json
	
>Method : GET

#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'artworks' : [artworks_info] :`
	- `'artwork' : [artwork_info]` :
		- `id`
		- `slug`
		- `name`
		- `person`
		- `date`
		- `content`
		- `text`
		- `notes`


## Get specific artwork
	`/api/artwork/{slug}`
> Request type : Json
	
>Method : GET

#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'artwork' : [artwork_info]` :
	- `id`
	- `slug`
	- `name`
	- `person`
	- `date`
	- `content`
	- `text`
	- `notes`



## Edit artwork
	`/api/artwork/{slug}/edit`
> Request type : Json
	
>Method : POST

### Require bearer toker
#### Fields :
- **"name"**  `required|max:255`
- **"person"** `optionnal`
- **"date"** `optionnal`
- **"content"** `optionnal`

#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'artwork' : [artwork_info] :`
	- `id`
	- `slug`
	- `name`
	- `person`
	- `date`
	- `content`
	- `text`
	- `notes`
  
## Delete artwork
	`/api/artwork/{slug}/delete`
> Request type : Json
	
>Method : POST


### Require bearer toker
#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
    
    
    
# Trash Controller (middleware):

## Get all element in trash
	`/api/trash`
> Request type : Json
	
>Method : GET

#### Return :
- `'elements' : [elements_info] :`
	- `'element' : [element_info]` :
        - `id`
        - `slug`
        - `name`
        - `img`
        - `person`
        - `bio`
        - `date`
        - `content`
        - `text`
        - `notes`


## Get specific element
	`/api/trash/{slug}`
> Request type : Json
	
>Method : GET

#### Return :
- `'status' : 'success'/'error'`
	- `'error' :  [error_description]`
- `'artwork' : [artwork_info]` :
	- `id`
	- `slug`
	- `name`
	- `person`
	- `date`
	- `content`
	- `text`
	- `notes`


## Restore specific element
	`/api/trash/{id}`
> Request type : Json
	
>Method : POST


### Require bearer toker

#### Return :
- `'element' : [element_info] :`
	- `id`
	- `slug`
	- `name`
	- `img`
	- `person`
	- `bio`
	- `date`
	- `content`
	- `text`
	- `notes`


## Delete specific element
	`/api/trash/{id}`
> Request type : Json
	
>Method : DELETE


### Require bearer toker

#### Return :
- `'elements' : [elements_info] :`
	- `'element' : [element_info]` :
        - `id`
        - `slug`
        - `name`
        - `img`
        - `person`
        - `bio`
        - `date`
        - `content`
        - `text`
        - `notes`
