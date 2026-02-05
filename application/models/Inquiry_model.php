<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Inquiry Model - Car & accessory inquiries (WhatsApp)
 */
class Inquiry_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($data) {
        $this->db->insert('inquiries', $data);
        return $this->db->insert_id();
    }

    public function get_list($filters = array(), $limit = 50, $offset = 0) {
        $this->db->select('inquiries.*, cars.id as car_id, cars.variant as car_variant, accessories.name as accessory_name');
        $this->db->from('inquiries');
        $this->db->join('cars', 'cars.id = inquiries.car_id', 'left');
        $this->db->join('accessories', 'accessories.id = inquiries.accessory_id', 'left');

        if (!empty($filters['type'])) {
            $this->db->where('inquiries.type', $filters['type']);
        }
        if (!empty($filters['from_date'])) {
            $this->db->where('inquiries.created_at >=', $filters['from_date'] . ' 00:00:00');
        }
        if (!empty($filters['to_date'])) {
            $this->db->where('inquiries.created_at <=', $filters['to_date'] . ' 23:59:59');
        }

        $this->db->order_by('inquiries.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function count_list($filters = array()) {
        $this->db->from('inquiries');
        if (!empty($filters['type'])) $this->db->where('type', $filters['type']);
        if (!empty($filters['from_date'])) $this->db->where('created_at >=', $filters['from_date'] . ' 00:00:00');
        if (!empty($filters['to_date'])) $this->db->where('created_at <=', $filters['to_date'] . ' 23:59:59');
        return $this->db->count_all_results();
    }

    /**
     * Get user's inquiry history
     */
    public function get_by_user($user_id, $limit = 20) {
        return $this->db->select('inquiries.*, cars.variant as car_variant, accessories.name as accessory_name')
            ->from('inquiries')
            ->join('cars', 'cars.id = inquiries.car_id', 'left')
            ->join('accessories', 'accessories.id = inquiries.accessory_id', 'left')
            ->where('inquiries.user_id', $user_id)
            ->order_by('inquiries.created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }
}
