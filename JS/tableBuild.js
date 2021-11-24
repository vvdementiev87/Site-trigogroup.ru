let xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        tableRender(myFunction(JSON.parse(this.response)));
        modalWindow(myFunction(JSON.parse(this.response)));
    }
}

function modalWindow(data) {
    let button3 = document.querySelectorAll('.btn-3');
    let nav3 = document.querySelector('.nav-3');
    let button4 = document.querySelectorAll('.btn-4');
    for (let element of button4) {
        element.addEventListener('click', function() {
            nav3.classList.toggle('open');
            nav3.classList.toggle('close');
        })
    }
    for (let element of button3) {
        element.addEventListener('click', function(event) {
            let inputId = document.getElementById('nameInputId');
            inputId.value = event.target.parentElement.dataset.id
            let inputMissionNumber = document.getElementById('nameInputMissionNumber');
            let inputMissionCustomer = document.getElementById('nameInputMissionCustomer');
            inputMissionNumber.value = data[event.target.parentElement.dataset.id].mission_number;
            inputMissionCustomer.value = data[event.target.parentElement.dataset.id].mission_customer;
            nav3.classList.toggle('open');
            nav3.classList.toggle('close');
        })
    }
}

xhttp.open('POST', 'https://trigogroup.ru/include/dbLink.php', true);
xhttp.send();

function myFunction(data) {
    let objElm = [];
    for (let key of data) {
        objElm.push(key);
    };
    return objElm
}

function tableRender(objElm) {
    let keyArr = [];
    for (let key in objElm[0]) {
        keyArr.push(key);
    }
    let inputData = [{
        name: 'mission_id',
        text: 'ID'
    }, {
        name: 'mission_cost_center',
        text: 'Центр затрат'
    }, {
        name: 'mission_number',
        text: 'Номер заказа'
    }, {
        name: 'mission_start_date',
        text: 'Дата начала'
    }, {
        name: 'mission_stop_date',
        text: 'Дата окончания'
    }, {
        name: 'mission_customer',
        text: 'Наименовани заказчика'
    }, {
        name: 'mission_resp_engineer',
        text: 'Ответственный TRIGO'
    }, {
        name: 'mission_tqf',
        text: 'Ответственный RENAULT'
    }, {
        name: 'mission_activity',
        text: 'Тип активности'
    }, {
        name: 'mission_comment',
        text: 'Комментарии'
    }, {
        name: 'mission_status',
        text: 'Статус'
    }, {
        name: 'mission_monitoring',
        text: 'Мониторинг'
    }, {
        name: 'mission_audit_frequency',
        text: 'Частота аудитов'
    }, {
        name: 'mission_defect',
        text: 'Дефект'
    }, {
        name: 'partnumber',
        text: 'Референс'
    }, {
        name: 'partname',
        text: 'Наименование детали'
    }];

    let tbody = document.createElement("tbody");
    let row_head$ = document.createElement("thead");
    row_head$.insertAdjacentElement('beforeend', document.createElement("tr"));
    for (let colIndex = 0; colIndex < inputData.length; colIndex++) {
        let col$ = document.createElement("th");
        let cellValue = inputData[colIndex].text;

        if (cellValue == null) cellValue = "";
        col$.textContent = cellValue;
        row_head$.insertAdjacentElement('beforeend', col$);
    }

    for (let i = objElm.length - 1; i >= 0; i--) {
        let row$ = document.createElement("tr");
        let elm = objElm[i];
        row$.dataset.id = elm.mission_id;

        for (let colIndex = 0; colIndex < inputData.length; colIndex++) {
            let col$ = document.createElement("td");
            let indexEl = inputData[colIndex].name;
            if (inputData[colIndex].name === 'mission_number') {
                col$.classList.add('btn-3');
            };
            let cellValue = elm[indexEl];
            if (cellValue == null) cellValue = "";
            col$.textContent = cellValue;
            row$.insertAdjacentElement('beforeend', col$);

        }
        tbody.insertAdjacentElement('beforeend', row$);
    }
    let tableEl = document.getElementById('excelDataTable');
    tableEl.insertAdjacentElement('beforeend', row_head$);
    tableEl.insertAdjacentElement('beforeend', tbody);
}