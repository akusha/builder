var menu = document.getElementsByClassName('menu')[0],
	left_menu = document.getElementsByClassName('left_menu')[0],
	conteiner = document.getElementsByClassName('conteiner')[0],
	bool = false;


function dKuk(){		// Удаление куки.
    var cookie_date = new Date();  // Текущая дата и время
  	cookie_date.setTime ( cookie_date.getTime() - 10000 );
  	document.cookie = "log=; expires=" + cookie_date.toGMTString();
 }   


window.onscroll = function() {
	var scrolled = window.pageYOffset || document.documentElement.scrollTop;

	menu.classList.toggle('fixed',scrolled>=100);

	if (scrolled<=100){
		left_menu.style.top= 150-scrolled+'px';
		conteiner.style.paddingTop = 20 +'px';
	}else {
		left_menu.style.top = 50+'px';	
		conteiner.style.paddingTop = 70  + 'px';
	}
}


document.getElementById('new_item').onclick = function (){

	if (bool = !bool)
		document.getElementById("visib").classList.remove('visib');
	else
		document.getElementById("visib").classList.add('visib');
}






var httpreq = getXmlHttp();

window.onload= function(){
	getOption();        		// ============ Load options ============//

	var lis = document.getElementsByClassName('leftmenu')[0].getElementsByTagName('li');

	for (var i=0;i<lis.length;i++)
		lis[i].onclick = menuClick;
}

function menuClick(){

	var menu_id = this.id;
	document.getElementsByClassName('conteiner')[0].getElementsByTagName('h2')[0].innerHTML=this.innerHTML;
	switch (menu_id) {
		case "op":getTable();break;
		case "st":getKAS("state"); break;
		case "ac":getKAS("acount");break;
		case "ka":getKAS("kagent");break;
	}

}



function toggleform(bool) {

	var form = document.getElementById("form_op") ;
	var fon  = document.getElementById("fon");

	form.classList.toggle("invisible",bool);
	fon.classList.toggle("fonnone",bool);	

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

 	document.getElementsByName('date')[0].value=s[1] ;

	document.getElementsByName('state')[0].value = s[8];
	document.getElementsByName('kagent')[0].value=s[7];
	document.getElementsByName('acount')[0].value=s[9];

	document.getElementsByName('count')[0].value=s[2];
	document.getElementsByName('type')[0].value=s[3];
	document.getElementsByName('id')[0].value=s[0];		

 }


 function getTRItems(tr){

 	var s = "";
 	var tds = tr.childNodes;

 	for (var i=0;i<tds.length-3;i++) s += tds[i].innerHTML + ";";

 	s += tds[i].innerHTML;

 	return s;

 }

var currentTR;

 function bdclick() 		//============ Обработчик кнопок; Добавить,Изменить,Удалить ================
 { 	
 	
 	var id = this.value; 
 	var name = this.getAttribute('name');
 	
 	currentTR = this.parentElement.parentElement;
 	document.getElementsByName('id')[0].value = id; 


 	switch (name) {   

 		case 'bbb':   // изменить 	

 			execute("operation=get&id="+id,function(){

 				if (httpreq.readyState == 4) {
 					if(httpreq.status == 200) {
		 				var s = httpreq.responseText; 
		 				toggleform(false); 
		 				document.getElementsByName('operation')[0].value = "update";        
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
		 				if (s=="Удалено"){       
		 					currentTR.parentElement.removeChild(tr);
		 				}	
 					}
 				} 	 				

 			});
 		}

 		break;
 		case 'add':  // добавить  
 			toggleform(false); 
 			document.getElementsByName('operation')[0].value = "insert";
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

function getKAS(tablename){

	var table = document.getElementById('table'),
		body = "table="+tablename;

	execute(body,function(){

 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {
 				table.innerHTML = httpreq.responseText;          
 				initializebbb();
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


function createTR(s){			// ====== Добавление новой строки в таблицу ======== //

	var tbody = document.getElementsByTagName('tbody')[0];
	var tr = document.createElement('tr');
	
	tr.innerHTML = s;

	if (tbody.firstChild) tbody.insertBefore(tr,tbody.firstChild); 
	else tbody.appendChild(tr);

	return tr;
	
}


document.getElementById('insert').onclick = function (){			

	var date = document.getElementsByName('date')[0].value,
		state = document.getElementsByName('state')[0].value,
		kagent = document.getElementsByName('kagent')[0].value,
		acount = document.getElementsByName('acount')[0].value,
		count = document.getElementsByName('count')[0].value,
		type = document.getElementsByName('type')[0].value,
		id = document.getElementsByName('id')[0].value,
		operation = document.getElementsByName('operation')[0].value;

	var body = "operation="+operation+"&date="+date+"&state="+state+"&kagent="+kagent+"&acount="+acount+"&count="+count+"&type="+type;

	if (operation == "update") body += "&id="+id;

	execute(body,function(){					// ========== Сохранение =========== //

		if (httpreq.readyState == 4) {
		 			if(httpreq.status == 200) {	   				 			
		 				

		 				var s =  httpreq.responseText.split(';');
		 			
		 				if (s[0] >= 1)	{	 						 				
			 				if (operation == "insert"){		 					
			 					currentTR = createTR(s[1]);
			 				}else {
			 					currentTR.innerHTML = s[1];
			 				}
			 				toggleform(true);
			 				initializebbb();
			 				}
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