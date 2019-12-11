function main(){
    var selectTypeQuestion = document.getElementById('typeQuestion').value;
    if(selectTypeQuestion == "true/false"){
        createTrueFalseForm();
    }else if(selectTypeQuestion == "multipleChoice"){
        createMultipleChoiceForm();
    }
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

function createTrueFalseForm(){
    createForm();
}

function createMultipleChoiceForm(){
    createForm();
    createInputNameQuestion();
}


function createForm(){
    var div = document.getElementById('Questions');
    // createElementDOM('a', "NEW QUESTION:", div, ["id=a"]);
    createElementDOM('form', "", div, ["method=post", "action=../saveQuestion.php", "id=formJs"]);
}

function createInputNameQuestion(){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['class=form-group', 'id=divTextName']);
    var div = document.getElementById('divTextName');
    createElementDOM('label', "NEW QUESTION", div, ['for=inputTextQuestion']);
    createElementDOM('input', "", div, ['type=text', 'class=form-control', 'id=inputTextQuestion', 'placeholder=Enter your question'])
}

// https://getbootstrap.com/docs/4.0/components/input-group/#checkboxes-and-radios

// https://stackoverflow.com/questions/7880619/multiple-inputs-with-same-name-through-post-in-php

{/* <input class="form-control" type="text" placeholder="Readonly input here…" readonly></input> */}