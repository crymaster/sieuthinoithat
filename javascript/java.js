// JavaScript Document
function checkEmpty(id)
{
	var obj = document.getElementById(id);
	var str = obj.value;
	var re = /^\s*$/;
	if(!re.test(str))
		return false;
	alert(" Bạn không đươc để trống thông tin này !");
	obj.focus();
	return true;
}

function checkEmpty1(id)
{
	var obj = document.getElementById(id);
	var str = obj.value;
	var re = /^\s*$/;
	if(!re.test(str))
		return false;
	return true;
}

function checkUser(id)
{
	var obj = document.getElementById(id);
	var str = obj.value;
	var re = /^\w{0,20}$/;
	if(re.test(str))
		return true;
	alert("Tên user chỉ là các chữ cái,dấu gạch dưới ,số và không vượt quá 20 ký tự !");
	obj.focus();
	return false;
}

function checkEmail(Id)
{
	var obj = document.getElementById(Id);
	var str = obj.value
	var re = /\b[a-zA-Z0-9_]+@[a-zA-Z0-9_]+\.[a-zA-Z]{2,4}\b/
	if(!re.test(str))
		{
		  alert("Email không chính xác ví dụ: abc@xmail.com ");
		  obj.value="";
		  obj.focus();
          return false;
		}
		return true;
}

function checkPass (id1,id2)
{
	var obj1 = document.getElementById(id1);
	var obj2 = document.getElementById(id2);
	var re =/^[\w\W]{6,20}$/;
	if(obj1.value != obj2.value)
	{
		alert("PassWord không trùng nhau !");
		obj1.value="";
		obj2.value="";
		obj1.focus();
		return false;
	}
	if(!re.test(obj1.value))
	{
		alert("Độ dài passWord từ 6 đến 22 ký tự !");
		obj1.value="";
		obj2.value="";
		obj1.focus();
		return false;
	}
	return true;
}

function checkName(id)
{
	var obj = document.getElementById(id);
	var re = /^[a-zA-z ]{0,25}$/;
	if(!re.test(obj.value))
		{
		  alert("Họ tên không bao gồm số và ký tự đặc biệt, độ dài tối đa 25 ký tự !");
		  obj.value="";
		  obj.focus();
          return false;
		}
		return true;
}

function checkAddress(id)
{
	var obj = document.getElementById(id);
	var re = /^[\w\W]{0,300}$/;
	if(!re.test(obj.value))
		{
		  alert("The address exceeds 300 characters");
		  obj.value="";
		  obj.focus();
          return false;
		}
		return true;
}

function checkPhone(id)
{
	var obj = document.getElementById(id);
	var re = /^\d{7,11}$/;
	if(!re.test(obj.value))
		{
		  alert("Điện thoại chứa các số và từ 7 đến 11 số !");
		  obj.value="";
		  obj.focus();
          return false;
		}
		return true;
}

function checkSelect(Id){
	var obj = document.getElementById(Id);
	var val = obj.value;
	if(val == null || val.length==0 || val==0){
		alert("Bạn chưa chọn câu hỏi bí mật !");
		obj.focus();
		return false;
	}
	return true;
}


function checkAnswer(id)
{
	var obj = document.getElementById(id);
	var re = /^[\w\W]{0,100}$/;
	if(!re.test(obj.value))
		{
		  alert("Độ dài câu hỏi không vượt quá 100 ký tự !");
		  obj.value="";
		  obj.focus();
          return false;
		}
		return true;
}

function checkRegister()
{
	if(
	   checkEmpty('user') ||
	   checkEmpty('email') ||
	   checkEmpty('pass') ||
	   checkEmpty('pass1') ||
	   checkEmpty('name') ||
	   checkEmpty('address') ||
	   checkEmpty('phone') ||
	   !checkSelect('ques') ||
	   checkEmpty('answer') ||
	   !checkUser('user')||
	   !checkEmail('email') ||
	   !checkPass('pass','pass1') ||
	   !checkName('name') ||
	   !checkAddress('address') ||
	   !checkPhone('phone') ||
	   !checkAnswer('answer')
	  )
		return false;
	return true;

}

function checkProfile()
{
	if(
	   (!checkEmpty1('email') && !checkEmail('email')) ||
	   (!checkEmpty1('npass') && !checkPass('npass','npass1')) ||
	   !checkName('name')||
	   !checkAddress('address') ||
	   (!checkEmpty1('phone') && !checkPhone('phone')) ||
	   !checkAnswer('answer')
	  )
		return false;
	if(checkEmpty1('opass') && !checkEmpty1('npass'))
	{
		alert("Please enter old password");
		var obj = document.getElementById('opass');
		obj.focus();
		return false;
	}
	return true;
}