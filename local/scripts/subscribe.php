<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    
    $_POST = json_decode(file_get_contents('php://input'), true);
	global $USER; 

    if($_POST && CModule::IncludeModule("iblock")) {
        $el = new CIBlockElement;

 		$arFilter = Array("IBLOCK_ID" => 6, "NAME" => $_POST['email']);
       	$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), Array());
        $itemCount = $res->SelectedRowsCount();
        
        if($itemCount){			
			
			$cUser = $USER::GetList(
				$by="ID",
				$order="desc",
				[
					'EMAIL' => $_POST["email"]
				],
				[
					'SELECT' => [
						'ID'
					]
				]
			)->fetch();
			
			$user = new CUser;
			$userID = $cUser['ID'];
			
			$userGroups = CUser::GetUserGroup($userID);
			
			if(!in_array(9, $userGroups)){		
			
				$userGroups[] = 9;
				
				CEvent::Send("CONF_SUB", SITE_ID, array(
					"EMAIL" => $_POST["email"]
				));
				
				$user->SetUserGroup($userID, $userGroups);
			}
			
            echo "error";
        }else{
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(),
				"IBLOCK_SECTION_ID" => false,
				"IBLOCK_ID"      => 6,
				"NAME"           => $_POST["email"],
				"ACTIVE"         => "Y"
			);

			CEvent::Send("CONF_SUB", SITE_ID, array(
				"EMAIL" => $_POST["email"]
			));	

			$PRODUCT_ID = $el->Add($arLoadProductArray);
        }

    }
?>