<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Shopping cart-js</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="content">
		<div class="devideDIV">
			<span>My Shopping Cart
<div class="cartIconDIV"></div>
			</span>

		</div>
		<div class="cartTop">
			<div class="countBalance">
				<span style="color:#FF6347">温馨提示:</span>
				Your Balance:
				<span style="font-size:20px;">1000.20</span>
				<span style="color:#FF6347;font-size:24px;">vnđ</span>
			</div>
			<div class="addressDIV">
				<span>Shipping address</span>
			</div>
		</div>
 <div style="clear:both;"></div>
		
		<div class="cartMain">
        <form action="cart.php" method="post">
			<table id="cartTable">
				<thead>
					<tr>
						<th>
							<label for="fl select-all">
					<input type="checkbox" class="check-all check"/>
					<span><a href="javascript:void(0)" class="selallSPAN">&nbsp;Select</a></span>
							</label>
						</th>
						<th>Item</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>SubTotal</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
                    <?php
	    	            require_once "./functions/database_functions.php";
	    	            require_once "./functions/cart_functions.php";

	    	            // bookid got from form post method, change this place later.
	                    if(isset($_POST['bookisbn']))
		                {
	    	                $bookid = $_POST['bookisbn'];
	    	            }
	    	            if(isset($bookid))
			            {
		    	            // new iem selected
		                    if(!isset($_SESSION['cart']))
			                {
		    	                // $_SESSION['cart'] is associative array that bookisbn => qty
		    	                $_SESSION['cart'] = array();
			   	                $_SESSION['total_items'] = 0;
			    	            $_SESSION['total_price'] = '0.00';
		    	            }
		    	            if(!isset($_SESSION['cart'][$bookid]))
		    	            {
			   	                $_SESSION['cart'][$bookid] = 1;
		    	            } 

		    	            elseif(isset($_POST['cart']))
		    	            {
				                $_SESSION['cart'][$bookid]++;
				                unset($_POST);
		                    }
	                    }
	    	            // if save change button is clicked , change the qty of each bookisbn
	    	            if(isset($_POST['save_change']))
	    	            {
		                    foreach($_SESSION['cart'] as $isbn =>$qty)
			                {
		    	                if($_POST[$isbn] == '0')
		    	                {
				    	            unset($_SESSION['cart']["$isbn"]);
			    	            } 
					            else 
			    	            {
				                    $_SESSION['cart']["$isbn"] = $_POST["$isbn"];
			                    }
		                    }
	                    }

	    	            // print out header here
	    	            $title = "Your shopping cart";

	    	            if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart'])))
			            {
		    	            $_SESSION['total_price'] = total_price($_SESSION['cart']);
		                    $_SESSION['total_items'] = total_items($_SESSION['cart']);
                        ?>

                        <tr>
                            <td class="checkbox">
                                <input type="checkbox" class="check-one check"/>
                            </td>
                            <td class="goods">
                                <img src="<?=$book['image']?>" alt=""/>
                                <span><a href="##" class="goodsTitle"><?=$book['name']?></a></span><br/>
                                <span><a href="##" class="sellerTitle"><?=$book['author']?></a></span>
                            </td>
                            <td class="price"><?=$book['price']?></td>
                            <td class="count">
                                <span class="reduce"></span>
                                <input type="text" class="count-input" value="1"/>
                                <span class="add">+</span>
                            </td>
                            <td class="subtotal"><?=$book['image']?></td>
                            <td class="opration">
                                <span class="deleteOne">Delete</span>
                            </td>
                        </tr>

                        <?php
	                    } else 
		                {
		                    echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	                    }
	                    if(isset($conn)){ mysqli_close($conn); }
                    ?>
				</tbody>
			</table>
        </form>
		</div>
		<div class="cartFooter" id="cartFooter">
			<div class="selall fl">
				<label for="fl select-all">
					<input type="checkbox" class="check-all check"/>
					<span><a href="javascript:void(0)" class="selallSPAN">&nbsp;全选</a></span>
				</label>
			</div>
			<a href="#" id="multiDelete" class="fl delete">多 选 删 除</a>
			<a href="#" id="allDelete" class="fl delete">清 空 购 物 车</a>
			<div class="fr closing">结 算</div>
			<div class="fr total">合计:￥<span id="priceTotal">0.00</span></div>
			<div class="fr selected" id="selected">
				已选商品
				<span id="selectedTotal">0</span>件
				<span class="arrow up">︽Click Here Aft Sel</span>
				<span class="arrow down">︾</span>
			</div>
			<div class="selected-view">
		        <div id="selectedViewList" class="clearfix">
		            <!-- <div><img src="images/1.jpg"/>
		            	<span class="selCount">1</span>
		            	<span class="del">取消选择</span>
		            </div> -->
		        </div>
		        <span class="arrow">◆<span>◆</span></span>
    		</div>
		</div>
	</div>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>

