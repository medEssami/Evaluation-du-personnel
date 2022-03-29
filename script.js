
function year_fnts() {
    var today =new Date();
    var Year = today.getFullYear();
    return Year.toString;
}
//-------------------------Rectangle
let canvas = document.getElementById('c1');
let ctx = canvas.getContext('2d');

ctx.strokeStyle = '#010101'; 
ctx.strokeRect(86, 1, 200, 30);
//-----------------------------
$(document).ready(function () {
                    var date = new Date();
                    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    $('#datepicker1').datepicker({
                        format: "mm/dd/yyyy",
                        todayHighlight: true,
                        startDate: today,
                        endDate: end,
                        autoclose: true
                    });
                    

                    $('#datepicker1').datepicker('setDate', today);
                });
/* function pour testé Email  */
function ValidateEmail(inputText)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(inputText.value.match(mailformat))
{
/*alert("Valid email address!");*/
document.form1.Email_Evalue.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");
document.form1.Email_Evalue.focus();
return false;
}
}
//
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
