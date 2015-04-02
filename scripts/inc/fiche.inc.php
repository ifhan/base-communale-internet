<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

/**
 * @var $id_type Identifiant du type de zonage 
 */
$id_type = $_REQUEST["id_type"];	
	
switch ($id_type):
    case 1:
        include(dirname(__FILE__)."/../fiche_apb.php");
        break;
    case 2:
        include(dirname(__FILE__)."/../fiche_rnn.php");
        break;
    case 3:
        include(dirname(__FILE__)."/../fiche_rnv.php");
        break;
    case 4:
        include(dirname(__FILE__)."/../fiche_zico.php");
        break;
    case 5: case 6: case 19: case 21: case 30:
        include(dirname(__FILE__)."/../fiche_site_natura.php");
        break;
    case 7:
        include(dirname(__FILE__)."/../fiche_pnr.php");
        break;
    /**
     * Affichage des ZNIEFF de première génération uniquement sur Intranet
     */
    case 8: case 9:
        include(dirname(__FILE__)."/../fiche_znieff1g.php");
        break;
    case 10: case 11:
        include(dirname(__FILE__)."/../fiche_znieff_ip.php");
        break;
    case 12:
        include(dirname(__FILE__)."/../fiche_zhim.php");
        break;
    case 13: case 14:
        include(dirname(__FILE__)."/../fiche_site_classe_inscrit.php");
        break;
    case 15:
        include(dirname(__FILE__)."/../fiche_ramsar.php");
        break;
    case 16:
        include(dirname(__FILE__)."/../fiche_sage.php");
        break;
    case 36:
        include(dirname(__FILE__)."/../fiche_site_preselectionne_inpg.php");
        break;
    case 37:
        include(dirname(__FILE__)."/../fiche_site_propose_inpg.php");
        break;
    case 39:
            include(dirname(__FILE__)."/../fiche_zde.php");
        break;    
    case 44:
            include(dirname(__FILE__)."/../fiche_secteur_scap.php");
        break;
    case 47:
            include(dirname(__FILE__)."/../fiche_site_basol.php");
        break;
    case 48:
            include(dirname(__FILE__)."/../fiche_site_basias.php");
        break;
    case 49:
            include(dirname(__FILE__)."/../fiche_icpe_silo.php");
        break;
    case 50:
            include(dirname(__FILE__)."/../fiche_icpe_seveso.php");
        break;
    case 51:
            include(dirname(__FILE__)."/../fiche_icpe_tar.php");
        break;
    case 52: case 53:
            include(dirname(__FILE__)."/../fiche_icpe.php");
        break;
    case 54:
            include(dirname(__FILE__)."/../fiche_pprt.php");
        break;
    case 55:
            include(dirname(__FILE__)."/../fiche_titre_minier.php");
        break;   
    case 56:
            include(dirname(__FILE__)."/../fiche_ancien_titre_minier.php");
        break; 
    case 57:
            include(dirname(__FILE__)."/../fiche_enveloppe_travaux.php");
        break;
    case 58:
            include(dirname(__FILE__)."/../fiche_ouvrage_minier.php");
        break;
    endswitch;
?>