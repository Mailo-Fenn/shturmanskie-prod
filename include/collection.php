<?php
    global $LENGUAGE;
?>
<div class="category-slider__slick">
    <?php
        $arSelect = Array();  
	    $arFilter = Array(
            "IBLOCK_ID"=>15, 
            "ACTIVE"=>"Y", 
            "PROPERTY_SHOW_IN_LIST" => 73
        );  
	    
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);  
	    while($ob = $res->GetNextElement())  {  
	        $fields = $ob->GetFields(); 
	        $properties = $ob->GetProperties();
    ?>
            <div>
                <a class="category-slider__item" href="/catalog/<?=$fields['CODE']; ?>/">
                    <div class="category-slider__item-image vertical-center">
                        <img src="<?=CFile::GetPath($fields['PREVIEW_PICTURE']); ?>">
                    </div>
                    <h3 class="product-title"><?=$LENGUAGE == "ru" ? $fields['NAME'] : $properties['NAME_ENG']['VALUE']; ?></h3>
                </a>
            </div>
    <?php
	    }     
    ?>
</div>