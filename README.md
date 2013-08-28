Base Communale Internet
=======================

Qu'est-ce que la Base communale ?
---------------------------------

La Base communale est une application web permettant de visualiser les 
zonages environnementaux ainsi que d'autres données par commune. Elle propose
pour ce faire un module de recherche géographique (par commune, par EPCI, par 
SCoT). Une recherche thématique (par type de zonage) est également disponible.

Versions de l'application
-------------------------

La version actuellement déployée est la 2.0.1.
La version 2.1 est en cours de développement.

Architecture technique
----------------------

L'application s'appuie sur le CMS SPIP (http://www.spip.net).
La version 2.0.1 de la Base communale utilise la version 2.1.23 de SPIP.
Des scripts PHP sont développés pour ajouter les fonctionnalités spécifiques 
à la Base communale, la passerelle s'effectue via des squelettes et des 
formualires SPIP adaptés.

La librairie javascript jQuery version 1.5.1(http://jquery.com/) est 
utilisée ainsi que les plug-ins suivants :
* Datatables 1.7.5 (http://datatables.net/)
* jqueryUI 1.8.9 (http://jqueryui.com/)
* FancyBox v2.0.6 (http://fancyapps.com/fancybox/)
* MediaElement.js (http://mediaelementjs.com/)