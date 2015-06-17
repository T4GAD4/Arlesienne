var base_url = "http://arlesienne.saint-roch-habitat.fr:8080/arlesienne/V3-aurelien";

var __POST = $.post;
$.post = function(url, data, success, type)
{
   url = base_url + url;
   var result = __POST.apply(this, [url, data, success, type]);
   
   return result;
}

 var __AJAX = $.ajax;
 $.ajax = function(url, setting)
{
	var result =  null;
	
	if(typeof url == "object")
	{
		result = __AJAX.apply(this, [url]);
	}
	else
	{
		result = __AJAX.apply(this, [url, setting]);
	}

	return result;
}