<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
  /**
  *  CI Library for jqGrid
  *
  * This is a wrapper class/library for server-side implementation of jqGrid in Code Ignighter
  *
  * @package    CodeIgniter
  * @subpackage libraries
  * @category   library
  * @version    1.0 <beta>
  * @author     Dipendu D3v <dipendu.d3v@gmail.com>
  *             CodeNTrix <info@codentrix.com>
  * @link       http://codentrix.com
  */
  class Jqgrid
  {
    private $ci;
    private $table;
    private $select;
    private $where;
    private $columns = array();
    private $sColumns = array();
    
    private $query;
    private $page;
    private $total;
    private $records;
    private $rows = array();
    private $param = array();
    
    
    /**
    * Copies an instance of CI
    */
    public function __construct()
    {
      $this->ci =& get_instance();
      return $this;
    }
    public function from($table){
      $this->table = $table;
      return $this;
    }
    public function select($columns){
      $this->select = $columns;
      foreach($this->explode(',', $columns) as $val)
      {
        $column = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$2', $val));
        $column = preg_replace('/.*\.(.*)/i', '$1', $column); // get name after `.`
        $this->columns[] =  $column;
      }
      return $this;
    }
    /**
    * get all searchable columns
    */
    public function searchable($columns)
    {
      foreach($this->explode(',', $columns) as $val)
      {
        $column = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$2', $val));
        $column = preg_replace('/.*\.(.*)/i', '$1', $column); // get name after `.`
        $this->sColumns[] =  $column;
      }
      return $this;
    }
    /**
    * WHERE clause
    */
    public function where($str){
      $this->where = $str;
      return $this;
    }

    public function query($str){
      $this->query = $str;
      return $this;
    }
    

    /**
    * set request type
    */
    public function set_param($type=null){
      if($type == 'POST')
        $this->param = $this->ci->input->post();
      else
        $this->param = $this->ci->input->get();
      
      return $this;
    }

    /**
    * Building the output
    */
    public function get_result($format=null){

      $SQL = $this->get_query();
      $responce = new stdClass;
      $responce->page = $this->page;
      $responce->total = $this->total;
      $responce->records = $this->records;
      $responce->rows = array();
      $query = $this->ci->db->query($SQL);
      foreach($query->result_array() as $row) {
          $responce->rows[]=$row;
      }
      if($format == 'json')
        return json_encode($responce);
      else
        return $responce;
    }

    public function get_query(){
      // check for request parameters
      if(empty($this->param))
        $this->set_param();

      $page = (int)$this->param['page']; // get the requested page
      $limit = $this->param['rows']; // get how many rows we want to have into the grid
      $sidx = $this->param['sidx']; // get index row - i.e. user click to sort
      $sord = strtoupper($this->param['sord']); // get the direction
      $gsearch = (isset($this->param['globalSearch'])? $this->param['globalSearch'] :'');
      if(!$sidx) $sidx =1;

      // Basic Query Srtring
      if($this->query == ''){
        if($this->table != ''){
          if($this->select != '')
            $this->query = "SELECT $this->select FROM $this->table";
          else
            $this->query = "SELECT * FROM $this->table";
        }else return false;
      }

      // construct global search %LIKE% where clause
      if($gsearch!=''){
          $gsearch= encode_ascii($gsearch);
          if(!empty($this->sColumns))
            $searchable = $this->sColumns;
          else
            $searchable = $this->columns;

          if(!empty($searchable)){
            $sWhere = "(";
            foreach($searchable as $col){
              $sWhere .= $col." LIKE '%" .$gsearch. "%' OR ";
            }
            $sWhere = substr_replace($sWhere, '', -3);
            $sWhere.= ")";
          }else{
            $sWhere = "* LIKE '%" .$gsearch. "%'";
          }

          if($this->where!='')
            $this->where .= ' AND '.$sWhere;
          else
            $this->where = $sWhere;
      }

      // get user defind where clause
      if($this->where != ''){
        $this->query .= " WHERE ".$this->where;
      }
      // Count Rows
      $query = $this->ci->db->query($this->query);
      $count = $query->num_rows();

      // Add Paging
      if( $count > 0 ) {
        $total_pages = ceil($count/$limit);
      } else {
        $total_pages = 0;
      }
      if($page > $total_pages) $page=$total_pages;
      $start = $limit*$page - $limit; // do not put $limit*($page - 1)
      if($start < 0) $start = 0;
      $this->query .= " ORDER BY $sidx $sord LIMIT $start , $limit";

      $this->page = $page;
      $this->total = $total_pages;
      $this->records = $count;
      // return query
      return $this->query;
    }












    /**
    * Return the difference of open and close characters
    *
    * @param string $str
    * @param string $open
    * @param string $close
    * @return string $retval
    */
    private function balanceChars($str, $open, $close)
    {
      $openCount = substr_count($str, $open);
      $closeCount = substr_count($str, $close);
      $retval = $openCount - $closeCount;
      return $retval;
    }

    /**
    * Explode, but ignore delimiter until closing characters are found
    *
    * @param string $delimiter
    * @param string $str
    * @param string $open
    * @param string $close
    * @return mixed $retval
    */
    private function explode($delimiter, $str, $open = '(', $close=')')
    {
      $retval = array();
      $hold = array();
      $balance = 0;
      $parts = explode($delimiter, $str);

      foreach($parts as $part)
      {
        $hold[] = $part;
        $balance += $this->balanceChars($part, $open, $close);

        if($balance < 1)
        {
          $retval[] = implode($delimiter, $hold);
          $hold = array();
          $balance = 0;
        }
      }

      if(count($hold) > 0)
        $retval[] = implode($delimiter, $hold);

      return $retval;
    }
}