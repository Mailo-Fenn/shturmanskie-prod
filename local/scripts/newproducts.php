<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    global $USER; 

    if($USER->IsAuthorized() && CModule::IncludeModule("iblock")) {
        $user = new CUser;
        $userID = $USER->GetID();

        $userGroups = CUser::GetUserGroup($USER->GetID());

        if(in_array(10, $userGroups)){
            $userGroups = array_diff($userGroups, array(10));
        }else{
            $userGroups[] = 10;

			CEvent::Send("CONF_SUB", SITE_ID, array(
				"EMAIL" => $USER->GetEmail()
			));	
        }

        $user->SetUserGroup($userID, $userGroups);
    }