
    <form action="/order" method="post">
        <div class="container">
            <h3>Basket</h3>
            <?php if(!empty($basketWithProducts)): ?>
            <?php $totalPrice = 0; ?>
            <?php foreach ($basketWithProducts as $product): ?>
            <div class="card-deck">
                <div class="card text-center">
                        <div class="card-header">
                            Hit!
                        </div>
                        <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="Card image">
                        <div class="card-body">
                            <p class="card-text text-muted">Category name</p>
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <div class="card-footer">
                                <?php $totalPrice = $totalPrice + $product['prise'] * $product['quantity'] ;?>
                                <?php echo $product['prise']; ?>
                                <input type="hidden"  name="productId" value="<?php echo $product['id']?>">
                                <input type="text" name="quantity" placeholder="quantity" value="<?php echo $product['quantity']?>">
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="card text-center">
            <br>
            <label> Общая стоимость</label>
            <br>
            <input type="text" readonly="readonly" name="totalPrice" value="<?php echo $totalPrice?>">
            <label>Телефон</label>
            <input type="text" name="phone" placeholder="номер телефона">
            <label>Адрес</label>
            <input type="text" name="address" placeholder="адрес проживания">
            <button type="submit" name="order">Оформить заказ</button>
        </div>

        <?php endif;?>
    </form>



