'use strict';

class Cart {
    constructor() {
        this._buyButtons = document.querySelectorAll('.catalog__item-button');
        this._cart = {};
        this._currentCartItems = 0;
        this._cookieCart = 'cart';
        this._cookieCountName = 'count';
    }
    init() {
        this._buyButtons.forEach(button => {
            button.addEventListener('click', event => {
                this._eventHandler(event);
            });
        });
        //todo refactor get cookie with 1 request
        if (this._getCookie(this._cookieCountName)) {
            this._cart = JSON.parse(this._getCookie(this._cookieCart));
            this._currentCartItems = Number(this._getCookie(this._cookieCountName));
            this._cartCountRender();
        }
    }
    _eventHandler(event) {
        this._addToCart(this._getProductId(event.path));
        this._setCookie(this._cookieCart, this._cart);
        this._setCookie(this._cookieCountName, this._currentCartItems);
        this._cartCountRender();
    }
    _cartCountRender() {
        const navButtons = document.querySelector('.nav-ul');
        const targetElement = navButtons.children[navButtons.children.length - 1].firstElementChild;
        targetElement.innerText = targetElement.innerText.replace(new RegExp(/\d/), this._currentCartItems);
    }
    _setCookie(name, value, options = {}) {
        options = {
            path: '/',
            ...options
        };

        if (options.expires instanceof Date) {
            options.expires = options.expires.toUTCString();
        }

        value = JSON.stringify(value);

        let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

        for (let optionKey in options) {
            updatedCookie += "; " + optionKey;
            let optionValue = options[optionKey];
            if (optionValue !== true) {
                updatedCookie += "=" + optionValue;
            }
        }

        document.cookie = updatedCookie;
    }
    _getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([.$?*|{}()\[\]\\\/+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    _deleteCookie(name) {
        this._setCookie(name, "", {
            'max-age': -1
        });
    }
    _deleteFromCart(id) {
        this._currentCartItems--;
    }
    _addToCart(id) {
        this._currentCartItems++;
        if (Object.keys(this._cart).length === 0) return this._cart[`${id}`] = 1;
        return this._cart[`${id}`] ? this._cart[`${id}`] += 1 : this._cart[`${id}`] = 1;
    }
    getCart(){
        return this._cart;
    }
    _getProductId(path) {
        for (let node of path) {
            if (node.id) return node.id;
        }
    }
}

let cart = new Cart();
cart.init();

//notice goods should add in to cart with backend only because need to synchronization with db