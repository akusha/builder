var httpreq = getXmlHttp();



function toggleform() {

	var form = document.getElementById("form_op") ;
	var fon  = document.getElementById("fon");

	form.classList.toggle("invisible");
	fon.classList.toggle("fonnone");
	getSelection();

}


document.getElementById("op").onclick = function (){

	toggleform();

}

document.getElementById("close").onclick = function (){

	toggleform();

}

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


 function getSelection(){

 	httpreq.open('post','achandler.php',true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 	httpreq.onreadystatechange = function() {
 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {
   				 			
 				var s = httpreq.responseText,
 					a = s.split(';'),
 					kagent = a[0],
 					state  = a[1],
 					acount = a[2];

 				document.getElementsByName("kagent")[0].innerHTML = kagent;
 				document.getElementsByName("state")[0].innerHTML = state;
 				document.getElementsByName("acount")[0].innerHTML = acount; 	
 			}
 		}	

 	}
 	httpreq.send("select=1");
}