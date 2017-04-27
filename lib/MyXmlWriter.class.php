<?php
/**
 * Class for writing XML documents into files or standart output.
 * Use OpenFile method to select file
 * In default settings class writes to standart output with 
 * indentations of the elements
 *
 */
class MyXmlWriter
{
  private $_file;
  private $_sOpenedTags;
  private $_sTop = 0;
  private $_unclosedBeginTag = 0;
  private $_needSpace = 0;

  public $encoding = "utf-8";
  
  /**
   * Current level of indentation.
   * Default: 0
   * 
   * @var int
   */
  public $Indents = 0; 
  /**
   * Quotation mark used for atribute values,
   * Default: "
   * 
   * @var string 
   */
  public $Quotation = '"';
  /**
   * Set whether XmlWriter should indent tags in the document
   * to follow the hierarchical structure
   * Default: true
   * 
   * @var bool 
   */
  public $UseIndents = 1;
  /**
   * Ending line sequence
   * Default: "\n"
   * @var string 
   */
  public $EndLine = "\n";
  /**
   * Indent string for one level of indentation.
   * Default: "    "
   * 
   * @var string 
   */
  public $Indent = "    ";
  
  /**
   * Enter description here...
   *
   * @var unknown_type
   */
  public $stg;
  
  public $htmlentities;
  
  /**
   * Initialize the XmlWriter Class
   *
   * @param string $FileName - file to write [optional]
   */
  public function __construct($FileName = null)
  {
    $this->OpenFile($FileName);
  }
  
  private function _makeSpace()
  {
  	if ($this->_needSpace) 
  		if (!$this->_file)
    	  echo " ";
    	else 
    		fwrite($this->_file, " ");
    $this->_needSpace = 0;
  }
  
  private function _write($string)
  {
    if (!$this->_file)
      echo $string;
    else 
    {
      fwrite($this->_file, $string);
      
    }
  }
  
  private function _pushTag($TagName)
  {
    $this->_sOpenedTags[$this->_sTop] = $TagName;
    $this->_sTop++;
  }
  
  private function _popTag()
  {
    $this->_sTop--;
    return $this->_sOpenedTags[$this->_sTop]; 
  }
  
  private function _doIndent()
  {
    if ($this->UseIndents)
    {
      for ($i = 0; $i < $this->Indents; $i++ )
        $this->_write($this->Indent);
    }
  }
  
  /**
   * Writes typical declaration of xml document.
   * For another declaration just use the FreeWrite method 
   *
   * @param string $Version - XML version
   * @param string $Encoding - character set encoding
   */
  public function WriteXMLDeclaration($Version = "1.0", $Encoding = "utf-8")
  {
  	if ($Encoding != "" && $Encoding != null)
  	{  	  
  	  $this->encoding = $Encoding;
    	$this->_write("<?xml version=".$this->Quotation.$Version.$this->Quotation." encoding=".$this->Quotation.$Encoding.$this->Quotation."?>".$this->EndLine);
    	
  	}
  	else 
  		$this->_write("<?xml version=".$this->Quotation.$Version.$this->Quotation."?>".$this->EndLine);
  }
  
  /**
   * Opens file with given filename for writing 
   * Content of existing file will be lost
   * if no file is opened, the writer writes to standart output
   *
   * @param string $FileName - filename (can be with path)
   */
  public function OpenFile($FileName)
  {
    if ($FileName != null)
    {
      if ($this->_file)
        fclose($this->file);
      $this->_file = fopen($FileName, "w");
    }
    else 
      $this->_file = null;
  }
  
  /**
   * Writes openning tag
   *
   * @param string $TagName - tag to write
   */
  public function WriteBeginTag($TagName)
  { 
    if ($this->_unclosedBeginTag)
    {
      $this->_write(">".$this->EndLine);
      $this->_unclosedBeginTag = 0;     
    }
    $this->_doIndent();
    $this->_write("<$TagName");
    $this->_needspace = 1;
    $this->_pushTag($TagName);
    $this->_unclosedBeginTag = 1;
    $this->Indents++;
    $this->_needSpace = 1;
  }
  
