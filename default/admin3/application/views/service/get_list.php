<?php 
	$question_type = $this->config->item('question_type');
	$question_status = $this->config->item('question_status');
?>
<div id="func_bar">
</div>

<form method="get" action="<?=site_url("service/get_list")?>" class="form-search">
	<input type="hidden" name="game_id" value="<?=$this->game_id?>">
	
	<div class="control-group">	
		
		遊戲
		<select name="game" style="width:120px">
			<option value="">--</option>
			<? foreach($games->result() as $row):?>
			<option value="<?=$row->game_id?>" <?=($this->input->get("game")==$row->game_id ? 'selected="selected"' : '')?>><?=$row->name?></option>
			<? endforeach;?>
		</select>		
			
		<span class="sptl"></span>
		
		問題類型 
		<select name="type" style="width:100px">
			<option value="">--</option>
			<? foreach($question_type as $key => $type):?>
			<option value="<?=$key?>" <?=($this->input->get("type")==$key ? 'selected="selected"' : '')?>><?=$type?></option>
			<? endforeach;?>
		</select>
		
		<span class="sptl"></span>
		
		問題狀態
		<select name="status" style="width:90px">
			<option value="">--</option>		
						
			<? foreach($question_status as $key => $status):?>
			<option value="<?=$key?>" <?=($this->input->get("status")===strval($key) ? 'selected="selected"' : '')?>><?=$status?></option>
			<? endforeach;?>
		</select>
		
		<span class="sptl"></span>
				
		建檔時間
		<input type="text" name="start_date" value="<?=$this->input->get("start_date")?>" style="width:120px"> 至
		<input type="text" name="end_date" value="<?=$this->input->get("end_date")?>" style="width:120px" placeholder="現在">
		<a href="javascript:;" class="clear_date"><i class="icon-remove-circle" title="清除"></i></a>
		
	</div>
	
	<div class="control-group">
		
		<input type="text" name="content" value="<?=$this->input->get("content")?>" style="width:120px" placeholder="提問描述">
		<input type="text" name="question_id" value="<?=$this->input->get("question_id")?>" style="width:90px" placeholder="#id">
		<input type="text" name="uid" value="<?=$this->input->get("uid")?>" style="width:90px" placeholder="uid">
		<input type="text" name="account" value="<?=$this->input->get("account")?>" style="width:90px" placeholder="帳號">
		<input type="text" name="character_name" value="<?=$this->input->get("character_name")?>" style="width:90px" placeholder="角色名稱">
		
		<span class="sptl"></span>
		
		<input type="text" name="email" value="<?=$this->input->get("email")?>" style="width:90px" placeholder="Email">
		
		<span class="sptl"></span>
		
		<input type="submit" class="btn btn-small btn-inverse" name="action" value="查詢">		
		
		<? if ($this->input->get("use_default") == false):?>
		<span class="sptl"></span>		
		<a href="?" class="btn btn-small"><i class="icon-remove"></i> 重置條件</a>
		<? endif;?>
		
	</div>
		
</form>

<? if ($query):?>

