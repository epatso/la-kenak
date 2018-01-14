function date_time(id){
	date = new Date;
	year = date.getFullYear();
	month = date.getMonth();
	months = new Array('Ιανουαρίου', 'Φεβρουαρίου', 'Μαρτίου', 'Απριλίου', 'Μαϊου', 'Ιουνίου', 'Ιουλίου', 'Αυγούστου', 'Σεπτεμβρίου', 'Οκτωβρίου', 'Νοεμβρίου', 'Δεκεμβρίου');
	d = date.getDate();
	day = date.getDay();
	days = new Array('Κυριακή', 'Δευτέρα', 'Τρίτη', 'Τετάρτη', 'Πέμπτη', 'Παρασκευή', 'Σάββατο');
	h = date.getHours();
	if(h<10)
	{
			h = "0"+h;
	}
	m = date.getMinutes();
	if(m<10)
	{
			m = "0"+m;
	}
	s = date.getSeconds();
	if(s<10)
	{
			s = "0"+s;
	}
	result = ''+days[day]+' '+d+' '+months[month]+' '+year+' '+h+':'+m+':'+s;
	document.getElementById(id).innerHTML = result;
	setTimeout('date_time("'+id+'");','1000');
	return true;
}