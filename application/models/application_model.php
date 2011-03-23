<?php
	class Application_Model extends CI_Model
	{
	   function __construct()
       {
            parent::__construct();			
		}

		function country()
		{
			return $this->db->get_where('country', array('region_id !=' => 0));
		}

		function get_country()
		{
			$sql = "SELECT
						country.*,
						region.name as region
					FROM
						country, region
					WHERE
						country.region_id = region.region_id
					";
			$this->db->query($sql);
		}
	}