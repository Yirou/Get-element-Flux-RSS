<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Feed extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
/**
 * get all feed on korben site
 */
    function get() {
        $url = "http://korben.info/feed";
        $rss = simplexml_load_file($url);
//        $data["rss"] = $rss;
        $data['title'] = "Flux RSS Korben";
        $footer['developper_name']="BY73";
        $url_paginate = base_url() . "feed/get";
        $number = count($rss->channel->item);
        $per_page = 10;
        $begin_number = $this->uri->segment(3);
        $this->pagination($per_page, $number, $url_paginate);
        $data['rss'] = $this->get_flux_rss($rss, $per_page, $begin_number);
        $this->load->view("flux", $data);
        $this->load->view("footer",$footer);
    }

    /**
     * 
     * @param type $flux =>array wich contain feed
     * @param type $perpage =>number feeed per page
     * @param type $id =>id who match with the last feed
     * @return array =>return the feed which can be fetch
     */
    function get_flux_rss($flux, $perpage, $id) {
        $flux_temp = array();
        $count_all_element = count($flux);
//        $nb_element = $perpage * $id;
//        $j = 0;

//                 array_push($flux_temp, $item);
//            } else {
//                break;
//            }
//        }     foreach ($flux->channel->item as $item) {
////            print_r($item);
//            if ($count > $nb_element && $j < $perpage) {
//                $j++;
//                array_push($flux_temp, $item);
//            } else {
//                break;
//            }
//        }
        for ($i = $id+1; $i < $count_all_element - $id, $i < $perpage + $id; $i++) {
            
            array_push($flux_temp, $flux->channel->item[$i]);
        }
        return $flux_temp;
    }

    /**
     * 
     * @param type $per_page => per page number
     * @param type $number => number of feed
     * @param type $url =>pagination url
     */
    function pagination($per_page, $number, $url) {
        $this->load->library("pagination");
        $config = array();
        $config['base_url'] = $url;
        $config['total_rows'] = $number;
        $config['per_page'] = $per_page;
        $config['full_tag_open'] = '<div><ul class="pagination pagination-small pagination-centered">';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#' onclick=\"return false;\">";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);
    }

}
