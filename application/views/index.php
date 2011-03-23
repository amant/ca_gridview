<h1>Grid Example</h1>
<p>Here are various data grid configuration example:</p>
<ul>
	<li>
		<?php echo anchor('test/example_1', 'Example1', array('target'=>'_blank')) ?>
		Basic example.
	</li>
	<li>
		<?php echo anchor('test/example_2', 'Example2', array('target'=>'_blank')) ?>
		Data grid with input Text field.
	</li>
	<li>
		<?php echo anchor('test/example_3', 'Example3', array('target'=>'_blank')) ?>
		Data grid with Radio field.
	</li>
	<li>
		<?php echo anchor('test/example_4', 'Example4', array('target'=>'_blank')) ?>
		Data grid with Select field.
	</li>
	<li>
		<?php echo anchor('test/example_5', 'Example5', array('target'=>'_blank')) ?>
		Data grid with Hyper link.
	</li>
	<li>
		<?php echo anchor('test/example_6', 'Example6', array('target'=>'_blank')) ?>
		Data grid where we embed custom html code into columns.
	</li>
	<li>
		<?php echo anchor('test/example_7', 'Example7', array('target'=>'_blank')) ?>
		Data grid where we disable sorting.
	</li>
	<li>
		<?php echo anchor('test/example_8', 'Example8', array('target'=>'_blank')) ?>
		Data grid with searching and filtering options.
	</li>
	<li>
		<?php echo anchor('test/example_9', 'Example9', array('target'=>'_blank')) ?>
		Data grid where we enable Action column.
	</li>
	<li>
		<?php echo anchor('test/example_10', 'Example10', array('target'=>'_blank')) ?>
		Data grid with Image field example.
	</li>
	<li>
		<?php echo anchor('test/example_11', 'Example11', array('target'=>'_blank')) ?>
		Data grid with row selecting checkbox enabled.
	</li>
	<li>
		<strike>
		<?php echo anchor('test/example_12', 'Example12', array('target'=>'_blank')) ?>
		Print And Export
		</strike>
	</li>
	<li>
		<strike>
		<?php echo anchor('test/example_13', 'Example13', array('target'=>'_blank')) ?>
		Debug Mode On
		</strike>
	</li>
</ul>


<h1>Configurations</h1>
<p>Different parameters and settings you can use to configure and customize library.</p>

<h2>set_query</h2>
<p>
	Pass the  Model Object result into this parameter.
</p>
<code>
	'set_query' =&gt; $this-&gt;app_model-&gt;country(),
</code>

<h2>set_multirow_selection</h2>

<h4>enable</h4>
<p>Boolean true | false</p>

<h4>primary_key</h4>
<p>Define the primary_key of the table.</p>

Example:
<code>
  'set_multirow_selection' =&gt; array(<br/>
	&nbsp;'enable' =&gt; true,<br/>
	&nbsp;'primary_key' =&gt; 'country_id'<br/>
	),
</code>

<h2>set_pagination</h2>
<p>Define the pagination and default table display order.</p>

<h3>enable</h3>
<p>Boolean value true | false</p>

<h3>initialize</h3>
<ol>
  <li>base_url</li>
  <li>per_page</li>
  <li>num_links</li>
</ol>
<p>Look at pagination chapter in codeigniter</p>

<h3>order_field</h3>
<p>Define the default Order Field</p>

<h3>order_type</h3>
<p>Define the ASC | DESC</p>

<h3>offset</h3>
<p>Initial Page 0</p>
Example:
<code>
'set_pagination' =&gt; array(
 &nbsp;'enable' =&gt; true,<br/>
 &nbsp;'initialize'=&gt; array('base_url' =&gt; site_url('http://localhost/index.php/controller/index'), 'per_page' =&gt; 25, 'num_links' =&gt; 5),<br/>
 &nbsp;'order_field' =&gt; 'country_id',<br/>
 &nbsp;'order_type' =&gt; 'ASC',<br/>
 &nbsp;'offset' =&gt; 0<br/>
)
</code>

<h2>set_column</h2>
<p>Define all the columns that are going to be displayed.</p>

<h3>{database_column}</h3>
<h4>title</h4>
<h4>type</h4>

