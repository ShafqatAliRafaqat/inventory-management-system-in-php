function generate_row()
{
var a=$("#code_s").val();
var f=$("#amount_s").val();
if(a!='' && f!='' && f!=0)
{
var row_number=$("#row_number").val();
var table_view=generate_table(row_number);
var div_new=document.createElement('div');
div_new.id='row'+row_number;
$('#show_tables').append(div_new);
$(div_new).append(table_view);
row_number++;
$("#row_number").val(row_number);
clear_fields();
total_amount();
}
else
{
if(a=='')
{
document.getElementById('code_s').style.borderColor ='red';
document.getElementById('code_s_error').innerHTML='*Enter Party Name';
document.getElementById('code_s_error').style.color='red';
}	
if(f=='' || f==0)
{
document.getElementById('amount_s').style.borderColor ='red';
document.getElementById('amount_s_error').innerHTML='*Enter Amount';	
document.getElementById('amount_s_error').style.color='red';	
}	
}
}
function generate_table(row_no)
{
var code=$("#code_s").val();
var party_name=document.getElementsByClassName('select2-chosen')[1].innerHTML;
var description=$("#description_s").val();
var amount=$("#amount_s").val();
var table_new=document.createElement('table');
table_new.className="table table-condensed table-bordered table-hover table-striped";
var tbody_new=document.createElement('tbody');
table_new.appendChild(tbody_new);
var tr_new=document.createElement('tr');
tbody_new.appendChild(tr_new);
var td_new1=document.createElement('td');
td_new1.innerHTML='<input type="text" class="form-control" id="code'+row_no+'"  name="code'+row_no+'" value="'+code+'" readonly>';
td_new1.style.width='10%';
tr_new.appendChild(td_new1);
var td_new2=document.createElement('td');
td_new2.innerHTML='<input type="text" class="form-control" id="party_name'+row_no+'"  name="party_name'+row_no+'" value="'+party_name+'" readonly>';
td_new2.style.width='30%';
tr_new.appendChild(td_new2);
var td_new3=document.createElement('td');
td_new3.innerHTML='<input type="text" class="form-control" id="description'+row_no+'"  name="description'+row_no+'" value="'+description+'" readonly>';
td_new3.style.width='30%';
tr_new.appendChild(td_new3);
var td_new6=document.createElement('td');
td_new6.innerHTML='<input type="text" class="form-control amount" id="amount'+row_no+'"  name="amount'+row_no+'" value="'+amount+'" readonly>';
td_new6.style.width='20%';
tr_new.appendChild(td_new6);
var td_new7=document.createElement('td');
td_new7.innerHTML='<button type="button" class="btn btn-icon waves-effect waves-light btn-warning" onClick="edit_row('+row_no+')"> <i class="typcn typcn-pencil"></i> </button> <button type="button" class="btn btn-icon waves-effect waves-light btn-danger" onClick="delete_row('+row_no+')"> <i class="fa fa-remove"></i></button>';
td_new7.style.width='';
tr_new.appendChild(td_new7);
return table_new;
}
function clear_fields()
{
$("#code_s").val('');
$("#party_name_s").select2('val', '');
$("#description_s").val('');
$("#amount_s").val('');
document.getElementById('code_s').style.borderColor ='';
document.getElementById('code_s_error').innerHTML='';
document.getElementById('code_s_error').style.color='';
document.getElementById('amount_s').style.borderColor ='';
document.getElementById('amount_s_error').innerHTML='';	
document.getElementById('amount_s_error').style.color='';
}