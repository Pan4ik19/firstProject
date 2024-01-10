
<div class="container">
    <h3>Catalog</h3>
    <?php if(!empty($products)): ?>
        <?php foreach ($products as $product): ?>

        <form action="/addProduct" method="post">
        <div class="card-deck">
            <div class="card text-center">
                <a href="#">
                    <div class="card-header">
                        Hit!
                    </div>
                    <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="Card image">
                    <div class="card-body">
                        <p class="card-text text-muted">Category name</p>
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <div class="card-footer">
                            <?php echo $product['prise']; ?>
                            <input type="hidden"  name="productId" value="<?php echo $product['id']?>">
                            <input type="text" name="quantity" placeholder="quantity">
                            <button type="submit"> buy </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </form>

    <?php endforeach; ?>
    <?php endif;?>
    </div>


<form action="/logout" method="post">
    <button type="submit" name="logout"> logout</button>
</form>

<form action="/cart" method="post">
    <button type="submit" name="basket">basket</button>
</form>

<style>



    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 11px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }
</style>