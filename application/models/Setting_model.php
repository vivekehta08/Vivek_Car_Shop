<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Setting Model - WhatsApp, logo, SEO, etc.
 */
class Setting_model extends CI_Model {

    private $cache = array();

    public function __construct() {
        parent::__construct();
    }

    public function get($key) {
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }
        $row = $this->db->where('setting_key', $key)->get('settings')->row();
        $val = $row ? $row->setting_value : NULL;
        $this->cache[$key] = $val;
        return $val;
    }

    public function set($key, $value) {
        $exists = $this->db->where('setting_key', $key)->get('settings')->row();
        if ($exists) {
            $this->db->where('setting_key', $key)->update('settings', array('setting_value' => $value));
        } else {
            $this->db->insert('settings', array('setting_key' => $key, 'setting_value' => $value));
        }
        $this->cache[$key] = $value;
        return TRUE;
    }

    public function get_all() {
        $rows = $this->db->get('settings')->result();
        $out = array();
        foreach ($rows as $r) {
            $out[$r->setting_key] = $r->setting_value;
        }
        return $out;
    }

    /**
     * Get WhatsApp number (formatted for API)
     */
    public function get_whatsapp_number() {
        $num = $this->get('whatsapp_number');
        if ($num) {
            $num = preg_replace('/[^0-9]/', '', $num);
            if (strlen($num) == 10) $num = '91' . $num;
        }
        return $num;
    }

    /**
     * Get WhatsApp URL for a message
     */
    public function get_whatsapp_url($message) {
        $num = $this->get_whatsapp_number();
        return 'https://wa.me/' . $num . '?text=' . urlencode($message);
    }
}
