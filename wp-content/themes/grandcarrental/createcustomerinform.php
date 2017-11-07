<?php

$ch = curl_init();
$array = json_decode($_POST['array_of_rateInfo']);
$pickuplocationinput= $_POST['locationidinput'];
$droplocationinput= $_POST['droplocationinput'];
$rentalOpt= $_POST['rentalOpt'];
$pickdateinput= explode(" ",$_POST['pickdateinput']);
$dropoffdate= explode(" ",$_POST['dropoffdate']);
$locationidinput= $_POST['locationidinput'];
$vehicletypeidinput= $_POST['vehicletypeidinput'];		
$dailyratecharge= $_POST['dailyratecharge'];
$rentalratecharge= $_POST['rentalratecharge'];
$totalforcalc = $dailyratecharge + $rentalratecharge;
$taxcharging = ($totalforcalc*16)/100;			
$retailtotal=  bcdiv($taxcharging, 1, 2);
$totalamount= $totalforcalc + $retailtotal;
curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetLocations");
$curl_post_getloc  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\"";
curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_getloc);
$locresult = curl_exec($ch);
$getlocerr = curl_error($ch);
if ($getlocerr) {
	echo "cURL Error #:" . $getlocerr;
} else {
	$getlocjson = json_decode($locresult); 
	$date1 = date_create($_POST['pickdateinput']);
	$confrmpickupdate = date_format($date1, 'l, jS F Y \a\t g:ia');	
	$date2 = date_create($_POST['dropoffdate']);	
	$confrmdropdate =  date_format($date2, 'l, jS F Y \a\t g:ia');
	if($locationidinput != ""){
		foreach ($getlocjson->LocationData as $item){
			if($item->LocationID == $locationidinput ){
				$getlocationnameconf =  $item->LocationName;
			}
			if($item->LocationID == $droplocationinput ){
				$getdrplocationname =  $item->LocationName;
			}				   
		}
	}	
}	
	$custname= $_POST['infor_fname'];
	$custlname= $_POST['infor_lname'];
	$custemail= $_POST['infor_email'];
	$custphone= $_POST['infor_phone'];
	$custdateofbth= $_POST['infor_dateofbirth'];
	$drlicencnumber = $_POST['infr_drlicensenumber'];
	$drliceexp = $_POST['infor_liceexp'];
	$drlicestate= $_POST['drivelicestate'];
	$cuscreditholder= $_POST['cardholder'];
	$cuscreditexp= $_POST['expmonth'];
	$cuscredityr= $_POST['expyear'];
	$cuscredittype= $_POST['credittype'];
	$cuscreditnumbr= $_POST['creditcarnumber'];
	$cusreq_local= $_POST['specialreq_local'];
	$cusspecialreq= $_POST['specialreq'];
	/* Additional Driver 1*/
	$drive1_name= $_POST['additionaldrivefname'];
	$drive1_last= $_POST['additionaldrivelname'];
	$drive1_email= $_POST['additionaldriveemail'];
	$additionaldriveaddress= $_POST['additionaldriveaddress'];
	$additionaldrivecity= $_POST['additionaldrivecity'];
	$CountryCode= $_POST['CountryCode'];
	$drive1phone= $_POST['additionaldrivephne'];
	$drive1dofbrith= $_POST['adddrivedateofbirth'];
	$additionaldrivezipcode= $_POST['additionaldrivezipcode'];
	$drive1licenumber= $_POST['adddrivelicenumber'];
	$drive1expmoth= $_POST['adddrivelicenumberexp'];
	$drive1state= $_POST['adddrivelicestate'];
	/* Additional Driver 1*/
	/* Additional Driver 2*/
	$drive2_name= $_POST['adddrive2name'];
	$SecondCountryCode= $_POST['SecondCountryCode'];
	$additionaldrivesecondcity= $_POST['additionaldrivesecondcity'];
	$drive2_last= $_POST['adddrive2lname'];
	$additionaldrivesecondaddress= $_POST['additionaldrivesecondaddress'];
	$additionaldrivesecondzipcode= $_POST['additionaldrivesecondzipcode'];
	$drive2_email= $_POST['adddrive2email'];
	$drive2phone= $_POST['adddrive2phone'];
	$drive2dofbrith= $_POST['adddrive2datebirth'];
	$drive2licenumber= $_POST['adddrive2licenumber'];
	$drive2expmoth= $_POST['adddrive2liceexp'];
	$drive2state= $_POST['adddrive2licestate'];
	/* Additional Driver 2*/
	curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/AddCustomer");
	$curl_post_data1  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"LocationID\":\"$locationidinput\",\"CustomerInfo\":{\"FirstName\":\"$custname\",\"LastName\":\"$custlname\",\"Password\":\"123456789\",\"SSN\":\"\",\"Address\":\"Test\",\"City\":\"Cairo\",\"StateCode\":\"Ar\",\"Zip\":\"99999\",\"CountryCode\":\"02\",\"Phone\":\"$custphone\",\"Email\":\"$custemail\",\"Fax\":\"123456\",\"Memo\":\"\",\"LicenseNumber\":\"$drlicencnumber\",\"LicenseExpiry\":\"$drliceexp\",\"LicenseState\":\"$drlicestate\",\"AccountHolder\":\"$cuscreditholder\",\"CCType\":\"$cuscredittype\",\"CCNumber\":\"$cuscreditnumbr\",\"CCExpiryYear\":\"$cuscredityr\",\"CCExpiryMonth\":\"$cuscreditexp\",\"CompanyName\":\"\",\"CompanyContactName\":\"\",\"CompanyAddress\":\"\",\"CompanyCity\":\"\",\"CompanyStateCode\":\"\",\"CompanyCountryCode\":\"\",\"CompanyZip\":\"\",\"CompanyPhone\":\"\",\"CompanyFax\":\"\",\"CompanyEmail\":\"co@mail.com\",\"LocationID\":\"$pickdateinput\",\"SourceOfReferral\":\"\",\"Region\":\"0\",\"Birthday\":\"$custdateofbth\",\"LastModifiedDate\":\"\",\"FreqTravelerID\":\"\",\"InsuranceCompany\":\"\",\"PolicyNumber\":\"\",\"InsuranceExpiry\":\"\",\"Agent\":\"\",\"InsurancePhone\":\"\",\"InsuranceFax\":\"\",\"ApprovedBy\":\"\",\"Gender\":\"Male\",\"CCTrack1\":\"\",\"CVV1\":\"\"}}";
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data1);
	$result = curl_exec($ch);
	$err = curl_error($ch);
	if ($err) {
		echo "cURL Error #:" . $err;
	} else {		  
		$jsonn = json_decode($result); 
	}	
	$customerdid = $jsonn->Customerid;				
	$returnmsg= array();			
	/*  To Save Reservation Data */			
	if($customerdid == 0){	
		$returnmsg['error'] = 1;	
		$returnmsg['msg'] = $jsonn->ReturnResult->ReturnMessages;
	}else{
		$RateCodeID = $array[0]->RateCodeID;
		$HourlyRateQuantity = $array[0]->HourlyRateQuantity;
		$HourlyRateCharge = $array[0]->HourlyRateCharge;
		$DailyRateQuantity = $array[0]->DailyRateQuantity;
		$DailyRateCharge = $array[0]->DailyRateCharge;
		$ExtraDailyRateQuantity = $array[0]->ExtraDailyRateQuantity;
		$ExtraDailyRateCharge = $array[0]->ExtraDailyRateCharge;
		$WeeklyRateQuantity = $array[0]->WeeklyRateQuantity;
		$WeeklyRateCharge = $array[0]->WeeklyRateCharge;
		$MonthlyRateQuantity = $array[0]->MonthlyRateQuantity;
		$MonthlyRateCharge = $array[0]->MonthlyRateCharge;
		$IncludedMileage = $array[0]->IncludedMileage;
		$AdditionalMileageCharge = $array[0]->AdditionalMileageCharge;
		$OneWayFee = $array[0]->OneWayFee;
		$ch = curl_init();
		if($rentalOpt=="0.00"){
			$misc =array();
			$insurance =array();
			$taxid =array();
		}else{
			$misc ="[\"1\",\"2\"]";
			$insurance ="[\"100\",\"101\"]";
			$taxid ="[\"38\",\"40\"]";
		}
		curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/SaveReservation");
		$curl_post_reser  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"LocationID\":\"$locationidinput\",\"PickupLocation\":\"$locationidinput\",\"DropoffLocation\":\"$droplocationinput\",\"CustomerID\":\"$customerdid\",\"PickupDate\":\"$pickdateinput[0]\",\"DropoffDate\":\"$dropoffdate[0]\",\"VehicleTypeID\":\"$vehicletypeidinput\",\"RateCodeID\":\"$RateCodeID\",\"InsuranceIDs\":\"$insurance\",\"TaxIDs\":\"$taxid\",\"MiscChargeIDs\":\"$misc\",\"Comment\":\"Test OnlineReservation\",\"RateInfo\":{\"RateCodeID\":\"$RateCodeID\",\"HourlyRateQuantity\":\"$HourlyRateQuantity\",\"HourlyRateCharge\":\"$HourlyRateCharge\",\"DailyRateQuantity\":\"$DailyRateQuantity\",\"DailyRateCharge\":\"$dailyratecharge\",\"ExtraDailyRateQuantity\":\"$ExtraDailyRateQuantity\",\"ExtraDailyRateCharge\":\"$ExtraDailyRateCharge\",\"WeeklyRateQuantity\":\"$WeeklyRateQuantity\",\"WeeklyRateCharge\":\"$WeeklyRateCharge\",\"MonthlyRateQuantity\":\"$MonthlyRateQuantity\",\"MonthlyRateCharge\":\"$MonthlyRateCharge\",\"IncludedMileage\":\"$IncludedMileage\",\"AdditionalMileageCharge\":\"$AdditionalMileageCharge\",\"OneWayFee\":\"$OneWayFee\"},\"Add1FName\":\"$drive1_name\",\"Add1LName\":\"$drive1_last\",\"Add1LicNum\":\"$drive1licenumber\",\"Add1LicExp\":\"$drive1expmoth\",\"add1LicenseState\":\"$drive1state\",\"Add1Address\":\"$additionaldriveaddress\",\"Add1City\":\"$additionaldrivecity\",\"Add1Zip\":\"$additionaldrivezipcode\",\"add1StateCode\":\"$drive1state\",\"add1CountryCode\":\"$CountryCode\",\"Add1Phone\":\"$drive1phone\",\"Add1Email\":\"$drive1_email\",\"Add1BirthDate\":\"$drive1dofbrith\",\"Add2FName\":\"$drive2_name\",\"Add2LName\":\"$drive2_last\",\"Add2LicNum\":\"$drive2licenumber\",\"Add2LicExp\":\"$drive2expmoth\",\"add2LicenseState\":\"$drive2state\",\"Add2Address\":\"$additionaldrivesecondaddress\",\"Add2City\":\"$additionaldrivesecondcity\",\"Add2Zip\":\"$additionaldrivesecondzipcode\",\"add2StateCode\":\"$drive2state\",\"add2CountryCode\":\"$SecondCountryCode\",\"Add2Phone\":\"$drive2phone\",\"Add2Email\":\"$drive2_email\",\"Add2BirthDate\":\"$drive2dofbrith\"}\r\n";
		//echo"<pre>";print_r($curl_post_reser);die();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_reser);
		$result = curl_exec($ch);
		$err = curl_error($ch); 
		if ($err){
			echo "cURL Error #:" . $err;
		}else {
			$jsonrev = json_decode($result); 
			$returnmsg['error'] = 0;
			$returnmsg['resnumber']= $jsonrev->ResNumber;
			$returnmsg['resid']= $jsonrev->ReservationID;
			$returnmsg['custmname']=$custname;
			$returnmsg['custmltnme']=$custlname;
			$returnmsg['custmphone']= $custphone;
			$returnmsg['customemail']= $custemail;
			$returnmsg['confrmpickloc']= $getlocationnameconf;
			$returnmsg['confirmdrploc']= $getdrplocationname; 
			$returnmsg['confrmpkupd']=$confrmpickupdate;
			$returnmsg['confrmdrpd']=$confrmdropdate;
			$returnmsg['confrmdalychrge']= bcdiv($dailyratecharge, 1, 2);
			$returnmsg['confrmrentalchrge'] = $rentalratecharge;
			$returnmsg['confrmtaxchge']= $retailtotal;
			$returnmsg['confrmtotalchrge']= bcdiv($totalamount, 1, 2);
		}	
	}
	$jsonresult = json_encode($returnmsg);
	print_r($jsonresult);
?>