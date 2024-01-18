<?if(!defined('ABSPATH')){exit;} ?>
<?
$type_filter = $args['type_filter'];
$array_items = $args['items'];
$class = ($args['sorting_class']) ? $args['sorting_class'] : null;

$category_id = false;
$taxonomy = false;
$index_row  = false;
$count = false;
$upload = false;
$clear = false;
$terms_uploaded = false;
if(isset($args['term_id'])){ $category_id = $args['term_id']; }
if(isset($args['taxonomy'])){ $taxonomy = $args['taxonomy'];}
if(isset($args['index_row'])){ $index_row = $args['index_row']; }
if(isset($args['count'])){ $count = $args['count']; }
if(isset($args['upload'])){ $upload = $args['upload']; }
if(isset($args['clear'])){ $clear = $args['clear']; }
if(isset($args['terms-uploaded'])){ $terms_uploaded = $args['terms-uploaded']; }
?>
<div class="sorting<?=$class;?> js-sorting" data-type-filter="<?=$type_filter;?>" <?=($taxonomy)? 'data-taxonomy="'.$taxonomy.'"' : null;?>  <?=($category_id)? 'data-term-id="'.$category_id.'"' : null;?> <?=($category_id)? 'data-index-row="'.$index_row.'"' : null;?> <?=($count)? 'data-count="'.$count.'"' : null;?> <?=($upload)? 'data-upload="'.$upload.'"' : null;?> <?=($clear)? 'data-clear="true"' : 'data-clear="false"';?> <?=($terms_uploaded)? 'data-terms-uploaded="'.$terms_uploaded.'"' : 'data-terms-uploaded="false"';?>>
    <div class="select-css"><?=$array_items[0]['label'];?></div>
    <div class="select-input">
        <?
            foreach($array_items as $key => $item) {
                echo '<span data-for="'.$item['slug'].'"';
                echo ($key===0) ? 'class="selected">' : '>';
                echo $item['label'].'</span>';
            }
        ?>
    </div>
</div>
