<?php
class Menu_m extends DIP_Model{

	public $rules = array(
			'holes' =>  array(
					'field'=>'holes',
					'label'=>'Hole',
					'rules'=>'trim|xss_clean|integer|required'
			),
			'par' =>  array(
					'field'=>'par',
					'label'=>'Par',
					'rules'=>'trim|xss_clean|integer|required'
			),
			'length' =>  array(
					'field'=>'length',
					'label'=>'Length',
					'rules'=>'xss_clean|required'
			),
	);

	function __construct(){
		parent::__construct();
	}

	public function get_menu_section($uid, $id=null){
		$u = new Menu_section();
		$u->where(array('id'=>$id,'user_id'=>$uid))->get();
		$u->stored->name = decode_data($u->name);
		return $u->stored;
	}
	public function save_menu_section($post,$pid,$id=null){
		$r = new Menu_section();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->user_id = $pid;
			
			//getting the next position
			$rp = new Menu_section();
			$rp->select_max('position');
			$rp->where('user_id',$pid);
			$rp->get();
			$r->position = intval($rp->position) + 1;
		}
		$r->name = encode_data($post['name']);
		$success = $r->save();
		if(!$success)
			return false;
		else
			return true;
	}
	public function position_menu_section($pos,$pid,$id){
		$r = new Menu_section();
		$r->get_by_id($id);
		
		//check if the position exists or not
		$ud = new Menu_section();
		$ud->where(array('position'=>$pos,'user_id'=>$pid))->get();
		if($ud->exists()){
			$or = new Menu_section();
			if($pos < $r->position){
				$s = $or->where(array('user_id'=>$pid, 'position >=' => $pos,'position <' => $r->position))
					->update('position' ,'position + 1', FALSE);
			}else{
				$s = $or->where(array('user_id'=>$pid, 'position <=' => $pos,'position >' => $r->position))
					->update('position' ,'position - 1', FALSE);
			}

			$r->position = $pos;
			$success = $r->save();
			if(!$success)
				return false;
			else
				return true;
		}
	}
	public function delete_menu_section($pid,$id){
		$r = new Menu_section();
		$r->where(array('id'=>$id,'user_id'=>$pid))->get();
		if($r->exists()){
			$mi = new Menu_item();
			$mi->where('menu_section_id',$id)->get();
			$mi->delete_all();

			$or = new Menu_section();
			$or->where(array('user_id'=>$pid, 'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}



	// course rate sections
	public function get_menu_item($uid, $id=null){
		$u = new Menu_item();
		$u->where(array('id'=>$id,'menu_section_id'=>$uid))->get();
		$u->stored->descr = decode_data($u->descr);
		$u->stored->price = decode_data($u->price);
		$u->stored->currency = decode_data($u->currency);
		return $u->stored;
	}
	public function save_menu_item($post,$pid,$id=null){
		$r = new Menu_item();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->menu_section_id = $pid;
			
			//getting the next position
			$rp = new Menu_item();
			$rp->select_max('position');
			$rp->where('menu_section_id',$pid);
			$rp->get();
			$r->position = intval($rp->position) + 1;
		}
		$r->descr = encode_data($post['descr']);
		$r->price = encode_data($post['price']);
		$r->currency = encode_data($post['currency']);
		$success = $r->save();
		if(!$success)
			return false;
		else
			return true;
	}
	public function position_menu_item($pos,$pid,$id){
		$r = new Menu_item();
		$r->get_by_id($id);

		//check if the position exists or not
		$ud = new Menu_item();
		$ud->where(array('position'=>$pos,'menu_section_id'=>$pid))->get();
		if($ud->exists()){
			$or = new Menu_item();
			if($pos < $r->position){
				$s = $or->where(array('menu_section_id'=>$pid, 'position >=' => $pos,'position <' => $r->position))
					->update('position' ,'position + 1', FALSE);
			}else{
				$s = $or->where(array('menu_section_id'=>$pid, 'position <=' => $pos,'position >' => $r->position))
					->update('position' ,'position - 1', FALSE);
			}
			$r->position = $pos;
			$success = $r->save();
			if(!$success)
				return false;
			else
				return true;
		}
	}
	public function delete_menu_item($pid,$id){
		$r = new Menu_item();
		$r->where(array('id'=>$id,'menu_section_id'=>$pid))->get();
		if($r->exists()){
			$or = new Menu_item();
			$or->where(array('menu_section_id'=>$pid, 'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}
}