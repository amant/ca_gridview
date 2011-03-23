Grid Example
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo anchor('example/example/example_1', 'Example1', array('target'=>'_blank')) ?></td>
    <td>Basic Setup Example</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_2', 'Example2', array('target'=>'_blank')) ?></td>
    <td>Text Field Example</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_3', 'Example3', array('target'=>'_blank')) ?></td>
    <td>Radio Button Example</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_4', 'Example4', array('target'=>'_blank')) ?></td>
    <td>Selection Button Example</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_5', 'Example5', array('target'=>'_blank')) ?></td>
    <td>Link Example</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_6', 'Example6', array('target'=>'_blank')) ?></td>
    <td>Custom Field Example</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_7', 'Example7', array('target'=>'_blank')) ?></td>
    <td>Colum with Sorting disable</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_8', 'Example8', array('target'=>'_blank')) ?></td>
    <td>Filter Example</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_9', 'Example9', array('target'=>'_blank')) ?></td>
    <td>Action Colum</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_10', 'Example10', array('target'=>'_blank')) ?></td>
    <td>Image Field Example</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_11', 'Example11', array('target'=>'_blank')) ?></td>
    <td>Multi Selectable Checkbox</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_12', 'Example12', array('target'=>'_blank')) ?></td>
    <td>Print And Export</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo anchor('example/example/example_13', 'Example13', array('target'=>'_blank')) ?></td>
    <td>Debug Mode On</td>
    <td>&nbsp;</td>
  </tr>
</table>

<hr />
<p>CA Grid View Wiki</p>
<p>Parameters</p>
<ol>
  <li><a href="#1">set_query</a></li>
  <li><a href="#2">set_multirow_selection</a>
    <ol>
      <li>enable</li>
      <li>primary_key</li>
    </ol>
  </li>
  <li><a href="#3">set_pagination</a>
    <ol>
      <li>enable</li>
      <li>initialize
        <ol>
          <li>base_url</li>
          <li>per_page</li>
          <li>num_links</li>
        </ol>
      </li>
      <li>order_filed</li>
      <li>order_type</li>
      <li>offset</li>
    </ol>
  </li>
  <li><a href="#4">set_column</a>
    <ol>
      <li>{database_column}
        <ol>
          <li>title</li>
          <li>type
            <ol>
              <li>text
                <ol>
                  <li>open_tag</li>
                  <li>close_tag</li>
                  <li>html_attribute</li>
                </ol>
              </li>
              <li>textfield<ol><li>table_name</li>
                  <li>primary_key</li>
                  <li>open_tag</li>
                  <li>close_tag</li>
                  <li>html_attribute</li>
                  </ol>
              </li>
              <li>radio</li>
              <li>select
                <ol>
                  <li>value</li>
                  <li>table_name</li>
                  <li>primary_key</li>
                  <li>open_tag</li>
                  <li>close_tag</li>
                  <li>html_attribute</li>
                </ol>
              </li>
              <li>image
                <ol>
                  <li>src</li>
                  <li>open_tag</li>
                  <li>close_tag</li>
                  <li>html_attribute</li>
                </ol>
              </li>
              <li>link
                <ol>
                  <li>href</li>
                  <li>open_tag</li>
                  <li>close_tag</li>
                  <li>html_attribute</li>
                </ol>
              </li>
              <li>custom
                <ol>
                  <li>html</li>
                </ol>
              </li>
            </ol>
          </li>
        </ol>
      </li>
    </ol>
  </li>
  <li><a href="#5">set_action</a>
    <ol>
      <li>enable
        <ol>
          <li>{column}
            <ol>
              <li>title</li>
              <li>type
                <ol>
                  <li>link
                    <ol>
                      <li>href</li>
                      <li>html_attribute</li>
                    </ol>
                  </li>
                  <li>image
                    <ol>
                      <li>src</li>
                      <li>html_attribute</li>
                    </ol>
                  </li>
                </ol>
              </li>
            </ol>
          </li>
        </ol>
      </li>
    </ol>
  </li>
  <li><a href="#6">set_filter</a>
    <ol>
      <li>enable
        <ol>
          <li>{database_column}
            <ol>
              <li>title</li>
              <li>type
                <ol>
                  <li>number</li>
                  <li>text</li>
                  <li>select
                    <ol>
                      <li>value</li>
                    </ol>
                  </li>
                </ol>
              </li>
            </ol>
          </li>
        </ol>
      </li>
    </ol>
  </li>
  <li><a href="#7">set_print</a>
    <ol>
      <li>enable</li>
    </ol>
  </li>
  <li><a href="#8">set_export</a>
    <ol>
      <li>enable
        <ol>
          <li>enable_cvs</li>
          <li>enable_xml</li>
        </ol>
      </li>
    </ol>
  </li>
  <li><a href="#9">set_debug</a>
    <ol>
      <li>enable</li>
    </ol>
  </li>