<style>
	* {margin: 0;padding: 0;}
body{font-family: "微软雅黑";}
a {color: #666;text-decoration: none;}
a:hover {color: red;text-decoration: none;}
.fl{float: left;}
.fr {float: right;}
table {
    border-collapse: collapse;
    border-spacing: 0;
    border: 0;
    text-align: center;
    width: 1000px;
}
th,td {
    border-bottom: 1px solid #e9e4de;
    height: 160px;
}
th {
    height: 50px;
    line-height: 50px;
    font-weight: normal;
}
td {
    padding: 10px 10px;
    color: #444;
    font-weight: bolder;
}
tbody tr:hover {background: #CFECEC;}

.content{
    width:1000px;
    margin: 40px auto;
}

.delete{
    display: block;
    height: 40px;
    line-height: 40px;
    width:150px;
    background-color: #BB9CA6;
    color: #fff;
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
}
.delete:hover{
    background-color: #c81622;
    color: #fff;
}
.deleteOne{
    display: block;
    height: 33px;
    line-height: 33px;
    width:130px;
    color: #b5b5b5;
    border:solid 2px #b5b5b5;
    border-radius: 8px;
    background-color: #F2F9F9;
    cursor: pointer;
}
.deleteOne:hover{
    color: #c81622;
    border:solid 2px #c81622;
}

.on{
    background-color: #eee;
}
.goodsTitle{
    color: #c81622;
}



.check{
    cursor: pointer;
}
.checkbox {
    width: 60px;
}
.goods {
    width: 300px;
    overflow: hidden;
}
.goods span {
    width: 140px;
    margin-top: 16px;
    text-align: left;
    float: left;
}
.price {
    width: 130px;
}
.count {
    width: 90px;
}
.count .add, .count input, .count .reduce {
    float: left;
    margin-right: -1px;
    position: relative;
    z-index: 0;
}
.count .add, .count .reduce {
    height: 23px;
    width: 17px;
    border: 1px solid #C4C1C1;
    background: #C4C1C1;
    text-align: center;
    line-height: 23px;
    color: #444;
    font-size: 21px;
}
.count .add:hover, .count .reduce:hover {
    color: #c81622;
    z-index: 3;
    border-color: #c81622;
    cursor: pointer;
}
.count input {
    width: 50px;
    height: 15px;
    line-height: 15px;
    border: 1px solid #aaa;
    color: #343434;
    text-align: center;
    padding: 4px 0;
    background-color: #fff;
    z-index: 2;
}
.subtotal {
    width: 150px;
    color: red;
    font-weight: bold;
}
.goods img {
    width: 130px;
    /*height: 130px;*/
    /*border: 1px solid #ccc;*/
    margin-right: 5px;
    float: left;
}

.cartFooter {
    width: 1000px;
    margin-top: 10px;
    color: #666;
    height: 48px;
    border: 1px solid #c81622;
    background-color: #eaeaea;
    background-image:linear-gradient(RGB(241,241,241),RGB(226,226,226));
    position: relative;
    z-index: 8;
}
.cartFooter div{
    line-height: 50px;
    height: 50px;
}
.cartFooter a {
    margin-top: 4px;
    margin-right: 20px;
}
.selall{
    width:100px;
    float: left;
    margin-left: 20px;
}
.selallSPAN:hover{
    color: red;
    cursor: pointer;
}
.cartFooter .select-all {
    width: 100px;
    height: 48px;
    line-height: 48px;
    padding-left: 5px;
    color: #666;
}
.cartFooter .closing {
    height: 48px;
    border-left: 1px solid #c81622;
    width: 100px;
    text-align: center;
    color: #000;
    font-weight: bold;
    background: RGB(238,238,238);
    cursor: pointer;
}
.cartFooter .closing:hover{
    color: #fff;
    background-color: #c81622;
}
.cartFooter .total{
    margin: 0 20px;
    cursor: pointer;
}
.cartFooter  #priceTotal, .cartFooter #selectedTotal {
    color: red;
    font-family: "Microsoft Yahei";
    font-weight: bold;
}
.cartFooter .selected {
    cursor: pointer;
}
.cartFooter .selected .arrow {
    position: relative;
    top:-3px;
    margin-left: 3px;
}
.cartFooter .selected .down {
    position: relative;
    top:3px;
    display: none;
}
 .show .selected .down {
    display: inline;
}
 .show .selected .up {
    display: none;
}
.cartFooter .selected:hover .arrow {
    color: red;
}
.cartFooter .selected-view {
    width: 1000px;
    border: 1px solid #c81622;
    position: absolute;
    height: auto;
    background: #B8D7D7;
    z-index: 9;
    bottom: 48px;
    left: -1px;
    display:none;
}
.show .selected-view {
    display: block;
}
.cartFooter .selected-view div{
    height: auto;
}
.cartFooter .selected-view img{
    width: 130px;
}
.cartFooter .selected-view .arrow {
    font-size: 30px;
    line-height: 100%;
    color:#c81622;
    position: absolute;
    right: 282px;
    bottom: -15px;
}
.cartFooter .selected-view .arrow span {
    color: #B8D7D7;
    position: absolute;
    left: 0px;
    bottom: 2px;
}
#selectedViewList {
    padding: 20px;
    margin-bottom: -20px;
}
#selectedViewList div{
    display: inline-block;
    position: relative;
    width: 130px;
    /*height: 130px;*/
    border: 1px solid #ccc;
    margin: 10px 13px;
}
#selectedViewList .del {
    display: none;
    color: #ffffff;
    font-size: 14px;
    position: absolute;
    bottom: 19px;
    right: 30px;
    width: 70px;
    height: 22px;
    line-height: 22px;
    text-align: center;
    background: #c81622;
    cursor: pointer;
}
#selectedViewList .selCount{
    display: block;
    color: #ffffff;
    font-size: 20px;
    position: absolute;
    top: -10px;
    right: -10px;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    background: #c81622;
    border-radius: 16px;
}
#selectedViewList div:hover span {
    display: block;
}


