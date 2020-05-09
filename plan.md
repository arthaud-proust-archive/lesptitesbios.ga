 

 root -> auteur -> oeuvre


#root
App:
    Header
    Main: 
        -intro
        -auteurs: [
            nom+date
            ]
    Footer




#auteur
App:
    Header
    Main:
        -nom + date
        -bio
        -oeuvres: [
            nom+date
            ]
    Footer




#oeuvre
App:
    Header
    Main:
        -titre + date
        -text
    Footer