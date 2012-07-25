<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/HabitatCorine.class.php';
?>
<ul class="plansite">
    <li>
        <?php $habitats_corine_1 = getHabitatsCorineByCdTypo1(); ?>
        <a name='1'></a>
        <?php foreach ($habitats_corine_1 as $habitat_corine):?>
            <?php if(strlen($habitat_corine["CD_TYPO"])== 1): ?>
            <a class="plansecteur">
                <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
            </a>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 2): ?>
            <ul><li>
                <a class="planrubniv1" href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 3): ?>
            <ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 4): ?>
            <ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul>
            <?php else: ?>
            <ul><li><ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul></li></ul>
	    <?php endif; ?>
        <?php endforeach; ?>
        <br />
        <?php $habitats_corine_2 = getHabitatsCorineByCdTypo2(); ?>
        <a name='2'></a>
        <?php foreach ($habitats_corine_2 as $habitat_corine):?>
            <?php if(strlen($habitat_corine["CD_TYPO"])== 1): ?>
            <a class="plansecteur">
                <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
            </a>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 2): ?>
            <ul><li>
                <a class="planrubniv1" href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 3): ?>
            <ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 4): ?>
            <ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul>
            <?php else: ?>
            <ul><li><ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul></li></ul>
	    <?php endif; ?>
        <?php endforeach; ?>
        <br />
        <?php $habitats_corine_3 = getHabitatsCorineByCdTypo3(); ?>
        <a name='3'></a>
        <?php foreach ($habitats_corine_3 as $habitat_corine):?>
            <?php if(strlen($habitat_corine["CD_TYPO"])== 1): ?>
            <a class="plansecteur">
                <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
            </a>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 2): ?>
            <ul><li>
                <a class="planrubniv1" href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 3): ?>
            <ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 4): ?>
            <ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul>
            <?php else: ?>
            <ul><li><ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul></li></ul>
	    <?php endif; ?>
        <?php endforeach; ?>
        <br />
        <?php $habitats_corine_4 = getHabitatsCorineByCdTypo4(); ?>
        <a name='4'></a>
        <?php foreach ($habitats_corine_4 as $habitat_corine):?>
            <?php if(strlen($habitat_corine["CD_TYPO"])== 1): ?>
            <a class="plansecteur">
                <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
            </a>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 2): ?>
            <ul><li>
                <a class="planrubniv1" href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 3): ?>
            <ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 4): ?>
            <ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul>
            <?php else: ?>
            <ul><li><ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul></li></ul>
	    <?php endif; ?>
        <?php endforeach; ?>
        <br />
        <?php $habitats_corine_5 = getHabitatsCorineByCdTypo5(); ?>
        <a name='5'></a>
        <?php foreach ($habitats_corine_5 as $habitat_corine):?>
            <?php if(strlen($habitat_corine["CD_TYPO"])== 1): ?>
            <a class="plansecteur">
                <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
            </a>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 2): ?>
            <ul><li>
                <a class="planrubniv1" href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 3): ?>
            <ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 4): ?>
            <ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul>
            <?php else: ?>
            <ul><li><ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul></li></ul>
	    <?php endif; ?>
        <?php endforeach; ?>
        <br />
        <?php $habitats_corine_6 = getHabitatsCorineByCdTypo6(); ?>
        <a name='6'></a>
        <?php foreach ($habitats_corine_6 as $habitat_corine):?>
            <?php if(strlen($habitat_corine["CD_TYPO"])== 1): ?>
            <a class="plansecteur">
                <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
            </a>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 2): ?>
            <ul><li>
                <a class="planrubniv1" href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 3): ?>
            <ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 4): ?>
            <ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul>
            <?php else: ?>
            <ul><li><ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul></li></ul>
	    <?php endif; ?>
        <?php endforeach; ?>
        <br />
        <?php $habitats_corine_7 = getHabitatsCorineByCdTypo7(); ?>
        <a name='7'></a>
        <?php foreach ($habitats_corine_7 as $habitat_corine):?>
            <?php if(strlen($habitat_corine["CD_TYPO"])== 1): ?>
            <a class="plansecteur">
                <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
            </a>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 2): ?>
            <ul><li>
                <a class="planrubniv1" href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 3): ?>
            <ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 4): ?>
            <ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul>
            <?php else: ?>
            <ul><li><ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul></li></ul>
	    <?php endif; ?>
        <?php endforeach; ?>
        <br />
        <?php $habitats_corine_8 = getHabitatsCorineByCdTypo8(); ?>
        <a name='8'></a>
        <?php foreach ($habitats_corine_8 as $habitat_corine):?>
            <?php if(strlen($habitat_corine["CD_TYPO"])== 1): ?>
            <a class="plansecteur">
                <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
            </a>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 2): ?>
            <ul><li>
                <a class="planrubniv1" href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 3): ?>
            <ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul>
            <?php elseif(strlen($habitat_corine["CD_TYPO"])== 4): ?>
            <ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul>
            <?php else: ?>
            <ul><li><ul><li><ul><li><ul><li>
                <a href="spip.php?page=liste_zonages&id_dpt=0&id_corine=<?=$habitat_corine["CD_TYPO"]?>">
                    <?=$habitat_corine["CD_TYPO"]?>. <?=$habitat_corine["LB_TYPO"]?>
                </a>
            </li></ul></li></ul></li></ul></li></ul>
	    <?php endif; ?>
        <?php endforeach; ?>
        <br />        
    </li>
</ul>