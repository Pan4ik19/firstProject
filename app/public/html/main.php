<form action="/main" method="post">
    <div class="container">
        <h3>Catalog</h3>
        <?php foreach ($products as $product): ?>
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
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach;?>
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