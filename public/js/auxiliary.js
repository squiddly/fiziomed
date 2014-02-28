$(document).ready(function() {
	if($('#container_div').length>0) renderHomeLayout($('#container_div').attr('interval'), 12);
	fillInCredentials();
});

//Render Homepage Layout timetable
function renderHomeLayout(interval, hours)
{
	var htmlString = '<table class="table table-bordered">', rows = 60/interval * hours, minutes = 0, mStr = "", arr = {};
	
	//get procedures dinamically
	var procAux = '{}';
	if(!$.isEmptyObject($('#container_div'))) procAux = $('#container_div').html($('#container_div').attr('procedures')).text();
	var proceduri = $.parseJSON(procAux);
	var procCount = 1;
	htmlString += '<thead><tr><th>Ora</th>';
	
	$.each(proceduri, function(index, value){
		procCount++;
		htmlString += '<th id="proc_'+index+'">'+value+'</th>';
	});
	htmlString += '</thead>';
	
	//make html code and write it
	for(var i = 0; i < rows; i++){
		htmlString += '<tr id="tr_'+i+'">';
		for(var j = 0; j < procCount; j++){	
			htmlString += '<td id = "cell_' + i + '_' + j +'" attr_i="'+i+'" attr_j="'+j+'"></td>';
		}
		htmlString += '</tr>';
	}
	
	//add tab layout
	var tabDatesAux = '{}';
	if(!$.isEmptyObject($('#container_div'))) tabDatesAux = $('#container_div').html($('#container_div').attr('tabDates')).text();
	var tabDates = $.parseJSON(tabDatesAux);
	var tabHeader = "<ul class=\"nav nav-tabs\" id=\"tabHeader\">";
	var tabContent = "<div class=\"tab-content\">"; 
	$.each(tabDates, function(index, value){
		tabHeader += "<li><a href=\"#"+ index +"\" data-toggle=\"tab\">"+ value +"</a></li>";
		tabContent += "<div class=\"tab-pane\" id=\""+ index +"\">NYI: stored info</div>";
	});
	tabHeader += "</ul>";
	tabContent += "</div>";
	$('#container_div').html(tabHeader + tabContent);
	$('#today').html(htmlString);
	$('#tabHeader a[href="#today"]').tab('show');
	
	//write text in the first column
	j = 8;
	for(var i = 0; i < rows; i++){
		if(minutes == 0) mStr = "00";
		else mStr = minutes;
		if(minutes == 60) { minutes = 0; j++; mStr  = "00"; }
		arr[i] = j + ':' + mStr;
		$('#cell_'+ i +'_0').html(arr[i]);
		minutes += parseInt(interval);
		$('#tr_' + i).mouseover(function(){
			$(this).attr('class','success');
		});
		$('#tr_' + i).mouseout(function(){
			$(this).attr('class','');
		});
	}

	//add functions for cells
	/*
	for(var i = 0; i < rows; i++)
		for(var j = 1; j < procCount; j++){
			$('#cell_' + i + '_' + j).click(function(){		
				$('#modaladd').modal({
					remote: $('#container_div').attr('homeurl') + 'add #addfromhere',
				});
			});
		}
	*/
}

//Fill in default credentials - temporary
function fillInCredentials()
{
	$('form').each(function(){
		var action=$(this).attr('action');
		action=action.substr(action.length-5,action.length-1);
		if(action=='login'){
			$("input[name='identity']").val('admin');
			$("input[name='credential']").val('parola');
		}
	});
}