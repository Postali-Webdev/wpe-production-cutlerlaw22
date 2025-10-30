<div class="category-dropdown">
    <?php

    $categories = get_terms( array(
        'taxonomy' => 'faqs_category',
        'hide_empty' => true,
    ) );

    $select = "<select name='cat' id='cat' class='postform category-form'>";
    if ($text = get_field('category_placeholder')) :
    $select.= '<option  value="" disabled selected>'. $text .'</option>';
    endif;
    if ($text = get_field('category_all')) :
	    $select.= '<option  value="-1">'. $text .'</option>';
    endif;
    foreach($categories as $category){
        /*if($category->count > 0){*/
        $select.= "<option value='".$category->slug."'>".$category->name."</option>";
        /*}*/
    }

    $select.= "</select>";

    echo $select;
    ?>
</div>
