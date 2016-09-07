function timeGetter()
{
	var time = "";
	var d = new Date();
	var ap = "";
	var hours = d.getHours();
	
	if (hours > 12)
	{
		hours = hours - 12;
		ap = "pm";
	}
	else if (hours == 12)
	{
		ap = "pm";
	}
	else if (hours > 0)
	{
		ap = "am";
	}
	else if (hours == 0)
	{
		hours = "12";
		ap = "am";
	}
	
	time = hours + ":" + d.getMinutes() + ap;
	return time;
}