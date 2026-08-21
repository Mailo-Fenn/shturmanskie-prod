<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    global $USER; 

    if($USER->IsAuthorized() && CModule::IncludeModule("iblock")) {
        $user = new CUser;
        $userID = $USER->GetID();

        $userGroups = CUser::GetUserGroup($USER->GetID());

        if(in_array(9, $userGroups)){
            $userGroups = array_diff($userGroups, array(9));
        }else{
            $userGroups[] = 9;
            
			$el = new CIBlockElement;
		
			$arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(),
				"IBLOCK_SECTION_ID" => false,
				"IBLOCK_ID"      => 6,
				"NAME"           => $USER->GetEmail(),
				"ACTIVE"         => "Y"
			);
			
			$PRODUCT_ID = $el->Add($arLoadProductArray);
			
			CEvent::Send("CONF_SUB", SITE_ID, array(
				"EMAIL" => $USER->GetEmail()
			));	
        }

        $user->SetUserGroup($userID, $userGroups);
    }