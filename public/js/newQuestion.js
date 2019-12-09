window.addEventListener("load", main);

function main(){
    createForm();
    createInputsForm();
    createSelectTimeForm();
    createSelectPointsForm();
    createButtonsForm();
    styleElements()
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
    createElementDOM('div', '', document.body, ["class=content"]);
    var div = document.getElementsByClassName('content')[0];
    createElementDOM('a', "NEW QUESTION:", div, ["id=a"]);
    createElementDOM('form', "", div, ["method=post", "action=../saveQuestion.php", "id=formJs"]);
}

function createInputsForm(){
    var form= document.getElementById('formJs');
    createElementDOM('input', "", form, ["id=inputQuestion","type=text", "name=text_question", "placeholder=Enter your question"]);
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
    createElementDOM('input', '', form, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion"]);
    createElementDOM('input', '', form, ["id=doneQuestions","type=submit", "name=Done", "value=Done"]);
}

function styleElements(){
    styleDivElement();
    styleSelectTimeElement();
    styleSelectPointsElement();
    styleInputQuestionElement();
    styleButtonAddElement();
    styleButtonDoneElement();
    styleLabelTrueElement();
    styleLabelFalseElement();
    styleATextElement()
}

function styleDivElement(){
    var div = document.getElementsByClassName('content')[0];
    div.style.position = "absolute";
    div.style.width = "99%";
    div.style.heigth = "86%";
    div.style.display = "row";
}

function styleSelectTimeElement(){
    var select= document.getElementById('time');
    select.style.position = "absolute";
    select.style.bottom = "50%";
    select.style.left = "45%";
    select.style.fontSize = "20px";
    select.style.backgroundColor = "lightblue";
    select.style.textAlign = "center";
    select.style.width = "8%";
    select.style.height = "5%";
    select.style.borderRadius = "20px"; 
}

function styleSelectPointsElement(){
    var select= document.getElementById('points');
    select.style.position = "absolute";
    select.style.bottom = "50%";
    select.style.left = "15%";
    select.style.fontSize = "20px";
    select.style.backgroundColor = "lightblue";
    select.style.textAlign = "center";
    select.style.width = "8%";
    select.style.height = "5%";
    select.style.borderRadius = "20px";
}

function styleInputQuestionElement(){
    var input = document.getElementById('inputQuestion');
    input.style.position = "absolute";
    input.style.bottom = "77%";
    input.style.left = "15%";
    input.style.alignContent = "center";
    input.style.fontSize = "30px";
    input.style.backgroundColor = "lightblue";
    input.style.display = "flex";
    input.style.flexDirection = "row";
    input.style.width = "60%";
    input.style.height = "7%";
    input.style.borderRadius = "20px";
}

function styleButtonAddElement(){
    var button = document.getElementById('addQuestion');
    button.style.position = "absolute";
    button.style.bottom = "10%";
    button.style.left = "59%";
    button.style.fontSize = "15px";
    button.style.backgroundColor = "lightblue";
    button.style.textAlign = "center";
    button.style.width = "8%";
    button.style.height = "5%";
    button.style.borderRadius = "20px";
}

function styleButtonDoneElement(){
    var button = document.getElementById('doneQuestions');
    button.style.position = "absolute";
    button.style.bottom = "10%";
    button.style.left = "69%";
    button.style.fontSize = "15px";
    button.style.backgroundColor = "lightblue";
    button.style.textAlign = "center";
    button.style.width = "8%";
    button.style.height = "5%";
    button.style.borderRadius = "20px";
}

function styleLabelTrueElement(){
    var labelTrue= document.getElementById('labelTrue');

    labelTrue.style.position = "absolute";
    labelTrue.style.bottom = "64%";
    labelTrue.style.left = "15%";
    labelTrue.style.fontSize = "20px";
    labelTrue.style.backgroundColor = "lightgreen";
    labelTrue.style.textAlign = "center";
    labelTrue.style.width = "8%";
    labelTrue.style.height = "5%";
    labelTrue.style.borderRadius = "20px";
}

function styleLabelFalseElement(){
    var labelTrue= document.getElementById('labelFalse');

    labelTrue.style.position = "absolute";
    labelTrue.style.bottom = "64%";
    labelTrue.style.left = "45%";
    labelTrue.style.fontSize = "20px";
    labelTrue.style.backgroundColor = "red";
    labelTrue.style.textAlign = "center";
    labelTrue.style.width = "8%";
    labelTrue.style.height = "5%";
    labelTrue.style.borderRadius = "20px";
}

function styleATextElement(){
    var text = document.getElementById('a');
    text.style.position = "absolute";
    text.style. bottom = "89%";
    text.style.left = "0%";
    text.style.alignContent = "center";
    text.style.fontSize = "30px";
    text.style.textAlign = "center";
    text.style.width = "40%";
    text.style.height = "7%";
}
