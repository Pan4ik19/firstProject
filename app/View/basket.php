
    <form action="/main" method="post">
        <div class="container">
            <h3>Basket</h3>
            <?php
            if(isset($products) && gettype($products) === "array"){
            foreach ($products as $product):
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
                                <button type="submit" id="<?php echo $product['id']?>" name="product"> buy </button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach;} else{echo "notWORk";}?>
    </form>

    <form action="/main" method="post">
        <button type="submit" name="basket">catalog</button>
    </form>

