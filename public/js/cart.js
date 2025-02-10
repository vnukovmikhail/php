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
const plusGoods = (e) => {
    const id = e.target.dataset.id
    cart[id]++
    saveCart()
    loadCart()
}
const minusGoods = (e) => {
    const id = e.target.dataset.id
    cart[id]--
    if(!cart[id]) {
        delete cart[id]
    }
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
            html += `<ins><b>описание:</b><i>${goods[id].description}</i></ins> `
            html += `<button data-id=${id} class='minus-goods'>-</button>`
            html += ` <b>${cart[id]}</b> `
            html += `<button data-id=${id} class='plus-goods'>+</button><br>`
        }
        $('.main-cart').html(html)
        $('.del-goods').on('click', (e) => delGoods(e))
        $('.minus-goods').on('click', (e) => minusGoods(e))
        $('.plus-goods').on('click', (e) => plusGoods(e))
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