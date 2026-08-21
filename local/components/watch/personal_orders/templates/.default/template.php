<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    use Bitrix\Catalog\Model\Price;

    global $LENGUAGE;
    require(__DIR__."/../../lang/$LENGUAGE/template.php");   
	
    global $USER;
    $userId = $USER->GetID();
	

    // Получаем список заказов текущего пользователя
    $arOrders = [];

    $F_COUNT = 0;
    $N_COUNT = 0;
    $RETURN_COUNT = 0;

    $status_sticker = [
        'F' => '<img src="/images/delivered.svg" alt="" />',
        'N' => '<img src="/images/in_progress.svg" alt="" />',
        'P' => '<img src="/images/in_progress.svg" alt="" />',
        'RETURN' => '<img src="/images/return.svg" alt="" />',
    ];

    $status_color = [
        'F' => '#15cf74',
        'N' => '#ff662c',
        'P' => '#ff662c',
        'RETURN' => '#e02b30',
    ];

    // <option value="F" selected="">Выполнен</option>
    // <option value="N">Принят, ожидается оплата</option>
    //<option value="P">Оплачен, формируется к отправке</option>

    if (\Bitrix\Main\Loader::includeModule('sale')) {
        $orderRes = \Bitrix\Sale\Order::getList([
            'filter' => ['USER_ID' => $userId],
            'order' => ['DATE_INSERT' => 'DESC'],
        ]);
        while ($arOrder = $orderRes->fetch()) {
            // Получаем пользовательские поля заказа
            $order = \Bitrix\Sale\Order::load($arOrder['ID']);
            $propertyCollection = $order->getPropertyCollection();
            $arOrder['USER_PROPS'] = [];
            foreach ($propertyCollection as $property) {
                $arOrder['USER_PROPS'][$property->getField('CODE')] = $property->getValue();
            }

            if($arOrder['STATUS_ID'] == 'F'){
                $F_COUNT++;
            }elseif($arOrder['STATUS_ID'] == 'N'){
                $N_COUNT++;
            }else{
                $arOrder['STATUS_ID'] = 'RETURN';
                $RETURN_COUNT++;
            }

            // Получаем товары в заказе
            $arOrder['ITEMS'] = [];
            $basket = $order->getBasket();
            foreach ($basket as $basketItem) {
                $productId = $basketItem->getProductId();

                $arProduct = [];
                
                if (\Bitrix\Main\Loader::includeModule('iblock')) {
                    $res = CIBlockElement::GetList(
                        [],
                        ['ID' => $productId],
                        false,
                        false,
                        ['ID', 'NAME', 'DETAIL_PICTURE', 'PROPERTY_NAME_ENG']
                    );
                
                    if ($ob = $res->GetNext()) {
                        $arProduct['NAME_ENG'] = $ob['PROPERTY_NAME_ENG_VALUE'];
                        if ($ob['DETAIL_PICTURE']) {
                            $arProduct['DETAIL_PICTURE_SRC'] = CFile::GetPath($ob['DETAIL_PICTURE']);
                        } else {
                            $arProduct['DETAIL_PICTURE_SRC'] = '';
                        }
                    }
                }


                $arOrder['ITEMS'][] = [
                    'PRODUCT_ID' => $productId,
                    'NAME' => $basketItem->getField('NAME'),
                    'QUANTITY' => $basketItem->getQuantity(),
                    'PRICE' => $basketItem->getPrice(),
                    'CURRENCY' => $basketItem->getCurrency(),
                    'SUM' => $basketItem->getFinalPrice(),
                    'LINK' => $basketItem->getField('DETAIL_PAGE_URL'),
                    'NAME_ENG' => $arProduct['NAME_ENG'] ?? '',
                    'DETAIL_PICTURE_SRC' => $arProduct['DETAIL_PICTURE_SRC'] ?? '',
                ];

            }
            $arOrders[] = $arOrder;
        }
    }
?>

