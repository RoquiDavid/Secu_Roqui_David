# Danger: A1 et A5

# Modification effectuées:

- Index.php : Hashage et cryptage des valeurs de session

- Login_succes_php: decryptage de la valeur de session

- Apache2 secury-conf: Ajout de Header set X-Content-Type-Options: "nosniff" 

- Apache2 secury-conf: Ajout de Header set X-Frame-Options: "deny"

- Suppression de l'affichage du error message (e->message) en cas d'une exception php lors de la connection

- Ajout d'un repertoire index dans la hierarchie du CSS permettant de remonter d'un cran au besoin

# ZAP:
	- Absence de Jetons Anti-CSRF (2): 
		- Solution: Ajout de csrf token et vérification sur tous les formulaires.
		
	- X-Frame-Options Header Not Set:
		-Solution: 
			- Apache2 secury-conf: Ajout de Header set X-Content-Type-Options: "nosniff" 
			- Apache2 secury-conf: Ajout de Header set X-Frame-Options: "deny"
			- Ajout de <meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff" http-equiv="Content-Type" /> à toutes les en-tête
	
	- Incompatibilité de charset (Header Versus Meta Content-Type Charset) (1):
		-Solution:
			Ajout de charset UT8 à toute les en-tête html
		
		
