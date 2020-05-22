<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Persons.php");

class Employees extends Persons
{
	public function __construct()
	{
		parent::__construct('employees');
	}

	/*
	Returns employee table data rows. This will be called with AJAX.
	*/
	public function search()
	{
		$search = $this->input->get('search');
		$limit  = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$sort   = $this->input->get('sort');
		$order  = $this->input->get('order');

		$employees = $this->Employee->search($search, $limit, $offset, $sort, $order);
		$total_rows = $this->Employee->get_found_rows($search);

		$data_rows = array();
		foreach($employees->result() as $person)
		{
			$data_rows[] = $this->xss_clean(get_person_data_row($person));
		}

		echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	public function suggest_search()
	{
		$suggestions = $this->xss_clean($this->Employee->get_search_suggestions($this->input->post('term')));

		echo json_encode($suggestions);
	}

	/*
	Loads the employee edit form
	*/
	public function view($employee_id = -1)
	{
		$person_info = $this->Employee->get_info($employee_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		$data['person_info'] = $person_info;

		$modules = array();
		foreach($this->Module->get_all_modules()->result() as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));
			$module->menu_group = $this->xss_clean($this->Employee->get_menu_group($module->module_id, $person_info->person_id));

			$modules[] = $module;
		}
		$data['all_modules'] = $modules;

		$permissions = array();
		foreach($this->Module->get_all_subpermissions()->result() as $permission)
		{
			$permission->module_id = $this->xss_clean($permission->module_id);
			$permission->permission_id = str_replace(' ', '_', $this->xss_clean($permission->permission_id));
			$permission->grant = $this->xss_clean($this->Employee->has_grant($permission->permission_id, $person_info->person_id));

			$permissions[] = $permission;
		}
		$data['all_subpermissions'] = $permissions;

		$this->load->view('employees/form', $data);
	}

	/*
	Inserts/updates an employee
	*/
	public function save($employee_id = -1)
	{
		$first_name = $this->xss_clean($this->input->post('first_name'));
		$last_name = $this->xss_clean($this->input->post('last_name'));
		$email = $this->xss_clean(strtolower($this->input->post('email')));

		// format first and last name properly
		$first_name = $this->nameize($first_name);
		$last_name = $this->nameize($last_name);

		$person_data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'gender' => $this->input->post('gender'),
			'email' => $email,
			'phone_number' => $this->input->post('phone_number'),
			'address_1' => $this->input->post('address_1'),
			'address_2' => $this->input->post('address_2'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country'),
			'comments' => $this->input->post('comments'),
		);

		$grants_array = array();
		foreach($this->Module->get_all_permissions()->result() as $permission)
		{
			$grants = array();
			$grant = $this->input->post('grant_'.$permission->permission_id) != NULL ? $this->input->post('grant_'.$permission->permission_id) : '';
			if($grant == $permission->permission_id)
			{
				$grants['permission_id'] = $permission->permission_id;
				$grants['menu_group'] = $this->input->post('menu_group_'.$permission->permission_id) != NULL ? $this->input->post('menu_group_'.$permission->permission_id) : '--';
				$grants_array[] = $grants;
			}
		}

		//Password has been changed OR first time password set
		if($this->input->post('password') != '' && ENVIRONMENT != 'testing')
		{
			$exploded = explode(":", $this->input->post('language'));
			$employee_data = array(
				'username' 	=> $this->input->post('username'),
				'password' 	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'hash_version' 	=> 2,
				'language_code' => $exploded[0],
				'language' 	=> $exploded[1]
			);
		}
		else //Password not changed
		{
			$exploded = explode(":", $this->input->post('language'));
			$employee_data = array(
				'username' 	=> $this->input->post('username'),
				'language_code'	=> $exploded[0],
				'language' 	=> $exploded[1]
			);
		}

		if($this->Employee->save_employee($person_data, $employee_data, $grants_array, $employee_id))
		{
			// New employee
			if($employee_id == -1)
			{
				echo json_encode(array('success' => TRUE,
								'message' => $this->lang->line('employees_successful_adding') . ' ' . $first_name . ' ' . $last_name,
								'id' => $this->xss_clean($employee_data['person_id'])));
			}
			else // Existing employee
			{
				echo json_encode(array('success' => TRUE,
								'message' => $this->lang->line('employees_successful_updating') . ' ' . $first_name . ' ' . $last_name,
								'id' => $employee_id));
			}
		}
		else // Failure
		{
			echo json_encode(array('success' => FALSE,
							'message' => $this->lang->line('employees_error_adding_updating') . ' ' . $first_name . ' ' . $last_name,
							'id' => -1));
		}
	}

	/*
	This deletes employees from the employees table
	*/
	public function delete()
	{
		$employees_to_delete = $this->xss_clean($this->input->post('ids'));

		if($this->Employee->delete_list($employees_to_delete))
		{
			echo json_encode(array('success' => TRUE,'message' => $this->lang->line('employees_successful_deleted') . ' ' .
							count($employees_to_delete) . ' ' . $this->lang->line('employees_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('employees_cannot_be_deleted')));
		}
	}
}
?>
