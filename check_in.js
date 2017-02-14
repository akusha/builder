var counter, a, b, c, d, e;
function getXmlHttp(){
		var xmlhttp;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
    }
    
	var ajax = getXmlHttp();    
    	
	function verifyLog(){  // Проверка текста логина. 
		var value=document.getElementsByName("log")[0].value;
		if(/^[A-Za-z0-9_-]{3,30}$/.test(value)){		
        var body = "ajax=ajax&log=" + value;
       	ajax.open('POST', "check_in.php", true);
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4) {
				if(ajax.status == 200) {
					var result = ajax.responseText;
                    if (result==0) {
						document.getElementsByName("log")[0].style.border="1px solid #229a27"; 
						a=1;
						//document.getElementsByName("submit")[0].disabled=0; 
					}
                    else {
						document.getElementsByName("log")[0].style.border="1px solid #e27b7b"; 
						a=0
						//document.getElementsByName("submit")[0].disabled=1;
					}
				}
			}
		}
		ajax.send(body);
		}
		else {
			document.getElementsByName("log")[0].style.border="1px solid #e27b7b";
			a=0;
		}
	if ((a+b+c+d+e)==5) document.getElementsByName("submit")[0].disabled=0;
	else document.getElementsByName("submit")[0].disabled=1;
	}

function verifyPass() {  // Проверка текста пароля. 
		var value=document.getElementsByName("pass")[0].value;		
		//if(value=="") document.getElementsByName("log")[0].style.border="1px solid #282c95"; 
        if(/^[A-Za-z0-9_-]{6,30}$/.test(value)){		
        	document.getElementsByName("pass")[0].style.border="1px solid #229a27";
			document.getElementsByName("pass")[1].disabled=0;
			b=1;
		}
        else {
			document.getElementsByName("pass")[0].style.border="1px solid #e27b7b"; 
			document.getElementsByName("pass")[1].disabled=1;
			b=0;
		}
		if ((a+b+c+d+e)==5) document.getElementsByName("submit")[0].disabled=0;
	else document.getElementsByName("submit")[0].disabled=1;
}
		
	function verifyPass1() {  // Проверка второго пароля. 
		var value=document.getElementsByName("pass")[0].value;		
		var value1=document.getElementsByName("pass")[1].value;		
		//if(value=="") document.getElementsByName("log")[0].style.border="1px solid #282c95"; 
        if(value==value1){
			document.getElementsByName("pass")[1].style.border="1px solid #229a27"; 
			c=1;
		}
		else {
			document.getElementsByName("pass")[1].style.border="1px solid #e27b7b"; 
			c=0;
		}
		if ((a+b+c+d+e)==5) document.getElementsByName("submit")[0].disabled=0;
	else document.getElementsByName("submit")[0].disabled=1;
	}
	function verifyNic() {  // Проверка текста ника. 
		var value=document.getElementsByName("nic")[0].value;	
		if(/^[A-Za-z0-9_-]{3,30}$/.test(value)){		
        	document.getElementsByName("nic")[0].style.border="1px solid #229a27"; 
			d=1;
		}
        else {
			document.getElementsByName("nic")[0].style.border="1px solid #e27b7b"; 
			d=0;
		}
		if ((a+b+c+d+e)==5) document.getElementsByName("submit")[0].disabled=0;
	else document.getElementsByName("submit")[0].disabled=1;
	}
	function verifyMail() {  // Проверка текста почты. 
		var value=document.getElementsByName("mail")[0].value;	
		if(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(value)){		
        	document.getElementsByName("mail")[0].style.border="1px solid #229a27"; 
			e=1;
		}
        else {
			document.getElementsByName("mail")[0].style.border="1px solid #e27b7b"; 
			e=0;
		}
		if ((a+b+c+d+e)==5) document.getElementsByName("submit")[0].disabled=0;
	else document.getElementsByName("submit")[0].disabled=1;
	}
	