</ol>
<hr />
<ol>
  <li><a name="1" id="1"></a>set_query<br />
  Pass the  Model Object result into this parameter.<br />
  Example:<br />
  'set_query' =&gt; $this-&gt;app_model-&gt;country(),<br />
    <br />
  </li>
  <li><a name="2" id="2"></a>set_multirow_selection
    <ol>
        <li>enable<br />
      Boolean Value true | false<br />
        <br />
      </li>
      <li>primary_key<br />
      Define the primary_key of the table<br />
        <br />
        Example:<br />
        'set_multirow_selection' =&gt; array(<br />
'enable' =&gt; true,<br />
'primary_key' =&gt; 'country_id'<br />
),<br />
<br />
      </li>
    </ol>
  </li>
  <li><a name="3" id="3"></a>set_pagination<br />
    Define the pagination and default table display order <br />
    <br />
    <ol>
        <li>enable<br />
      Boolean value true | false<br />
        <br />
      </li>
        <li>initialize
        <ol>
              <li>base_url</li>
          <li>per_page</li>
          <li>num_links<br />
            Look at pagination chapter in codeigniter<br />
            <br />
          </li>
        </ol>
      </li>
      <li>order_field<br />
      Define the default Order Field<br />
      </li>
      <li>order_type<br />
      Define the ASC | DESC</li>
      <li>offset<br />
      Initial Page 0<br />
        <br />
      Example:<br />
      'set_pagination' =&gt; array(<br />
'enable' =&gt; true,<br />
'initialize'=&gt; array('base_url'=&gt;&quot;http://localhost/index.php/application/index&quot;, 'per_page'=&gt;25, 'num_links'=&gt;5),<br />
'order_field' =&gt; 'country_id',<br />
'order_type' =&gt; 'ASC',<br />
'offset' =&gt; 0<br />
)<br />
<br />
      </li>
    </ol>
  </li>
  <li><a name="4" id="4"></a>set_column
    <br />
    Define all the columns that are going to be displayed.<br />
    <br />
    <ol>
        <li>{database_column}
          <br />
          <ol>
              <li>title</li>
            <li>type
              <ol>
                    <li>text
                      <ol>
                          <li>open_tag</li>
                        <li>close_tag</li>
                        <li>html_attribute<br />
                        Example:<br />
                          'set_column' =&gt; array(<br />
'country_id' =&gt; array(<br />
'title' =&gt; 'Country ID', <br />
'type' =&gt; array('text'), <br />
),<br />
                        </li>
                      </ol>
                    </li>
                <li>textfield
                    <ol>
                      <li>table_name</li>
                      <li>primary_key</li>
                      <li>open_tag</li>
                      <li>close_tag</li>
                      <li>html_attribute<br />
                      Example:<br />
                      'country_name' =&gt; array(<br />
'title'=&gt;'Country',<br />
'sortable'=&gt;true,<br />
'type' =&gt; array(<br />
'textfield',<br />
'table_name' =&gt; 'country',<br />
'primary_key' =&gt; 'country_id',<br />
'open_tag' =&gt; '&lt;b&gt;',<br />
'close_tag' =&gt; '&lt;/b&gt;',<br />
'html_attribute' =&gt; array('size'=&gt;'20')<br />
),</li>
                    </ol>
                </li>
                <li>radio</li>
                <li>select
                  <ol>
                          <li>value</li>
                    <li>table_name</li>
                    <li>primary_key</li>
                    <li>open_tag</li>
                    <li>close_tag</li>
                    <li>html_attribute<br />
                    Example:<br />
                    'region_id' =&gt; array(<br />
'title' =&gt; 'Region ID',<br />
'type' =&gt; array(<br />
'select',<br />
'value'=&gt;array(1=&gt;'Region 1', 2=&gt;'Region 2', 3=&gt;'Region 3', 4=&gt;'Region 4', 5=&gt;'Region 5'),<br />
'table_name' =&gt; 'country',<br />
'primary_key' =&gt; 'country_id',<br />
'open_tag' =&gt; '&lt;b&gt;',<br />
'close_tag' =&gt; '&lt;/b&gt;'<br />
)<br />
),</li>
                  </ol>
                </li>
                <li>image
                  <ol>
                          <li>src</li>
                    <li>open_tag</li>
                    <li>close_tag</li>
                    <li>html_attribute<br />
                    Example:<br />
                    'region_id' =&gt; array(<br />
'title' =&gt; 'Region ID',<br />
'type' =&gt; array(<br />
'image',<br />
'src'=&gt;'http://localhost/public/images/{region_id}.png',<br />
'open_tag' =&gt; '&lt;b&gt;',<br />
'close_tag' =&gt; '&lt;/b&gt;'<br />
)<br />
),</li>
                  </ol>
                </li>
                <li>link
                  <ol>
                          <li>href</li>
                    <li>open_tag</li>
                    <li>close_tag</li>
                    <li>html_attribute<br />
                    Example:<br />
                    'country_name' =&gt; array(<br />
'title'=&gt;'Country',<br />
'type' =&gt; array(<br />
'link',<br />
'href'=&gt;'http://localhost/index.php/application/edit/{country_id}/{region_id}'<br />
),</li>
                  </ol>
                </li>
                <li>custom
                  <ol>
                          <li>html<br />
                    Example:<br />
                    'region_id' =&gt; array(<br />
'title' =&gt; 'Region ID',<br />
'type' =&gt; array(<br />
'Custom',<br />
'html'=&gt;'&lt;p&gt;testing testing &lt;b&gt;&lt;i&gt;{region_id}&lt;/i&gt;&lt;/b&gt;&lt;/p&gt;',<br />
)<br />
),</li>
                  </ol>
                </li>
              </ol>
            </li>
          </ol>
        </li>
    </ol>
  </li>
  <li><a name="5" id="5"></a>set_action
    <br />
    Example:<br />
    'set_action' =&gt; array(<br />
'enable'=&gt;true,<br />
array(<br />
'edit'=&gt;array(<br />
'title'=&gt;'Edit',<br />
'type'=&gt;array('image', 'src'=&gt;'http://localhost/public/images/edit.gif'),<br />
'href'=&gt;'http://localhost/index.php/application/edit/{country_id}',<br />
),<br />
<br />
'delete'=&gt;array(<br />
'title'=&gt;'Delete',<br />
'type'=&gt;array('image', 'src'=&gt;'http://localhost/public/images/delete.gif'),<br />
'href'=&gt;'http://localhost/index.php/application/delete/{country_id}',<br />
),<br />
<br />
'action'=&gt;array(<br />
'title'=&gt;'Action',<br />
'type'=&gt;'link',<br />
'href'=&gt;'http://localhost/index.php/application/action/{country_id}/{region_id}',<br />
'html_attribute'=&gt;array('onclick'=&gt;&quot;javascript: return fn_action();&quot;))<br />
)<br />
),
    <ol>
        <li>enable
          <ol>
              <li>{column}
                <ol>
                    <li>title</li>
                  <li>type
                    <ol>
                          <li>link
                            <ol>
                                <li>href</li>
                              <li>html_attribute</li>
                            </ol>
                          </li>
                      <li>image
                        <ol>
                                <li>src</li>
                          <li>html_attribute</li>
                        </ol>
                      </li>
                    </ol>
                  </li>
                </ol>
              </li>
          </ol>
        </li>
    </ol>
  </li>
  <li><a name="6" id="6"></a>set_filter
    <br />
    Example:<br />
    <br />
'set_filter' =&gt; array(<br />
'enable' =&gt; true,<br />
array(<br />
'country_id'=&gt;array(<br />
'title'=&gt;'Country ID',<br />
'type'=&gt;array('number'),<br />
),<br />
<br />
'country_name'=&gt;array(<br />
'title' =&gt; 'Country Name',<br />
'type' =&gt; array('text')<br />
),<br />
<br />
'region_id'=&gt;array(<br />
'title'=&gt;'Region ',<br />
'type' =&gt; array('select', 'value'=&gt;array('1'=&gt;'Region 1', '2'=&gt;'Region 2', '3'=&gt;'Region 3'))<br />
)<br />
<br />
)<br />
),
    <ol>
        <li>enable
          <ol>
              <li>{database_column}
                <ol>
                    <li>title</li>
                  <li>type
                    <ol>
                          <li>number</li>
                      <li>text</li>
                      <li>select
                        <ol>
                                <li>value</li>
                        </ol>
                      </li>
                    </ol>
                  </li>
                </ol>
              </li>
          </ol>
        </li>
    </ol>
  </li>
  <li><a name="7" id="7"></a>set_print
    <ol>
        <li>enable</li>
    </ol>
  </li>
  <li><a name="8" id="8"></a>set_export
    <br />
    Example:<br />
    <br />
'set_export' =&gt; array(<br />
'enable' =&gt; false,<br />
array(<br />
'enable_cvs'=&gt; true,<br />
'enable_xml'=&gt; true,<br />
'enable_xls'=&gt; true<br />
)<br />
),
    <ol>
        <li>enable
          <ol>
              <li>enable_cvs</li>
            <li>enable_xml</li>
          </ol>
        </li>
    </ol>
  </li>
  <li><a name="9" id="9"></a>set_debug
    <ol>
        <li>enable</li>
    </ol>
  </li>
</ol>
<p></p>
<p><br />
</p>
