<?php
include("connect.php");
// Get the 1000 most recently added products
$stmt = $db->prepare('SELECT * FROM books ORDER BY bookid DESC LIMIT 1000');
$stmt->execute();
$resultSet = $stmt->get_result();
$data = $resultSet->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>CodePen - Store Page Thing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="css/product.css">


</head>
<body>
<!-- partial:index.partial.html -->
<!-- FONTS -->
<link href="https://fonts.googleapis.com/css?family=Comfortaa|Open+Sans" rel="stylesheet">

<!-- PAGE STUFF  -->
<div id="app">
    <div class="menu">
        <p class="rela-block">menu</p>
    </div>
    <div :class="['rela-block', 'page-container', menuOpen?'shifted':'']">
        <div :class="['rela-block', 'nav-bar']">
            <div class="rela-block gutter-container inner-nav-container">
                <div :class="['nav-flip', 'top', searchOpen?'active':'']">
                    <div class="abs-center logo link">tunes.</div>
                    <div :class="['left', 'ui-icon', 'menu-button', menuOpen?'active':'']" @click="menuOpen = !menuOpen">
                        <svg viewbox="0 0 40 50" class="button-svg">
                            <path d="M 7 15 L 33 15"/>
                            <path d="M 7 25 L 33 25"/>
                            <path d="M 7 35 L 33 35"/>
                        </svg>
                    </div>
                    <div :class="['right', 'ui-icon', 'cart-button', cartOpen?'active':'']" @click="cartOpen = !cartOpen">
                        <svg viewbox="0 0 50 50" class="button-svg">
                            <path d="M 4 8 L 9 8 L 16 33 L 39 33 L 44 13 L 17 13"/>
                            <circle cx="19" cy="41" r="3"/>
                            <circle cx="37" cy="41" r="3"/>
                        </svg>
                    </div>
                </div>
                <div :class="['nav-flip', 'bottom', searchOpen?'active':'']">
                    <input v-model="searchInput" type="text" placeholder="Search here..." class="search-bar"/>
                </div>
                <div :class="['vert-center', 'ui-icon', 'search-button']" @click="searchOpen = !searchOpen">
                    <svg viewbox="0 0 50 50" class="button-svg">
                        <circle cx="20" cy="22" r="12"/>
                        <path d="M 31 32 L 39 40"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="rela-block page-section top-section">
            <div class="gutter-container">
                <div class="rela-block section-nav">
                    <h2 class="left">New Item Showcase</h2>
                </div>
                <div class="rela-block new-item-container">
                    <div :class="['vert-center', 'move-arrow', 'left-arrow', newItemPos<=0?'disabled':'']" @click="updateNewItemPos(-1)"><</div>
                    <div :class="['vert-center', 'move-arrow', 'right-arrow', newItemPos>=(newItems.length-1)?'disabled':'']" @click="updateNewItemPos(1)">></div>
                    <div class="inner-moving-container" :style="{'left': ((newItemPos * -320)+1)+'px'}">
                        <div v-for="(ni,index) in newItems" class="rela-inline new-item" :style="{'background': 'url(\''+ni.img+'\') center no-repeat', 'animation-delay': (index*0.1)+'s'}">
                            <div class="new-item-info">
                                <p class="abs-center" style="color: white;">{{ni.name}}<br>{{ni.author}}</p>
                            </div>
                            <div class="product-view-button" @click="viewProduct(ni.id)">View</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rela-block page-section grey product-section">
            <div class="rela-block gutter-container">
                <div class="rela-block section-nav">
                    <h2 class="left">All Products<span v-show="currentCatg !== 'All'">/{{currentCatg}}</span></h2>
                    <div class="right category-select">
                        <div v-for="c in catg" :class="['rela-inline', 'category', currentCatg===c?'active':'']"
                             @click="currentCatg = c; updateFilteredProducts()" >{{c}}</div>
                    </div>
                </div>
                <div class="rela-block product-item-container">
                    <product-comp v-for="(item,index) in displayedProducts" :info="item"></product-comp>
                </div>
                <div v-show="this.displayPos < this.filteredProducts.length" class="rela-block load-button">
                    <div class="rela-inline load-button-container" @click="addDisplayedProducts">
                        <p>Load More</p>
                        <svg viewbox="0 0 50 50" class="button-svg">
                            <path />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="rela-block page-section new-section">
            <div class="rela-block gutter-container">
                <div class="rela-block section-nav">
                    <h2 class="left">Coming Soon...</h2>
                </div>
            </div>
        </div>
        <div class="rela-block footer">
            <div class="rela-block gutter-container inner-footer-container">
                <div class="logo">tunes.</div>
            </div>                
        </div>
    </div>
        
    <div :class="['product-view-container', productViewOpen?'active':'']">
        <div class="rela-block gutter-container">
            <div class="rela-block section-nav">
                <h2 class="left">Product View</h2>
                <div class="rela-inline right close-button" @click="productViewOpen = false">
                    <svg viewbox="0 0 30 30" class="button-svg">
                        <path d="M 8 8 L 22 22"/>
                        <path d="M 22 8 L 8 22"/>
                    </svg>
                </div>
            </div>
            <div class="rela-block pv-container">
                <div class="rela-block pv-pic" :style="{'background': 'url(\''+viewedProduct.img+'\') center no-repeat'}"></div>
            </div>
            <div class="rela-block pv-container">
                <div class="rela-block pv-info">
                    <h2 class="rela-block">{{viewedProduct.name}}</h2>
                    <h3 class="rela-block">{{viewedProduct.author}}</h3>
                    <div class="rela-block info-row">
                        <div class="rela-inline left">Release Date: </div>
                        <div class="rela-block text" v-html="viewedProduct.date||'No Release Date'"></div>
                    </div>
                    <div class="rela-block info-row">
                        <div class="rela-inline left">Product Category: </div>
                        <div class="rela-block text" v-html="viewedProduct.catg||'No Category'"></div>
                    </div>
                    <div class="rela-block info-row">
                        <div class="rela-inline left">Product Description: </div>
                        <div class="rela-block text" v-html="viewedProduct.desc||'No Description'"></div>
                    </div>
                </div>
            </div>
            <div class="rela-block pv-container">
                <span v-show="currentCatg != 'All'"><h2>Related Books</h2></span>
                <span v-show="currentCatg == 'All'"><h2>Recommend New Books</h2></span>
                <div class="rela-block pv-related-container">
                    <div class="rela-block gutter-container">
                        <span v-show="currentCatg != 'All'">
                        <div class="rela-block product-item-container">
                            <product-comp v-for="(item,index) in displayedProducts" :info="item"></product-comp>
                        </div>
                        </span>
                        <span v-show="currentCatg == 'All'">
                            <div class="rela-block page-section top-section">
                                <div class="gutter-container">
                                    <div class="rela-block new-item-container">
                                        <div :class="['vert-center', 'move-arrow', 'left-arrow', newItemPos<=0?'disabled':'']" @click="updateNewItemPos(-1)"><</div>
                                        <div :class="['vert-center', 'move-arrow', 'right-arrow', newItemPos>=(newItems.length-1)?'disabled':'']" @click="updateNewItemPos(1)">></div>
                                        <div class="inner-moving-container" :style="{'left': ((newItemPos * -320)+1)+'px'}">
                                            <div v-for="(ni,index) in newItems" class="rela-inline new-item" :style="{'background': 'url(\''+ni.img+'\') center no-repeat', 'animation-delay': (index*0.1)+'s'}">
                                                <div class="new-item-info">
                                                    <p class="abs-center" style="color: white;">{{ni.name}}<br>{{ni.author}}</p>
                                                </div>
                                                <div class="product-view-button" @click="viewProduct(ni.id)">View</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                        <?php 
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js'></script>
</div>

