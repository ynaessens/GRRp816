<?php
/**
 * admin_couleurs.php
 * Interface permettant à l'administrateur la personnalisation de certaines couleurs
 * Ce script fait partie de l'application GRR.
 * Dernière modification : $Date: 2019-11-26 16:00$
 * @author    Yan Naessens
 * @copyright Copyright 2003-2019 Team DEVOME - JeromeB
 * @link      http://www.gnu.org/licenses/licenses.html
 *
 * This file is part of GRR.
 *
 * GRR is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 */
$grr_script_name = "admin_couleurs.php";
include "../include/admin.inc.php";

$back = 'admin_accueil.php';
$ok = (isset($_GET['ok']))? $_GET['ok']: NULL;
/* initialisations */
// Liste des couleurs paramétrées
$champs_couleur=array('header_bgcolor' => '--header-bgcolor'
,'header_text' => '--header-text'
,'header_hover' => '--header-hover'
,'menuG_bgcolor' => '--menuG-bgcolor'
,'menuG_color' => '--menuG-color'
,'cal_titrecolor' => '--cal-titrecolor'
,'cal_titrebgcolor' => '--cal-titrebgcolor'
,'cal_joursbgcolor' => '--cal-joursbgcolor'
,'cal_jourscolor' => '--cal-jourscolor'
,'cal_sembgcolor' => '--cal-sembgcolor'
,'cal_semcolor' => '--cal-semcolor'
,'cal_semhovercolor' => '--cal-semhovercolor'
,'cal_weekbgcolor' => '--cal-weekbgcolor'
,'cal_weekcolor' => '--cal-weekcolor'
,'cal_cellbgcolor' => '--cal-cellbgcolor'
,'cal_cellcolor' => '--cal-cellcolor'
,'cal_cellhoverbgcolor' => '--cal-cellhoverbgcolor'
,'cal_cellhovercolor' => '--cal-cellhovercolor'
,'cal_current_day_bgcolor' => '--cal-current-day-bg'
,'cal_current_day_color' => '--cal-current-day-col'
,'pl2_titrebgcolor' => '--pl2-titrebgcolor'
,'pl2_titrecolor' => '--pl2-titrecolor'
,'pl2_entetebgcolor' => '--pl2-entetebgcolor'
,'pl2_entetecolor' => '--pl2-entetecolor'
,'pl2_cellbgcolor' => '--pl2-cellbgcolor'
,'pl2_cellcolor' => '--pl2-cellcolor'
,'icons_color' => '--icons-color'
,'btn_primary_color' => '--btn-primary-color'
,'btn_primary_bgcolor' => '--btn-primary-bgcolor'
,'btn_primary_bordcolor' => '--btn-primary-bordcolor'
,'active_btn_primary_color' => '--active-btn-primary-color'
,'active_btn_primary_bgcolor' => '--active-btn-primary-bgcolor'
,'active_btn_primary_bordcolor' => '--active-btn-primary-bordcolor'
,'focus_btn_primary_bgcolor' => '--focus-btn-primary-bgcolor'
,'focus_btn_primary_bordcolor' => '--focus-btn-primary-bordcolor'
,'focus_btn_primary_color' => '--focus-btn-primary-color'
,'ssmenuadm_actif_bgcolor' => '--ssmenuadm-actif-bg'
,'ssmenuadm_actif_color' => '--ssmenuadm-actif-color');// NOTE: Pour JavaScript, on n'a pas le droit au '-' dans un nom de variable
// liste des couleurs en cours d'utilisation -reste à mettre au point
$current_color_tab=array();
// liste des couleurs par défaut, ce sont celles du modèle "default"
$default_color_tab=array('header_bgcolor' => '#FFF'
,'header_text' => '#337AB7'
,'header_hover' => '#23527C'
,'menuG_bgcolor' => '#FFF'
,'menuG_color' => '#333'
,'cal_titrecolor' => '#333'
,'cal_titrebgcolor' => '#FFF'
,'cal_joursbgcolor' => '#FFF'
,'cal_jourscolor' => '#333'
,'cal_sembgcolor' => '#FFF'
,'cal_semcolor' => '#337AB7'
,'cal_semhovercolor' => '#23527C'
,'cal_weekbgcolor' => '#FFF'
,'cal_weekcolor' => '#337AB7'
,'cal_cellbgcolor' => '#FFF'
,'cal_cellcolor' => '#337AB7'
,'cal_cellhoverbgcolor' => '#FFF'
,'cal_cellhovercolor' => '#23527C'
,'cal_current_day_bgcolor' => '#FFF'
,'cal_current_day_color' => '#000'
,'pl2_titrebgcolor' => 'FFF'
,'pl2_titrecolor' => '777'
,'pl2_entetebgcolor' => 'FFF'
,'pl2_entetecolor' => '337AB7'
,'pl2_cellbgcolor' => 'FFF'
,'pl2_cellcolor' => '337AB7'
,'icons_color' => '#333'
,'btn_primary_color' => '#FFF'
,'btn_primary_bgcolor' => '#337AB7'
,'btn_primary_bordcolor' => '#2E6DA4'
,'active_btn_primary_color' => '#FFF'
,'active_btn_primary_bgcolor' => '#2C6CA3'
,'active_btn_primary_bordcolor' => '#2E6DA4'
,'focus_btn_primary_bgcolor' => '#286090'
,'focus_btn_primary_bordcolor' => '#204D74'
,'focus_btn_primary_color' => '#FFF'
,'ssmenuadm_actif_bgcolor' => '#F5F5F5'
,'ssmenuadm_actif_color' => '#F00'
);

