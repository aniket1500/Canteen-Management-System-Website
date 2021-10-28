//selectors
// var addButton = document.getElementById("add-btn-id");
// var quantity = document.getElementById("quantity-id");


var itemNameList = ["item 1", "item 2", "item 3", "item 4", "item 5", "item 6"];
var itemPriceList = [45, 40, 35, 30, 25, 56];

//to create category div and other divs and ul
var itemList = document.getElementById("item-list-id");

var itemName = document.createElement('li');
itemName.classList.add('item-name');
itemList.appendChild(itemName);

var itemPrice = document.createElement('li');
itemPrice.classList.add('item-name');
itemList.appendChild(itemPrice);

itemListCreator(itemNameList[0],itemPriceList[0]);
itemListCreator(itemNameList[1],itemPriceList[1]);

// function appendQuantity(){
//     quantity++;
//     document.getElementById("quantity-id").innerHTML = quantity; 
//     document.getElementById("minus-btn-img-id").style.display = "block";
//     document.getElementById("quantity-id").style.display = "block";
    
// }
function itemListCreator(title, price){//to create the whole item bar
    itemName.innerHTML = title;
    itemPrice.innerHTML = price;

}
// function removeItem(){
//     if(quantity == 0){
        
//     }
//     else{
//         quantity--;
//     }
//     document.getElementById("quantity-id").innerHTML = quantity; 
// }