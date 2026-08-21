<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

global $APPLICATION;

Loader::includeModule('iblock');

if(!function_exists('viewArray')){
	function viewArray($arr) {
		
		$keys = array_keys($arr);
		$kLen = count($keys);
		
		for($i = 0; $i < $kLen; $i++) {
			
			echo '['.$keys[$i].'] - '.$arr[$keys[$i]].'<br />';
			
		}
		
		echo '<hr />';
		
	}
}


$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE");
$arFilter = Array("IBLOCK_ID" => 2, "ID"=> 3946);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
if($ob = $res->GetNext())
{
	
	$preview = CFile::GetFileArray($ob["PREVIEW_PICTURE"]);	
	$preview_id = $ob["PREVIEW_PICTURE"];
	
	if(!isset($preview['WIDTH']) && !isset($preview['WIDTH'])) {
		
		$preview = CFile::GetFileArray($ob["DETAIL_PICTURE"]);	
		$preview_id = $ob["DETAIL_PICTURE"];
		
	}
	
	

	
	
	
	if(CFile::GetPath($ob["PREVIEW_PICTURE"]) != '' && isset($preview['WIDTH']) && isset($preview['HEIGHT']) && ($preview['WIDTH'] > 600 || $preview['HEIGHT'] > 600)) {
		
		$el = new CIBlockElement;
		$subFields = [];
		$subFields['PREVIEW_PICTURE'] = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($ob["PREVIEW_PICTURE"]));
		$subFields['DETAIL_PICTURE'] = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($ob["DETAIL_PICTURE"]));
		
		
		viewArray($subFields['PREVIEW_PICTURE']);
		viewArray($subFields['DETAIL_PICTURE']);
		//$subFields['PREVIEW_PICTURE']["del"] = "Y";
		$el->Update(3949, $subFields, false, false, true);
		
		/*$file = CFile::ResizeImageGet($preview_id, array('width'=>600, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true);   
		
		$el = new CIBlockElement;
		$subFields = [];
		$subFields['PREVIEW_PICTURE'] = CFile::MakeFileArray($file['src']);
		$subFields['PREVIEW_PICTURE']["del"] = "Y";
		
		
        $el->Update(3949, $subFields);
		
		*/
		
	
	}
	
	
	exit;
	
	$detail = CFile::GetFileArray($ob["DETAIL_PICTURE"]);
	
	if(isset($detail['WIDTH']) && isset($detail['HEIGHT']) && ($detail['WIDTH'] > 1100 || $detail['HEIGHT'] > 1100)) {
		echo $ob["DETAIL_PICTURE"];
		echo '<hr />';
		$file = CFile::ResizeImageGet($ob["DETAIL_PICTURE"], array('width'=>1100, 'height'=>1100), BX_RESIZE_IMAGE_PROPORTIONAL, true);   
		$el = new CIBlockElement;
		$subFields = [];
		$subFields['DETAIL_PICTURE'] = CFile::MakeFileArray($file['src']);
		$subFields['DETAIL_PICTURE']["del"] = "Y";
        $el->Update(3949, $subFields);
		viewArray($subFields['DETAIL_PICTURE']);
	}
	
}




//AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("IBChanger", "OnAfterIBlockElementUpdate")); 
//AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("IBChanger", "OnAfterIBlockElementUpdate"));

	

/*class IBChanger { 

    public static $disableHandler = false;	
	
	public static function OnAfterIBlockElementUpdate(&$arFields) {

		if (self::$disableHandler == $arFields['ID'])
        return;
	
		global $DB;
		
		$startFields = $arFields;
		
		self::$disableHandler = $startFields['ID'];

		//$f = fopen($_SERVER['DOCUMENT_ROOT'].'/mmm.txt', "a+");
		
		if(($arFields['IBLOCK_ID'] == 2 || $arFields['IBLOCK_ID'] == 17) && $arFields['ID'] == 3949) {
			
			//fwrite($f, $arFields['IBLOCK_ID']."\r\n");
			
			$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE");
			$arFilter = Array("IBLOCK_ID" => $arFields['IBLOCK_ID'], "ID"=> $arFields['ID']);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
			if($ob = $res->GetNext())
			{
				//fwrite($f, $arFields['ID']."\r\n");				
				
				if((int) $ob["PREVIEW_PICTURE"] > 0 || (int) $ob["DETAIL_PICTURE"] > 0) {
					
					if ((int) $ob["PREVIEW_PICTURE"] > 0) {
						
						$preview = CFile::GetFileArray($ob["PREVIEW_PICTURE"]);	
						$preview_id = $ob["PREVIEW_PICTURE"];
						
						if(!isset($preview['WIDTH']) && !isset($preview['HEIGHT']) && (int) $ob["DETAIL_PICTURE"] > 0) {
							
							$preview = CFile::GetFileArray($ob["DETAIL_PICTURE"]);
							$preview_id = $ob["DETAIL_PICTURE"];							
							
						}							
						
					}
					else {
						
						if(!isset($preview['WIDTH']) && !isset($preview['HEIGHT']) && (int) $ob["DETAIL_PICTURE"] > 0) {
							
							$preview = CFile::GetFileArray($ob["DETAIL_PICTURE"]);
							$preview_id = $ob["DETAIL_PICTURE"];							
							
						}	
						
					}
					
					
					if(isset($preview['WIDTH']) && isset($preview['HEIGHT']) && ($preview['WIDTH'] > 710 || $preview['HEIGHT'] > 710)) {
						//fwrite($f, 'preview var'."\r\n");
						$file = CFile::ResizeImageGet($preview_id, array('width'=>710, 'height'=>710), BX_RESIZE_IMAGE_PROPORTIONAL, true);   
						$el = new CIBlockElement;
						$subFields = [];
						$subFields['PREVIEW_PICTURE'] = CFile::MakeFileArray($file['src']);
						$subFields['PREVIEW_PICTURE']["del"] = "Y";						
						$el->Update($arFields['ID'], $subFields);
						
						//fwrite($f, $file['src']."\r\n");						
						
					}
				
				}				
				
				if((int) $ob["DETAIL_PICTURE"] > 0) {
				
					$detail = CFile::GetFileArray($ob["DETAIL_PICTURE"]);
					
					if(isset($detail['WIDTH']) && isset($detail['HEIGHT']) && ($detail['WIDTH'] > 1100 || $detail['HEIGHT'] > 1100)) {
						//fwrite($f, 'detail var'."\r\n");
						$file = CFile::ResizeImageGet($ob["DETAIL_PICTURE"], array('width'=>1100, 'height'=>1100), BX_RESIZE_IMAGE_PROPORTIONAL, true);   
						$el = new CIBlockElement;
						$subFields = [];
						$subFields['DETAIL_PICTURE'] = CFile::MakeFileArray($file['src']);
						$subFields['DETAIL_PICTURE']["del"] = "Y";
						$el->Update($arFields['ID'], $subFields);
						
						//fwrite($f, $file['src']."\r\n");
						
					}
				
				}
				
			}
			
		}
	
	//fwrite($f, "\r\n----------\r\n\r\n");
		//fclose($f);
	
	}	
	
	
	
	
	
	
} 
*/



?>