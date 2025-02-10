let cart = {}

const loadCart = () => {
    if(localStorage.getItem('cart')) {
        cart = JSON.parse(localStorage.getItem('cart'))
        showMiniCart()
    }
}
const saveCart = () => {
    localStorage.setItem('cart', JSON.stringify(cart))
}
const showMiniCart = () => {
    let html = ''
    for(let key in cart) {
        html += `${key}---${cart[key]}\n`
    }
    $('#mini-cart').html(html)
}
const addToCart = (e) => {
    const { id } = e.target.dataset
    if(!cart[id]) {
        cart[id] = 1
    } else {
        cart[id]++
    }
    showMiniCart()
    saveCart()
}

const goodsOut = (data) => {
    $.each(data, function (id, e) { 
        const html = `
            <div class='cart'>
                <p class='name'>${e.name}</p>
                <img src='src/${e.img}'>
                <div class='price'>${e.price}$</div>
                <button class='add-to-cart' data-id='${id}'>купить</button>
            </div>
        `
        $('#goods-out').append(html)
    })
    $('.add-to-cart').on('click', (e) => addToCart(e))
}
const init = () => {
    $.getJSON('./goods.json', (data) => goodsOut(data))
}

$(document).ready(() => {
    init()
    loadCart()
})