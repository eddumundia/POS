<?php echo form_open('config/save_receipt/', array('id' => 'receipt_config_form', 'class' => 'form-horizontal')); ?>
	<div id="config_wrapper">
		<fieldset id="config_info">
			<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
			<ul id="receipt_error_message_box" class="error_message_box"></ul>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_receipt_template'), 'receipt_template', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-2'>
					<?php echo form_dropdown('receipt_template', array(
						'receipt_default' => $this->lang->line('config_receipt_default'),
						'receipt_short' => $this->lang->line('config_receipt_short')
					),
					$this->config->item('receipt_template'), array('class' => 'form-control input-sm'));
					?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_receipt_font_size'), 'receipt_font_size', array('class' => 'control-label col-xs-2 required')); ?>
				<div class='col-xs-2'>
					<div class="input-group">
						<?php echo form_input(array(
							'type' => 'number',
							'min' => '0',
							'max' => '20',
							'name' => 'receipt_font_size',
							'id' => 'receipt_font_size',
							'class' => 'form-control input-sm required',
							'value' => $this->config->item('receipt_font_size'))); ?>
						<span class="input-group-addon input-sm">px</span>
					</div>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_print_delay_autoreturn'), 'print_delay_autoreturn', array('class' => 'control-label col-xs-2 required')); ?>
				<div class='col-xs-2'>
					<div class="input-group">
						<?php echo form_input(array(
							'type' => 'number',
							'min' => '0',
							'max' => '30',
							'name' => 'print_delay_autoreturn',
							'id' => 'print_delay_autoreturn',
							'class' => 'form-control input-sm required',
							'value' => $this->config->item('print_delay_autoreturn'))); ?>
						<span class="input-group-addon input-sm">s</span>
					</div>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_email_receipt_check_behaviour'), 'email_receipt_check_behaviour', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-8'>
					<label class="radio-inline">
						<?php echo form_radio(array(
							'name' => 'email_receipt_check_behaviour',
							'value' => 'always',
							'checked' => $this->config->item('email_receipt_check_behaviour') == 'always')); ?>
						<?php echo $this->lang->line('config_email_receipt_check_behaviour_always'); ?>
					</label>
					<label class="radio-inline">
						<?php echo form_radio(array(
							'name' => 'email_receipt_check_behaviour',
							'value' => 'never',
							'checked' => $this->config->item('email_receipt_check_behaviour') == 'never')); ?>
						<?php echo $this->lang->line('config_email_receipt_check_behaviour_never'); ?>
					</label>
					<label class="radio-inline">
						<?php echo form_radio(array(
							'name' => 'email_receipt_check_behaviour',
							'value' => 'last',
							'checked' => $this->config->item('email_receipt_check_behaviour') == 'last')); ?>
						<?php echo $this->lang->line('config_email_receipt_check_behaviour_last'); ?>
					</label>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_print_receipt_check_behaviour'), 'print_receipt_check_behaviour', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-8'>
					<label class="radio-inline">
						<?php echo form_radio(array(
							'name' => 'print_receipt_check_behaviour',
							'value' => 'always',
							'checked' => $this->config->item('print_receipt_check_behaviour') == 'always')); ?>
						<?php echo $this->lang->line('config_print_receipt_check_behaviour_always'); ?>
					</label>
					<label class="radio-inline">
						<?php echo form_radio(array(
							'name' => 'print_receipt_check_behaviour',
							'value' => 'never',
							'checked' => $this->config->item('print_receipt_check_behaviour') == 'never')); ?>
						<?php echo $this->lang->line('config_print_receipt_check_behaviour_never'); ?>
					</label>
					<label class="radio-inline">
						<?php echo form_radio(array(
							'name' => 'print_receipt_check_behaviour',
							'value' => 'last',
							'checked' => $this->config->item('print_receipt_check_behaviour') == 'last')); ?>
						<?php echo $this->lang->line('config_print_receipt_check_behaviour_last'); ?>
					</label>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_receipt_show_company_name'), 'receipt_show_company_name', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'receipt_show_company_name',
						'value' => 'receipt_show_company_name',
						'id' => 'receipt_show_company_name',
						'checked' => $this->config->item('receipt_show_company_name'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_receipt_show_taxes'), 'receipt_show_taxes', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'receipt_show_taxes',
						'value' => 'receipt_show_taxes',
						'id' => 'receipt_show_taxes',
						'checked' => $this->config->item('receipt_show_taxes'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_receipt_show_tax_ind'), 'receipt_show_tax_ind', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'receipt_show_tax_ind',
						'value' => 'receipt_show_tax_ind',
						'id' => 'receipt_show_tax_ind',
						'checked' => $this->config->item('receipt_show_tax_ind'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_receipt_show_total_discount'), 'receipt_show_total_discount', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'receipt_show_total_discount',
						'value' => 'receipt_show_total_discount',
						'id' => 'receipt_show_total_discount',
						'checked' => $this->config->item('receipt_show_total_discount'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_receipt_show_description'), 'receipt_show_description', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'receipt_show_description',
						'value' => 'receipt_show_description',
						'id' => 'receipt_show_description',
						'checked' => $this->config->item('receipt_show_description'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_receipt_show_serialnumber'), 'receipt_show_serialnumber', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'receipt_show_serialnumber',
						'value' => 'receipt_show_serialnumber',
						'id' => 'receipt_show_serialnumber',
						'checked' => $this->config->item('receipt_show_serialnumber'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_print_silently'), 'print_silently', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'print_silently',
						'id' => 'print_silently',
						'value' => 'print_silently',
						'checked' => $this->config->item('print_silently'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_print_header'), 'print_header', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'print_header',
						'id' => 'print_header',
						'value' => 'print_header',
						'checked' => $this->config->item('print_header'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_print_footer'), 'print_footer', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'print_footer',
						'id' => 'print_footer',
						'value' => 'print_footer',
						'checked' => $this->config->item('print_footer'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_receipt_printer'), 'config_receipt_printer', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-2'>
					<?php echo form_dropdown('receipt_printer',	array(), ' ', 'id="receipt_printer" class="form-control"'); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_invoice_printer'), 'config_invoice_printer', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-2'>
					<?php echo form_dropdown('invoice_printer', array(), ' ', 'id="invoice_printer" class="form-control"'); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_takings_printer'), 'config_takings_printer', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-2'>
					<?php echo form_dropdown('takings_printer', array(), ' ', 'id="takings_printer" class="form-control"'); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_print_top_margin'), 'print_top_margin', array('class' => 'control-label col-xs-2 required')); ?>
				<div class='col-xs-2'>
					<div class="input-group">
						<?php echo form_input(array(
							'type' => 'number',
							'min' => '0',
							'max' => '20',
							'name' => 'print_top_margin',
							'id' => 'print_top_margin',
							'class' => 'form-control input-sm required',
							'value' => $this->config->item('print_top_margin'))); ?>
						<span class="input-group-addon input-sm">px</span>
					</div>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_print_left_margin'), 'print_left_margin', array('class' => 'control-label col-xs-2 required')); ?>
				<div class='col-xs-2'>
					<div class="input-group">
						<?php echo form_input(array(
							'type' => 'number',
							'min' => '0',
							'max' => '20',
							'name' => 'print_left_margin',
							'id' => 'print_left_margin',
							'class' => 'form-control input-sm required',
							'value' => $this->config->item('print_left_margin'))); ?>
						<span class="input-group-addon input-sm">px</span>
					</div>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_print_bottom_margin'), 'print_bottom_margin', array('class' => 'control-label col-xs-2 required')); ?>
				<div class='col-xs-2'>
					<div class="input-group">
						<?php echo form_input(array(
							'type' => 'number',
							'min' => '0',
							'max' => '20',
							'name' => 'print_bottom_margin',
							'id' => 'print_bottom_margin',
							'class' => 'form-control input-sm required',
							'value' => $this->config->item('print_bottom_margin'))); ?>
						<span class="input-group-addon input-sm">px</span>
					</div>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('config_print_right_margin'), 'print_right_margin', array('class' => 'control-label col-xs-2 required')); ?>
				<div class='col-xs-2'>
					<div class="input-group">
						<?php echo form_input(array(
							'type' => 'number',
							'min' => '0',
							'max' => '20',
							'name' => 'print_right_margin',
							'id' => 'print_right_margin',
							'class' => 'form-control input-sm required',
							'value' => $this->config->item('print_right_margin'))); ?>
						<span class="input-group-addon input-sm">px</span>
					</div>
				</div>
			</div>

			<?php echo form_submit(array(
				'name' => 'submit_receipt',
				'id' => 'submit_receipt',
				'value' => $this->lang->line('common_submit'),
				'class' => 'btn btn-primary btn-sm pull-right')); ?>
		</fieldset>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	if (window.localStorage && window.jsPrintSetup)
	{
		var printers = (jsPrintSetup.getPrintersList() && jsPrintSetup.getPrintersList().split(',')) || [];
		$('#receipt_printer, #invoice_printer, #takings_printer').each(function()
		{
			var $this = $(this)
			$(printers).each(function(key, value)
			{
				 $this.append($('<option>', { value : value }).text(value));
			});
			$("option[value='" + localStorage[$(this).attr('id')] + "']", this).prop('selected', true);
			$(this).change(function()
			{
				localStorage[$(this).attr('id')] = $(this).val();
			});
		});
	}
	else
	{
		$("input[id*='margin'], #print_footer, #print_header, #receipt_printer, #invoice_printer, #takings_printer, #print_silently").prop('disabled', true);
		$("#receipt_printer, #invoice_printer, #takings_printer").each(function()
		{
			$(this).append($('<option>', {value : 'na'}).text('N/A'));
		});
	}

	var dialog_confirmed = window.jsPrintSetup;

	$('#receipt_config_form').validate($.extend(form_support.handler, {
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				beforeSerialize: function(arr, $form, options) {
					return ( dialog_confirmed || confirm('<?php echo $this->lang->line('config_jsprintsetup_required'); ?>') );
				},
				success: function(response) {
					$.notify(response.message, { type: response.success ? 'success' : 'danger'} );
				},
				dataType:'json'
			});
		},

		errorLabelContainer: "#receipt_error_message_box",

		rules:
		{
			print_top_margin:
			{
				required:true,
				number:true
			},
			print_left_margin:
			{
				required:true,
				number:true
			},
			print_bottom_margin:
			{
				required:true,
				number:true
			},
			print_right_margin:
			{
				required:true,
				number:true
			},
			receipt_font_size:
			{
				required:true,
				number:true
			},
			print_delay_autoreturn:
			{
				required:true,
				number:true
			}
		},

		messages:
		{
			print_top_margin:
			{
				required:"<?php echo $this->lang->line('config_print_top_margin_required'); ?>",
				number:"<?php echo $this->lang->line('config_print_top_margin_number'); ?>"
			},
			print_left_margin:
			{
				required:"<?php echo $this->lang->line('config_print_left_margin_required'); ?>",
				number:"<?php echo $this->lang->line('config_print_left_margin_number'); ?>"
			},
			print_bottom_margin:
			{
				required:"<?php echo $this->lang->line('config_print_bottom_margin_required'); ?>",
				number:"<?php echo $this->lang->line('config_print_bottom_margin_number'); ?>"
			},
			print_right_margin:
			{
				required:"<?php echo $this->lang->line('config_print_right_margin_required'); ?>",
				number:"<?php echo $this->lang->line('config_print_right_margin_number'); ?>"
			},
			receipt_font_size:
			{
				required:"<?php echo $this->lang->line('config_receipt_font_size_required'); ?>",
				number:"<?php echo $this->lang->line('config_receipt_font_size_number'); ?>"
			},
			print_delay_autoreturn:
			{
				required:"<?php echo $this->lang->line('config_print_delay_autoreturn_required'); ?>",
				number:"<?php echo $this->lang->line('config_print_delay_autoreturn_number'); ?>"
			}
		}
	}));
});
</script>
