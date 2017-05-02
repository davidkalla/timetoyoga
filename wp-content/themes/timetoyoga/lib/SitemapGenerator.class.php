<?php
require_once("MyXmlWriter.class.php");

class SitemapGenerator
{
	/**
	 * Generuje Sitemap dle protokolu - www.sitemaps.org
	 * V resource musi byt pouzit SQL konstrukt AS
	 * (AS loc, AS lastmod[opt], AS priority[opt], as changefreq[opt]
	 */
	
	private $w;
	
	public function WriteHeader($filename, $encoding = null)
	{
		$this->w = new MyXmlWriter($filename);
		$this->w->WriteXMLDeclaration("1.0", $encoding);
		$this->w->WriteBeginTag("urlset");
			$this->w->WriteAttribute("xmlns:xsi", "http://www.sitemaps.org/schemas/sitemap/0.9");
      $this->w->WriteAttribute("xsi:schemaLocation","http://www.sitemaps.org/schemas/sitemap/0.9 \n".
         "http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd");
      $this->w->WriteAttribute("xmlns","http://www.sitemaps.org/schemas/sitemap/0.9");
	}
	public function WriteFooter()
	{
		$this->w->CloseTag(); //urlset
	}
	
	public function GenerateURLsFromResource($res)
	{
		/* parsing passed resource */
		while ($item = mysql_fetch_object($resource))
		{
			$loc = ""; $lastmod =""; $changefreq = ""; $priority = "";
			if (array_key_exists("loc", $item))
				$loc = $item->loc;
			if (array_key_exists("lastmod", $item))
				$lastmod = $item->lastmod;
			if (array_key_exists("priority", $item))
				$priority = $item->priority;
			if (array_key_exists("changefreq", $item))
				$changefreq = $item->changefreq;
			$this->GenerateUrl($loc, $lastmod, $priority, $changefreq);
		}
	}
	
	public function GenerateUrl($loc, $lastmod = "", $priority = "", $changefreq = "")
	{
		$this->w->WriteBeginTag("url");
			if ($loc != "")
			$this->w->WriteSimpleTextNode("loc", $loc);
			if ($lastmod != "")
			$this->w->WriteSimpleTextNode("lastmod", $lastmod);
			if ($priority != "")
			$this->w->WriteSimpleTextNode("priority", $priority);
			if ($changefreq != "")
			$this->w->WriteSimpleTextNode("changefreq", $changefreq);
		$this->w->CloseTag();		
	}
}




?>
