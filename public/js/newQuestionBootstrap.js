function main(){
    var selectTypeQuestion = document.getElementById('typeQuestion').value;
    if(selectTypeQuestion == "true/false"){
        createTrueFalseForm();
        createImgUploader();
    }else if(selectTypeQuestion == "multipleChoice"){
        createMultipleChoiceForm();
        createImgUploader();
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
function createImgUploader(){
    var form = document.getElementById('formJs');
    //creating image uploader
    createElementDOM('input', "", form, ["type=file","value=Search", "id=customFile", "accept=image/*"]);
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

}

function deleteForm(){
    var form = document.getElementById('formJs');
    if(form != null){
        form.parentElement.removeChild(form);
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
    createElementDOM('input', "");
    createElementDOM('input', '', div, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion", 'class=btn btn-primary mr-1']);
    createElementDOM('input', '', div, ["id=doneQuestions","type=submit", "name=Done", "value=Done", 'class=btn btn-success']);

}


// https://getbootstrap.com/docs/4.0/components/input-group/#checkboxes-and-radios

// https://stackoverflow.com/questions/7880619/multiple-inputs-with-same-name-through-post-in-php

{/* <input class="form-control" type="text" placeholder="Readonly input here…" readonly></input> */}
