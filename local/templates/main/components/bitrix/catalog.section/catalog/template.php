<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

global $LENGUAGE;

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
// $this->addExternalCss('/bitrix/css/main/bootstrap.css');

if (!empty($arResult['NAV_RESULT'])) {
	$navParams = array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
} else {
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'USE_PAGINATION_CONTAINER' => $showTopPager || $showBottomPager,
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$arParams['~MESS_BTN_BUY'] = ($arParams['~MESS_BTN_BUY'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = ($arParams['~MESS_BTN_DETAIL'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = ($arParams['~MESS_BTN_COMPARE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = ($arParams['~MESS_BTN_SUBSCRIBE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = ($arParams['~MESS_BTN_ADD_TO_BASKET'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = ($arParams['~MESS_NOT_AVAILABLE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_NOT_AVAILABLE_SERVICE'] = ($arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '') ?: Loc::getMessage('CP_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE_SERVICE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = ($arParams['~MESS_SHOW_MAX_QUANTITY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');

$arParams['MESS_BTN_LAZY_LOAD'] = $arParams['MESS_BTN_LAZY_LOAD'] ?: Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');

$obName = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-' . $navParams['NavNum'];

if ($showTopPager) {
	?>
	<div data-pagination-num="<?= $navParams['NavNum'] ?>">
		<!-- pagination-container -->
		<?= $arResult['NAV_STRING'] ?>
		<!-- pagination-container -->
	</div>
	<?
}

if (!isset($arParams['HIDE_SECTION_DESCRIPTION']) || $arParams['HIDE_SECTION_DESCRIPTION'] !== 'Y') {
	?>
	<div class="bx-section-desc bx-<?= $arParams['TEMPLATE_THEME'] ?>">
		<p class="bx-section-desc-post"><?= $arResult['DESCRIPTION'] ?? '' ?></p>
	</div>
	<?
}
?>

<?php
$categories = [];
$arFilter = array('IBLOCK_ID' => $LENGUAGE == "ru" ? 2 : 17, 'ACTIVE' => 'Y');
$arSelect = array('*');
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, $arSelect);
while ($arSection = $rsSections->GetNext()) {
	$categories[] = array(
		'name' => $arSection['NAME'],
		'code' => $arSection['CODE'],
		'id' => $arSection['ID'],
		'parent_id' => $arSection['IBLOCK_SECTION_ID'],
	);
}

$groupedCategories = [];
foreach ($categories as $category) {
	$parentId = $category['parent_id'] ?? 0;
	if (!isset($groupedCategories[$parentId])) {
		$groupedCategories[$parentId] = [];
	}

	$name = explode('#', $category['name']);

	$groupedCategories[$parentId][] = array(
		'id' => $category['id'],
		'code' => $category['code'],
		'name' => $LENGUAGE == 'ru' ? $name[0] : $name[1],
		'parent_id' => $category['parent_id'],
	);
}

?>

<script>
	const groupedCategories = <?= json_encode($groupedCategories); ?>;
</script>


<div class="catalog-section bx-<?= $arParams['TEMPLATE_THEME'] ?>" data-entity="<?= $containerName ?>">
	<div class="catalog-list__filter">
		<div class="c1">
			<div class="catalog-list__filter-item" id="filter-sort">
				<?= $LENGUAGE == 'ru' ? 'Цена' : 'Price'; ?>
				<svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1.5L8 8.5L15 1.5" stroke="<?= $_GET['fmprice'] ? "#FF662C" : "#121212"; ?>"
						stroke-width="2" />
				</svg>
				<svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 8.5L8 1.5L1 8.5" stroke="<?= !$_GET['fmprice'] ? "#FF662C" : "#121212"; ?>"
						stroke-width="2" />
				</svg>
			</div>
			<div class="catalog-list__filter-item" id="filter-on-stock"
				style="<?= $_GET['stock'] ? 'color: #FF662C;' : ''; ?>">
				<?= $LENGUAGE == 'ru' ? 'В наличии' : 'On stock'; ?>
			</div>
		</div>

		<div class="c2">
			<div class="catalog-list__filter-item catalog-list__filter-search">
				<?= $LENGUAGE == 'ru' ? 'Фильтры' : 'Filters'; ?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M6 17C7.10457 17 8 17.8954 8 19C8 20.1046 7.10457 21 6 21C4.89543 21 4 20.1046 4 19C4 17.8954 4.89543 17 6 17Z"
						fill="black" fill-opacity="0.15" />
					<path
						d="M18 10C19.1046 10 20 10.8954 20 12C20 13.1046 19.1046 14 18 14C16.8954 14 16 13.1046 16 12C16 10.8954 16.8954 10 18 10Z"
						fill="black" fill-opacity="0.15" />
					<path
						d="M14 5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5C10 6.10457 10.8954 7 12 7C13.1046 7 14 6.10457 14 5Z"
						fill="black" fill-opacity="0.15" />
					<path
						d="M4 5L10 5M10 5C10 6.10457 10.8954 7 12 7C13.1046 7 14 6.10457 14 5M10 5C10 3.89543 10.8954 3 12 3C13.1046 3 14 3.89543 14 5M14 5L20 5M4 12L16 12M16 12C16 13.1046 16.8954 14 18 14C19.1046 14 20 13.1046 20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12ZM8 19L20 19M8 19C8 17.8954 7.10457 17 6 17C4.89543 17 4 17.8954 4 19C4 20.1046 4.89543 21 6 21C7.10457 21 8 20.1046 8 19Z"
						stroke="#121212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</div>

			<div class="catalog-list__filter-popup">
				<form action="">
					<input type="hidden" name="s" value="<?= $_GET['s'] ?>" />
					<input type="hidden" name="stock" value="<?= $_GET['stock'] ?>" />
					<input type="hidden" name="fmprice" value="<?= $_GET['fmprice'] ?>" />

					<div class="radio">
						<label>
							<input type="checkbox" name="new" <?= $_GET['new'] ? 'checked' : ''; ?> />
							<?= $LENGUAGE == 'ru' ? 'Только новые' : 'Only new'; ?>
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="checkbox" name="man" <?= $_GET['man'] ? 'checked' : ''; ?> />
							<?= $LENGUAGE == 'ru' ? 'Мужские' : 'Man'; ?>
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="checkbox" name="woman" <?= $_GET['woman'] ? 'checked' : ''; ?> />
							<?= $LENGUAGE == 'ru' ? 'Женские' : 'Woman'; ?>
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="checkbox" name="limited" <?= $_GET['limited'] ? 'checked' : ''; ?> />
							<?= $LENGUAGE == 'ru' ? 'Ограниченный выпуск' : 'Limited edition'; ?>
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="checkbox" name="titan" <?= $_GET['titan'] ? 'checked' : ''; ?> />
							<?= $LENGUAGE == 'ru' ? 'Титановые' : 'Titan'; ?>
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="checkbox" name="mechan" <?= $_GET['mechan'] ? 'checked' : ''; ?> />
							<?= $LENGUAGE == 'ru' ? 'Механические' : 'Mechanical'; ?>
						</label>
					</div>					
					<div class="radio">
						<label>
							<input type="checkbox" name="chrono" <?= $_GET['chrono'] ? 'checked' : ''; ?> />
							<?= $LENGUAGE == 'ru' ? 'Хронограф' : 'Chronograph'; ?>
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="checkbox" name="winding" <?= $_GET['winding'] ? 'checked' : ''; ?> />
							<?= $LENGUAGE == 'ru' ? 'Автоподзавод' : 'Automatic winding'; ?>
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="checkbox" name="archive" <?= $_GET['archive'] ? 'checked' : ''; ?> />
							<?= $LENGUAGE == 'ru' ? 'Архив' : 'Archive'; ?>
						</label>
					</div>					
					<label class="select type-select">
						<span><?= $LENGUAGE == 'ru' ? 'Коллекции' : 'Collections'; ?></span>
						<select name="collection" id="collection-select">
							<option value="" <?= $_GET['collection'] == '' ? 'selected' : ''; ?>>
								<?= $LENGUAGE == 'ru' ? 'Все' : 'All'; ?>
							</option>
							<?php foreach ($categories as $category) { ?>
								<?php if (!$category['parent_id']) { ?>
									<? $name = explode('#', $category['name']); ?>
									<option value="<?= $category['id'] ?>" <?= $_GET['collection'] == $category['id'] ? 'selected' : ''; ?>><?= $LENGUAGE == 'ru' ? $name[0] : $name[1]; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</label>
					<label class="select model-list">
						<span><?= $LENGUAGE == 'ru' ? 'Модель' : 'Model'; ?></span>
						<select name="model" all="<?= $LENGUAGE == 'ru' ? 'Все' : 'All'; ?>">
							<option value="" <?= $_GET['model'] == '' ? 'selected' : ''; ?>>
								<?= $LENGUAGE == 'ru' ? 'Все' : 'All'; ?>
							</option>
							<?php foreach ($groupedCategories[$_GET['collection']] as $category) { ?>
								<? $name = explode('#', $category['name']); ?>
								<option value="<?= $category['id'] ?>" <?= $_GET['model'] == $category['id'] ? 'selected' : ''; ?>><?= $LENGUAGE == 'ru' ? $category['name'] : $category['name']; ?></option>
							<?php } ?>
						</select>
					</label>

					<div class="catalog-list__filter-popup__btns">
						<?php
						$url = $_SERVER['REQUEST_URI'];
						$url = explode('?', $url);
						$url = $url[0];
						?>
						<a href="<?= $url; ?>"><?= $LENGUAGE == 'ru' ? 'Сбросить' : 'Reset'; ?></a>

						<div class="button_submit">
							<button><?= $LENGUAGE == 'ru' ? 'Найти' : 'Find'; ?></button>
							<p></p>
						</div>
					</div>
					</div>
				</form>
			</div>
		</div>
		<?
		if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS'])) {
			$generalParams = [
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
				'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
				'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
				'MESS_SHOW_MAX_QUANTITY' => $arParams['~MESS_SHOW_MAX_QUANTITY'],
				'MESS_RELATIVE_QUANTITY_MANY' => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
				'MESS_RELATIVE_QUANTITY_FEW' => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
				'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
				'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
				'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
				'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'],
				'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
				'COMPARE_PATH' => $arParams['COMPARE_PATH'],
				'COMPARE_NAME' => $arParams['COMPARE_NAME'],
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
				'LABEL_POSITION_CLASS' => $labelPositionClass,
				'DISCOUNT_POSITION_CLASS' => $discountPositionClass,
				'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
				'SLIDER_PROGRESS' => $arParams['SLIDER_PROGRESS'],
				'~BASKET_URL' => $arParams['~BASKET_URL'],
				'~ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
				'~BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
				'~COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
				'~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
				'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
				'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
				'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
				'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY'],
				'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
				'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
				'MESS_BTN_COMPARE' => $arParams['~MESS_BTN_COMPARE'],
				'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
				'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
			];

			$areaIds = [];
			$itemParameters = [];

			foreach ($arResult['ITEMS'] as $item) {
				$uniqueId = $item['ID'] . '_' . md5($this->randString() . $component->getAction());
				$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
				$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
				$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);

				$itemParameters[$item['ID']] = [
					'SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']],
					'MESS_NOT_AVAILABLE' => ($arResult['MODULES']['catalog'] && $item['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE
						? $arParams['~MESS_NOT_AVAILABLE_SERVICE']
						: $arParams['~MESS_NOT_AVAILABLE']
					),
				];
			}
			?>
			<!-- items-container -->
			<div class="catalog-list__wrapper">
				<?
				foreach ($arResult['ITEM_ROWS'] as $rowData) {
					$rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);

					$item = reset($rowItems);

					$APPLICATION->IncludeComponent(
						'bitrix:catalog.item',
						'watch',
						array(
							'RESULT' => array(
								'ITEM' => $item,
								'AREA_ID' => $areaIds[$item['ID']],
								'TYPE' => $rowData['TYPE'],
								'BIG_LABEL' => 'N',
								'BIG_DISCOUNT_PERCENT' => 'N',
								'BIG_BUTTONS' => 'N',
								'SCALABLE' => 'N'
							),
							'PARAMS' => $generalParams + $itemParameters[$item['ID']],
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					);
				}

				unset($rowItems);

				unset($itemParameters);
				unset($areaIds);

				unset($generalParams);
				?>
			</div>
			<?
		} else {
			// load css for bigData/deferred load
			$APPLICATION->IncludeComponent(
				'bitrix:catalog.item',
				'',
				array(),
				$component,
				array('HIDE_ICONS' => 'Y')
			);
		}
		?>
	</div>
	<?
	if ($showLazyLoad) {
		?>
		<div class="row bx-<?= $arParams['TEMPLATE_THEME'] ?>">
			<div class="btn btn-default btn-lg center-block" style="margin: 15px;"
				data-use="show-more-<?= $navParams['NavNum'] ?>">
				<?= $arParams['MESS_BTN_LAZY_LOAD'] ?>
			</div>
		</div>
		<?
	}

	if ($showBottomPager) {
		?>
		<div data-pagination-num="<?= $navParams['NavNum'] ?>">
			<!-- pagination-container -->
			<?= $arResult['NAV_STRING'] ?>
			<!-- pagination-container -->
		</div>
		<?
	}

	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedTemplate = $signer->sign($templateName, 'catalog.section');
	$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
	?>
	<script>
		BX.message({
			BTN_MESSAGE_BASKET_REDIRECT: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
			BASKET_URL: '<?= $arParams['BASKET_URL'] ?>',
			ADD_TO_BASKET_OK: '<?= GetMessageJS('ADD_TO_BASKET_OK') ?>',
			TITLE_ERROR: '<?= GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
			TITLE_BASKET_PROPS: '<?= GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
			TITLE_SUCCESSFUL: '<?= GetMessageJS('ADD_TO_BASKET_OK') ?>',
			BASKET_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
			BTN_MESSAGE_SEND_PROPS: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS') ?>',
			BTN_MESSAGE_CLOSE: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
			BTN_MESSAGE_CLOSE_POPUP: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP') ?>',
			COMPARE_MESSAGE_OK: '<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
			COMPARE_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
			COMPARE_TITLE: '<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
			PRICE_TOTAL_PREFIX: '<?= GetMessageJS('CT_BCS_CATALOG_PRICE_TOTAL_PREFIX') ?>',
			RELATIVE_QUANTITY_MANY: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
			RELATIVE_QUANTITY_FEW: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>',
			BTN_MESSAGE_COMPARE_REDIRECT: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
			BTN_MESSAGE_LAZY_LOAD: '<?= CUtil::JSEscape($arParams['MESS_BTN_LAZY_LOAD']) ?>',
			BTN_MESSAGE_LAZY_LOAD_WAITER: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_LAZY_LOAD_WAITER') ?>',
			SITE_ID: '<?= CUtil::JSEscape($component->getSiteId()) ?>'
		});
		var <?= $obName ?> = new JCCatalogSectionComponent({
			siteId: '<?= CUtil::JSEscape($component->getSiteId()) ?>',
			componentPath: '<?= CUtil::JSEscape($componentPath) ?>',
			navParams: <?= CUtil::PhpToJSObject($navParams) ?>,
			deferredLoad: false,
			initiallyShowHeader: '<?= !empty($arResult['ITEM_ROWS']) ?>',
			bigData: <?= CUtil::PhpToJSObject($arResult['BIG_DATA']) ?>,
			lazyLoad: !!'<?= $showLazyLoad ?>',
			loadOnScroll: !!'<?= ($arParams['LOAD_ON_SCROLL'] === 'Y') ?>',
			template: '<?= CUtil::JSEscape($signedTemplate) ?>',
			ajaxId: '<?= CUtil::JSEscape($arParams['AJAX_ID'] ?? '') ?>',
			parameters: '<?= CUtil::JSEscape($signedParams) ?>',
			container: '<?= $containerName ?>'
		});
	</script>
	<!-- component-end -->