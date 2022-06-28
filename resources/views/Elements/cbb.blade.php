<?php
$nameHtml       = isset($nameHtml) ? $nameHtml : 'combobox';
$domeHtml       = isset($domeHtml) ? $domeHtml : 'combobox';
$clsHtml        = isset($clsHtml) ? $clsHtml : '';
$listData       = isset($listData) ? $listData : [];
$id             = isset($id) ? $id : -1;
$isAll          = isset($isAll) ? $isAll : 0;
$isMultiple     = isset($isMultiple) ? $isMultiple : 0;
$isNone         = isset($isNone) ? $isNone : 0;
$isSearch       = (isset($isSearch) && $isSearch) || !isset($isSearch)? "combobox-search" : "";
$valueField     = isset($valueField) ? $valueField : 'id';
$displayField   = isset($displayField) ? $displayField : 'name';
$edited         = isset($edited) ? $edited : '';
$isRequired     = isset($required) ? $required : false;
$title    		= isset($title) ? $title : '';
$cbb_placeholder    = isset($cbb_placeholder) ? $cbb_placeholder : '';
?>

<select class="form-control
        {{ $isSearch }}
{{ $edited }}
		border-no-radius {{ $clsHtml }}"
		<?php if($isMultiple){ ?>
		multiple="multiple"
		<?php }?>
		@if($isRequired)
		required
		@endif
		<?php if($cbb_placeholder){?>
		title="<?php echo $cbb_placeholder ?>"
		<?php }?>

		id="<?php echo $domeHtml?>" name="<?php echo $nameHtml?>">
	<?php if($isAll){ ?>
	<option value="0" {{ $id == 0 ? "selected" : "" }}><?php echo __("Tất cả")?></option>
	<?php }?>




	<?php if($isNone){ ?>
	<option value="0" {{ $id == 0 ? "selected" : "" }}><?php echo __("Không có")?></option>
	<?php }?>

	<?php
	foreach($listData as $key => $item){
	$selected = $item[$valueField] == $id ? 'selected' : '';
	?>
	<option <?php echo $selected?> value="<?php echo $item[$valueField]?>"><?php echo __($item[$displayField])?></option>
	<?php
	}
	?>

</select>