</body>
</html>
<script type="text/javascript">
Vue.component('productComp', {
    template: ` <div v-show="info.id >= 0" :class="['rela-inline', 'product-card']" :key="info.id" :style="{'animation-delay':(info.delay*0.1)+'s'}">
                    <div class="rela-block product-pic" :style="{'background': 'url('+info.img+') center no-repeat'}">
                        <div class="product-view-button" @click="view(info.id)">View</div>
                    </div>
                    <div class="rela-block product-info">
                        <div class="rela-block">
                            <p>{{info.name}}</p>
                            <span class="product-author">{{info.author}}</span>
                            <div class="product-cost">\{{info.cost}}.000vnđ</div>
                        </div>
                        <button class="vert-center product-buy">Buy</button>
                    </div>
                </div>`,
    props: {
        info: {
            type: Object,
            default: {
                id: 0,
                name: 'Untitled',
                author: 'Author',
                desc: 'Product description',
                delay: 0,
                cost: 0,
                catg: 'test',
                img: 'https://picsum.photos/600/?random',
            }
        },
    },
    methods: {
        view: function(id) { app.viewProduct(id); },
    }
});

// - Vue Stuff -
var app = new Vue({
    el: '#app',
    data: {
        menuOpen: false,
        cartOpen: false,
        searchOpen: false,
        productViewOpen: false,
        currentViewedProduct: 0, // Product's id
        viewedProduct: {},
        searchInput: '',
        newItems: [],
        newItemPos: 0,
        products: [
            <?php foreach ($data as $book): ?>
                {
                id: <?=$book['bookid']?>,
                name: '<?=$book['name']?>',
                author: '<?=$book['author']?>',
                desc: '<?=$book['description']?>',
                cost: <?=$book['price']?>,
                img: '<?=$book['image']?>',
                catg: '<?=$book['category']?>',
                date: '<?=$book['date']?>'
                },
            <?php endforeach; ?>
        ],
        filteredProducts: [],
        displayedProducts: [],
        displayPos: 0,
        catg: ['All','Internet','Education','Romance','Travel'],
        currentCatg: 'All',
    },
    methods: {
        init: function() {
            app.updateNewItems();
            app.updateFilteredProducts();
        },
        updateNewItems: function() {
            // sort all of the products by date and then take the 10 newest
            this.newItems = [];
            var arr = [];
            // 1 because of the test product (Need to fix that)
            for(var i = 1; i < this.products.length; i++) {arr.push(this.products[i])}
            arr.sort(function(a, b){ return (new Date(b.date)).getTime() - (new Date(a.date)).getTime() });
            
            for(var i = 0; i < 10 && i < arr.length; i++) { this.newItems.push(arr[i]) }
        },
        
        updateNewItemPos: function(num) {
            this.newItemPos += num;
            // Checks
            if(this.newItemPos < 0) { this.newItemPos = 0 }
            if(this.newItems.length > 1 && (this.newItemPos > this.newItems.length - 1)) { 
                this.newItemPos = this.newItems.length - 1
            }
        },
        updateFilteredProducts: function() {
            this.filteredProducts = [];
            for(var i in this.products) {
                if(this.products[i].catg === this.currentCatg || this.currentCatg === 'All') { this.filteredProducts.push(this.products[i]) }
            }
            app.updateDisplayedProducts();
        },
        updateDisplayedProducts: function() {
            this.displayedProducts = [];
            this.displayPos = 0;
            app.addDisplayedProducts();
        },
        addDisplayedProducts: function() {
            if((this.filteredProducts.length - this.displayPos) <= 12) {
                this.displayedProducts = JSON.parse(JSON.stringify( this.filteredProducts ));
                for(var i = 0; i < this.displayedProducts.length; i++) { this.displayedProducts[i].delay = (i - this.displayPos); }
                this.displayPos = this.filteredProducts.length;
            } else {
                // The ternary is for the test product. I really need to fix that.... :/
                for(var i = 0; i < (this.displayPos===0?13:12); i++) { 
                    this.displayedProducts.push(this.filteredProducts[i + this.displayPos]);
                    this.displayedProducts[i+this.displayPos].delay = (i);
                }
                this.displayPos = this.displayedProducts.length;
            }
        },
        updateViewedProduct: function() { 
            this.viewedProduct = (app.products.filter(function(el){ return el.id === app.currentViewedProduct }))[0]; 
        },
        viewProduct: function(id) {
            this.currentViewedProduct = id; 
            app.updateViewedProduct(); 
            this.productViewOpen = true;
        },
    }
});

app.init();

// Scroll Function
// window.addEventListener('scroll', function() { app.pageScrolled = (window.scrollY > 0); }, false);




</script>
