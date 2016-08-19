// JavaScript Document

function checkEmpty(Id)
{
	var obj = document.getElementById(Id);
	var str = obj.value;
	var re = /^\s*$/;
	if(!re.test(str))
			{
				return true;				
			}
			alert("Chưa nhập dữ liệu cho mục này!");
			obj.bgColor='#FF0000';
			obj.focus();
			return false;
}

function CheckEmail(Id)
{
	var obj = document.getElementById(Id);
	var str = obj.value
	var re = /\b[a-zA-Z0-9_]+@[a-zA-Z0-9_]+\.[a-zA-Z]{2,4}\b/
	if(!re.test(str))
		{
		  alert("Email không chính xác!");
		  obj.value="";
		  obj.focus();
          return false;
		}
		return true;
}

function CheckPhone(Id)		
{		
	var obj = document.getElementById(Id);
	var str = obj.value
	re = /[\d]+/;
	if(!re.test(str))
		{
			alert("Số điện thoại không đúng!");
			 obj.value="";
			 obj.focus();
			return false;
		} 
		return true;
}



function checkSelect(obj){
	var val = obj.value;
	if(eval(val)==0){
		alert("Bạn chưa chọn loại sản phẩm !");
		obj.focus();
		return false;
	}
	return true;
}

function checkSelect1(obj){
	var val = obj.value;
	if(val == null || val==0){
		alert("Bạn chưa chọn nhà cung cấp !");
		obj.focus();
		
		return false;
	}
	return true;
}

function checkSelect2(obj){
	var val = obj.value;
	if(val == null || val==0){
		alert("Bạn chưa chọn dòng sản phẩm !");
		obj.focus();
		return false;
	}
	return true;
}


function CheckNumber(Id)		
{		
	var obj = document.getElementById(Id);
	var str = obj.value
	re = /[0-9]+/;
	if(!re.test(str) || eval(str)<=0)
		{
			alert("Dữ liệu không đúng,phải là số và lớn hơn 0!");
			 obj.value="";
			 obj.focus();
			return false;
		} 
		return true;
}


function CheckNumber1(Id)		
{		
	var obj = document.getElementById(Id);
	var str = obj.value
	re = /[\d]+/;
	if(!re.test(str) || eval(str)<=0)
		{
			alert("Dữ liệu không đúng,phải là số và lớn hơn 0!");
			 obj.value="";
			 obj.focus();
			return false;
		} 
		return true;
}
function CheckNumber2(Id)		
{		
	var obj = document.getElementById(Id);
	var str = obj.value
	var s1=parseInt(str);
	re = /[\d]+/;
	if(!re.test(str) || eval(str)<=0 || s1!=eval(str))
		{
			alert("Dữ liệu không đúng,phải là số và lớn hơn 0 và là số nguyên!");
			 obj.value="";
			 obj.focus();
			return false;
		} 
		return true;
}


function CheckFormCate()
{
	if(!checkEmpty('catName'))
	{
		return false;
	}
			return true;
}
function CheckFormSpec()
{
	if
		(
		 !checkEmpty('specName')
		)
		return false;
			return true;
}

function CheckFormQues()
{
	if
		(
		 !checkEmpty('question')
		)
		return false;
			return true;
}


function CheckFormSup()
{
	if
		(
		 !checkEmpty('supName') ||
		 !CheckPhone('supPhone') ||
		 !checkEmpty('supAdd') ||
		 !CheckEmail('supEmail') 										
		)
		return false;
			return true;
}

function CheckFormMod()
{
	if
		(
		 !checkEmpty('modName')
		)
		return false;
			return true;
}

function CheckFormProAdd()
{
	if(
	   		!checkSelect(document.getElementById('group_category')) ||
			!checkSelect2(document.getElementById('modID')) ||
			!checkSelect1(document.getElementById('supplier')) ||
			!checkEmpty('proName') ||
		 	!checkEmpty('proDescription') ||
		 	!CheckNumber2('proPrice') ||
			!CheckNumber2('proQuantity') ||
			!CheckNumber2('salePrice') 
			
	   )
	return false;
		return true;
}
function CheckFormNews()
{
	if
		(
		 !checkEmpty('ntitle') ||
		 !checkEmpty('nheader') ||
		 !checkEmpty('ncontent') 
		)
		return false;
			return true;
}