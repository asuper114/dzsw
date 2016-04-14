function init()
{
	SelectList(document.research.province,"");
	SelectList(document.research.city,"");
}

function deftaultcountry(country_value){	
	var country_value = country_value;
}

function gocountry(country){	
	var country = country != '' ? country : 'country';
	var obj_country	= document.getElementById(country);
	for(i in countryid){
		obj_country.options.add(new Option(countryname[i],countryid[i]));
	}
}

function goprovince(country,province,city){
	var country = country != '' ? country : 'country';
	var province = province != '' ? province : 'province';
	var city = city != '' ? city : 'city';

	var obj_province	= document.getElementById(province);

	if(obj_province){
		obj_province.options.length = 0;
		if(typeof(country) == "string"){
			var obj_country		= document.getElementById(country);
			for (var i=0;i< obj_country.length;i++){
				if (obj_country.options[i].selected){
					var covalue = obj_country.options[i].value;
				}
			}
		}else{
			var covalue = country;
		}
		LoadProvince(covalue,obj_province);
		gocity(province,city);
	}
}

function gocity(province,city){
	var province = province != '' ? province : 'province';
	var city = city != '' ? city : 'city';	

	var obj_province	= document.getElementById(province);
	var obj_city		= document.getElementById(city);
	
	if(obj_city){
		obj_city.options.length = 0;
		for (var i=0;i< obj_province.length;i++){
			if (obj_province.options[i].selected){
				var pid = obj_province.options[i].value;
				LoadCity(pid,obj_city);
				break;
			}
		}	
	}
}

function LoadProvince(covalue,objListCo){
	objListCo.options.length=0;
	for(i in provinceid){
		arr = provinceid[i].split("|");
		if (arr[0]==covalue){
			objListCo.options.add(new Option(provincename[i],arr[1]));
		}
	}
}

function LoadCity(pvalue,objListC){
	objListC.options.length=0;
	for(i in cityid){
		arr = cityid[i].split("|");
		if (arr[0] == pvalue){
			objListC.options.add(new Option(cityname[i],arr[1]));
		}
	}
}

function SelectFirstList(objList){
	objList.options[0].selected = true;
}

function SelectList(objList_,idstring){
	var objList	= document.getElementById(objList_);
	for (var i=0;i<objList.length;i++){
		if (objList.options[i].value==idstring){
			objList.options[i].selected = true;
			return;
		}
	}
}