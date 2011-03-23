<!-- Start Loading all Styles -->
<?php echo style('ca_gridview/ca_gridview.css') ?>
<?php echo style('ca_gridview/tablecloth.css') ?>
<!-- End ALL Styles -->

<?php echo form_open_multipart($this->ca_gridview->removefslash($this->ca_gridview->params['set_pagination']['initialize']['base_url']), array('name'=>'frm_ca_gridview', 'id'=>'frm_ca_gridview')) ?>
<input type="hidden" id="primary_key" name="primary_key" value="" />
<input type="hidden" id="table_name" name="table_name" value="" />
<input type="hidden" id="field" name="field" value="" />

<?php if($set_print): ?>
<fieldset>
	<legend><?php echo $this->lang->line('ca_print') ?></legend>
    <ul>
    	<li><a href="<?php echo $this->ca_gridview->shape_uri_segment(array('offset'=>0), '', array('export'=>'print')) ?>">Print</a></li>
    </ul>
</fieldset>
<?php endif; ?>

<?php if($set_export): ?>
<fieldset>
	<legend><?php echo $this->lang->line('ca_export') ?></legend>
    <ul>
    	<li><a href="<?php echo $this->ca_gridview->shape_uri_segment(array('offset'=>0), '', array('export'=>'csv')) ?>" target="_blank">CSV</a></li>
        <li><a href="<?php echo $this->ca_gridview->shape_uri_segment(array('offset'=>0), '', array('export'=>'xml')) ?>" target="_blank">XML</a></li>
        <?php /*<li><a href="<?php echo $this->ca_gridview->shape_uri_segment(array('offset'=>0), '', array('export'=>'xls')) ?>" target="_blank">XLS</a></li> */ ?>
    </ul>
</fieldset>
<?php endif; ?>

<?php if($set_filter && $this->ca_gridview->total_result > 0 ): ?>
<div id="ca_filter_button" class="ca_filter_hide">&nbsp;</div>
<fieldset id="ca_filter">
	<legend><?php echo $this->lang->line('ca_filter') ?></legend>
    <center>
	<table width="50%" border="0" cellspacing="2" cellpadding="2">
      <?php echo $this->ca_gridview->display_filter_option() ?>
      <tr>
        <td><?php echo $this->lang->line('ca_filter_type') ?></td>
        <td><?php echo $this->ca_gridview->filter_operator('search_type','search_type') ?></td>
        <td>
        	<input type="hidden" name="flt_action" id="flt_action" value="<?php echo $this->ca_gridview->display_url_filter() ?>" />
            <input type="button" name="btn_srch" id="btn_srch" value="<?php echo $this->lang->line('ca_search') ?>" />

            <?php if($this->ca_gridview->is_exist_uri_segment('search_result') === 'enable'): ?>
        	<input type="button" name="btn_srch_reset" id="btn_srch_reset" value="<?php echo $this->lang->line('ca_search_reset') ?>" />
            <?php endif;?>
        </td>
      </tr>
    </table>
    </center>
</fieldset>
<br/>
<?php endif; ?>

<?php if($set_query->num_rows() > 0): ?>

<center>
<div class="ca-pagenavi ca-clearfix">
	<div class="pagenavi ca-clearfix"><?php echo $set_pagination ?></div>
</div>
</center>

<span style="float:right; color:#666"><?php echo $this->lang->line('ca_total_result') ?><?php echo $this->ca_gridview->total_result ?></span>

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ca_gridview">
    <thead>
      <tr>
      	<?php if($set_multirow_selection): ?>
        <th><input type="checkbox" name="ca_checkall" id="ca_checkall" /></th>
        <?php endif; ?>

        <?php foreach($set_column as $field=>$value): ?>
        	<th>
        		<?php echo $this->ca_gridview->is_order_by_field($field) ?>

        		<?php echo $value['title'] ?>
				
				<?php if($this->ca_gridview->is_sortable($field)): ?>
					<a href="<?php echo $this->ca_gridview->display_url_asc($field) ?>" class="ca_gridview_ordering"><?php echo image('ca_gridview/asc.png')?></a>
					<a href="<?php echo $this->ca_gridview->display_url_desc($field) ?>" class="ca_gridview_ordering"><?php echo image('ca_gridview/desc.png')?></a>
				<?php endif; ?>
        		

        		<?php if($this->ca_gridview->is_column_save($field)): ?>
                	<span class="ui_button">
        				<a href="#save_<?php echo$field?>" class="ui_button_green"><?php echo $this->lang->line('ca_save') ?></a>
                        <span class="ui_button_green_r"></span>
                    </span>
        			<input type="hidden" name="primary_key_<?php echo $field ?>" id="primary_key_<?php echo $field ?>" value="<?php echo $value['type']['primary_key'] ?>">
        			<input type="hidden" name="table_name_<?php echo $field ?>" id="table_name_<?php echo $field ?>" value="<?php echo $value['type']['table_name'] ?>">
        		<?php endif; ?>
        	</th>
        <?php endforeach; ?>

        <?php if($set_action): ?>
        	<th><?php echo $this->lang->line('ca_action') ?></th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>

    <?php // display query result here ?>
    <?php foreach($set_query->result_array() as $row): ?>
    	<tr>
        	<?php if($set_multirow_selection): ?>
            <td>
            	<input type="checkbox" name="chk_<?php echo $set_multirow_selection ?>[]" value="<?php echo $row[$set_multirow_selection] ?>" id="ca_checkbox"/>
            </td>
            <?php endif; ?>

            <?php foreach($set_column as $field=>$value): ?>
            	<td>
            		&nbsp; <?php echo $this->ca_gridview->display_column($field, $row) ?>
            		<?php if($this->ca_gridview->is_column_save($field)): ?>
        				<input type="hidden" name="pk_<?php echo $field ?>[]" id="pk_<?php echo $field ?>" value="<?php echo $row[$value['type']['primary_key']] ?>">
        			<?php endif; ?>
            	</td>
        	<?php endforeach; ?>

        	<?php if($set_action): ?>
            	<td>
            		<?php $this->ca_gridview->display_set_action($row) ?>
            	</td>
            <?php endif; ?>

      	</tr>
    <?php endforeach; ?>

    </tbody>
  </table>

<center>
<div class="ca-pagenavi ca-clearfix">
	<div class="pagenavi ca-clearfix"><?php echo $set_pagination ?></div>
</div>
</center>

<?php else: ?>
No Record Found!

<?php endif; ?>

<?php echo form_close();?>
<?php if($set_debug): ?>
<div style="border:1px solid red">
<h1>CA_GridView Debug Mode On</h1>
	<ul>
		<?php
			if(count($this->ca_gridview->msg)):
				foreach ($this->ca_gridview->msg as $key=>$value):
		?>
		<li><?php echo $value ?></li>
		<?php
				endforeach;
			endif;
		?>
	</ul>
</div>
<?php endif; ?>

<!-- Load  Javascript Frame Work -->
<?php echo script('prototype/prototype.js') ?>
<?php echo script('ca_gridview/ca_gridview.js') ?>
<?php echo script('ca_gridview/tablecloth.js') ?>