$msg = '';
// couleurs pour le formulaire ; si on arrive ici sans avoir enregistré, on récupère les valeurs par défaut, définies dans le tableau $default_color_tab
$header_text = (isset($_POST['header_text']))? valid_color($_POST['header_text']) : $default_color_tab["header_text"];
$header_bgcolor = (isset($_POST['header_bgcolor']))? valid_color($_POST['header_bgcolor']) : $default_color_tab["header_bgcolor"];
$header_hover = (isset($_POST['header_hover']))? valid_color($_POST["header_hover"]) : $default_color_tab["header_hover"];
$menuG_color = (isset($_POST['menuG_color']))? valid_color($_POST['menuG_color']) : $default_color_tab["menuG_color"];
$menuG_bgcolor = (isset($_POST['menuG_bgcolor']))? valid_color($_POST['menuG_bgcolor']) : $default_color_tab["menuG_bgcolor"];
$cal_titrecolor = (isset($_POST['cal_titrecolor']))? valid_color($_POST['cal_titrecolor']) : $default_color_tab["cal_titrecolor"];
$cal_titrebgcolor = (isset($_POST['cal_titrebgcolor']))? valid_color($_POST['cal_titrebgcolor']) : $default_color_tab["cal_titrebgcolor"];
$cal_jourscolor = (isset($_POST['cal_jourscolor']))? valid_color($_POST['cal_jourscolor']) : $default_color_tab["cal_jourscolor"];
$cal_joursbgcolor = (isset($_POST['cal_joursbgcolor']))? valid_color($_POST['cal_joursbgcolor']) : $default_color_tab["cal_joursbgcolor"];
$cal_semcolor = (isset($_POST['cal_semcolor']))? valid_color($_POST['cal_semcolor']) : $default_color_tab["cal_semcolor"];
$cal_sembgcolor = (isset($_POST['cal_sembgcolor']))? valid_color($_POST['cal_sembgcolor']) : $default_color_tab["cal_sembgcolor"];
$cal_semhovercolor = (isset($_POST['cal_semhovercolor']))? valid_color($_POST["cal_semhovercolor"]) : $default_color_tab["cal_semhovercolor"];
$cal_weekcolor = (isset($_POST['cal_weekcolor']))? valid_color($_POST['cal_weekcolor']) : $default_color_tab["cal_weekcolor"];
$cal_weekbgcolor = (isset($_POST['cal_weekbgcolor']))? valid_color($_POST['cal_weekbgcolor']) : $default_color_tab["cal_weekbgcolor"];
$cal_cellcolor = (isset($_POST['cal_cellcolor']))? valid_color($_POST['cal_cellcolor']) : $default_color_tab["cal_cellcolor"];
$cal_cellbgcolor = (isset($_POST['cal_cellbgcolor']))? valid_color($_POST['cal_cellbgcolor']) : $default_color_tab["cal_cellbgcolor"];
$cal_cellhovercolor = (isset($_POST['cal_cellhovercolor']))? valid_color($_POST['cal_cellhovercolor']) : $default_color_tab["cal_cellhovercolor"];
$cal_cellhoverbgcolor = (isset($_POST['cal_cellhoverbgcolor']))? valid_color($_POST['cal_cellhoverbgcolor']) : $default_color_tab['cal_cellhoverbgcolor'];
$cal_current_day_color = (isset($_POST['cal_current_day_color']))? valid_color($_POST['cal_current_day_color']) : $default_color_tab["cal_current_day_color"];
$cal_current_day_bgcolor = (isset($_POST['cal_current_day_bgcolor']))? valid_color($_POST['cal_current_day_bgcolor']) : $default_color_tab["cal_current_day_bgcolor"];
$pl2_titrecolor = (isset($_POST['pl2_titrecolor']))? valid_color($_POST['pl2_titrecolor']) : $default_color_tab["pl2_titrecolor"];
$pl2_titrebgcolor = (isset($_POST['pl2_titrebgcolor']))? valid_color($_POST['pl2_titrebgcolor']) : $default_color_tab['pl2_titrebgcolor'];
$pl2_entetecolor = (isset($_POST['pl2_entetecolor']))? valid_color($_POST['pl2_entetecolor']) : $default_color_tab["pl2_entetecolor"];
$pl2_entetebgcolor = (isset($_POST['pl2_entetebgcolor']))? valid_color($_POST['pl2_entetebgcolor']) : $default_color_tab["pl2_entetebgcolor"];
$pl2_cellcolor = (isset($_POST['pl2_cellcolor']))? valid_color($_POST['pl2_cellcolor']) : $default_color_tab["pl2_cellcolor"];
$pl2_cellbgcolor = (isset($_POST['pl2_cellbgcolor']))? valid_color($_POST['pl2_cellbgcolor']) : $default_color_tab["pl2_cellbgcolor"];
$icons_color = (isset($_POST['icons_color']))? valid_color($_POST["icons_color"]) : $default_color_tab["icons_color"];
$btn_primary_color = (isset($_POST['btn_primary_color']))? valid_color($_POST['btn_primary_color']) : $default_color_tab["btn_primary_color"];
$btn_primary_bgcolor = (isset($_POST['btn_primary_bgcolor']))? valid_color($_POST['btn_primary_bgcolor']) : $default_color_tab["btn_primary_bgcolor"];
$btn_primary_bordcolor = (isset($_POST['btn_primary_bordcolor']))? valid_color($_POST['btn_primary_bordcolor']) : $default_color_tab["btn_primary_bordcolor"];
$active_btn_primary_color = (isset($_POST['active_btn_primary_color']))? valid_color($_POST['active_btn_primary_color']) : $default_color_tab["active_btn_primary_color"];
$active_btn_primary_bgcolor = (isset($_POST['active_btn_primary_bgcolor']))? valid_color($_POST['active_btn_primary_bgcolor']) : $default_color_tab["active_btn_primary_bgcolor"];
$active_btn_primary_bordcolor = (isset($_POST['active_btn_primary_bordcolor']))? valid_color($_POST['active_btn_primary_bordcolor']) : $default_color_tab["active_btn_primary_bordcolor"];
$focus_btn_primary_color = (isset($_POST['focus_btn_primary_color']))? valid_color($_POST['focus_btn_primary_color']) : $default_color_tab["focus_btn_primary_color"];
$focus_btn_primary_bgcolor = (isset($_POST['focus_btn_primary_bgcolor']))? valid_color($_POST['focus_btn_primary_bgcolor']) : $default_color_tab["focus_btn_primary_bgcolor"];
$focus_btn_primary_bordcolor = (isset($_POST['focus_btn_primary_bordcolor']))? valid_color($_POST['focus_btn_primary_bordcolor']) : $default_color_tab["focus_btn_primary_bordcolor"];
$ssmenuadm_actif_color = (isset($_POST['ssmenuadm_actif_color']))? valid_color($_POST['ssmenuadm_actif_color']) : $default_color_tab["ssmenuadm_actif_color"];
$ssmenuadm_actif_bgcolor = (isset($_POST['ssmenuadm_actif_bgcolor']))? valid_color($_POST['ssmenuadm_actif_bgcolor']) : $default_color_tab["ssmenuadm_actif_bgcolor"];