<? 
		switch ($this->input->get("action")) 
		{
			case "查詢":
				$get = $this->input->get();
				$get['sort'] = 'expense';
				$query_string = http_build_query($get);
		?>
	
<span class="label label-warning">總筆數<?=$total_rows?></span>

<?=tran_pagination($this->pagination->create_links());?>

<table class="table table-striped table-bordered" style="width:auto;">
	<thead>
		<tr>
			<th style="width:60px;">#</th>
			<th style="width:80px">遊戲</th>
			<th style="width:120px">角色名稱</th>
			<th style="width:400px">描述</th>
			<th style="width:90px;">uid</th>
			<th style="width:110px;"><a href="?<?=$query_string?>">轉點金額</a><?=$this->input->get("sort") == 'expense' ? ' <i class="icon icon-chevron-down"></i>' : ''?></th>
			<th style="width:80px;">狀態</th>
			<th style="width:80px;">處理人</th>
			<th style="width:100px;">日期</th>		
			<th></th>	 	
		</tr>
	</thead>
	<tbody>
		<? if ($query->num_rows() == 0):?>
				
		<tr>
			<td colspan="10">
				<div style="padding:10px; color:#777;">查無記錄</div>
			</td>
		</tr>

		<? else:?>
		
		<? foreach($query->result() as $row):?>
		<tr>
			<td><a href="<?=site_url("service/view/{$row->id}")?>"><?=$row->id?></a></td>
			<td><?=$row->game_name?></td>
			<td><?=$row->character_name?></td>
			<? if ($row->type == '9'):?>
			<td colspan="3">
				<span style="font-size:12px;">【<?=$question_type[$row->type]?>】</span>
				<a href="<?=site_url("service/view/{$row->id}")?>"><?=mb_strimwidth(strip_tags($row->content), 0, 98, '...', 'utf-8')?></a>
			</td>
			<td><?=$question_status[$row->status]?>
				<div style="font-size:11px;"> 
				<?  if ($row->allocate_status == '1'):?>
					<span style="color:#999">(後送中)</span>
				<? elseif ($row->allocate_status == '2'):?>
					<span style="color:#090">(後送完成)</span>
				<? endif;?>
				</div>
			</td>						
			<? else:?>
			<td style="word-break: break-all">
				<span style="font-size:12px;">【<?=$question_type[$row->type]?>】</span>
				<a href="<?=site_url("service/view/{$row->id}")?>"><?=mb_strimwidth(strip_tags($row->content), 0, 66, '...', 'utf-8')?></a>
			</td>			
			<td>
				<a href="<?=site_url("member/view/{$row->uid}")?>"><?=$row->uid?></a>
				<a href="<?=site_url("service/get_list?uid={$row->uid}&action=查詢")?>"><i class="icon-search"></i></a>
			</td>
			<td><?=$row->expense?></td>
			<td><?=$question_status[$row->status]?>
				<div style="font-size:11px;"> 
				
				<?  if ($row->status == '2' || $row->status == '4'):?>				
					<?= $row->is_read ? '<span style="color:#090">(已讀)</span>' : '<span style="color:#999">(未讀)</span>'; ?>				
				<? endif;?>
				
				<?  if ($row->allocate_status == '1'):?>
					<span style="color:#999">(後送中)</span>
				<? elseif ($row->allocate_status == '2'):?>
					<span style="color:#090">(後送完成)</span>
				<? endif;?>
				
				</div>
			</td>			
			<? endif;?>			
			<td><?=$row->admin_uname?></td>
			<td><?=date("Y-m-d H:i", strtotime($row->create_time))?></td>
			<td>
				<div class="btn-group">
					<button type="button" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>	
					<ul class="dropdown-menu pull-right">
						<? if ($row->status == '0'):?>
						<li><a href="javascript:;" class="json_post" url="<?=site_url("service/show_question/{$row->id}")?>"><i class="icon-repeat"></i> 調回處理中</a></li>
						<? else:?>
						<li><a href="javascript:;" class="json_post" url="<?=site_url("service/hide_question/{$row->id}")?>"><i class="icon-remove"></i> 隱藏</a></li>
						<? endif;?>
					</ul>
				</div>			
			</td>
		</tr>
		<? endforeach;?>

<? if ($_SERVER['REQUEST_URI'] == '/admin3/service/todo'):?>
<script language="JavaScript">
title_tmp1 = document.title;
if (title_tmp1.indexOf(">>")!=-1) {
	title_tmp2=title_tmp1.split(">>");
	title_last=" —> "+title_tmp2[1];
	title_last=title_last + " —> " + title_tmp2[2];
}else{
	if (title_tmp1.indexOf("——")!=-1) {
		title_tmp2=title_tmp1.split("——");
		title_last=" —> "+title_tmp2[1];
		if (title_last==" —> ") {title_last=" —> "};
		if (title_last==" —> ") {title_last=" —> "};
	}
}
title_new="待處理案件";
step=0;
function flash_title()
{
	step++;
	if (step==5) {step=1;}
	if (step==1) {document.title='★☆☆ '+title_new+'(<?=$total_rows?>) ☆☆★';}
	if (step==2) {document.title='☆★☆ '+title_new+'(<?=$total_rows?>) ☆★☆';}
	if (step==3) {document.title='☆☆★ '+title_new+'(<?=$total_rows?>) ★☆☆';}
	if (step==4) {document.title='☆★☆ '+title_new+'(<?=$total_rows?>) ☆★☆';}
	setTimeout("flash_title()",500);
}
flash_title();
</script>		
<? endif;?>
		
		<? endif;?>
		
	</tbody>
</table>

		<? 
			break;				
		?>

		<? } ?>
<? endif;?>