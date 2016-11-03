<?php
/**
 * @title            QR Code Genarator
 * @author           Dipendu D3v <dipendu.d3v@gmail.com>
 * @copyright        (c) 2012-2013, Dipendu-Das. All Rights Reserved.
 * @license          GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 * @version          1.1
 */

class QRCode
{
    const API_URL = 'http://chart.apis.google.com/chart?chs=';
    public $data;

    public function __construct(){
        $this->data = array();
    }
    public function get_data(){
        return $this->data;
    }
    public function get_data_str(){
        $str = '';
        foreach($this->data as $key=>$value){
            $str .= $key.':'.$value."\n";
        }
        return $str;
    }
    public function add_data($key,$value)
    {
        if($key){
            $this->data[$key] = $value;
        }else{
            $this->data[] = $value;
        }
    }

    public function get($iSize = 200, $sECLevel = 'H', $iMargin = 1)
    {
        $Data = urlencode($this->get_data_str());
        return self::API_URL . $iSize . 'x' . $iSize . '&cht=qr&chld=' . $sECLevel . '|' . $iMargin . '&chl=' . $Data;
    }
    public function get_url(){
        return $this->get();
    }
    public function display()
    {
        echo '<img src="' . $this->_cleanUrl($this->get()) . '" alt="QR Code" />';
    }
}
