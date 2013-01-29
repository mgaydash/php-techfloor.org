function expand(obj)
{
	var elmnt = document.getElementById(obj);

	if(elmnt.style.display != 'block')
	{
		elmnt.style.display = 'block';
	}

	else
	{
		elmnt.style.display = 'none';
	}
		
}

