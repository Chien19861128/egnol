<?php 
	$channels = $this->config->item('channels');
?>
<div id="func_bar">
	
</div>

<ul class="nav nav-tabs">
    <li class="<?=empty($span) ? "active" : ""?>">
        <a href="<?=site_url("statistics/revenue")?>">日報表</a>
    </li>
    <li class="<?=($span=='weekly') ? "active" : ""?>">
        <a href="<?=site_url("statistics/revenue?span=weekly")?>">週報表</a>
    </li>
    <li class="<?=($span=='monthly') ? "active" : ""?>">
        <a href="<?=site_url("statistics/revenue?span=monthly")?>">月報表</a>
    </li>
    <li class="<?=($span=='deposit_behavior') ? "active" : ""?>">
        <a href="<?=site_url("statistics/deposit_behavior")?>">儲值習慣</a>
    </li>
    <li class="<?=($span=='lifetime_value') ? "active" : ""?>">
        <a href="<?=site_url("statistics/lifetime_value")?>">玩家價值</a>
    </li>
</ul>

<form method="get" action="<?=site_url("statistics/revenue")?>" class="form-search">
	<input type="hidden" name="span" value="<?=$this->input->get("span")?>">
		
	<div class="control-group">
		
		時間
		<input type="text" name="start_date" class="date required" value="<?=($this->input->get("start_date"))?$this->input->get("start_date"):date("Y-m-d",strtotime("-8 days"))?>" style="width:120px"> 至
		<input type="text" name="end_date" class="date" value="<?=$this->input->get("end_date")?>" style="width:120px" placeholder="現在">
		<a href="javascript:;" class="clear_date"><i class="icon-remove-circle" title="清除"></i></a>
		
		<input type="submit" class="btn btn-small btn-inverse" name="action" value="營收統計">	
	
	</div>
		
</form>

<? if ($query):?>
	<? if ($query->num_rows() == 0): echo '<div class="none">查無資料</div>'; else: ?>

	<table class="table table-striped table-bordered" style="width:auto;">
		<thead>
			<tr>
				<th nowrap="nowrap">日期</th>
				<th style="width:70px">總儲點</th>
				<th style="width:70px">iOS</th>
				<th style="width:70px">Android</th>
				<th style="width:70px">GASH</th>
				<th style="width:70px">其他儲點</th>
				<th style="width:70px">儲值地區-台灣</th>
				<th style="width:70px">儲值地區-香港</th>
				<th style="width:70px">儲值地區-澳門</th>
				<th style="width:70px">儲值地區-新加坡</th>
				<th style="width:70px">儲值地區-馬來西亞</th>
				<th style="width:70px">儲值地區-其他</th>
			</tr>
		</thead>
		<tbody>
		<? foreach($query->result() as $row):?>
			<tr>			
				<td nowrap="nowrap"><?=$row->date?></td>
				<td style="text-align:right"><?=number_format($row->sum)?></td>
				<td style="text-align:right"><?=number_format($row->ios_sum)?></td>
				<td style="text-align:right"><?=number_format($row->android_sum)?></td>
				<td style="text-align:right"><?=number_format($row->gash_sum)?></td>
				<td style="text-align:right"><?=number_format($row->other_billing_sum)?></td>
				<td style="text-align:right"><?=number_format($row->twn_sum)?></td>
				<td style="text-align:right"><?=number_format($row->hkg_sum)?></td>
				<td style="text-align:right"><?=number_format($row->mac_sum)?></td>
				<td style="text-align:right"><?=number_format($row->sgp_sum)?></td>
				<td style="text-align:right"><?=number_format($row->mys_sum)?></td>
				<td style="text-align:right"><?=number_format($row->other_country_sum)?></td>
			</tr>
		<? endforeach;?>
		</tbody>
	</table>
	<? endif;?>
<? endif;?>