<ul>
	<li>text
	  <ul>
		<li>open_tag</li>
		<li>close_tag</li>
		<li>html_attribute<br />
		Example:
		<code>
			'set_column' =&gt; array(<br />
				&nbsp; 'country_id' =&gt; array(<br />
				&nbsp; 'title' =&gt; 'Country ID', <br />
				&nbsp; 'type' =&gt; array('text'), <br />
			),
		</code>
		</li>
	  </ul>
	</li>
	<li>textfield
		<ul>
			<li>table_name</li>
			<li>primary_key</li>
			<li>open_tag</li>
			<li>close_tag</li>
			<li>html_attribute<br />
			Example:
			<code>
			'country_name' =&gt; array(<br />
				&nbsp;'title'=&gt;'Country',<br />
				&nbsp;'sortable'=&gt;true,<br />
				&nbsp;'type' =&gt; array(<br />
				&nbsp;'textfield',<br />
				&nbsp;'table_name' =&gt; 'country',<br />
				&nbsp;'primary_key' =&gt; 'country_id',<br />
				&nbsp;'open_tag' =&gt; '&lt;b&gt;',<br />
				&nbsp;'close_tag' =&gt; '&lt;/b&gt;',<br />
				&nbsp;'html_attribute' =&gt; array('size'=&gt;'20')<br />
			),
			</code>
			</li>
		</ul>
	</li>
	<li>radio</li>
	<li>select
		<ul>
			<li>value</li>
			<li>table_name</li>
			<li>primary_key</li>
			<li>open_tag</li>
			<li>close_tag</li>
			<li>html_attribute<br />
			Example:
			<code>
			'region_id' =&gt; array(<br />
				&nbsp;'title' =&gt; 'Region ID',<br />
				&nbsp;'type' =&gt; array(<br />
					&nbsp;&nbsp; 'select',<br />
					&nbsp;&nbsp; 'value'=&gt;array(1=&gt;'Region 1', 2=&gt;'Region 2', 3=&gt;'Region 3', 4=&gt;'Region 4', 5=&gt;'Region 5'),<br />
					&nbsp;&nbsp; 'table_name' =&gt; 'country',<br />
					&nbsp;&nbsp; 'primary_key' =&gt; 'country_id',<br />
					&nbsp;&nbsp; 'open_tag' =&gt; '&lt;b&gt;',<br />
					&nbsp;&nbsp; 'close_tag' =&gt; '&lt;/b&gt;'<br />
				&nbsp;)<br />
			),
			</code>
			</li>
		</ul>
	</li>
	<li>image
		<ul>
			<li>src</li>
			<li>open_tag</li>
			<li>close_tag</li>
			<li>html_attribute<br />
			Example:
			<code>
			'region_id' =&gt; array(<br />
				&nbsp;'title' =&gt; 'Region ID',<br />
				&nbsp;'type' =&gt; array(<br />
					&nbsp;&nbsp; 'image',<br />
					&nbsp;&nbsp; 'src'=&gt;'http://localhost/public/images/{region_id}.png',<br />
					&nbsp;&nbsp; 'open_tag' =&gt; '&lt;b&gt;',<br />
					&nbsp;&nbsp; 'close_tag' =&gt; '&lt;/b&gt;'<br />
				&nbsp;)<br />
			),
			</code>
			</li>
		</ul>
	</li>
	<li>link
		<ul>
			<li>href</li>
			<li>open_tag</li>
			<li>close_tag</li>
			<li>html_attribute<br />
			Example:
			<code>
			'country_name' =&gt; array(<br />
				&nbsp;'title'=&gt;'Country',<br />
				&nbsp;'type' =&gt; array(<br />
				&nbsp;'link',<br />
				&nbsp;'href'=&gt;'http://localhost/index.php/application/edit/{country_id}/{region_id}'<br />
			),
			</code>
			</li>
		</ul>
	</li>
	<li>custom
		<ul>
			<li>html<br />
			Example:
			<code>
			'region_id' =&gt; array(<br />
				&nbsp;'title' =&gt; 'Region ID',<br />
				&nbsp;'type' =&gt; array(<br />
					&nbsp;&nbsp; 'Custom',<br />
					&nbsp;&nbsp; 'html'=&gt;'&lt;p&gt;testing testing &lt;b&gt;&lt;i&gt;{region_id}&lt;/i&gt;&lt;/b&gt;&lt;/p&gt;',<br />
					&nbsp;)<br />
			),
			</code>
			</li>
		</ul>
	</li>
</ul>


<h2>set_action</h2>
<h3>enable</h3>
<h3>{column}</h3>
<ul>
	<li>title</li>
	<li>type
		<ul>
			<li>link
				<ul>
					<li>href</li>
					<li>html_attribute</li>
				</ul>
			</li>
			<li>image
				<ul>
					<li>src</li>
					<li>html_attribute</li>
				</ul>
			</li>
		</ul>
	</li>
</ul>

Example:
<code>
'set_action' =&gt; array(<br />
	&nbsp;'enable'=&gt;true,<br />
	&nbsp;array(<br />
		&nbsp;&nbsp; 'edit'=&gt;array(<br />
		&nbsp;&nbsp; 'title'=&gt;'Edit',<br />
		&nbsp;&nbsp; 'type'=&gt;array('image', 'src'=&gt;'http://localhost/public/images/edit.gif'),<br />
		&nbsp;&nbsp; 'href'=&gt;'http://localhost/index.php/application/edit/{country_id}',<br />
	&nbsp;),<br />
	<br />
	&nbsp;'delete'=&gt;array(<br />
		&nbsp;&nbsp; 'title'=&gt;'Delete',<br />
		&nbsp;&nbsp; 'type'=&gt;array('image', 'src'=&gt;'http://localhost/public/images/delete.gif'),<br />
		&nbsp;&nbsp; 'href'=&gt;'http://localhost/index.php/application/delete/{country_id}',<br />
	&nbsp;),<br />
	<br />
	&nbsp;'action'=&gt;array(<br />
		&nbsp;&nbsp; 'title'=&gt;'Action',<br />
		&nbsp;&nbsp; 'type'=&gt;'link',<br />
		&nbsp;&nbsp; 'href'=&gt;'http://localhost/index.php/application/action/{country_id}/{region_id}',<br />
		&nbsp;&nbsp; 'html_attribute'=&gt;array('onclick'=&gt;&quot;javascript: return fn_action();&quot;))<br />
	&nbsp;)<br />
),
</code>

<h2>set_filter</h2>
<h3>enable</h3>
<h3>{database_column}</h3>

<ul>
	<li>title</li>
	<li>type
		<ul>
			<li>number</li>
			<li>text</li>
			<li>select
				<ul>
					<li>value</li>
				</ul>
			</li>
		</ul>
	</li>
</ul>

Example:
<code>
'set_filter' =&gt; array(<br />
	&nbsp; 'enable' =&gt; true,<br />
	&nbsp; array(<br />
		&nbsp;&nbsp;'country_id'=&gt;array(<br />
		&nbsp;&nbsp;'title'=&gt;'Country ID',<br />
		&nbsp;&nbsp;'type'=&gt;array('number'),<br />
	&nbsp;),<br />
	<br />
	&nbsp;'country_name'=&gt;array(<br />
		&nbsp;&nbsp;'title' =&gt; 'Country Name',<br />
		&nbsp;&nbsp;'type' =&gt; array('text')<br />
	&nbsp;),<br />
	<br />
	&nbsp;'region_id'=&gt;array(<br />
		&nbsp;&nbsp;'title'=&gt;'Region ',<br />
		&nbsp;&nbsp;'type' =&gt; array('select', 'value'=&gt;array('1'=&gt;'Region 1', '2'=&gt;'Region 2', '3'=&gt;'Region 3'))<br />
	&nbsp;)<br />
&nbsp;),
</code>

<strike>
<h2>set_print</h2>
<h3>enable</h3>

<h2>set_export</h2>
<h3>enable</h3>
<ul>
	<li>enable_cvs</li>
	<li>enable_xml</li>
</ul>

Example:
<code>    
'set_export' =&gt; array(<br />
	&nbsp;'enable' =&gt; false,<br />
	&nbsp;array(<br />
		&nbsp;&nbsp; 'enable_cvs'=&gt; true,<br />
		&nbsp;&nbsp; 'enable_xml'=&gt; true,<br />
		&nbsp; 'enable_xls'=&gt; true<br />
	&nbsp;)<br />
&nbsp;),
</code>
    
<h2>set_debug</h2>
<h3>enable</h3>
</strike>