<? if(count($arOrders) > 0){ ?>

    <section class="account-orders">
        <div class="container form">
            <div class="account-orders__header">
                <div>
                    <a id="ALL" class="active"><?=$MESS['ALL']?> (<?= count($arOrders) ?>)</a>
                    <a id="F"><?=$MESS['F']?> (<?= $F_COUNT ?>)</a>
                    <a id="RETURN"><?=$MESS['RETURN']?> (<?= $RETURN_COUNT ?>)</a>   
                    <a id="N"><?=$MESS['N']?> (<?= $N_COUNT ?>)</a>
                </div>
            </div>

            <? foreach($arOrders as $arOrder){ ?>
                <div class="account-orders__item" type="<?=$arOrder['STATUS_ID']?>">
                    <div class="account-orders__item-header">
                        <div>
                            <span class="account-orders__item-label"><?=$MESS['ORDER_TIME']?></span><br/>
                            <?=date('d.m.Y - H:i', strtotime($arOrder['DATE_INSERT'])); ?>
                        </div> 
                        <div>
                            <span class="account-orders__item-label"><?=$MESS['RECIPIENT']?></span><br/>
                            <?=$arOrder['USER_PROPS']['FIO']; ?>
                        </div>
                        <div>
                            <span class="account-orders__item-label"><?=$MESS['DELIVERY']?></span><br/>        
                            <?=$LENGUAGE == 'ru' ? 'Курьером' : 'Courier'; ?>
                        </div>
                        <div>
                            <span><?=$MESS['ORDER_NUMBER']?> #<?= $arOrder['ID'] ?></span><br/>
                            <div class="account-orders__item-header-total">
                                <?=$MESS['TOTAL']; ?>:
                                <span><?=number_format($arOrder['PRICE'], 2, '.', '') ?> <?=$LENGUAGE == 'ru' ? '₽' : '€'?></span>
                            </div>
                        </div>
                    </div>
                    <div class="account-orders__item-body">
                        <? foreach($arOrder['ITEMS'] as $arItem){ ?>
                            <div>
                                <div class="account-orders__item-body__image">
                                    <a href="<?=$arItem['LINK']?>">
                                        <img src="<?=$arItem['DETAIL_PICTURE_SRC']?>" alt="" />
                                    </a>
                                </div>
                                <div class="account-orders__item-body__info">
                                    <div>
                                        <h3><a href="<?=$arItem['LINK']?>"><?=$LENGUAGE == 'ru' ? $arItem['NAME'] : $arItem['NAME_ENG']?></a></h3>
                                        <p><?=number_format($arItem['PRICE'], 2, '.', '') ?> <?=$LENGUAGE == 'ru' ? '₽' : '€'?><span> x <?=$arItem['QUANTITY']?></span></p>
                                    </div>
                                </div>
                                <div class="account-orders__item-body__status">
                                    <div class="account-orders__item-body__status-wrapper">
                                        <div>
                                            <h3 style="color: <?=$status_color[$arOrder['STATUS_ID']]; ?>">
                                                <?=$status_sticker[$arOrder['STATUS_ID']]; ?>
                                                <?=$MESS[$arOrder['STATUS_ID']]; ?>
                                            </h3>
                                            <? if($arOrder['STATUS_ID'] != 'F' && $arOrder['STATUS_ID'] != 'N'){ ?>
                                                <p><?=$MESS['RETURN_TEXT']; ?>: <?=$arItem['SUM']?> <?=$LENGUAGE == 'ru' ? '₽' : '€'?></p>
                                            <? } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </div> 
				<?			
				if($arOrder['STATUS_ID'] != 'F' && $arOrder['STATUS_ID'] != 'RETURN') {	
			
				?>
					
					<div class="support_btns" type="<?=$arOrder['STATUS_ID']?>">
						<?
						if($arOrder['USER_PROPS']['IS_CANCEL_ORDER'] != 'Y' && $arOrder['STATUS_ID'] != 'DT' && $arOrder['STATUS_ID'] != 'DS' && $arOrder['STATUS_ID'] != 'DF' && $arOrder['STATUS_ID'] != 'RETURN') {					
						?>
						<a class="cancel_order" data-id="<?=$arOrder['ID']?>"><?=$MESS['CANCEL_ORDER']?></a>
						<?
						}
						else {
						?>
						<a class="cancel_order noactive"><?=$MESS['CANCEL_ORDER_DONE']?></a>
						<?
						}
						
						if(isset($arOrder['TRACKING_NUMBER']) && $arOrder['TRACKING_NUMBER'] != '') {
						?>
						<a class="where_status" href="https://www.cdek.ru/ru/tracking/?order_id=<?=$arOrder['TRACKING_NUMBER']?>" target="_blank"><?=$MESS['WHERE_STATUS']?></a>
						<?
						}
						?>
					<?

					?>						
						<div class="clear"></div>
					</div>
					
				<?
				}	
				?>
				
				
            <? } ?>
        </div>
    </section>
<? }else{ ?>
    <div class="blank-item">
        <h2><?=$MESS['BLANK_TITLE']?></h2>
        <p><?=$MESS['BLANK_TEXT']?></p>    
        <a href="/catalog/"><?=$MESS['BLANK_BUTTON']?></a>
    </div>
<? } ?>