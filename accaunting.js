var httpreq = getXmlHttp();

window.onload= function(){
	getOption();        		// ============ Load options ============//
}



function toggleform(bool) {

	var form = document.getElementById("form_op") ;
	var fon  = document.getElementById("fon");

	form.classList.toggle("invisible",bool);
	fon.classList.toggle("fonnone",bool);	

}


document.getElementById("op").onclick = function (){

	getTable();	

}

document.getElementById("close").onclick = function (){

	toggleform(true);

}

function initializebbb(){

 	var bds = document.getElementsByClassName("bd");

 	for (var i=0;i<bds.length;i++){

 		bds[i].onclick = bdclick;

 	}

 }

 function fillform(data){

 	//o.id,date,value,o.type,k.name,s.name,a.name,k.id,s.id,a.id

 	var s = data.split(';');

 	toggleform(false);

 	document.getElementsByName('date')[0].value=s[1] ;

	document.getElementsByName('state')[0].value = s[8];
	document.getElementsByName('kagent')[0].value=s[7];
	document.getElementsByName('acount')[0].value=s[9];

	document.getElementsByName('count')[0].value=s[2];
	document.getElementsByName('type')[0].value=s[3];
	document.getElementsByName('id')[0].value=s[0];

	

 }

 function bdclick() 		//============ Обработчик кнопок; Добавить,Изменить,Удалить ================
 {
 	
 	var id = this.value; 
 	var name = this.getAttribute('name');

 	document.getElementsByName('id')[0].value = id; 


 	switch (name) {   

 		case 'bbb':   // изменить 						
 			execute("operation=get&id="+id,function(){

 				if (httpreq.readyState == 4) {
 					if(httpreq.status == 200) {
		 				var s = httpreq.responseText;          
		 				fillform(s);
 					}
 				} 	 

 			})

 		break;

 		case 'ddd':    // удалить
 		if (confirm("Вы уверены в этом?")) {
 			execute("operation=delete&id="+id,function(){

 				if (httpreq.readyState == 4) {
 					if(httpreq.status == 200) {
		 				var s = httpreq.responseText;          
		 				getTable();
 					}
 				} 	 				

 			});
 		}

 		break;
 		case 'add':  // добавить  ,  показывает соответсвующую форму редактирования 
 			
 			toggleform(false); 
 			getOption(); 						

 		break;
 	}
 	
 }


function getOption(){
	execute("select=1",function() {
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

		 		});		
}

function getTable(){

	var table = document.getElementById('table'),
		body = "operation=get";

	execute(body,function(){

 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {
 				table.innerHTML = httpreq.responseText;          
 				initializebbb();
 			}

 		} 	

	});

}


document.getElementById('insert').onclick = function (){			

	var date = document.getElementsByName('date')[0].value,
		state = document.getElementsByName('state')[0].value,
		kagent = document.getElementsByName('kagent')[0].value,
		acount = document.getElementsByName('acount')[0].value,
		count = document.getElementsByName('count')[0].value,
		type = document.getElementsByName('type')[0].value;


	var body = "operation=insert"+"&date="+date+"&state="+state+"&kagent="+kagent+"&acount="+acount+"&count="+count+"&type="+type;

	execute(body,function(){					// ========== добавление новой записи =========== //

		if (httpreq.readyState == 4) {
		 			if(httpreq.status == 200) {	   				 			
		 				
		 				getTable();
		 				toggleform(true);

		 			}
		 		}	
	})	

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

function execute(body,callback){					//======= ajax ========//

	httpreq.open('post','achandler.php',true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 	httpreq.onreadystatechange = callback;
 	httpreq.send(body);

}