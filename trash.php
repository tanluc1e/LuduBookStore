
    <?php foreach ($data as $book): ?>
        <div v-show="<?=$book['bookid']?> >= 0" :class="['rela-inline', 'product-card']" :key="<?=$book['bookid']?>" :style="{'animation-delay':(info.delay*0.1)+'s'}">
            <div class="rela-block product-pic" style="background: url(./<?=$book['image']?>); ">
                <div class="product-view-button" @click="view(<?=$book['bookid']?>)">View</div>
            </div>
            <div class="rela-block product-info">
                <div class="rela-block">
                    <p><?=$book['name']?></p>
                    <span class="product-artist"><?=$book['author']?>}</span>
                    <div class="product-cost"><?=$book['price']?></div>
                </div>
                <button class="vert-center product-buy">Buy</button>
            </div>
        </div>
    <?php endforeach; ?>