/*收货地址CSS*/
.cartTop{
    clear: both;
    height: 45px;
}
.countBalance{
    width:500px;
    float: left;
    margin-top: 15px;
}
.addressDIV {
  width: 150px;
  height: 40px;
  line-height: 40px;
  color: #fff;
  font-size: 17px;
  margin: 10px 28px 0 0;
  text-align: center;
  position: relative;
  float: right;
  cursor: pointer;
}

.addressDIV span {
  display: inline-block;
  width: 150px;
  height: 100%;
  transform: skew(20deg);
  -webkit-transform: skew(20deg);
  background: #FF6347;
  position: absolute;
  right: -9px;
  top: 0;
}
.addressDIV span::before,
.addressDIV span::after {
  content: "";
  width: 4px;
  height: 100%;
  background: #FF6347;
  position: absolute;
  top: 0;
  right: -8px;
}
.addressDIV span::after {
  right: -16px
}
.addressDIV span:hover {
   transform: skew(0deg);
  -webkit-transform: skew(0deg);
}
.devideDIV{
    height: 50px;
    line-height: 50px;
    border:solid 2px #555;
}
.devideDIV span{
    display: block;
    width: 100%;
    text-align: center;
    font-size: 20px;
}
.devideDIV img{
    width: 30px;
    height: 30px;
}
.cartIconDIV{
    margin-top: 10px;
}
</style>