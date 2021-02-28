
<?php
/*
Parser is base class that can get data with regexs and the content by below functions
*/

class Parser{
    protected $content,$titleRegex,$dateRegex,$contentRegex;
    public function getTitle(){
        preg_match($this->titleRegex,$this->content,$matches);
        return $matches[1];
    }
    public function getContent(){
        preg_match($this->contentRegex, $this->content,$matches);
        return  $matches[1];
    }
    public function getDate(){
        preg_match($this->dateRegex,$this->content,$matches);
        return $matches[1];
    }
}
?>