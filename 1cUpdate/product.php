<?php
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    if($_GET['key'] != "8afa55b2-413f-4b73-be96-6770cbf5a6d7"){
        die();
        exit();
    }

    
    $jsonData = get_data();
     
    [$validItems, $articlesList] = get_valid_items($jsonData['data']);
    
    $existingProductsID_RU = GetExistingProductsIDs($articlesList, true);
    $existingProductsID_ENG = GetExistingProductsIDs($articlesList, false);

    foreach($validItems as $item){
        $targetCategory_RU = get_target_category($item, get_categories_RU());
        $targetCategory_ENG = get_target_category($item, get_categories_ENG());
        $PROP = get_product_props($item);

        if($targetCategory_RU && $targetCategory_ENG){
            $PRODUCT_ID = null;
            $PRODUCT_ID_ENG = null;

            //RU
            if($existingProductsID_RU[$item['Article']]){
                $PRODUCT_ID = update_product($item, $PROP, $existingProductsID_RU[$item['Article']], true);
            }else{
                $PRODUCT_ID = add_product($item, $PROP, $targetCategory_RU, 2, true);
            }

            //ENG
            if($existingProductsID_ENG[$item['Article']]){
                $PRODUCT_ID_ENG = update_product($item, $PROP, $existingProductsID_ENG[$item['Article']], false);
            }else{
                $PRODUCT_ID_ENG = add_product($item, $PROP, $targetCategory_ENG, 17, false);
            }

            if($item['Pic'])
                AddImages($PRODUCT_ID, $PRODUCT_ID_ENG, $item['Pic']);
        }
    }


    function get_data(){
        $entityBody = file_get_contents('php://input');
        $jsonData = json_decode($entityBody, true);
        
        return $jsonData;
    }

    function get_valid_items($jsonData){
        $validItems = [];
        $articlesList = [];

        foreach($jsonData as $item){
            if(
                $item['Article'] && 
                $item['Article'] != " " && 
                $item['ГруппировкаУровень1'] &&
                $item['Price'] > 0 &&
                $item['Price2'] > 0
            ){
                $articlesList[] = $item['Article'];
                $validItems[] = $item;
            }
        }

        return [$validItems, $articlesList];
    }

    function get_categories_ENG(){
        return array(
            "ОТКРЫТЫЙ КОСМОС#eng# OPEN SPACE #eng#" => 71,
            "ОТКРЫТЫЙ КОСМОС НАСЛЕДИЕ#eng# OPEN SPACE HERITAGE #eng#" => 71,
            "ГАГАРИН#eng# GAGARIN #eng#" => 68,
            "ГАГАРИН НАСЛЕДИЕ АВТОМАТ#eng# GAGARIN HERITAGE AUTOMATIC #eng#" => 86,
            "ОТКРЫТЫЙ КОСМОС ХРОНОГРАФ АВТОМАТ#eng# OPEN SPACE CHRONOGRAPH AUTOMATIC #eng#" => 88,
            "ГАГАРИН ПЕРВЫЙ#eng# GAGARIN THE FIRST #eng#" => 84,
            "ГАГАРИН НАСЛЕДИЕ СТАЛЬ 904L#eng# GAGARIN HERITAGE STEEL 904L #eng#" => 87,
            "ГАГАРИН НАСЛЕДИЕ#eng# GAGARIN HERITAGE #eng#" => 87,
            "МАРС#eng# MARS #eng#" => 74,
            "МАРС LADY#eng# MARS LADY #eng#" => 75,
            "GALAXY#eng# GALAXY #eng#" => 71, 
            "ГЭЛАКСИ#eng# GALAXY #eng#" => 71,
            "ОТКРЫТЫЙ КОСМОС DAY-DATE АВТОМАТ#eng# OPEN SPACE DAY-DATE AUTOMATIC #eng#" => 90,
            "ОКЕАН#eng# OCEAN #eng#" => 73,
            "ОКЕАН СТИНГРЕЙ#eng# OCEAN STINGRAY #eng#" => false,
            "АМФИБИЯ#eng#AMPHIBIA#eng#" => false,
            "МАРС 2#eng# MARS 2 #eng#" => 74,
            "ОТКРЫТЫЙ КОСМОС КВАРЦ#eng# OPEN SPACE QUARTZ #eng#" => 89,
            "ГАГАРИН ДЕНЬ-НОЧЬ#eng# GAGARIN DAY-NIGHT #eng#" => 81,
            "ГАГАРИН 60 ЛЕТ#eng# GAGARIN 60 YEARS #eng#" => false,
            "ОТКРЫТЫЙ КОСМОС СИГНАЛ#eng# OPEN SPACE SIGNAL #eng#" => false,
            "СПУТНИК#eng# SPUTNIK #eng#" => 70,
            "СПУТНИК НАСЛЕДИЕ#eng# SPUTNIK HERITAGE #eng#" => 92,
            "СПУТНИК НАСЛЕДИЕ МАЛАЯ СЕКУНДА#eng# SPUTNIK HERITAGE SMALL SECONDS #eng#" => 94,
            "ОТКРЫТЫЙ КОСМОС КЛАССИКА МАЛАЯ СЕКУНДА#eng# OPEN SPACE CLASSIC SMALL SECONDS #eng#" => false,
            "АРКТИКА#eng# АRКТIКА #eng#" => 69,
            "АРКТИКА НАСЛЕДИЕ 24 ЧАСА#eng# ARKTIKA HERITAGE 24 HOUR #eng#" => 76,
            "ГАГАРИН КЛАССИКА 33#eng# GAGARIN CLASSIC 33#eng#" => 79,
            "ГАГАРИН НАСЛЕДИЕ КЛАССИКА#eng# GAGARIN HERITAGE CLASSIC #eng#" => 85,
            "ОТКРЫТЫЙ КОСМОС КЛАССИКА АВТОМАТ#eng# OPEN SPACE CLASSIC AUTOMATIC #eng#" => false,
            "ГАГАРИН НАСЛЕДИЕ 42#eng#GAGARIN HERITAGE 42#eng#" => 83,
            "ОТКРЫТЫЙ КОСМОС ХРОНОГРАФ НАСЛЕДИЕ#eng# OPEN SPACE CHRONOGRAPH HERITAGE #eng#" => false,
            "СПУТНИК GMT#eng# SPUTNIK GMT #eng#" => 93,
            "ОТКРЫТЫЙ КОСМОС ВТОРОЕ ЧАСОВОЕ ВРЕМЯ #eng# OPEN SPACE GMT #eng#" => 91,
            "LUNA 25#eng# LUNA 25 #eng#" => 72,
            "ТЁМНАЯ ЛУНА 25#eng# DARK MOON#eng#" => false,
            "Футболка с принтом#eng# T-shirt with print #eng#" => false,
            "АРКТИКА НАСЛЕДИЕ АВТОМАТ#eng# АRКТIКА HERITAGE AUTOMATIC #eng#" => 78,
            "АРКТИКА ДЕНЬ-НОЧЬ#eng# АRКТIКА DAY-NIGHT #eng#" => 77,
            "ЛУНА 25#eng# LUNA 25 #eng#" => 72,
            "ГАГАРИН 24 ЧАСА#eng# GAGARIN 24 HOURS #eng#" => 80,
            "ОКЕАН 3133#eng# OCEAN 3133 #eng#" => false,
            "ГАГАРИН КЛАССИКА АВТОМАТ#eng# GAGARIN CLASSIC AUTOMATIC #eng#" => 82
        );
    }

    function get_categories_RU(){
        return array(
            "ОТКРЫТЫЙ КОСМОС#eng# OPEN SPACE #eng#" => 44,
            "ОТКРЫТЫЙ КОСМОС НАСЛЕДИЕ#eng# OPEN SPACE HERITAGE #eng#" => 44,
            "ГАГАРИН#eng# GAGARIN #eng#" => 41,
            "ГАГАРИН НАСЛЕДИЕ АВТОМАТ#eng# GAGARIN HERITAGE AUTOMATIC #eng#" => 50,
            "ОТКРЫТЫЙ КОСМОС ХРОНОГРАФ АВТОМАТ#eng# OPEN SPACE CHRONOGRAPH AUTOMATIC #eng#" => 67,
            "ГАГАРИН ПЕРВЫЙ#eng# GAGARIN THE FIRST #eng#" => 52,
            "ГАГАРИН НАСЛЕДИЕ СТАЛЬ 904L#eng# GAGARIN HERITAGE STEEL 904L #eng#" => 49,
            "ГАГАРИН НАСЛЕДИЕ#eng# GAGARIN HERITAGE #eng#" => 49,
            "МАРС#eng# MARS #eng#" => 47,
            "МАРС LADY#eng# MARS LADY #eng#" => 48,
            "GALAXY#eng# GALAXY #eng#" => 44,
            "ГЭЛАКСИ#eng# GALAXY #eng#" => 44,
            "ОТКРЫТЫЙ КОСМОС DAY-DATE АВТОМАТ#eng# OPEN SPACE DAY-DATE AUTOMATIC #eng#" => 65,
            "ОКЕАН#eng# OCEAN #eng#" => 46,
            "ОКЕАН СТИНГРЕЙ#eng# OCEAN STINGRAY #eng#" => false,
            "АМФИБИЯ#eng#AMPHIBIA#eng#" => false,
            "МАРС 2#eng# MARS 2 #eng#" => 47,
            "ОТКРЫТЫЙ КОСМОС КВАРЦ#eng# OPEN SPACE QUARTZ #eng#" => 66,
            "ГАГАРИН ДЕНЬ-НОЧЬ#eng# GAGARIN DAY-NIGHT #eng#" => 55,
            "ГАГАРИН 60 ЛЕТ#eng# GAGARIN 60 YEARS #eng#" => false,
            "ОТКРЫТЫЙ КОСМОС СИГНАЛ#eng# OPEN SPACE SIGNAL #eng#" => false,
            "СПУТНИК#eng# SPUTNIK #eng#" => 43,
            "СПУТНИК НАСЛЕДИЕ#eng# SPUTNIK HERITAGE #eng#" => 61,
            "СПУТНИК НАСЛЕДИЕ МАЛАЯ СЕКУНДА#eng# SPUTNIK HERITAGE SMALL SECONDS #eng#" => 62,
            "ОТКРЫТЫЙ КОСМОС КЛАССИКА МАЛАЯ СЕКУНДА#eng# OPEN SPACE CLASSIC SMALL SECONDS #eng#" => false,
            "АРКТИКА#eng# АRКТIКА #eng#" => 42,
            "АРКТИКА НАСЛЕДИЕ 24 ЧАСА#eng# ARKTIKA HERITAGE 24 HOUR #eng#" => 60,
            "ГАГАРИН КЛАССИКА 33#eng# GAGARIN CLASSIC 33#eng#" => 57,
            "ГАГАРИН НАСЛЕДИЕ КЛАССИКА#eng# GAGARIN HERITAGE CLASSIC #eng#" => 51,
            "ОТКРЫТЫЙ КОСМОС КЛАССИКА АВТОМАТ#eng# OPEN SPACE CLASSIC AUTOMATIC #eng#" => false,
            "ГАГАРИН НАСЛЕДИЕ 42#eng#GAGARIN HERITAGE 42#eng#" => 53,
            "ОТКРЫТЫЙ КОСМОС ХРОНОГРАФ НАСЛЕДИЕ#eng# OPEN SPACE CHRONOGRAPH HERITAGE #eng#" => false,
            "СПУТНИК GMT#eng# SPUTNIK GMT #eng#" => 63,
            "ОТКРЫТЫЙ КОСМОС ВТОРОЕ ЧАСОВОЕ ВРЕМЯ #eng# OPEN SPACE GMT #eng#" => 64,
            "LUNA 25#eng# LUNA 25 #eng#" => 45,
            "ТЁМНАЯ ЛУНА 25#eng# DARK MOON#eng#" => false,
            "Футболка с принтом#eng# T-shirt with print #eng#" => false,
            "АРКТИКА НАСЛЕДИЕ АВТОМАТ#eng# АRКТIКА HERITAGE AUTOMATIC #eng#" => 58,
            "АРКТИКА ДЕНЬ-НОЧЬ#eng# АRКТIКА DAY-NIGHT #eng#" => 59,
            "ЛУНА 25#eng# LUNA 25 #eng#" => 45,
            "ГАГАРИН 24 ЧАСА#eng# GAGARIN 24 HOURS #eng#" => 56,
            "ОКЕАН 3133#eng# OCEAN 3133 #eng#" => false,
            "ГАГАРИН КЛАССИКА АВТОМАТ#eng# GAGARIN CLASSIC AUTOMATIC #eng#" => 54
        );
    }

    function GetExistingProductsIDs($articles, $isRus){
        $result = array();
        
        if (!CModule::IncludeModule("iblock")) {
            return $result;
        }

        $arFilter = array(
            "IBLOCK_ID" => $isRus ? 2 : 17,
            "ACTIVE" => "Y",
            "PROPERTY_ARTNUMBER" => $articles
        );
    
        $arSelect = array("ID", "PROPERTY_ARTNUMBER");

        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNext()) {
            $result[$ob['PROPERTY_ARTNUMBER_VALUE']] = $ob['ID'];
        }

        return $result;
    }

    function str_to_slug($str) {
        // Преобразуем в нижний регистр
        $str = mb_strtolower($str, 'UTF-8');
        // Транслитерация кириллицы в латиницу
        $str = strtr($str, array(
            'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'zh','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'','ы'=>'y','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya',
            'А'=>'a','Б'=>'b','В'=>'v','Г'=>'g','Д'=>'d','Е'=>'e','Ё'=>'e','Ж'=>'zh','З'=>'z','И'=>'i','Й'=>'y','К'=>'k','Л'=>'l','М'=>'m','Н'=>'n','О'=>'o','П'=>'p','Р'=>'r','С'=>'s','Т'=>'t','У'=>'u','Ф'=>'f','Х'=>'h','Ц'=>'ts','Ч'=>'ch','Ш'=>'sh','Щ'=>'sch','Ъ'=>'','Ы'=>'y','Ь'=>'','Э'=>'e','Ю'=>'yu','Я'=>'ya'
        ));
        // Заменяем все не-буквенно-цифровые символы на дефис
        $str = preg_replace('~[^a-z0-9]+~u', '-', $str);
        // Удаляем начальные и конечные дефисы
        $str = trim($str, '-');
        return $str;
    }

    function get_product_props($item){
        $PROP = array();
        $CALIBRE = explode('#eng#', $item['ДИАМЕТР2']);
        $M_TYPE = explode('#eng#', $item['ТипМеханизма']);

        $PROP = [
            'NAME_ENG' => get_product_name($item, false),
            'DESC_ENG' => '',
            'CALIBRE' => $CALIBRE[0].' - '.$M_TYPE[0],
            'CALIBRE_ENG' => $CALIBRE[1].' - '.$M_TYPE[1],
            'ARTNUMBER' => $item['Article'],
            'DIAMETER' => $item['ДИАМЕТР2'],
            'DIAL_COLOR' => $item['ЦВЕТЦИФЕРБЛАТА'],
            'BACKLIGHT' => $item['ПОДСВЕТКА2'],
            'SERIES' => $item['СЕРИЯ'],
            'PAUL' => $item['Пол'],
            'COUNTRY' => $item['СтранаMANUFACTURER'],
            'RRC' => $item['РРЦ'],
            'MODEL_RANGE' => $item['РазмерДиаметр'],
            'STRAP_MATERIAL' => $item['МатериалРемешкаБраслета'],
            'GLASS' => $item['Стекло'],
            'TYPE_MECHANISM' => $item['ТипМеханизма'],
            'GUARANTEE' => $item['Гарантия'],
            'MANUFACTURER' => $item['СтранаMANUFACTURER'],
            'BRAND' => $item['Бренд'],
            'WATER_RESISTANCE' => $item['Водонепроницаемость'],
            'BODY_MATERIAL' => $item['МатериалКорпуса'],
            'CL_S' => $item['Калибр'],
            'CATEGORY' => array()
        ];

        if(str_contains(mb_strtolower($item['Пол'], 'UTF-8'), "мужские"))
            $PROP['CATEGORY'][] = 56;

        if(str_contains(mb_strtolower($item['Пол'], 'UTF-8'), "женские"))
            $PROP['CATEGORY'][] = 57;
    
        if($item['СЕРИЯ'] == "LIMITED EDITION")
            $PROP['CATEGORY'][] = 62;

        if(str_contains(mb_strtolower($item['МатериалКорпуса'], 'UTF-8'), "титан"))
            $PROP['CATEGORY'][] = 60;

        if(str_contains(mb_strtolower($item['ГруппировкаУровень22'], 'UTF-8'), "автомат"))
            $PROP['CATEGORY'][] = 58;

        if(str_contains(mb_strtolower($item['ТипМеханизма'], 'UTF-8'), "механический"))
            $PROP['CATEGORY'][] = 59;

        if(str_contains(mb_strtolower($item['ТипМеханизма'], 'UTF-8'), "хронограф"))
            $PROP['CATEGORY'][] = 61;


        return $PROP;
    }

    function get_product_name($item, $isRus){
        $name = '';

        if($item['ГруппировкаУровень1'] && $item['ГруппировкаУровень1'] != ""){
            $name = $item['ГруппировкаУровень1'];
        }

        if($item['ГруппировкаУровень22'] && $item['ГруппировкаУровень22'] != ""){
            $name = $item['ГруппировкаУровень22'];
        }

        $name = explode("#eng#", $name);

        return $isRus ? $name[0] : $name[1];
    }

    function get_target_category($item, $categories){
        $targetCategory = array();

        if(
            $categories[$item['ГруппировкаУровень22']] && 
            $categories[$item['ГруппировкаУровень22']] != ""
        )
            $targetCategory[] = $categories[$item['ГруппировкаУровень22']]; 

        if(
            $categories[$item['ГруппировкаУровень1']] && 
            $categories[$item['ГруппировкаУровень1']] != ""
        )
            $targetCategory[] = $categories[$item['ГруппировкаУровень1']];

        return $targetCategory;
    }

    function PriceUpdate($PRICE, $PRICE_TYPE_ID, $PRODUCT_ID, $CURRENCY){
        CModule::IncludeModule("iblock");
        CModule::IncludeModule("catalog");
        
        $arFields = Array(
            "PRODUCT_ID" => $PRODUCT_ID,
            "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
            "PRICE" => $PRICE,
            "CURRENCY" => $CURRENCY,
        );

        $res = CPrice::GetList(
            array(),
            array(
                "PRODUCT_ID" => $PRODUCT_ID,
                "CATALOG_GROUP_ID" => $PRICE_TYPE_ID
            )
        );

        if ($arr = $res->Fetch()){
            CPrice::Update($arr["ID"], $arFields);
        }else{
            CPrice::Add($arFields);
        }
    }

    function update_product($item, $PROP, $existingProductsID, $isRus){
        CModule::IncludeModule("iblock");
        $el = new CIBlockElement;

        $PRODUCT_ID = $existingProductsID;

        CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, $isRus ? 2 : 17, $PROP);

        PriceUpdate($isRus ? $item['Price'] : $item['Price2'], 1, $PRODUCT_ID, $isRus ? "RUB" : "EUR"); 

        if (CModule::IncludeModule("catalog")) {
            CCatalogProduct::Update($PRODUCT_ID, array('QUANTITY' => $item['Qty']));
        }


        return $PRODUCT_ID;
    }

    function add_product($item, $PROP, $targetCategory, $IBLOCK_ID, $isRus){
        CModule::IncludeModule("iblock");
        
        $el = new CIBlockElement;

        $arLoadProductArray = array(
            "MODIFIED_BY"    => 1, // ID пользователя
            "IBLOCK_SECTION" => $targetCategory, // раздел не указываем
            "IBLOCK_ID"      => $IBLOCK_ID,
            "NAME"           => get_product_name($item, $isRus),
            "ACTIVE"         => "Y",
            "PROPERTY_VALUES"=> $PROP,
            "CODE"           => str_replace("/", "-", $item['Article']),
        );

        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            PriceUpdate($isRus ? $item['Price'] : $item['Price2'], 1, $PRODUCT_ID, $isRus ? "RUB" : "EUR");

            CCatalogProduct::add(array('ID' => $PRODUCT_ID, 'QUANTITY' => $item['Qty']), false);
        } 

        return $PRODUCT_ID;
    }

    function AddImages($productID_RU, $productID_ENG, $images){
        echo "tes";
        
        CModule::IncludeModule("iblock");
        CModule::IncludeModule("catalog");

        $arProductImages = GetProductImages($productID_RU, 2);
        $arProductImages_ENG = GetProductImages($productID_ENG, 17);

        $gallery_RU  = array();
        $gallery_ENG = array();
        $IMAGES_IDS_RU = $arProductImages['PROPERTY_MORE_PHOTO_IDS'];
        $IMAGES_IDS_ENG = $arProductImages_ENG['PROPERTY_MORE_PHOTO_IDS'];

        $flag = false;
        $index = 0;
        
        foreach($images as $image){
            if($image['Заглавная'] == '1'){
                AddPreviewImage($productID_RU, $productID_ENG, $image);
                $IMAGES_IDS_RU[] = $image['uid'];
                $IMAGES_IDS_ENG[] = $image['uid'];

                $flag = true;
            }

            if(!in_array($image['uid'], $IMAGES_IDS_RU)){
                $gallery_RU[] = AddImageFileArray($image['Данные'], $image['uid']);
                $IMAGES_IDS_RU[] = $image['uid'];
                
                $flag = true;
            }
 
            if(!in_array($image['uid'], $IMAGES_IDS_ENG)){
                $gallery_ENG[] = AddImageFileArray($image['Данные'], $image['uid']);
                $IMAGES_IDS_ENG[] = $image['uid'];
                
                $flag = true;
            }
            $index++;
        }

        if($flag){                
            CIBlockElement::SetPropertyValueCode($productID_RU, 'MORE_PHOTO', $gallery_RU);
            CIBlockElement::SetPropertyValueCode($productID_RU, 'DOP_IMAGE', $gallery_RU);
            CIBlockElement::SetPropertyValuesEx($productID_RU, 2, array('IMAGES_IDS' => $IMAGES_IDS_RU,));

            CIBlockElement::SetPropertyValueCode($productID_ENG, 'MORE_PHOTO', $gallery_ENG);
            CIBlockElement::SetPropertyValueCode($productID_ENG, 'DOP_IMAGE', $gallery_ENG);
            CIBlockElement::SetPropertyValuesEx($productID_ENG, 17, array('IMAGES_IDS' => $IMAGES_IDS_ENG,)); 
        }
    }

    function GetProductImages($productID, $IBLOCK_ID){
        CModule::IncludeModule("iblock");
        $morePhoto = array();
        $morePhotoIDS = array();

        $arSelect = Array();
        $arFilter = Array("IBLOCK_ID"=> $IBLOCK_ID, "ID"=>$productID);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if($arElem = $res->GetNextElement()){
            $arFields = $arElem->GetFields();
            $arProps = $arElem->GetProperties();

            $morePhoto = $arProps['MORE_PHOTO']['VALUE'] ? $arProps['MORE_PHOTO']['VALUE'] : array();
            $morePhotoIDS = $arProps['IMAGES_IDS']['VALUE'] ? $arProps['IMAGES_IDS']['VALUE'] : array();
        }

        return array(
            "DETAIL_PICTURE_URL" => CFile::GetPath($arFields['DETAIL_PICTURE']),
            "PREVIEW_PICTURE_URL" => CFile::GetPath($arFields['PREVIEW_PICTURE']),
            "PROPERTY_MORE_PHOTO" => $morePhoto,
            "PROPERTY_MORE_PHOTO_IDS" => $morePhotoIDS
        );
    }

    function AddImageFileArray($b64, $uid){
        $imageContent = base64_decode($b64);

        $arFileArray = false;

        if ($imageContent !== false) { 
            $fileExt = 'jpg';
            $tmpFile = tempnam(sys_get_temp_dir(), 'news_img') . '.' . $fileExt;
            file_put_contents($tmpFile, $imageContent);

            $arFileArray = CFile::MakeFileArray($tmpFile);

            $arFileArray['name'] = 'preview.' . $fileExt;
        }

        return $arFileArray;
    }

    function AddPreviewImage($productID_RU, $productID_ENG, $image){
        CModule::IncludeModule("iblock");   
        $el = new CIBlockElement;

        $imageContent = AddImageFileArray($image['Данные'], $image['uid']);

        $fields = array(
            "IBLOCK_ID" => 2,
        );

        if($imageContent){
            $fields["PREVIEW_PICTURE"] = $imageContent;
            $fields["DETAIL_PICTURE"] = $imageContent;
        }

        $el->Update($productID_RU, $fields);
        
        $arLoadProductArray['IBLOCK_ID'] = 17;
        $el->Update($productID_ENG, $fields);
    }
