<?php

class Xtra_m extends DIP_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all_languages() {
        $l = new Language();
        $l->get();
        $result = array();
        foreach ($l as $li) {
            $result[$li->id] = $li->name;
        }
        return $result;
    }

    public function get_all_facilities() {
        $langs = new Facility();
        $langs->get();
        $result = array();
        foreach ($langs as $lang) {
            $result[$lang->id] = $lang->name;
        }
        return $result;
    }

    public function get_all_countries() {
        $this->load->helper('text');
        $countries = new Country();
        $countries->order_by("country_name", "asc")->get();
        $data = array();
        foreach ($countries as $country) {
            $data[$country->country_code] = ascii_to_entities($country->country_name);
        }
        return $data;
    }

    public function get_all_currencies() {
        $c = new Currency();
        $c->order_by('currency_name', 'asc');
        $c->get();
        $data = array();
        foreach ($c as $currency) {
            $data[$currency->currency_code] = $currency->currency_code . ' - ' . $currency->currency_name;
        }
        return $data;
    }

    public function get_currency_by_country($country_code) {
        $country = new Country();
        $country->get_by_country_code($country_code);
        return $country->currency_code;
    }

    public function get_ratings($client_id) {
        $u = new User();
        $u->get_by_id($client_id);
        if (!$u->exists())
            $this->api->error(100);
        if ($u->creation_date)
            $cdate = $u->creation_date;
        else
            $cdate = '2015-01-01';
        $month_diff = (strtotime(date('Y-m-d')) - strtotime($cdate)) / (86400 * 30); // time difference in month

        $sql = 'select user_id, COUNT(id) as count, SUM(over_all_condition) as oc, SUM(value) as vl, SUM(place_of_play) as pp, SUM(staff_friendliness) as sf, SUM(food_and_beverage) as fb, SUM(course_condition) as cc';
        $sql .= ' from dip_nt_ratings where user_id=' . $client_id . ' group by user_id';

        $query = $this->db->query($sql);
        $row = $query->row();
        if ($query->num_rows() < 1)
            return null;

        $rating = new stdClass;
        $rating->over_all_condition = $this->get_rating_average($row->oc, $row->count, $month_diff);
        $rating->value = $this->get_rating_average($row->vl, $row->count, $month_diff);
        $rating->place_of_play = $this->get_rating_average($row->pp, $row->count, $month_diff);
        $rating->staff_friendliness = $this->get_rating_average($row->sf, $row->count, $month_diff);
        $rating->food_and_beverage = $this->get_rating_average($row->fb, $row->count, $month_diff);
        $rating->course_condition = $this->get_rating_average($row->cc, $row->count, $month_diff);
        $rating->total_rating = round(($rating->over_all_condition + $rating->value + $rating->place_of_play + $rating->staff_friendliness + $rating->food_and_beverage + $rating->course_condition) / 6);
        $rating->total_review = (int) $row->count;
        return $rating;
    }

    public function get_rating_average($item, $count, $month_diff) {
        $avgRating = 5;
        $minReview = 10;
        // getting the rating average
        $avg = (($minReview * $avgRating) + $item) / ($minReview + $count);
        // taking consideration of popularity
        $pop = $count / ($count + ($month_diff * 0.1));
        return round($avg * $pop);
    }

    public function get_max_id($table) {
        $query = $this->db->query('SELECT MAX(id) as max_id FROM ' . $table);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $maxid = $row->max_id;
        } else {
            $maxid = 1;
        }
        return $maxid;
    }

    public function get_next_pos($table, $uid) {
        $query = $this->db->query('SELECT MAX(position) as max_id FROM ' . $table . ' WHERE user_id=' . $uid);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $maxid = (int) $row->max_id;
        } else {
            $maxid = 0;
        }
        return ($maxid + 1);
    }

    public function currencyConverter1($currencyFrom, $currencyTo, $currencyValue) {
		$query = $this->db->query('SELECT currency_code, to_currency, new_rate FROM dip_exchangerate WHERE currency_code = "'.$currencyFrom.'" AND to_currency = "'.$currencyTo.'"');
    	if ($query->num_rows() > 0) {
            $row = $query->row();
            return ($currencyValue / $row->new_rate);
        }else{
            return currencyValue;
        }
    }

}
