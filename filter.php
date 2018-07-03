<?php
/**
 * Created by PhpStorm.
 * User: frycj
 * Date: 02/05/2018
 * Time: 16:23
 */

class filter_linklight extends moodle_text_filter
{

    /**
     * Override this function to actually implement the filtering.
     *
     * @param $text some HTML content.
     * @param array $options options passed to the filters
     * @return the HTML content after the filtering has been applied.
     */
    public function filter($text, array $options = array())
    {
        global $CFG;
        $matches=[];
        preg_match_all('/<a[^\>]*>/',$text,$matches,PREG_OFFSET_CAPTURE);
        for($i=count($matches[0])-1;$i>=0;$i--) // We need to go from end. Otherwise we would break positioning
        {
            $match=$matches[0][$i];
            if(count($match)==0)
                continue;
            $pos=strpos($match[0],'href=')+5;

            if(strpos($match[0],$CFG->wwwroot,$pos)==$pos+1)
                $text=$this->internal_link($text,$match[1],strlen($match[0]));
            else
                $text=$this->external_link($text,$match[1],strlen($match[0]));

        }
        return $text;
    }
    private function external_link(string $text,int $before_a,int $a_length)
    {
        $text=substr($text,0,$before_a)."&nbsp;".substr($text,$before_a,$a_length)."<i class='fa fa-globe'></i>".substr($text,$before_a+$a_length);
        return $text;
    }
    private function internal_link(string $text,int $before_a,int $a_length)
    {
        $text=substr($text,0,$before_a)."&nbsp;".substr($text,$before_a,$a_length)."<i class='fa fa-link'></i>&nbsp;".substr($text,$before_a+$a_length);
        return $text;
    }
}