<?php

/**
 * json带格式输出
 * @author  tadaydayup
 * @version 1.0.0
 * @date    2019-02-13
 * @desc    description
 * @param   [array]          $data   [数据]
 * @param   [string]         $indent [缩进字符，默认4个空格 ]
 */
function JsonFormat($data, $indent = null)
{
    // json encode  
    $data = json_encode($data, JSON_UNESCAPED_UNICODE);
  
    // 缩进处理  
    $ret = '';
    $pos = 0;
    $length = strlen($data);
    $indent = isset($indent)? $indent : '    ';
    $newline = "\n";
    $prevchar = '';
    $outofquotes = true;
  
    for($i=0; $i<=$length; $i++)
    {
        $char = substr($data, $i, 1);
  
        if($char == '"' && $prevchar != '\\')
        {
            $outofquotes = !$outofquotes;  
        } elseif(($char == '}' || $char == ']') && $outofquotes)
        {
            $ret .= $newline;
            $pos--;
            for($j=0; $j<$pos; $j++)
            {
                $ret .= $indent;
            }
        }
  
        $ret .= $char;  

        if(($char == ',' || $char == '{' || $char == '[') && $outofquotes)
        {
            $ret .= $newline;
            if($char == '{' || $char == '[')
            {
                $pos++;
            }
  
            for($j=0; $j<$pos; $j++)
            {
                $ret .= $indent;
            }
        }
  
        $prevchar = $char;
    }
  
    return $ret;  
}