<?php
$nameHtml       = isset($nameHtml) ? $nameHtml : 'combobox';
$domeHtml       = isset($domeHtml) ? $domeHtml : 'combobox';
$clsHtml        = isset($clsHtml) ? $clsHtml : 'combobox';
$label          = isset($label) ? $label : 'Combobox';
$listData       = isset($listData) ? $listData : [];
$id             = isset($id) ? $id : -1;
$valueField     = isset($valueField) ? $valueField : 'id';
$displayField   = isset($displayField) ? $displayField : 'name';
$isAll          = isset($isAll) ? $isAll : false;
$required       = isset($required) ? $required : false;
?>
<select id="<?php echo $domeHtml;?>" class="selectpicker form-control with-ajax <?php echo $clsHtml;?>" data-live-search="true" name="<?php echo $nameHtml;?>">

    <?php
    if($isAll){
    ?>
    <option  value="0"><?php echo "Tất cả"?></option>
    <?php
    }
    ?>

    <?php
    foreach($listData as $key => $item){
    $selected = $item[$valueField] == $id ? 'selected' : '';
    ?>
    <option <?php echo $selected?> value="<?php echo $item[$valueField]?>"><?php echo $item[$displayField]?></option>
    <?php
    }
    ?>

</select>
