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
    	
	function disab(){    //Если логин оригинальный, активирует кнопку отправки формы. 
        var value = this.value;
        var body = "ajax=ajax&log=" + value;
       	ajax.open('POST', "check_in.php", true);
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4) {
				if(ajax.status == 200) {
					var result = ajax.responseText;
                    if (result==0) document.getElementsByName("submit")[0].disabled=0;                        
                    else document.getElementsByName("submit")[0].disabled=1;
				}
			}
		}
		ajax.send(body);
	}