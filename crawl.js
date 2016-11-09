

 var prevurl="";
function crawl(element) {
 
if(element.value=="")
{
  prevurl="";
 
}

  var match = /(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.)(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.exec(element.value);
     if(match)
     {

 urlchecksum(match[0],element.value,element.value.length);
   
    }
  
     
 else
 {

    var match1 =/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.exec(element.value);
    if(match1)
    {

     urlchecksum(match1[0],element.value,element.value.length);
  
    }
    else
    {
        prevurl="";
    }
 }   
     
 
      
     
}


function urlchecksum(url,value,len)
{
  if(prevurl!=url)
{

  if(value.lastIndexOf(" ")==(len-1))
{
      
 checkurl(url);          
    prevurl=url;
    
}

}
function IsURL(url) {

  // var urlregex = new RegExp(
  //       "^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.com|.co|.uk|.in|.org|.edu|.gl)");
 var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.|http:\/\/|https:\/\/|ftp:\/\/){1}([0-9A-Za-z]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|co|uk|in)|[0-9A-Za-z]+\.[0-9A-Za-z]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|co|uk|in))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");
 
  return urlregex.test(url);
 }

function checkurl(value)
{
  
var response=IsURL(value);
if(response)
{
 
  var url="crawl.php";
                  $.ajax({
                    url:url,
                    data:{url:value},
                    dateType:"json",
                    type:"POST",
                    success: function(data)
                    {
                      var obj=JSON.parse(data);
                      var html="";
                       html+="<strong>og:title: </strong>"+obj.ogtitle+"<br>";
                       html+="<strong>og:description: </strong>"+obj.ogdescription+"<br>";
                       html+="<strong>og:image: </strong><br>2<img src='"+obj.ogimage+"' ><br>";
                       html+="<strong>og:video: </strong>"+obj.ogvideo+"<br>";
                       html+="<strong>Host: </strong>"+obj.host+"<br>";

                       $("#output").html(html);
                    }
                  });
}   
  

}
}
    
