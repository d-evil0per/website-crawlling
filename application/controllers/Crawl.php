<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crawl extends CI_Controller {

function __construct() {
        parent::__construct();
        header('X-Frame-Options: GOFORIT');
         $this->load->helper('url');
    }

	public function index()
	{
		$this->load->view('index');
	}

	 function crawlurl()
	{

				$url=$_POST['url'];
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
				$image=$doc->getElementsByTagName('img');
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
				    $linktag = $links->item($i); 
				     if($linktag->getAttribute('href')!="" )
				    {
				      if($linktag->getAttribute('href')!="#" )
				    {
				  if($linktag->getAttribute('href')!="javascript:void(0);" )
				    {
				    	if (filter_var($linktag->getAttribute('href'), FILTER_VALIDATE_URL) == false) {
				    		$linkurl=$url."/".$linktag->getAttribute('href');
				    	}
				    	else
				    	{
				    		$linkurl=$linktag->getAttribute('href');
				    	}

				    $link.="<a href='".$linkurl."' target='_blank'>".$linkurl."</a><br>"; 

					}}
					}
				}

				$img="";
				for ($i = 0; $i < $image->length; $i++)
				{
				    $imagetag = $image->item($i);
				    if($imagetag->getAttribute('src')!="")
				    {
				    	if (filter_var($imagetag->getAttribute('src'), FILTER_VALIDATE_URL) == false) {
				    		$img_src=$url."/".$imagetag->getAttribute('src');
				    	}
				    	else
				    	{
				    		$img_src=$imagetag->getAttribute('src');
				    	}
				    $img.="<img style='margin:5px;' src='".$img_src."' width='100' height='100' >"; 	
				    }
				    
				}

				if($ogtitle=="")
				{
				    $ogtitle=$title;
				}
				if($ogdescription=="")
				{
				    $ogdescription=$description;
				}
				if (filter_var($ogimage, FILTER_VALIDATE_URL) == false) {
				    		$ogimage=$url."/".$ogimage;
				    	}
				    	
				$content = @file_get_contents($url);
				$data = array('ogtitle' =>$ogtitle ,
				               'ogdescription'=>$ogdescription,
				               'ogimage'=>$ogimage,
				               'ogvideo'=>$ogvideo,
				               'host'=>$host["host"],
				               'link'=>$link,
				               'image'=>$img,
				               'previewurl'=>$url,
				               'source'=>$content
				                            );

				echo json_encode($data);
				
	}

}
