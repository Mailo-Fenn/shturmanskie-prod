<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */

global $LENGUAGE;

if ($arParams["SET_TITLE"] == "Y") {
	$APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}
?>

<section class="success">
	<div class="container bottom-min form-padding first">
		<div class="success-wrapper center">
			<h1 class="section-title">
				<? if ($LENGUAGE == 'ru'): ?>
					Спасибо за покупку! Ваш заказ<br />подтвержден.
				<? else: ?>
					Thank you for your purchase! Your order<br />has been confirmed.
				<? endif; ?>
			</h1>

			<p>
				<? if ($LENGUAGE == 'ru'): ?>
					Ваш заказ успешно подтвержден! Мы рады приветствовать Вас в семье<br />
					Штурманских. Теперь вы в команде исследователей космоса!
				<? else: ?>
					 Thank you very much for your order.<br>
                        We will confirm it asap and will send you our invoice from our distribution center in Europe, MB European Distribution Company.
						<div style="color:red; font-weight:bold;">
                        A PayPal link from our European distribution company will be sent to your email shortly.
                    </div> 
				<? endif; ?>
			</p>

			<div class="pay_container">
				<? if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y'): ?>
					<? if (!empty($arResult["PAYMENT"])): ?>
						<? foreach ($arResult["PAYMENT"] as $payment): ?>
							<? if ($payment["PAID"] != 'Y'): ?>
								<? if (
									!empty($arResult['PAY_SYSTEM_LIST'])
									&& array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
								): ?>
									<? $arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]]; ?>
									<? if (empty($arPaySystem["ERROR"])): ?>
										<!-- <div class="pay_name"><?= Loc::getMessage("SOA_PAY") ?></div> -->
										<!-- <?= CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0\" style=\"width:100px\"", "", false) ?> -->
										<!-- <div class="paysystem_name"><?= $arPaySystem["NAME"] ?></div> -->
										<? if ($arPaySystem["ACTION_FILE"] <> '' && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
											<?
											$orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
											$paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
											?>
											<script>
												window.open('<?= $arParams["PATH_TO_PAYMENT"] ?>?ORDER_ID=<?= $orderAccountNumber ?>&PAYMENT_ID=<?= $paymentAccountNumber ?>');
											</script>
											<?= Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . $orderAccountNumber . "&PAYMENT_ID=" . $paymentAccountNumber)) ?>
											<? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
												<?= Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . $orderAccountNumber . "&pdf=1&DOWNLOAD=Y")) ?>
											<? endif ?>
										<? else: ?>
											<?= $arPaySystem["BUFFERED_OUTPUT"] ?>
										<? endif ?>
									<? else: ?>
										<span style="color:red;"><?= Loc::getMessage("SOA_ORDER_PS_ERROR") ?></span>
									<? endif; ?>
								<? endif; ?>
							<? endif; ?>
						<? endforeach; ?>
					<? endif; ?>
				<? else: ?>
					<strong><?= $arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] ?></strong>
				<? endif; ?>
			</div>

			<svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0_101_4179)">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M60 120C93.1373 120 120 93.1373 120 60C120 26.8629 93.1373 0 60 0C26.8629 0 0 26.8629 0 60C0 93.1373 26.8629 120 60 120ZM88.3522 47.1025C90.549 44.9058 90.549 41.3442 88.3522 39.1475C86.1555 36.9508 82.5945 36.9508 80.3978 39.1475L50.625 68.92L39.6025 57.8975C37.4058 55.7008 33.8442 55.7008 31.6475 57.8975C29.4508 60.0942 29.4508 63.6558 31.6475 65.8525L46.6475 80.8522C48.8442 83.049 52.4058 83.049 54.6025 80.8522L88.3522 47.1025Z"
						fill="#FF662C" />
				</g>
				<defs>
					<clipPath id="clip0_101_4179">
						<rect width="120" height="120" fill="white" />
					</clipPath>
				</defs>
			</svg>
		</div>
	</div>
</section>