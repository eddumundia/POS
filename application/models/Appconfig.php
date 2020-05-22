<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Appconfig class
 */

class Appconfig extends CI_Model
{
	public function exists($key)
	{
		$this->db->from('app_config');
		$this->db->where('app_config.key', $key);

		return ($this->db->get()->num_rows() == 1);
	}

	public function get_all()
	{
		$this->db->from('app_config');
		$this->db->order_by('key', 'asc');

		return $this->db->get();
	}

	public function get($key, $default = '')
	{
		$query = $this->db->get_where('app_config', array('key' => $key), 1);

		if($query->num_rows() == 1)
		{
			return $query->row()->value;
		}

		return $default;
	}

	public function save($key, $value)
	{
		$config_data = array(
			'key'   => $key,
			'value' => $value
		);

		if(!$this->exists($key))
		{
			return $this->db->insert('app_config', $config_data);
		}

		$this->db->where('key', $key);

		return $this->db->update('app_config', $config_data);
	}

	public function batch_save($data)
	{
		$success = TRUE;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		foreach($data as $key=>$value)
		{
			$success &= $this->save($key, $value);
		}

		$this->db->trans_complete();

		$success &= $this->db->trans_status();

		return $success;
	}

	public function delete($key)
	{
		return $this->db->delete('app_config', array('key' => $key));
	}

	public function delete_all()
	{
		return $this->db->empty_table('app_config');
	}

	public function acquire_save_next_invoice_sequence()
	{
		$last_used = $this->get('last_used_invoice_number') + 1;
		$this->save('last_used_invoice_number', $last_used);
		return $last_used;
	}

	public function acquire_save_next_quote_sequence()
	{
		$last_used = $this->get('last_used_quote_number') + 1;
		$this->save('last_used_quote_number', $last_used);
		return $last_used;
	}

	public function acquire_save_next_work_order_sequence()
	{
		$last_used = $this->get('last_used_work_order_number') + 1;
		$this->save('last_used_work_order_number', $last_used);
		return $last_used;
	}
}
?>
