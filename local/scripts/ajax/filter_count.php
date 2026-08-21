<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if ($_POST['ajax_action'] != 'get_product_count') {
    die(json_encode(['success' => false, 'error' => 'Invalid request']));
}

CModule::IncludeModule('iblock');

function getFilteredProductCount($filter) {
    $arFilter = [
        'IBLOCK_ID' => LANGUAGE_ID == 'en' ? 17 : 2,
        'ACTIVE' => 'Y',
        'CHECK_PERMISSIONS' => 'Y'
    ];
    
    if (!empty($filter['s'])) {
        $arFilter['NAME'] = '%' . $filter['s'] . '%';
    }
    
    if (!empty($filter['stock']) && $filter['stock'] == 'Y') {
        $arFilter['!CATALOG_QUANTITY'] = 0;
    }
    
    if (!empty($filter['new']) && $filter['new'] == 'on') {
        $arFilter['PROPERTY_NEWPRODUCT_VALUE'] = 'да';
    }
	
	if (!empty($filter['archive']) && $filter['archive'] == 'on') {
        $arFilter['PROPERTY_ARCHIVE_VALUE'] = 'да';
    }
	
	
	if (!empty($filter['man']) && $filter['man'] == 'on' ||
	!empty($filter['woman']) && $filter['woman'] == 'on' ||
	!empty($filter['limited']) && $filter['limited'] == 'on' ||
	!empty($filter['titan']) && $filter['titan'] == 'on' ||
	!empty($filter['mechan']) && $filter['mechan'] == 'on' ||
	!empty($filter['chrono']) && $filter['chrono'] == 'on' ||
	!empty($filter['winding']) && $filter['winding'] == 'on'	
	) {
        
		$cats = [];
		if (!empty($filter['man']) && $filter['man'] == 'on') {
			$cats[] = 'Мужские';
		}
		if (!empty($filter['woman']) && $filter['woman'] == 'on') {
			$cats[] = 'Женские';
		}
		if (!empty($filter['limited']) && $filter['limited'] == 'on') {
			$cats[] = 'Автоматические';
		}
		if (!empty($filter['titan']) && $filter['titan'] == 'on') {
			$cats[] = 'Титановые';
		}
		if (!empty($filter['mechan']) && $filter['mechan'] == 'on') {
			$cats[] = 'Механические';
		}
		if (!empty($filter['chrono']) && $filter['chrono'] == 'on') {
			$cats[] = 'Хронограф';
		}
		if (!empty($filter['winding']) && $filter['winding'] == 'on') {
			$cats[] = 'Limited edition';
		}
		
		$arFilter['PROPERTY_CATEGORY_VALUE'] = $cats;
		
    }
	
    
    if (!empty($filter['fmprice'])) {
        $price = floatval($filter['fmprice']);
        if ($price > 0) {
            $arFilter['>=CATALOG_PRICE_1'] = $price;
        }
    }
    
    if (!empty($filter['collection'])) {
        $collectionId = intval($filter['collection']);
        if ($collectionId > 0) {
            $subSections = getSectionChildrenIds($collectionId);
            $arFilter['SECTION_ID'] = $subSections;
        }
    }
    
    if (!empty($filter['model'])) {
        $modelId = intval($filter['model']);
        if ($modelId > 0) {
            $arFilter['SECTION_ID'] = $modelId;
        }
    }
    
    $dbItems = CIBlockElement::GetList(
        [],
        $arFilter,
        [],
        false,
        ['ID']
    );
    
    return $dbItems;
}

function getSectionChildrenIds($sectionId) {
    $childrenIds = [$sectionId];
    
    $dbSections = CIBlockSection::GetList(
        ['LEFT_MARGIN' => 'ASC'],
        [
            'IBLOCK_ID' => LANGUAGE_ID == 'en' ? 17 : 2,
            'SECTION_ID' => $sectionId,
            'ACTIVE' => 'Y'
        ],
        false,
        ['ID']
    );
    
    while ($arSection = $dbSections->Fetch()) {
        $childrenIds[] = $arSection['ID'];
    }
    
    return $childrenIds;
}

function getProductsText($count, $lang = 'ru') {
    if ($lang == 'en') {
        return $count . ' product' . ($count != 1 ? 's' : '') . ' found';
    }
    
    $lastDigit = $count % 10;
    $lastTwoDigits = $count % 100;
    
    if ($lastTwoDigits >= 11 && $lastTwoDigits <= 19) {
        $word = 'товаров';
    } else {
        switch ($lastDigit) {
            case 1:
                $word = 'товар';
                break;
            case 2:
                $word = 'товара';
                break;
            case 3:
                $word = 'товара';
                break;
            case 4:
                $word = 'товара';
                break;
            default:
                $word = 'товаров';
        }
    }
    
    return 'найдено ' . $count . ' ' . $word;
}

try {
    $filter = [
        's' => $_POST['s'] ?? '',
        'stock' => $_POST['stock'] ?? '',
        'fmprice' => $_POST['fmprice'] ?? '',
        'new' => $_POST['new'] ?? '',
		'archive' => $_POST['archive'] ?? '',
        'collection' => $_POST['collection'] ?? '',
        'model' => $_POST['model'] ?? '',
		'man' => $_POST['man'] ?? '',
		'woman' => $_POST['woman'] ?? '',
		'limited' => $_POST['limited'] ?? '',
		'titan' => $_POST['titan'] ?? '',
		'mechan' => $_POST['mechan'] ?? '',
		'chrono' => $_POST['chrono'] ?? '',
		'winding' => $_POST['winding'] ?? ''
    ];
    
    $count = getFilteredProductCount($filter);
    
    echo json_encode([
        'success' => true,
        'count' => $count,
        'text' => getProductsText($count, LANGUAGE_ID),
        'filter' => $filter
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}