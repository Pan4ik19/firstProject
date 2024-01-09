
    <form action="/" method="post">
        <div class="container">
            <h3>Basket</h3>
            <?php
            if(isset($basketWithProducts)){
                foreach ($basketWithProducts as $product):
            ?>
            <div class="card-deck">
                <div class="card text-center">
                    <a href="#">
                        <div class="card-header">
                            Hit!
                        </div>
                        <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="Card image">
                        <div class="card-body">
                            <p class="card-text text-muted">Category name</p>
                            <a href="#"><h5 class="card-title"><?php echo $product['name']; ?></h5></a>
                            <div class="card-footer">
                                <?php echo $product['prise']; ?>
                                <input type="hidden"  name="productId" value="<?php echo $product['id']?>">
                                <input type="text" name="quantity" placeholder="quantity" value="<?php echo $product['quantity']?>">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach;} else{echo "notWORk";}?>
    </form>

    <form action="/main" method="get">
        <button type="submit">catalog</button>
    </form>

