<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'css/invoice_email.css';?>"/>
</head>

<body>
<?php
	if(isset($error_message))
	{
		echo "<div class='alert alert-dismissible alert-danger'>".$error_message."</div>";
		exit;
	}
?>

<div id="page-wrap">
	<div id="header"><?php echo $this->lang->line('sales_quote'); ?></div>
	<table id="info">
		<tr>
			<td id="logo">
				<?php if($this->config->item('company_logo') != '')
				{
				?>
					<img id="image" src="<?php echo 'uploads/' . $this->config->item('company_logo'); ?>" alt="company_logo" />
				<?php
				}
				?>
			</td>
			<td id="customer-title">
				<pre><?php if(isset($customer)) { echo $customer_info; } ?></pre>
			</td>
		</tr>
		<tr>
			<td id="company-title">
				<pre><?php echo $this->config->item('company'); ?></pre>
				<pre><?php echo $company_info; ?></pre>
			</td>
			<td id="meta">
				<table align="right">
					<tr>
						<td class="meta-head"><?php echo $this->lang->line('sales_quote_number');?> </td>
						<td><div><?php echo $quote_number; ?></div></td>
					</tr>
					<tr>
						<td class="meta-head"><?php echo $this->lang->line('common_date'); ?></td>
						<td><div><?php echo $transaction_date; ?></div></td>
					</tr>
					<?php
					if($amount_due > 0)
					{
					?>
						<tr>
							<td class="meta-head"><?php echo $this->lang->line('sales_amount_due'); ?></td>
							<td><div class="due"><?php echo to_currency($total); ?></div></td>
						</tr>
					<?php
					}
					?>
				</table>
			</td>
		</tr>
	</table>

	<table id="items">
		<tr>
			<th><?php echo $this->lang->line('sales_item_number'); ?></th>
			<th><?php echo $this->lang->line('sales_item_name'); ?></th>
			<th><?php echo $this->lang->line('sales_quantity'); ?></th>
			<th><?php echo $this->lang->line('sales_price'); ?></th>
			<th><?php echo $this->lang->line('sales_discount'); ?></th>
			<?php
			$quote_columns = 6;
			if($discount > 0)
			{
				$quote_columns = $quote_columns + 1;
				?>
				<th><?php echo $this->lang->line('sales_customer_discount'); ?></th>
				<?php
			}
			?>
			<th><?php echo $this->lang->line('sales_total'); ?></th>
		</tr>

		<?php
		foreach($cart as $line=>$item)
		{
			if($item['print_option'] == PRINT_YES)
			{
			?>
				<tr class="item-row">
					<td><?php echo $item['item_number']; ?></td>
					<td class="item-name"><?php echo $item['name']; ?></td>
					<td><?php echo to_quantity_decimals($item['quantity']); ?></td>
					<td><?php echo to_currency($item['price']); ?></td>
					<td><?php echo ($item['discount_type']==FIXED)?to_currency($item['discount']):$item['discount'] . '%';?></td>
					<?php if($discount > 0): ?>
						<td><?php echo to_currency($item['discounted_total'] / $item['quantity']); ?></td>
					<?php endif; ?>
					<td class="total-line"><?php echo to_currency($item['discounted_total']); ?></td>
				</tr>
			<?php
			}
		}
		?>

		<tr>
			<td colspan="<?php echo $quote_columns; ?>" align="center"><?php echo '&nbsp;'; ?></td>
		</tr>

		<tr>
			<td colspan="<?php echo $quote_columns-3; ?>" class="blank"> </td>
			<td colspan="2" class="total-line"><?php echo $this->lang->line('sales_sub_total'); ?></td>
			<td id="subtotal" class="total-value"><?php echo to_currency($subtotal); ?></td>
		</tr>

		<?php
		foreach($taxes as $tax_group_index=>$tax)
		{
		?>
			<tr>
				<td colspan="<?php echo $quote_columns-3; ?>" class="blank"> </td>
				<td colspan="2" class="total-line"><?php echo (float)$tax['tax_rate'] . '% ' . $tax['tax_group']; ?></td>
				<td id="taxes" class="total-value"><?php echo to_currency_tax($tax['sale_tax_amount']); ?></td>
			</tr>
		<?php
		}
		?>

		<tr>
			<td colspan="<?php echo $quote_columns-3; ?>" class="blank"> </td>
			<td colspan="2" class="total-line"><?php echo $this->lang->line('sales_total'); ?></td>
			<td id="total" class="total-value"><?php echo to_currency($total); ?></td>
		</tr>
	</table>

	<div id="terms">
		<textarea id="sale_return_policy">
			<h5>
				<textarea rows="5" cols="6"><?php echo nl2br($this->config->item('payment_message')); ?></textarea>
				<textarea rows="5" cols="6"><?php echo empty($comments) ? '' : $this->lang->line('sales_comments') . ': ' . $comments; ?></textarea>
				<textarea rows="5" cols="6"><?php echo $this->config->item('quote_default_comments'); ?></textarea>
			</h5>
			<?php echo nl2br($this->config->item('return_policy')); ?>
		</div>
		<div id='barcode'>
			<?php echo $quote_number; ?>
		</div>
	</div>
</div>

</body>
</html>
