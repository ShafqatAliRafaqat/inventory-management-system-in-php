//Main Js
function load_list(url,div)
{
$('#'+div+'').html('<h1 align="center"><img src="assets/images/Loading _save.gif"/></h1>');
$.post(url,"",function(data){
$('#'+div+'').html(data);		
});
}
function load_main(url,div)
{
$('#'+div+'').html('<h1 align="center"><img src="assets/images/Loading _save.gif"/></h1>');
$.post(url,"",function(data){
$('#'+div+'').html(data);
});
}
function load_details(url,div,pvalue)
{
$('#details_modal').modal('show');
$('#'+div+'').html('<h1 align="center"><img src="assets/images/Loading _save.gif"/></h1>');
$.post(url,{
	no:pvalue
},function(data){
$('#'+div+'').html(data);	
});
}
function edit_details(url,div,pvalue)
{
$('#edit_modal').modal('show');
$('#'+div+'').html('<h1 align="center"><img src="assets/images/Loading _save.gif"/></h1>');
$.post(url,{
	no:pvalue
},function(data){
$('#'+div+'').html(data);		
});
}
function del(url,div,pvalue,urla,diva)
{
  swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this data!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false 
        }, function(){
$.post(url,{
no:pvalue
},function(data){
var c=data.trim();
if(c!='')
{
swal(c);	
}
else{
swal("Deleted!", "Successfully Deleted", "success");
load_main(urla,diva);	
}
});
});
}
function printData(divname)
    {
     var divToPrint=document.getElementById(divname);
    newWin= window.open("");
    newWin.document.write(divToPrint.innerHTML);
   setTimeout(function(){  
	newWin.print();
    newWin.close();
	document.getElementById(divname).innerHTML="";
	}, 1500);
    
   }
function print(url,div,pvalue)
{
$('#form1').css('display','none');
$('#loading_bar').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.post(url,{
no:pvalue
},function(data){
$("#"+div+"").html(data);
printData(div);	
$('#loading_bar').html('');
$('#form1').css('display','inline');
});
}
function round(value, decimals) {
    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}
function view_down(a)
{
var b='<img src="'+a+'">';	
$('#viewd').modal('show');
$('#viewdo').html(b);	
}
function compare_date(dateTimeA, dateTimeB) {
    var momentA = moment(dateTimeA,"DD/MM/YYYY");
    var momentB = moment(dateTimeB,"DD/MM/YYYY");
    if (momentA > momentB) return 1;
    else if (momentA < momentB) return 0;
    else return 1;
}
function removeParam(parameter)
{
  var url=document.location.href;
  var urlparts= url.split('?');

 if (urlparts.length>=2)
 {
  var urlBase=urlparts.shift(); 
  var queryString=urlparts.join("?"); 

  var prefix = encodeURIComponent(parameter)+'=';
  var pars = queryString.split(/[&;]/g);
  for (var i= pars.length; i-->0;)               
      if (pars[i].lastIndexOf(prefix, 0)!==-1)   
          pars.splice(i, 1);
  url = urlBase;
  window.history.pushState('',document.title,url); // added this line to push the new url directly to url bar .

}
return url;
}
function printDataa(divname)
    {
     var divToPrint=document.getElementById(divname);
    newWin= window.open("");
    newWin.document.write(divToPrint.innerHTML);
	setTimeout(function(){
	newWin.print();
	newWin.close();
	},1500);
    }