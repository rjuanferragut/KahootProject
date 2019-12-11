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
    deleteForm();
    createForm();
    createInputNameQuestion();
    createInputsTrueFalse();
    createButtonsTrueFalse();
}

function createMultipleChoiceForm(){
    deleteForm();
    createForm();
    createInputNameQuestion();
    createInputsAnswerMultipleChoice();
    createButtonsMultipleChoice();
}

function deleteForm(){
    var form = document.getElementById('formJs');
    if(form != null){
        form.parentElement.removeChild(form);
    }  
}

function removeButtonsMultipleChoice(){
    var div = document.getElementById('buttonsMultipleChoice');
    if(div != null){
        div.parentElement.removeChild(div);
    }
}

function createForm(){
    var div = document.getElementById('Questions');
    // createElementDOM('a', "NEW QUESTION:", div, ["id=a"]);
    createElementDOM('form', "", div, ["method=post", "action=../saveQuestion.php", "id=formJs"]);
}

function createInputNameQuestion(){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['class=form-group mt-3 ', 'id=divTextName']);
    var div = document.getElementById('divTextName');
    createElementDOM('label', "NEW QUESTION", div, ['for=inputTextQuestion']);
    createElementDOM('input', "", div, ['type=text', 'class=form-control col-8', 'id=inputTextQuestion', 'placeholder=Enter your question'])
}

function createInputsTrueFalse(){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['class=custom-control custom-radio custom-control-inline', 'id=divCheckboxTrue']);
    var div = document.getElementById('divCheckboxTrue');
    createElementDOM('input', "", div, ['type=radio', 'name=correct?', 'id=radioButtonTrue', 'value=true', 'class=custom-control-input']);
    createElementDOM('label', "TRUE", div, ['class=custom-control-label', 'for=radioButtonTrue']);

    createElementDOM('div', "", form, ['class=custom-control custom-radio custom-control-inline', 'id=divCheckboxFalse']);
    var div2 = document.getElementById('divCheckboxFalse');
    createElementDOM('input', "", div2, ['type=radio', 'name=correct?', 'id=radioButtonFalse', 'value=false', 'class=custom-control-input']);
    createElementDOM('label', "FALSE", div2, ['class=custom-control-label', 'for=radioButtonFalse']);
    // createElementDOM('div', "", div, ['class=input-group-prepend', 'id=divCheckboxTrue2']);
    // createElementDOM('label', "TRUE", div, []);
    // var div2 = document.getElementById('divCheckboxTrue2');
    // createElementDOM('div', "", div2, ['class=input-group-text', 'id=divCheckboxTrue3']);
    // var div3 = document.getElementById('divCheckboxTrue3');
    
}    

function createButtonsTrueFalse(){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['id=buttonsTrueFalse', 'class=mt-5']);
    var div = document.getElementById('buttonsTrueFalse');
    createElementDOM('input', '', div, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion", 'class=btn btn-primary mr-1']);
    createElementDOM('input', '', div, ["id=doneQuestions","type=submit", "name=Done", "value=Done", 'class=btn btn-success']);
}

function createButtonsMultipleChoice(){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['id=buttonsMultipleChoice', 'class=mt-5']);
    var div = document.getElementById('buttonsMultipleChoice');
    createElementDOM('button', "Add Answer", div, ["id=addAnswer","type=button", "name=AddAnswer", 'onclick=addAnswerMultipleChoice()','class=btn btn-warning mr-1']);
    createElementDOM('input', '', div, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion", 'class=btn btn-primary mr-1']);
    createElementDOM('input', '', div, ["id=doneQuestions","type=submit", "name=Done", "value=Done", 'class=btn btn-success']);

}

function createInputsAnswerMultipleChoice(){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['class=input-group mb-3 mt-3 divInputMultipleChoice1']);
    var div = document.getElementsByClassName('divInputMultipleChoice1')[document.getElementsByClassName('divInputMultipleChoice1').length-1];
    createElementDOM('div', "", div, ['class=input-group-prepend divInputMultipleChoice2']);
    var div2 = document.getElementsByClassName('divInputMultipleChoice2')[document.getElementsByClassName('divInputMultipleChoice2').length-1];
    createElementDOM('input', "", div, ['type=text', 'name=question[]', 'class=form-control']);
    createElementDOM('div', "", div2, ['class=input-group-text divInputMultipleChoice3']);
    var div3 = document.getElementsByClassName('divInputMultipleChoice3')[document.getElementsByClassName('divInputMultipleChoice3').length-1];
    createElementDOM('input', "", div3, ['type=checkbox', 'name=correct?[]', 'value=true']);
}

function addAnswerMultipleChoice(){
    removeButtonsMultipleChoice();
    createInputsAnswerMultipleChoice();
    createButtonsMultipleChoice();
}


// https://getbootstrap.com/docs/4.0/components/input-group/#checkboxes-and-radios

// https://stackoverflow.com/questions/7880619/multiple-inputs-with-same-name-through-post-in-php

{/* <input class="form-control" type="text" placeholder="Readonly input here…" readonly></input> */}