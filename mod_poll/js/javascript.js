
var open = false;

function openPoll(){
	if(open){
		open = false;
		document.getElementById('innerPoll').style.height = "0px;";
		document.getElementById('innerPoll').style.display = "none";
		document.getElementById('icon').innerHTML = "<i class='fa fa-minus' aria-hidden='true'></i>";
	}
	else{
		open = true;
		document.getElementById('innerPoll').style.height = "auto;";
		document.getElementById('innerPoll').style.display = "block";
		document.getElementById('icon').innerHTML = "<i class='fa fa-times' aria-hidden='true'></i>";
	}
}