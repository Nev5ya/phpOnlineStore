'use strict';

class Cart {
    constructor() {
        this._cartActionButtons = document.querySelectorAll('.catalog__item-button');
        this._cartCheckoutButton = document.querySelector('.checkout__button');
        this._fieldList = ["name", "number", "email"];
    }

    init() {
        this._cartActionButtons.forEach(button => {
            button.addEventListener('click', event => {
                this._eventHandler(event);
            });
        });

        if (typeof(this._cartCheckoutButton) != "undefined" && this._cartCheckoutButton !== null) {
            this._cartCheckoutButton.addEventListener('click', event => {
                this._eventHandler(event);
            });
        }
    }

    _eventHandler(event) {
        switch (event.target.dataset.id) {
            case 'buy':

                this._addToCart(this._getProductId(event.path))
                    .then(json => {
                        this._cartCountRender(json);
                        this._cartEachCountRender(json, event);
                        this._cartTotalAmountRender(json);
                    })
                    .catch(e => console.error(e));

                break;

            case 'delete':

                this._deleteFromCart(this._getProductId(event.path))
                    .then(json => {
                        this._cartCountRender(json);
                        this._cartEachCountRender(json, event);
                        this._cartTotalAmountRender(json);
                    })
                    .catch(e => console.error(e));

                break;

            case 'checkout':
                this._makeAnOrder(this._readValueData(this._cartCheckoutButton, this._fieldList))
                    .catch(e => console.log(e));
                break;
        }
    }

    async _makeAnOrder(data) {
        return await (await fetch(`/cartapi/checkout/`, {
            method: 'POST',
            headers: new Headers({
                'Content-Type': 'application/json'
            }),
            body: JSON.stringify(data)
        })).json();
    }

    _readValueData(buttonNode, fieldList) {
        const data = {};
        let inputValues = this._getInputValues(buttonNode);
        const fieldValues = [...inputValues].map((item) => item.value);

        for (let i = 0; i < fieldValues.length - 1; i++) {
            data[fieldList[i]] = `${fieldValues[i]}`;
        }
        return data;
    }

    _getInputValues(node) {
        return node.parentNode.children;
    }

    async _deleteFromCart(id) {
        return  await (await fetch('/cartapi/delete/?id=' + id)).json();
    }

    async _addToCart(id) {
        return  await (await fetch('/cartapi/add/?id=' + id)).json();
    }

    _cartTotalAmountRender(json) {
        const target = document.querySelector('.total');
        const numberFormat = new Intl.NumberFormat();

        if (json.total === 0) {
            const cartElem = document.querySelector('.cart');
            this._getParentElement(target).remove();
            cartElem.innerHTML = 'В корзине ничего нет <br><br> ¯\\_(ツ)_/¯';
            return json;
        }

        if (target) {
            target.innerText = numberFormat.format(json.total) + " ";
        }
        return json;
    }

    _cartEachCountRender(json, event) {
        if (!event.target.parentElement.classList.contains('cart-buttons_wrapper')) return json;
        const target = event.target.parentElement.children[1];

        if (json.hasOwnProperty('added')) {
            target.innerText++;
        } else {
            target.innerText--;
        }

        if (target.innerText === '0') {
            //remove paragraph with info about good in checkout div
            const itemParentId = this._getParentElement(target).id;
            document.getElementById('checkoutID:' + itemParentId).remove();
            //remove good from cart
            this._getParentElement(event.target).remove();
            return json;
        }
    }

    _cartCountRender(json) {
        const navButtons = document.querySelector('.nav-ul');
        const targetElement = navButtons.children[navButtons.children.length - 2].firstElementChild;
        targetElement.innerText = targetElement.innerText.replace(new RegExp(/\d/), json.count);
        return json;
    }

    _getParentElement(element) {
        if (!element.id) return this._getParentElement(element.parentElement);
        return element;
    }

    _getProductId(path) {
        for (let node of path) {
            if (node.id) return node.id;
        }
    }
}

new Cart().init();