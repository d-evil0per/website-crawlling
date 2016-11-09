<?php 

$url=$_POST['url'];
crawlurl($url);

function crawlurl($url)
{


$urlcheck=explode('://',$url);
        if($urlcheck[0]!='http')
        {
            $url="http://".$_POST['url'];
        }
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $html = curl_exec($ch);
    curl_close($ch);

$doc = new DOMDocument();
@$doc->loadHTML($html);
$metas = $doc->getElementsByTagName('meta');
$links=$doc->getElementsByTagName('a');
$ogdescription="";
$ogtitle="";
$ogimage="";
$ogvideo="";
$title="";
$description="";
$host=parse_url($url);
for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if($meta->getAttribute('property') == 'og:description')
        $ogdescription = $meta->getAttribute('content');
    if($meta->getAttribute('property') == 'og:title')
        $ogtitle = $meta->getAttribute('content');
       if($meta->getAttribute('property') == 'og:image')
        $ogimage = $meta->getAttribute('content');
    if($meta->getAttribute('property') == 'og:video')
        $ogvideo = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'title')
        $title = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');
}
$link="";
for ($i = 0; $i < $links->length; $i++)
{
    $meta = $links->item($i);
    $link.="<br>".$meta->getAttribute('href'); 
}
if($ogtitle=="")
{
    $ogtitle=$title;
}
if($ogdescription=="")
{
    $ogdescription=$description;
}
$data = array('ogtitle' =>$ogtitle ,
               'ogdescription'=>$ogdescription,
               'ogimage'=>$ogimage,
               'ogvideo'=>$ogvideo,
               'host'=>$host["host"],
               'link'=>$link,
                            );

echo json_encode($data);

}


?>