/* Enregistrement des données si enregistrement */
// enregistrement des couleurs dans la feuille de style
if ((isset($_POST['record'])) && (!isset($ok)))
{
    try {
        $fich=fopen("../themes/perso/css/perso.css","w+"); // première écriture
        fwrite($fich,"/* personnalisations */");
        fclose($fich);
        $fich=fopen("../themes/perso/css/perso.css","a+");
        fwrite($fich,":root{");
        foreach($champs_couleur as $code_js => $code_css)
		{
            $couleur = valid_color($_POST[$code_js]);
            fwrite($fich," 
    ".$code_css.": ".$couleur.";");
        }
        fwrite($fich,"}
");
        fclose($fich);
    }
    catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
        $ok = 'no';
        die();
    }

    // Si pas de problème, message de confirmation
    $_SESSION['displ_msg'] = 'yes';
    if ($msg == '') {
        $msg = get_vocab('message_records');
    }
}

// code HTML
// haut de page et début de section
start_page_w_header("", "", "", $type="with_session");

if (!($desactive_VerifNomPrenomUser))
    $desactive_VerifNomPrenomUser = 'n';
// On vérifie que les noms et prénoms ne sont pas vides
VerifNomPrenomUser("with_session"); // une page admin ne doit pas être accessible hors session

// Affichage de la colonne de gauche
include 'admin_col_gauche2.php'; 
// colonne de droite
echo "<div class='col-md-9 col-sm-8 col-xs-12'>";
affiche_pop_up($msg,"admin");
echo "<h2>".get_vocab('admin_couleurs.php')."</h2>";
echo '<p>'.get_vocab('admin_couleurs_explications').'</p>';
//echo "<div>tableau initial</div><div id='initial'></div>";
//print_r($_POST);
//echo "<br/>";
//print_r($_GET);
/*print_r($champs_couleur);
echo "<br/>";*/
//if (isset($ok)) echo "variable ok affectée";
// formulaire
echo "<form action='./admin_couleurs.php' method='post'>";
// page_header
echo '<p><b><span id="testPageHeader" class="larger">'.get_vocab('page_header').'</span></b>
        <label for="header_text">'.get_vocab('text').'</label>
        <input name="header_text" id="headerfg" value="'.$header_text.'" size="7">

        <label for="header_bgcolor">'.get_vocab('bgcolor').'</label>
        <input name="header_bgcolor" id="headerbg" value="'.$header_bgcolor.'" size="7">
    ';
echo '&nbsp;<b><span id="testPageHeaderHover" class="larger">'.get_vocab('page_header_hover').'</span></b>
        <label for="header_hover">'.get_vocab('hover_text').'</label>
        <input name="header_hover" id="headerho" value="'.$header_hover.'" size="7">
    ';
echo '</p>';
// 'menuG_bgcolor','menuG_color'
echo '<p><b><span id="testMenuG" class="larger">'.get_vocab('menuG').'</span></b>
        <label for="menuG_color">'.get_vocab('text').'</label>
        <input name="menuG_color" id="menuG_color" value="'.$menuG_color.'" size="7">

        <label for="menuG_bgcolor">'.get_vocab('bgcolor').'</label>
        <input name="menuG_bgcolor" id="menuG_bgcolor" value="'.$menuG_bgcolor.'" size="7">
    ';
echo '</p>';
// 'cal_titrecolor','cal_titrebgcolor'
echo '<p><b><span id="testcal_titre" class="larger">'.get_vocab('cal_titre').'</span></b>
        <label for="cal_titrecolor">'.get_vocab('text').'</label>
        <input name="cal_titrecolor" id="cal_titrecolor" value="'.$cal_titrecolor.'" size="7">

        <label for="cal_titrebgcolor">'.get_vocab('bgcolor').'</label>
        <input name="cal_titrebgcolor" id="cal_titrebgcolor" value="'.$cal_titrebgcolor.'" size="7">
    ';
echo '</p>';
// 'cal_joursbgcolor','cal_jourscolor'
echo '<p><b><span id="testcal_jours" class="larger">'.get_vocab('cal_jours').'</span></b>
        <label for="cal_jourscolor">'.get_vocab('text').'</label>
        <input name="cal_jourscolor" id="cal_jourscolor" value="'.$cal_jourscolor.'" size="7">

        <label for="cal_joursbgcolor">'.get_vocab('bgcolor').'</label>
        <input name="cal_joursbgcolor" id="cal_joursbgcolor" value="'.$cal_joursbgcolor.'" size="7">
    ';
echo '</p>';
// 'cal_sembgcolor','cal_semcolor'
echo '<p><b><span id="testcal_sem" class="larger">'.get_vocab('cal_sem').'</span></b>
        <label for="cal_semcolor">'.get_vocab('text').'</label>
        <input name="cal_semcolor" id="cal_semcolor" value="'.$cal_semcolor.'" size="7">

        <label for="cal_sembgcolor">'.get_vocab('bgcolor').'</label>
        <input name="cal_sembgcolor" id="cal_sembgcolor" value="'.$cal_sembgcolor.'" size="7">
    ';
// 'cal_semhovercolor'
echo '&nbsp;<b><span id="testcal_semhovercolor" class="larger">'.get_vocab('cal_semhovercolor').'</span></b>
        <label for="cal_semhovercolor">'.get_vocab('text').'</label>
        <input name="cal_semhovercolor" id="cal_semhovercolor" value="'.$cal_semhovercolor.'" size="7">
    ';
echo '</p>';
// 'cal_weekbgcolor','cal_weekcolor'
echo '<p><b><span id="testcal_week" class="larger">'.get_vocab('cal_week').'</span></b>
        <label for="cal_weekcolor">'.get_vocab('text').'</label>
        <input name="cal_weekcolor" id="cal_weekcolor" value="'.$cal_weekcolor.'" size="7">

        <label for="cal_weekbgcolor">'.get_vocab('bgcolor').'</label>
        <input name="cal_weekbgcolor" id="cal_weekbgcolor" value="'.$cal_weekbgcolor.'" size="7">
    ';
echo '</p>';
// 'cal_cellbgcolor','cal_cellcolor'
echo '<p><b><span id="testcal_cell" class="larger">'.get_vocab('cal_cell').'</span></b>
        <label for="cal_cellcolor">'.get_vocab('text').'</label>
        <input name="cal_cellcolor" id="cal_cellcolor" value="'.$cal_cellcolor.'" size="7">

        <label for="cal_cellbgcolor">'.get_vocab('bgcolor').'</label>
        <input name="cal_cellbgcolor" id="cal_cellbgcolor" value="'.$cal_cellbgcolor.'" size="7">
    ';
// 'cal_cellhoverbgcolor','cal_cellhovercolor'
echo '&nbsp;<b><span id="testcal_cellhover" class="larger">'.get_vocab('cal_cellhover').'</span></b>
        <label for="cal_cellhovercolor">'.get_vocab('text').'</label>
        <input name="cal_cellhovercolor" id="cal_cellhovercolor" value="'.$cal_cellhovercolor.'" size="7">

        <label for="cal_cellhoverbgcolor">'.get_vocab('bgcolor').'</label>
        <input name="cal_cellhoverbgcolor" id="cal_cellhoverbgcolor" value="'.$cal_cellhoverbgcolor.'" size="7">
    ';
echo '</p>';
// 'cal_current_day_bgcolor','cal_current_day_color'
echo '<p><b><span id="testcal_current_day_" class="larger">'.get_vocab('cal_current_day_').'</span></b>
        <label for="cal_current_day_color">'.get_vocab('text').'</label>
        <input name="cal_current_day_color" id="cal_current_day_color" value="'.$cal_current_day_color.'" size="7">

        <label for="cal_current_day_bgcolor">'.get_vocab('bgcolor').'</label>
        <input name="cal_current_day_bgcolor" id="cal_current_day_bgcolor" value="'.$cal_current_day_bgcolor.'" size="7">
    ';
echo '</p>';
// 'pl2_titrebgcolor','pl2_titrecolor'
echo '<p><b><span id="testpl2_titre" class="larger">'.get_vocab('pl2_titre').'</span></b>
        <label for="pl2_titrecolor">'.get_vocab('text').'</label>
        <input name="pl2_titrecolor" id="pl2_titrecolor" value="'.$pl2_titrecolor.'" size="7">

        <label for="pl2_titrebgcolor">'.get_vocab('bgcolor').'</label>
        <input name="pl2_titrebgcolor" id="pl2_titrebgcolor" value="'.$pl2_titrebgcolor.'" size="7">
    ';
echo '</p>';
// 'pl2_entetebgcolor','pl2_entetecolor'
echo '<p><b><span id="testpl2_entete" class="larger">'.get_vocab('pl2_entete').'</span></b>
        <label for="pl2_entetecolor">'.get_vocab('text').'</label>
        <input name="pl2_entetecolor" id="pl2_entetecolor" value="'.$pl2_entetecolor.'" size="7">

        <label for="pl2_entetebgcolor">'.get_vocab('bgcolor').'</label>
        <input name="pl2_entetebgcolor" id="pl2_entetebgcolor" value="'.$pl2_entetebgcolor.'" size="7">
    ';
echo '</p>';
// 'pl2_cellbgcolor','pl2_cellcolor'
echo '<p><b><span id="testpl2_cell" class="larger">'.get_vocab('pl2_cell').'</span></b>
        <label for="pl2_cellcolor">'.get_vocab('text').'</label>
        <input name="pl2_cellcolor" id="pl2_cellcolor" value="'.$pl2_cellcolor.'" size="7">

        <label for="pl2_cellbgcolor">'.get_vocab('bgcolor').'</label>
        <input name="pl2_cellbgcolor" id="pl2_cellbgcolor" value="'.$pl2_cellbgcolor.'" size="7">
    ';
echo '</p>';
// 'icons_color'
echo '<p><b><span id="testicons_color" class="larger">'.get_vocab('icons_color').'</span></b>
        <label for="icons_color">'.get_vocab('text').'</label>
        <input name="icons_color" id="icons_color" value="'.$icons_color.'" size="7">
    ';
echo '</p>';
// 'btn_primary_color','btn_primary_bgcolor','btn_primary_bordcolor'
echo '<p><b><span id="testbtn_primary_" class="larger">'.get_vocab('btn_primary_').'</span></b>
        <label for="btn_primary_color">'.get_vocab('text').'</label>
        <input name="btn_primary_color" id="btn_primary_color" value="'.$btn_primary_color.'" size="7">

        <label for="btn_primary_bgcolor">'.get_vocab('bgcolor').'</label>
        <input name="btn_primary_bgcolor" id="btn_primary_bgcolor" value="'.$btn_primary_bgcolor.'" size="7">
        
        <label for="btn_primary_bordcolor">'.get_vocab('bordcolor').'</label>
        <input name="btn_primary_bordcolor" id="btn_primary_bordcolor" value="'.$btn_primary_bordcolor.'" size="7">
    ';
echo '</p>';
// 'active_btn_primary_color','active_btn_primary_bgcolor','active_btn_primary_bordcolor'
echo '<p><b><span id="testactive_btn_primary_" class="larger">'.get_vocab('active_btn_primary_').'</span></b>
        <label for="active_btn_primary_color">'.get_vocab('text').'</label>
        <input name="active_btn_primary_color" id="active_btn_primary_color" value="'.$active_btn_primary_color.'" size="7">

        <label for="active_btn_primary_bgcolor">'.get_vocab('bgcolor').'</label>
        <input name="active_btn_primary_bgcolor" id="active_btn_primary_bgcolor" value="'.$active_btn_primary_bgcolor.'" size="7">
        
        <label for="active_btn_primary_bordcolor">'.get_vocab('bordcolor').'</label>
        <input name="active_btn_primary_bordcolor" id="active_btn_primary_bordcolor" value="'.$active_btn_primary_bordcolor.'" size="7">
    ';
echo '</p>';
// 'focus_btn_primary_bgcolor','focus_btn_primary_bordcolor','focus_btn_primary_color'
echo '<p><b><span id="testfocus_btn_primary_" class="larger">'.get_vocab('focus_btn_primary_').'</span></b>
        <label for="focus_btn_primary_color">'.get_vocab('text').'</label>
        <input name="focus_btn_primary_color" id="focus_btn_primary_color" value="'.$focus_btn_primary_color.'" size="7">

        <label for="focus_btn_primary_bgcolor">'.get_vocab('bgcolor').'</label>
        <input name="focus_btn_primary_bgcolor" id="focus_btn_primary_bgcolor" value="'.$focus_btn_primary_bgcolor.'" size="7">
        
        <label for="focus_btn_primary_bordcolor">'.get_vocab('bordcolor').'</label>
        <input name="focus_btn_primary_bordcolor" id="focus_btn_primary_bordcolor" value="'.$focus_btn_primary_bordcolor.'" size="7">
    ';
echo '</p>';
// 'ssmenuadm_actif_bgcolor','ssmenuadm_actif_color'
echo '<p><b><span id="testssmenuadm_actif" class="larger">'.get_vocab('ssmenuadm_actif').'</span></b>
        <label for="ssmenuadm_actif_color">'.get_vocab('text').'</label>
        <input name="ssmenuadm_actif_color" id="ssmenuadm_actif_color" value="'.$ssmenuadm_actif_color.'" size="7">

        <label for="ssmenuadm_actif_bgcolor">'.get_vocab('bgcolor').'</label>
        <input name="ssmenuadm_actif_bgcolor" id="ssmenuadm_actif_bgcolor" value="'.$ssmenuadm_actif_bgcolor.'" size="7">
    ';
echo '</p>';
echo "<div class='center'>";
echo '<a class="btn btn-danger" type="button" href="./admin_accueil.php" style="font-variant: small-caps;">'.get_vocab("cancel").'</a>';
echo '<a class="btn btn-info" type="button" href="admin_couleurs.php?theme=defaut" style="font-variant: small-caps;">'.get_vocab('default').'</a>';
echo '<input class="btn btn-primary" type="submit" name="record" value="'.get_vocab('save').'" style="font-variant: small-caps;"/>'.PHP_EOL;
echo "</div>";
echo "</form>";
/*echo '<div id="fixe" style="text-align:center;">'.PHP_EOL;
echo '<a class="btn btn-info" type="button" href="admin_couleurs.php?defaut=" style="font-variant: small-caps;">'.get_vocab('default').'</a>';
echo '<a class="btn btn-danger" type="button" href="./admin_accueil.php" style="font-variant: small-caps;">'.get_vocab("cancel").'</a>';
echo '<input class="btn btn-primary" type="submit" name="ok" value="'.get_vocab('save').'" style="font-variant: small-caps;"/>'.PHP_EOL;
echo '</div>';
echo '</form>';*/
echo '</div>'; // fin de la colonne droite
echo "</section>";
// un div masqué pour utiliser tous les styles paramétrables et ainsi récupérer la valeur courante - reste à mettre au point
echo "<footer id='masque' style='visibility:hidden'>";
echo "Ceci sera caché";
echo "<div id='HEADER' style='background-color:$header_bgcolor ; color:$header_text'></div>";
echo "</footer>";
echo "</body>";
//echo "</html>";
?>
<script>
var html='';
html += 'fond entête = '+document.getElementById('HEADER').style.backgroundColor;
document.getElementById('initial').innerHTML += html;
</script>
<script>
// reprendre les couleurs par groupe pour itérer
var items = new Array('header_bgcolor','header_text','header_hover','menuG_bgcolor','menuG_color','cal_titrecolor','cal_titrebgcolor','cal_joursbgcolor','cal_jourscolor','cal_sembgcolor','cal_semcolor','cal_semhovercolor','cal_weekbgcolor','cal_weekcolor','cal_cellbgcolor','cal_cellcolor','cal_cellhoverbgcolor','cal_cellhovercolor','cal_current_day_bgcolor','cal_current_day_color','pl2_titrebgcolor','pl2_titrecolor','pl2_entetebgcolor','pl2_entetecolor','pl2_cellbgcolor','pl2_cellcolor','icons_color','btn_primary_color','btn_primary_bgcolor','btn_primary_bordcolor','active_btn_primary_color','active_btn_primary_bgcolor','active_btn_primary_bordcolor','focus_btn_primary_bgcolor','focus_btn_primary_bordcolor','focus_btn_primary_color','ssmenuadm_actif_bgcolor','ssmenuadm_actif_color');

// définition des color-pickers
var options = {
    valueElement: null,
    width: 300,
    height: 120,
    sliderSize: 20,
    borderColor: '#CCC',
    insetColor: '#CCC',
    backgroundColor: '#202020'
};
var pickers = {};

pickers.headerbg = new jscolor('headerbg', options);
pickers.headerbg.onFineChange = "update1()";
pickers.headerbg.fromString('<?php echo $header_bgcolor; ?>');

pickers.headerfg = new jscolor('headerfg', options);
pickers.headerfg.onFineChange = "update1()";
pickers.headerfg.fromString('<?php echo $header_text; ?>');

pickers.headerho = new jscolor('headerho', options);
pickers.headerho.onFineChange = "update2()";
pickers.headerho.fromString('<?php echo $header_hover; ?>');

function update1() {
    document.getElementById('headerbg').value =
    document.getElementById('testPageHeader').style.backgroundColor =
    document.getElementById('testPageHeaderHover').style.backgroundColor = 
        pickers.headerbg.toHEXString();
    document.getElementById('headerfg').value =
    document.getElementById('testPageHeader').style.color =
        pickers.headerfg.toHEXString();
}
function update2(){
    document.getElementById('headerho').value =
    document.getElementById('testPageHeaderHover').style.color = 
        pickers.headerho.toHEXString();
}

pickers.menuG_bgcolor = new jscolor('menuG_bgcolor',options);
pickers.menuG_bgcolor.onFineChange = "update3()";
pickers.menuG_bgcolor.fromString('<?php echo $menuG_bgcolor; ?>');

pickers.menuG_color = new jscolor('menuG_color',options);
pickers.menuG_color.onFineChange = "update3()";
pickers.menuG_color.fromString('<?php echo $menuG_color; ?>');

function update3(){
    document.getElementById('menuG_bgcolor').value = 
    document.getElementById('testMenuG').style.backgroundColor = 
        pickers.menuG_bgcolor.toHEXString();
    document.getElementById('menuG_color').value = 
    document.getElementById('testMenuG').style.color =
        pickers.menuG_color.toHEXString();
}

pickers.cal_titrebgcolor = new jscolor('cal_titrebgcolor',options);
pickers.cal_titrebgcolor.onFineChange = "update4()";
pickers.cal_titrebgcolor.fromString('<?php echo $cal_titrebgcolor; ?>');

pickers.cal_titrecolor = new jscolor('cal_titrecolor',options);
pickers.cal_titrecolor.onFineChange = "update4()";
pickers.cal_titrecolor.fromString('<?php echo $cal_titrecolor; ?>');

function update4(){
    document.getElementById('cal_titrebgcolor').value = 
    document.getElementById('testcal_titre').style.backgroundColor = 
        pickers.cal_titrebgcolor.toHEXString();
    document.getElementById('cal_titrecolor').value = 
    document.getElementById('testcal_titre').style.color =
        pickers.cal_titrecolor.toHEXString();
}

pickers.cal_joursbgcolor = new jscolor('cal_joursbgcolor',options);
pickers.cal_joursbgcolor.onFineChange = "update5()";
pickers.cal_joursbgcolor.fromString('<?php echo $cal_joursbgcolor; ?>');

pickers.cal_jourscolor = new jscolor('cal_jourscolor',options);
pickers.cal_jourscolor.onFineChange = "update5()";
pickers.cal_jourscolor.fromString('<?php echo $cal_jourscolor; ?>');

function update5(){
    document.getElementById('cal_joursbgcolor').value = 
    document.getElementById('testcal_jours').style.backgroundColor = 
        pickers.cal_joursbgcolor.toHEXString();
    document.getElementById('cal_jourscolor').value = 
    document.getElementById('testcal_jours').style.color =
        pickers.cal_jourscolor.toHEXString();
}

pickers.cal_sembgcolor = new jscolor('cal_sembgcolor',options);
pickers.cal_sembgcolor.onFineChange = "update6()";
pickers.cal_sembgcolor.fromString('<?php echo $cal_sembgcolor; ?>');

pickers.cal_semcolor = new jscolor('cal_semcolor',options);
pickers.cal_semcolor.onFineChange = "update6()";
pickers.cal_semcolor.fromString('<?php echo $cal_semcolor; ?>');

function update6(){
    document.getElementById('cal_sembgcolor').value = 
    document.getElementById('testcal_sem').style.backgroundColor = 
    document.getElementById('testcal_semhovercolor').style.backgroundColor = 
        pickers.cal_sembgcolor.toHEXString();
    document.getElementById('cal_semcolor').value = 
    document.getElementById('testcal_sem').style.color =
        pickers.cal_semcolor.toHEXString();
}

pickers.cal_semhovercolor = new jscolor('cal_semhovercolor', options);
pickers.cal_semhovercolor.onFineChange = "update7()";
pickers.cal_semhovercolor.fromString('<?php echo $cal_semhovercolor; ?>');

function update7(){
    document.getElementById('cal_semhovercolor').value =
    document.getElementById('testcal_semhovercolor').style.color = 
        pickers.cal_semhovercolor.toHEXString();
}

pickers.cal_weekbgcolor = new jscolor('cal_weekbgcolor',options);
pickers.cal_weekbgcolor.onFineChange = "update8()";
pickers.cal_weekbgcolor.fromString('<?php echo $cal_weekbgcolor; ?>');

pickers.cal_weekcolor = new jscolor('cal_weekcolor',options);
pickers.cal_weekcolor.onFineChange = "update8()";
pickers.cal_weekcolor.fromString('<?php echo $cal_weekcolor; ?>');

function update8(){
    document.getElementById('cal_weekbgcolor').value = 
    document.getElementById('testcal_week').style.backgroundColor = 
        pickers.cal_weekbgcolor.toHEXString();
    document.getElementById('cal_weekcolor').value = 
    document.getElementById('testcal_week').style.color =
        pickers.cal_weekcolor.toHEXString();
}

pickers.cal_cellbgcolor = new jscolor('cal_cellbgcolor',options);
pickers.cal_cellbgcolor.onFineChange = "update9()";
pickers.cal_cellbgcolor.fromString('<?php echo $cal_cellbgcolor; ?>');

pickers.cal_cellcolor = new jscolor('cal_cellcolor',options);
pickers.cal_cellcolor.onFineChange = "update9()";
pickers.cal_cellcolor.fromString('<?php echo $cal_cellcolor; ?>');

function update9(){
    document.getElementById('cal_cellbgcolor').value = 
    document.getElementById('testcal_cell').style.backgroundColor = 
        pickers.cal_cellbgcolor.toHEXString();
    document.getElementById('cal_cellcolor').value = 
    document.getElementById('testcal_cell').style.color =
        pickers.cal_cellcolor.toHEXString();
}

pickers.cal_cellhoverbgcolor = new jscolor('cal_cellhoverbgcolor',options);
pickers.cal_cellhoverbgcolor.onFineChange = "update10()";
pickers.cal_cellhoverbgcolor.fromString('<?php echo $cal_cellhoverbgcolor; ?>');

pickers.cal_cellhovercolor = new jscolor('cal_cellhovercolor',options);
pickers.cal_cellhovercolor.onFineChange = "update10()";
pickers.cal_cellhovercolor.fromString('<?php echo $cal_cellhovercolor; ?>');

function update10(){
    document.getElementById('cal_cellhoverbgcolor').value = 
    document.getElementById('testcal_cellhover').style.backgroundColor = 
        pickers.cal_cellhoverbgcolor.toHEXString();
    document.getElementById('cal_cellhovercolor').value = 
    document.getElementById('testcal_cellhover').style.color =
        pickers.cal_cellhovercolor.toHEXString();
}

pickers.cal_current_day_bgcolor = new jscolor('cal_current_day_bgcolor',options);
pickers.cal_current_day_bgcolor.onFineChange = "update11()";
pickers.cal_current_day_bgcolor.fromString('<?php echo $cal_current_day_bgcolor; ?>');

pickers.cal_current_day_color = new jscolor('cal_current_day_color',options);
pickers.cal_current_day_color.onFineChange = "update11()";
pickers.cal_current_day_color.fromString('<?php echo $cal_current_day_color; ?>');

function update11(){
    document.getElementById('cal_current_day_bgcolor').value = 
    document.getElementById('testcal_current_day_').style.backgroundColor = 
        pickers.cal_current_day_bgcolor.toHEXString();
    document.getElementById('cal_current_day_color').value = 
    document.getElementById('testcal_current_day_').style.color =
        pickers.cal_current_day_color.toHEXString();
}

pickers.pl2_titrebgcolor = new jscolor('pl2_titrebgcolor',options);
pickers.pl2_titrebgcolor.onFineChange = "update12()";
pickers.pl2_titrebgcolor.fromString('<?php echo $pl2_titrebgcolor; ?>');

pickers.pl2_titrecolor = new jscolor('pl2_titrecolor',options);
pickers.pl2_titrecolor.onFineChange = "update12()";
pickers.pl2_titrecolor.fromString('<?php echo $pl2_titrecolor; ?>');

function update12(){
    document.getElementById('pl2_titrebgcolor').value = 
    document.getElementById('testpl2_titre').style.backgroundColor = 
        pickers.pl2_titrebgcolor.toHEXString();
    document.getElementById('pl2_titrecolor').value = 
    document.getElementById('testpl2_titre').style.color =
        pickers.pl2_titrecolor.toHEXString();
}

pickers.pl2_entetebgcolor = new jscolor('pl2_entetebgcolor',options);
pickers.pl2_entetebgcolor.onFineChange = "update13()";
pickers.pl2_entetebgcolor.fromString('<?php echo $pl2_entetebgcolor; ?>');

pickers.pl2_entetecolor = new jscolor('pl2_entetecolor',options);
pickers.pl2_entetecolor.onFineChange = "update13()";
pickers.pl2_entetecolor.fromString('<?php echo $pl2_entetecolor; ?>');

function update13(){
    document.getElementById('pl2_entetebgcolor').value = 
    document.getElementById('testpl2_entete').style.backgroundColor = 
        pickers.pl2_entetebgcolor.toHEXString();
    document.getElementById('pl2_entetecolor').value = 
    document.getElementById('testpl2_entete').style.color =
        pickers.pl2_entetecolor.toHEXString();
}

pickers.pl2_cellbgcolor = new jscolor('pl2_cellbgcolor',options);
pickers.pl2_cellbgcolor.onFineChange = "update14()";
pickers.pl2_cellbgcolor.fromString('<?php echo $pl2_cellbgcolor; ?>');

pickers.pl2_cellcolor = new jscolor('pl2_cellcolor',options);
pickers.pl2_cellcolor.onFineChange = "update14()";
pickers.pl2_cellcolor.fromString('<?php echo $pl2_cellcolor; ?>');

function update14(){
    document.getElementById('pl2_cellbgcolor').value = 
    document.getElementById('testpl2_cell').style.backgroundColor = 
        pickers.pl2_cellbgcolor.toHEXString();
    document.getElementById('pl2_cellcolor').value = 
    document.getElementById('testpl2_cell').style.color =
        pickers.pl2_cellcolor.toHEXString();
}

pickers.icons_color = new jscolor('icons_color', options);
pickers.icons_color.onFineChange = "update15()";
pickers.icons_color.fromString('<?php echo $icons_color; ?>');

function update15(){
    document.getElementById('icons_color').value =
    document.getElementById('testicons_color').style.color = 
        pickers.icons_color.toHEXString();
}

pickers.btn_primary_bgcolor = new jscolor('btn_primary_bgcolor',options);
pickers.btn_primary_bgcolor.onFineChange = "update16()";
pickers.btn_primary_bgcolor.fromString('<?php echo $btn_primary_bgcolor; ?>');

pickers.btn_primary_bordcolor = new jscolor('btn_primary_bordcolor',options);
pickers.btn_primary_bordcolor.onFineChange = "update16()";
pickers.btn_primary_bordcolor.fromString('<?php echo $btn_primary_bordcolor; ?>');

pickers.btn_primary_color = new jscolor('btn_primary_color',options);
pickers.btn_primary_color.onFineChange = "update16()";
pickers.btn_primary_color.fromString('<?php echo $btn_primary_color; ?>');

function update16(){
    document.getElementById('btn_primary_bgcolor').value = 
    document.getElementById('testbtn_primary_').style.backgroundColor = 
        pickers.btn_primary_bgcolor.toHEXString();
    document.getElementById('btn_primary_color').value = 
    document.getElementById('testbtn_primary_').style.color =
        pickers.btn_primary_color.toHEXString();
    document.getElementById('testbtn_primary_').value =
    document.getElementById('testbtn_primary_').style.border =
        "solid "+pickers.btn_primary_bordcolor.toHEXString();
}
pickers.active_btn_primary_bgcolor = new jscolor('active_btn_primary_bgcolor',options);
pickers.active_btn_primary_bgcolor.onFineChange = "update17()";
pickers.active_btn_primary_bgcolor.fromString('<?php echo $active_btn_primary_bgcolor; ?>');

pickers.active_btn_primary_bordcolor = new jscolor('active_btn_primary_bordcolor',options);
pickers.active_btn_primary_bordcolor.onFineChange = "update17()";
pickers.active_btn_primary_bordcolor.fromString('<?php echo $active_btn_primary_bordcolor; ?>');

pickers.active_btn_primary_color = new jscolor('active_btn_primary_color',options);
pickers.active_btn_primary_color.onFineChange = "update17()";
pickers.active_btn_primary_color.fromString('<?php echo $active_btn_primary_color; ?>');

function update17(){
    document.getElementById('active_btn_primary_bgcolor').value = 
    document.getElementById('testactive_btn_primary_').style.backgroundColor = 
        pickers.active_btn_primary_bgcolor.toHEXString();
    document.getElementById('active_btn_primary_color').value = 
    document.getElementById('testactive_btn_primary_').style.color =
        pickers.active_btn_primary_color.toHEXString();
    document.getElementById('testactive_btn_primary_').value =
    document.getElementById('testactive_btn_primary_').style.border =
        "solid "+pickers.active_btn_primary_bordcolor.toHEXString();
}
pickers.focus_btn_primary_bgcolor = new jscolor('focus_btn_primary_bgcolor',options);
pickers.focus_btn_primary_bgcolor.onFineChange = "update18()";
pickers.focus_btn_primary_bgcolor.fromString('<?php echo $focus_btn_primary_bgcolor; ?>');

pickers.focus_btn_primary_bordcolor = new jscolor('focus_btn_primary_bordcolor',options);
pickers.focus_btn_primary_bordcolor.onFineChange = "update18()";
pickers.focus_btn_primary_bordcolor.fromString('<?php echo $focus_btn_primary_bordcolor; ?>');

pickers.focus_btn_primary_color = new jscolor('focus_btn_primary_color',options);
pickers.focus_btn_primary_color.onFineChange = "update18()";
pickers.focus_btn_primary_color.fromString('<?php echo $focus_btn_primary_color; ?>');

function update18(){
    document.getElementById('focus_btn_primary_bgcolor').value = 
    document.getElementById('testfocus_btn_primary_').style.backgroundColor = 
        pickers.focus_btn_primary_bgcolor.toHEXString();
    document.getElementById('focus_btn_primary_color').value = 
    document.getElementById('testfocus_btn_primary_').style.color =
        pickers.focus_btn_primary_color.toHEXString();
    document.getElementById('testfocus_btn_primary_').value =
    document.getElementById('testfocus_btn_primary_').style.border =
        "solid "+pickers.focus_btn_primary_bordcolor.toHEXString();
}

pickers.ssmenuadm_actif_bgcolor = new jscolor('ssmenuadm_actif_bgcolor',options);
pickers.ssmenuadm_actif_bgcolor.onFineChange = "update19()";
pickers.ssmenuadm_actif_bgcolor.fromString('<?php echo $ssmenuadm_actif_bgcolor; ?>');

pickers.ssmenuadm_actif_color = new jscolor('ssmenuadm_actif_color',options);
pickers.ssmenuadm_actif_color.onFineChange = "update19()";
pickers.ssmenuadm_actif_color.fromString('<?php echo $ssmenuadm_actif_color; ?>');

function update19(){
    document.getElementById('ssmenuadm_actif_bgcolor').value = 
    document.getElementById('testssmenuadm_actif').style.backgroundColor = 
        pickers.ssmenuadm_actif_bgcolor.toHEXString();
    document.getElementById('ssmenuadm_actif_color').value = 
    document.getElementById('testssmenuadm_actif').style.color =
        pickers.ssmenuadm_actif_color.toHEXString();
}

update1();
update2();
update3();
update4();
update5();
update6();
update7();
update8();
update9();
update10();
update11();
update12();
update13();
update14();
update15();
update16();
update17();
update18();
update19();
</script>
</html>
