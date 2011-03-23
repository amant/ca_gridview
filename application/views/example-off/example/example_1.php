<fieldset>
	<legend>Country List - Example 1</legend>
<?php echo render_partial('/ca_gridview') ?>
</fieldset>

<fieldset>
<legend>CA Grid-View Wiki</legend>
    <p>Steps that are involved in setting up this Grid</p>
    <ol>
    	<li>
        	Setup Parameters
            <ol>
            	<li>set_query: Pass Query From Model</li>
                <li>set_pagination: Define Pagination and Default ordering and offset values</li>
                <li>set_colum: Define Page Column that are to be shown</li>
            </ol>
        </li>        
        <li>
        	Initalize Grid
            <ul>
            	<li>
                	Init the Grid by sending down the parameters <br/>
                	$this->ca_gridview->render_grid($grid_params);                </li>
            </ul>
        </li>
        <li>
        	Setup the View
            <ul>
            	<li> 
                	We then setup the view file with this code <br />
                	&lt;?= render_partial('/ca_gridview') ?&gt;                </li>
            </ul>
        </li>
        <li>
        	Render Page
        	<ul>
            	<li>
                	We then Render the page<br />
                    $this-&gt;ocular-&gt;render();</li>
            </ul>
        </li>
    </ol>
</fieldset>

<fieldset>
<legend>Code</legend>
<form>
  <p>Model Code</p>
  <textarea cols="100" rows="20">
class Application_Model extends CI_Model
{
    function Application_Model()
    {
        parent::Model();			
    }
    
    function country() {
        return $this->db->get('country');			
    }
    
    
}
   </textarea>
  <p>View Code</p>
  <textarea cols="100" rows="20">
	<p>Country List - Example 1</p>
	&lt;?= render_partial('/ca_gridview') ?&gt;
  </textarea>
  
  <p>Controller Code</p>
  <textarea cols="100" rows="50">
class Example extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Application_Model','app_model');
        $this->load->library('ca_gridview');			
    }
		
    function index()
    {
        $grid_params = array(
            'set_query' => $this->app_model->country(),
            
            'set_pagination' => array(
                'enable' => true,
                'initialize'=> array('base_url'=>site_url()."/example/index", 'per_page'=>25, 'num_links'=>5),
                'order_field' => 'country_id',
                'order_type' => 'ASC',
                'offset' => 0
            ),
            
            'set_column' => array(
                'country_id' => array(
                    'title' => 'Country-ID',
                    'type' => array('text'),
                ),
                'region_id' => array(
                    'title' => 'Region-ID',
                    'type' => array('text'),
                ),
                'country_name' => array(
                    'title' => 'Country',
                    'type' => array('text'),
                ),
                'country_3_code' => array(
                    'title' => 'CODE 3',
                    'type' => array('text'),
                ),
                'country_2_code' => array(
                    'title' => 'CODE 2',
                    'type' => array('text'),
                )
            )
        ); 			
        $this->ca_gridview->render_grid($grid_params); 		
        $this->ocular->render();			
    }
}        
    	
    </textarea>
</form>
</fieldset>
Page Renders in {elapsed_time} seconds