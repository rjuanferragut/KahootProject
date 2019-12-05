window.addEventListener("load", main);

function main(){
    createForm();
    createInputsForm();
    createSelectTimeForm();
    createSelectPointsForm();
    createButtonsForm();
}

function createElementDOM(tagElement, text, parentNode, attributes) {
    var element = document.createElement(tagElement);
    if (text.length > 0){
        var textElement = document.createTextNode(text);
        element.appendChild(textElement);
    }
    if (attributes.length > 0) {
        for(var i = 0;i < attributes.length; i++){
            var att = attributes[i].split("=")[0];
            var value = attributes[i].split("=")[1];

            element.setAttribute(att,value);
        }
    }
    parentNode.appendChild(element);
}

function createForm(){
    createElementDOM('div', '', document.body, ["id=dinamicForm"]);
    var div = document.getElementById('dinamicForm');
    createElementDOM('form', "", div, ["method=post", "action=../saveQuestion.php", "id=formJs"]);
}

function createInputsForm(){
    var form= document.getElementById('formJs');
    createElementDOM('input', "", form, ["type=text", "name=text_question", "placeholder=Enter your question"]);
    createElementDOM('label', ' TRUE ', form, ["id=labelTrue"]);
    var labelTrue= document.getElementById('labelTrue');
    createElementDOM('input', '', labelTrue, ["type=radio", "name=correct?", "value=true"]);
    createElementDOM('label', ' FALSE ', form, ["id=labelFalse"]);
    var labelTrue= document.getElementById('labelFalse');
    createElementDOM('input', '', labelTrue, ["type=radio", "name=correct?", "value=false"]);
}

function createSelectTimeForm(){
    var form= document.getElementById('formJs');
    createElementDOM('select', '', form, ["name=time", "id=time"]);
    var select= document.getElementById('time');
    createElementDOM('option', '10s', select, ["value=10"]);
    createElementDOM('option', '20s', select, ["value=20"]);
    createElementDOM('option', '30s', select, ["value=30"]);
    createElementDOM('option', '40s', select, ["value=40"]);
    createElementDOM('option', '50s', select, ["value=50"]);
    createElementDOM('option', '60s', select, ["value=60"]);
}

function createSelectPointsForm(){
    var form= document.getElementById('formJs');
    createElementDOM('select', '', form, ["name=points", "id=points"]);
    var select= document.getElementById('points');
    createElementDOM('option', '10 points', select, ["value=10"]);
    createElementDOM('option', '50 points', select, ["value=50"]);
    createElementDOM('option', '100 points', select, ["value=100"]);
    createElementDOM('option', '150 points', select, ["value=150"]);
    createElementDOM('option', '300 points', select, ["value=300"]);
    createElementDOM('option', '500 points', select, ["value=500"]);
    createElementDOM('option', '1000 points', select, ["value=1000"]);

}

function createButtonsForm(){
    var form= document.getElementById('formJs');
    createElementDOM('input', '', form, ["type=submit", "name=AddQuestion", "value=AddQuestion"]);
    createElementDOM('input', '', form, ["type=submit", "name=Done", "value=Done"]);
}

