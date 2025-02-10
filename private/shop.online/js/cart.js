let cart = {}

const saveCart = () => {
    localStorage.setItem('cart', JSON.stringify(cart))
}
const delGoods = (e) => {
    const id = e.target.dataset.id
    delete cart[id]
    saveCart()
    loadCart()
}
const showCart = () => {
    $.getJSON('goods.json', function (data) {
        let goods = data
        let html = ''
        for(let id in cart) {
            html += `<button data-id=${id} class='del-goods'>x</button> `
            html += `<img src='src/${goods[id].img}'> `
            html += `<em>${goods[id].name}</em> `
            html += `<sub>${cart[id]} штук</sub> `
            html += `<b><i>описание: ${goods[id].description}</i></b><br>`
        }
        $('.main-cart').html(html)
        $('.del-goods').on('click', (e) => delGoods(e))
    })
}
const isEmpty = (obj) => {
    if(Object.keys(obj).length === 0) {
        return true
    } else {
        return false
    }
}
const loadCart = () => {
    if(localStorage.getItem('cart')) {
        cart = JSON.parse(localStorage.getItem('cart'))
        if(isEmpty(cart)) {
            $('.main-cart').html('корзина пуста')
        } else {
            showCart()
        }
    } else {
        $('.main-cart').html('корзина пуста')
    }
}

$(document).ready(() => {
    loadCart()
})