function tableInput() {
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'https://trigogroup.ru/include/dbLink.php', true);
    xhttp.send();
    let responseTable = [];
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
        }
    };
    xhttp.onloadend = function() {
        responseTable = this.response;
        if (responseTable.length == 0) {
            tableInput();
        } else {
            tableRender(myFunction(JSON.parse(this.response)));
            modalWindow(myFunction(JSON.parse(this.response)));
        }
    };

    return responseTable;
}

tableInput();

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
            let idNumber = event.target.parentElement.dataset.id;
            let inputId = document.getElementById('nameInputId');
            inputId.value = data[idNumber].mission_id;
            let inputMissionNumber = document.getElementById('nameInputMissionNumber');
            inputMissionNumber.value = data[idNumber].mission_number;
            let inputMissionCustomer = document.getElementById('nameInputMissionCustomer');
            inputMissionCustomer.value = data[idNumber].mission_customer;
            let inputMissionCostCenter = document.getElementById('nameMissionCostCenter');
            inputMissionCostCenter.value = data[idNumber].mission_cost_center;
            let inputMissionStartDate = document.getElementById('nameMissionStartDate');
            inputMissionStartDate.value = data[idNumber].mission_start_date;
            let inputMissionStopDate = document.getElementById('nameMissionStopDate');
            inputMissionStopDate.value = data[idNumber].mission_stop_date;
            let inputMissionRespEngineer = document.getElementById('nameMissionRespEngineer');
            inputMissionRespEngineer.value = data[idNumber].mission_resp_engineer;
            let inputMissionTqf = document.getElementById('nameMissionTqf');
            inputMissionTqf.value = data[idNumber].mission_tqf;
            let inputMissionActivity = document.getElementById('nameMissionActivity');
            inputMissionActivity.value = data[idNumber].mission_activity;
            let inputMissionComment = document.getElementById('nameMissionComment');
            inputMissionComment.value = data[idNumber].mission_comment;
            let inputMissionStatus = document.getElementById('nameMissionStatus');
            inputMissionStatus.value = data[idNumber].mission_status;
            let inputMissionMonitoring = document.getElementById('nameMissionMonitoring');
            inputMissionMonitoring.value = data[idNumber].mission_monitoring;
            let inputMissionAuditFrequency = document.getElementById('nameMissionAuditFrequency');
            inputMissionAuditFrequency.value = data[idNumber].mission_audit_frequency;
            let inputMissionDefect = document.getElementById('nameMissionDefect');
            inputMissionDefect.value = data[idNumber].mission_defect;
            let inputPartNumber = document.getElementById('namePartNumber');
            inputPartNumber.value = data[idNumber].partnumber;
            let inputPartName = document.getElementById('namePartName');
            inputPartName.value = data[idNumber].partname;
            nav3.classList.toggle('open');
            nav3.classList.toggle('close');
        })
    }
}



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
        name: 'mission_number',
        text: 'Номер заказа'
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
        name: 'partnumber',
        text: 'Референс'
    }, {
        name: 'partname',
        text: 'Наименование детали'
    }, {
        name: 'mission_defect',
        text: 'Дефект'
    }, {
        name: 'mission_status',
        text: 'Статус'
    }, {
        name: 'mission_comment',
        text: 'Комментарии'
    }, {
        name: 'mission_cost_center',
        text: 'Центр затрат'
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
        let rowId = elm.mission_id - 1;
        row$.dataset.id = rowId;

        for (let colIndex = 0; colIndex < inputData.length; colIndex++) {
            let col$ = document.createElement("td");
            let indexEl = inputData[colIndex].name;
            if (inputData[colIndex].name === 'mission_number') {
                col$.classList.add('btn-3', 'btn__main');
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