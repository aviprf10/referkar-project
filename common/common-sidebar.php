 <div class="js-sticky-sidebar initialize active">
        <div data-js-position-desktop="sidebar" data-sticky-sidebar-inner="" style="position: relative;">
            <div id="shopify-section-collection-sidebar" class="shopify-section">
                <div data-section-id="collection-sidebar" data-section-type="collection-sidebar">
                <aside class="collection-sidebar js-position js-collection-sidebar" data-js-collection-sidebar="" data-js-position-name="sidebar">
                    <nav class="collection-sidebar__navigation">
                        <div class="layer-navigation d-none" data-js-collection-nav-section="current_filters" data-js-accordion="all">
                            <div class="layer-navigation__head py-10 cursor-pointer open" data-js-accordion-button="">
                            <h5 class="d-flex align-items-center mb-0">
                                CURRENT FILTERS
                                <i class="layer-navigation__arrow">
                                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-229" viewBox="0 0 24 24">
                                        <path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"></path>
                                    </svg>
                                </i>
                            </h5>
                            </div>
                            <div class="layer-navigation__accordion" data-js-accordion-content="">
                            <div class="pt-2 pb-10">
                                <div data-js-collection-replace="current-tags">
                                    <p class="mb-8">There are no current tags</p>
                                </div>
                            </div>
                            </div>
                            <div class="border-bottom"></div>
                        </div>
                        <div class="layer-navigation" data-js-collection-nav-section="collections" data-js-accordion="all">
                            <div class="layer-navigation__head py-10 cursor-pointer open" data-js-accordion-button="">
                            <h5 class="d-flex align-items-center mb-0">
                               <b>CATEGORIES</b>
                            </h5>
                            </div>
                            <div class="layer-navigation__accordion" data-js-accordion-content="">
                            <div class="pt-2 pb-10">
                                <div class="collections-menu" data-js-collections-menu="">
                                <?php
                                if(count($category_data_array) > 0)
                                { 
                                    foreach($category_data_array as $category_data){
                                        $cat_id = $category_data['id'];
                                        $get_product_count_query = "select * from product where category_id ='$cat_id'  and is_deleted='0'";
                                        $result_get_product_count_query = mysqli_query($db_mysqli, $get_product_count_query);
                                        $total_data = mysqli_num_rows($result_get_product_count_query);
                                        
                                ?>    
                                    <div class="collections-menu__item" data-js-accordion="all" data-section-for-collection="<?php echo $category_data['category_name']; ?>">
                                            <div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer" data-js-accordion-button="">
                                            <label>
                                                <!-- <input type="checkbox"  id="categoryId" name="collection"  <?php //if($title == $category_data['category_unique_slug']){ ?> checked="checked" <?php //} ?>> -->
                                                <span><a href="<?php echo $base_url;?>collections/<?php echo $category_data['category_unique_slug'];?>" onclick="go_to_category('<?php echo $base_url;?>collections/<?php echo $category_data['category_unique_slug'];?>')"><?php echo ucfirst($category_data['category_name']); ?></a></span>
                                            </label>
                                            <i class="collections-menu__arrow"   id="collection<?php echo $cat_id; ?>">
                                                <svg aria-hidden="true" focusable="false"  id="collection" role="presentation" class="icon icon-theme-229" viewBox="0 0 24 24">
                                                    <path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"></path>
                                                </svg>
                                            </i>
                                            <span class="ml-auto"><?php echo $total_data; ?></span>
                                            </div>
                                            <div class="collections-menu__list pt-1 ml-25" id="collapse<?php echo $cat_id; ?>">
                                            <?php 
                                                
                                                $subcategory_data_array = array();
                                                $get_subcategory_query = "select * from sub_category where is_deleted='0' and category_id='$cat_id' ";
                                                $result_get_subcategory_query = mysqli_query($db_mysqli, $get_subcategory_query);
                                                while ($row_get_subcategory_query = mysqli_fetch_assoc($result_get_subcategory_query))
                                                {
                                                    $subcategory_data_array[] = $row_get_subcategory_query;
                                                }
                                                if(count($subcategory_data_array) > 0){
                                                    foreach($subcategory_data_array as $subcategory_data){
                                                        $subcat_id = $subcategory_data['id'];
                                                        $get_product_subcount_query = "select * from product where sub_category_id ='$subcat_id'  and is_deleted='0'";
                                                        $result_get_product_subcount_query = mysqli_query($db_mysqli, $get_product_subcount_query);
                                                        $subtotal_data = mysqli_num_rows($result_get_product_subcount_query);
                                            ?>
                                            <div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer">
                                                <label>
                                                    <!-- <input type="checkbox" id="collection" name="collection" value="<?php //echo $subcategory_data['sub_category_unique_slug']; ?>" <?php //if($title == $subcategory_data['sub_category_unique_slug']){ ?> checked="checked" <?php //} ?>> -->
                                                    <span><a href="<?php echo $base_url;?>collections/<?php echo $subcategory_data['sub_category_unique_slug'];?>" onclick="go_to_category('<?php echo $base_url;?>collections/<?php echo $subcategory_data['sub_category_unique_slug'];?>')"><?php echo ucfirst($subcategory_data['sub_category_name']); ?></a><span>
                                                </label>
                                                <span class="ml-auto"><?php echo $subtotal_data; ?></span>
                                            </div>
                                            <?php }} ?>       
                                        </div>
                                    </div>
                                <?php 
                                    }
                                }else{
                                    ?>
                                    <p>No category found!</p>
                                <?php } ?>        
                                </div>
                            </div>
                            <div class="border-bottom"></div>
                        </div>
                        <div class="layer-navigation" data-js-collection-nav-section="filter_by_price" data-js-accordion="all">
                            <div class="layer-navigation__head py-10 cursor-pointer open" data-js-accordion-button="">
                            <h5 class="d-flex align-items-center mb-0">
                                <b>PRICE</b>
                            </h5>
                            </div>
                            <div class="layer-navigation__accordion" data-js-accordion-content="">
                                <div class="pt-2 pb-10">
                                    <div class="list-group">   
                                        <br>
                                        <input type="text" id="slider-range" value="" name="range" />
                                        <input type="hidden" id="min_price_filter" name="min_price" value="0" placeholder="Min price">
                                        <input type="hidden" id="max_price_filter" name="max_price" value="0"  placeholder="Max price">
                                        <br>
                                    </div>
                                </div>
                            </div>
                                <div class="m-t-20"><br>
                                    <a href="<?php echo $base_url;?>collections" class="lnk btn btn-primary" style="width: 100%;"><i class="glyphicon glyphicon-repeat"></i> Reset</a>
                                </div>
                            <div class="border-bottom"></div>
                        </div>
                    </nav>
                </aside>
                </div>
            </div>
        </div>
    </div>