  /**
   * Writes attribute and value for current opened tag
   * htmlentities from global settings
   *
   * @param string $Attribute - atribute name
   * @param string $Value - value of the atribute
   * 
   */
	public function WriteAttribute($Atribute, $Value)
	{
		$this->WriteAttributeControlEntities($Atribute, $Value, $this->htmlentities);
		
	}
  /**
   * Writes attribute and value for current opened tag
   *
   * @param string $Attribute - atribute name
   * @param string $Value - value of the atribute
   * @param bool $HtmlEntities - if true, text will be pre-processed before
   *                             writing to prevent cross site scripting
   */
	
	public function WriteAttributeControlEntities($Attribute, $Value, $HtmlEntities)
  {
    if (!$this->_unclosedBeginTag)
      throw new Exception("XMLWriter Error: Writing attribute when no tag is opened.");
    $this->_makeSpace();
    if ($HtmlEntities)
      $Value = htmlentities($Value);
    $this->_write("$Attribute=$this->Quotation".$Value."$this->Quotation");
    $this->_needSpace = 1;
  }
  
  /**
   * Writes text of the tag, htmlentities from global settings
   *
   * @param string $Text - text to write
   * 
   */
  public function WriteText($Text)
  {
  	$this->WriteTextControlEntities($Text, $this->htmlentities);
  }
  
  /**
   * Writes text of the tag
   *
   * @param string $Text - text to write
   * @param bool $HtmlEntities - if true, text will be pre-processed before
   *                             writing to prevent cross site scripting
   */
  public function WriteTextControlEntities($Text, $HtmlEntities = 1)
  {
    
    if ($this->_unclosedBeginTag)
    {
      $this->_write(">$this->EndLine");
      $this->_unclosedBeginTag = 0;     
    }
    if ($HtmlEntities)
      $Text = htmlentities($Text);
    $this->_doIndent();
    $this->_write($Text.$this->EndLine);
  }
  
  /**
   * Writes closing tag for the current opened tag
   */
  public function CloseTag()
  {
    if ($this->_unclosedBeginTag)
    {
      $this->_write("/>$this->EndLine");
      $this->_unclosedBeginTag = 0;
    }
    else 
    {
      $this->Indents--;
      $this->_doIndent();
      $this->_write("</".$this->_popTag().">$this->EndLine");
    }  
  }
  
  /**
   * Writes string into the document without formating
   *
   * @param string $string - string to write
   */
  public function FreeWrite($string)
  {
    $this->_write($string);
  }
  
  /**
   * Closes all currently opened tags
   *
   */
  public function CloseAllTags()
  {
    while ($this->_sTop > 0)
      $this->CloseTag(); 
  }

  /**
   * Writes XML comment
   *
   * @param string $Comment - Comment text
   */
  public function WriteComment($Comment)
  {
    $this->_doIndent();
    $this->_write("<!-- $Comment -->".$this->EndLine);
  }
  
  /**
   * Writes string like <$NodeName>$NodeText</$NodeName>
   *
   * @param string $NodeName
   * @param string $NodeText
   */
  public function WriteSimpleTextNode($NodeName, $NodeText)
  {
  	if ($this->_unclosedBeginTag)
    {
      $this->_write(">".$this->EndLine);
      $this->_unclosedBeginTag = 0;     
    }
    $this->_write($this->EndLine);
    $this->_doIndent();
  	$this->_write("<$NodeName>");
  	$this->_write($NodeText);
  	$this->_write("</$NodeName>");
  	
  }
}

/*
$xml = new XMLWriter();
//$xml->OpenFile("out.xml");
$xml->WriteXMLDeclaration();
$xml = new XMLWriter();
$xml->WriteBeginTag("html");
$xml->WriteBeginTag("head");
$xml->WriteBeginTag("title");
$xml->WriteText("Titulek");
$xml->CloseTag();
$xml->CloseTag();
$xml->WriteComment("koment");
$xml->WriteBeginTag("body");
$xml->WriteAttribute("bgColor", "AAAAAA");
$xml->WriteText("tag <a> se pouziva pro odkazy");
$xml->CloseAllTags();
*/
?>
