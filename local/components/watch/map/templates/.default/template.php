<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    global $LENGUAGE;
    require(__DIR__."/../../lang/$LENGUAGE/template.php");

?>

<div class="where-map__content" style="z-index: 5;">
    <div class="where-map__content-title">
        <?=$MESS['FIND']; ?>
    </div>

    <div class="where-map__content-list">
        <h3><?=$MESS['SUBJECT']; ?></h3>
        <input type="text" placeholder="<?=$MESS['SEARCH']; ?>" />
        <ul>
            <? foreach($arResult["REGIONS"] as $value){ ?>
                <li len="<?=$value['COORDINATES'][0]; ?>" let="<?=$value['COORDINATES'][1]; ?>"><?=$value['NAME']; ?></li>
            <? } ?>
        </ul>
    </div>
</div>
<div id="app" style="width: 100%; height: 650px"></div>

<script>
    const MapDots = <?=json_encode($arResult["OBJECTS"]); ?>;
</script>

<style>
    .ymarker{
        width: 50px;
        height: 50px;
        background-image: url('/images/map-marker.svg');
        background-size: 50px 50px;
        transform: translate(-50%, -50%);
        background-position: center top;
        background-repeat: no-repeat;
    }
    .ymarker>span{
        display: none;
        position: absolute;
        max-width: 200px;
        background-color: white;
        box-shadow: 0 1px 20px 0 rgba(0, 0, 0, 0.06), 0 6px 30px 3px rgba(0, 0, 0, 0.06);
        border-radius: 5px;
        padding: 10px;
        font-size: 12px;
        width: 125px;
        left: 50px;
    }

    .ymarker:hover>span{
        display: block;
    }
</style>