'use strict';
const actionButtons = document.querySelector('.feedback-wrapper');
const feedbackNode = document.querySelector('.feedback-side');
const fieldList = ["name", "feedback", "id", "good_id"];
const feedbackID = getFeedbackID();

actionButtons.addEventListener('click', (e) => handleButtonsCRUD(e));

async function handleButtonsCRUD(e) {
    const buttonNode = e.path[0];
    if (!buttonNode.id) return;
    const action = buttonNode.id;

    switch (action) {
        case 'create':
            if (!validateValueData(buttonNode)) return;
            create(buttonNode, action);
            break;

        case 'read':
            read(buttonNode, action);
            break;

        case 'update':
            if (!validateValueData(buttonNode)) return;
            update(buttonNode, action);
            break;

        case  'delete':
            remove(buttonNode, action);
            break;
    }
}

//CRUD BLOCK
function create(buttonNode, action){
    const data = readValueData(buttonNode, fieldList);

    fetchData(data, action)
        .then(response => response.json())
        .then(json => {
            clearInputValues(getInputValues(buttonNode));
            renderNewFeedback(json);
            toggleSideVisibility();
        })
        .catch(e => console.log(e));
}

function read(buttonNode, action) {
    getOneFeedback(Number(getParent(buttonNode).id), action)
        .catch(e => console.error(e));
}

function update(node, action) {
    const data = readValueData(node, fieldList);
    fetchData(data, action)
        .then(response => response.json())
        .then(json => {
            if (json.updated) {
                removeFeedbackById(data.id);
                renderNewFeedback(data);
                clearInputValues(getInputValues(node));
            }
        })
        .catch(e => console.log(e));
}

function remove(buttonNode, action) {
    fetchData(Number(getParent(buttonNode).id), action)
        .then(res => res.json())
        .then(json => {
            if (json.deleted) {
                getParent(buttonNode).remove();
                toggleSideVisibility();
            }
        });
}

//OTHER FUNCTIONS
function validateValueData(node){
    for (const [, value] of Object.entries(readValueData(node, fieldList))) {
        if (typeof(value) == "undefined" && value == null) return false;
    }
    return true;
}

function readValueData(buttonNode, fieldList) {
    const data = {};
    let inputValues = getInputValues(buttonNode);
    const fieldValues = [...inputValues].map((item) => item.value);

    for (let i = 0; i < fieldValues.length - 1; i++) {
        data[fieldList[i]] = `${fieldValues[i]}`;
    }
    data['good_ID'] = feedbackID;
    return data;
}

function removeFeedbackById(id){
    [...feedbackNode.children].forEach(node => {
        if (node.id === id) node.remove();
    });
}

async function getOneFeedback(id, action) {
    return await fetchData(id, action)
        .then(response => response.json())
        .then(json => {
            renderFeedbackToUpdate(json)
        });
}

async function fetchData(data, action) {
    return await fetch(`/feedbackapi/${action}/`, {
        method: 'POST',
        headers: new Headers({
            'Content-Type': 'application/json'
        }),
        body: JSON.stringify(data)
    });
}

function renderFeedbackToUpdate(feedback){
    let html = `
        <div class="feedback">
            <input required class="feedback__input" type="text" placeholder="Введите имя" value="${feedback.name}">
            <textarea required class="feedback__input feedback__input_textarea" placeholder="Ваш отзыв">${feedback.feedback}</textarea>
            <input id="id" hidden value="${feedback.id}">
            <button class="feedback__button" type="button" id="update">Править</button>
        </div>
    `;
    actionButtons.firstElementChild.remove();
    actionButtons.insertAdjacentHTML('afterbegin', html);
}

function renderNewFeedback(feedback){
    const html = `
        <div class="feedback-side__item" id='${feedback.id}'>
            <p class="feedback-side__p">${feedback.name}</p>
            <p class="feedback-side__p">${feedback.feedback}</p>
            <div class="feedback-button_wrapper">
                <button class="feedback-side__button feedback__button" id="read">&#9998;</button>
                <button class="feedback-side__button feedback__button" id="delete">&#10008;</button>
            </div>
        </div>
    `;
    feedbackNode.insertAdjacentHTML('beforeend', html);
}

function clearInputValues(inputValues) {
    return [...inputValues].map(i => i.value = '');
}

function getInputValues(node) {
    return node.parentNode.children;
}

function getParent(node) {
    return node.parentNode.parentNode;
}

function toggleSideVisibility() {
    const feedbackNode = document.querySelector('.feedback-side');
    if (feedbackNode.classList.contains('feedback-side_display') || feedbackNode.children.length) {
        feedbackNode.classList.remove('feedback-side_display');
    } else {
        feedbackNode.classList.add('feedback-side_display');
    }
}

function isPersonalFeedback(href) {
    return href.includes('good');
}

function getFeedbackID() {
    const href = document.location.href.split('/');
    if (isPersonalFeedback(href)) {
        const idStr = href.find(i => {
            return i.match(/\d/);
        });
        return Number(idStr[idStr.length - 1]);
    }
    return 0;
}