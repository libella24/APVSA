function newCategory(){
    // holt die divs "zutatenliste" und "zutatenblock" aus dem HTML
    var block = document.querySelector(".category_list .category_block"); // clont die div.class= category_list > category_block

    var neuer_block = block.cloneNode(true);
    document.querySelector(".category_list").appendChild(neuer_block);

    neuer_block.querySelector("select").value = "";
}