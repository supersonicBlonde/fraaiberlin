<?php foreach($args['posts'] as $arg): ?>  
<div class="col-md-4 mb-4">
    <a href="<?php echo $arg['permalink']; ?>">       
        <?php echo $arg['thumbnail']; ?>
    </a>
    
        <h2 class="mt-3 woocommerce-loop-product__title"><a href="<?php  echo $arg['permalink']; ?>"><?php echo $arg['title'];  ?></a></h2>
    
    <div class="short-description"><?php echo $arg['excerpt']; ?></div>
    <?php wc_get_template( 'loop/price.php' );?>
</div>
<?php endforeach; ?>
