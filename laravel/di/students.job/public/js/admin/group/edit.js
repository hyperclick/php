// записываем в переменную данные, пришедшие из PHP
let data = startData = JSON.parse(document.querySelector('#data').value);
// ссылка на элемент с таблицей
let table = document.querySelector('#userTable');
// информация о сортировке в таблице
let sort = {
    key: null, // текущий ключ, по которому сделана сортировка
    desc: false, // по возрастанию или убыванию
}

// слушатель события загрузки страницы
window.addEventListener('load', fillTable);

// заполняе таблицу данными
function fillTable() {
    for (let i = 0; i < data.length; i++) {
        table.querySelector('tbody').append(createDocElement({
            type: 'tr',
            content: [
                createDocElement({type: 'td', content: [
                        createDocElement({type: 'img', class: 'sj-photo', attributes: {src: '/photos/' + data[i].photo}})
                    ]}),
                createDocElement({type: 'td', content: data[i].name}),
                createDocElement({type: 'td', content: data[i].status}),
                createDocElement({type: 'td', content: data[i].age}),
                createDocElement({type: 'td', content: data[i].places}),
            ],
        }));
    }
}

// обновить таблицу
function updateTable() {
    table.querySelector('tbody').innerHTML = '';
    fillTable();
}

// создать DOM элемент
function createDocElement(options) {
    let element = document.createElement(options.type || 'div');

    if (options.content instanceof Object) {
        if (options.content instanceof Array) {
            options.content.forEach(cont => element.append(cont));
        } else
            element.append(options.content);
    } else
        element.innerHTML = options.content || '';
    if (options.class)
        element.className = options.class;
    if (options.attributes) {
        for (let key in options.attributes) {
            element.setAttribute(key, options.attributes[key]);
        }
    }
    if (options.events) {
        for (let key in options.events) {
            element.addEventListener(key, options.events[key]);
        }
    }

    return element;
}

// сортировка массива
function getSortedArray(pArray, pKey, pDesc = false) {
    for (let i = 0, tmpLeast; i < pArray.length - 1; i++) {
        tmpLeast = i;
        for (let j = i + 1; j < pArray.length; j++) {
            tmpLeast = (pDesc) ? ((pArray[j][pKey] > pArray[tmpLeast][pKey]) ? j : tmpLeast) : ((pArray[j][pKey] < pArray[tmpLeast][pKey]) ? j : tmpLeast);
        }
        let tmpVar = pArray[i];
        pArray[i] = pArray[tmpLeast];
        pArray[tmpLeast] = tmpVar;
    }
    return pArray;
}

// сортировка
function sortData(key) {
    getSortedArray(data, key, (key === sort.key) ? (sort.desc = !sort.desc) : false);
    sort.key = key;

    updateTable();
}

// фильтрация данных
function filterData(key, value) {
    if (value === '-') {
        data = startData;
    } else {
        data = [];

        for (let i = 0; i < startData.length; i++) {
            if (startData[i][key] === value) {
                data.push(startData[i]);
            }
        }
    }

    updateTable();
}
