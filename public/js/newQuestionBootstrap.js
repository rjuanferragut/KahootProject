function main(edit){
    var role = document.getElementById('role').value;
    var numQuestions = document.getElementById('numQuestions').value;
    if(role != "premium"){
        var rolePremium = false;
    }else{
        var rolePremium = true;
    }
    if(edit){
        var selectTypeQuestion = document.getElementById('questionType').value;
    }else{
        var selectTypeQuestion = document.getElementById('typeQuestion').value;
    }
    if(selectTypeQuestion == "true/false"){
        createTrueFalseForm(rolePremium, numQuestions, edit);
    }else if(selectTypeQuestion == "multipleChoice"){
        createMultipleChoiceForm(rolePremium, numQuestions, edit);
    }else if(selectTypeQuestion == "ompleElsForats"){
        createOmpleEslForatsForm(rolePremium, numQuestions, edit);
    }
}

function edit(){
    main(true);
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

function createTrueFalseForm(rolePremium, numQuestions, edit){
    deleteForm();
    createForm();
    createInputNameQuestion(edit);
    createInputsTrueFalse(edit);
    // createSelectTime(rolePremium, edit);
    name(rolePremium, edit);
    createSelectPoints(edit);
    createButtonsTrueFalse(rolePremium, numQuestions, edit);
}

function createMultipleChoiceForm(rolePremium, numQuestions, edit){
    deleteForm();
    createForm();
    createInputNameQuestion(edit);
    // createSelectTime(rolePremium, edit);
    name(rolePremium, edit);
    createSelectPoints(edit);
    if(edit){
        // createEditInputsAnswerMultipleChoice(edit);
        var ids = document.getElementsByClassName('answer');
        for(i= 0; i < ids.length; i++){
            createEditInputsAnswerMultipleChoice(ids[i].value);
        }
    }else{
        createInputsAnswerMultipleChoice(edit);
    }
    createButtonsMultipleChoice(rolePremium, numQuestions, edit);
}

function createOmpleEslForatsForm(rolePremium, numQuestions, edit){
    deleteForm();
    createForm();
    createTexAreaOmpleElsForats(edit);
    // createSelectTime(rolePremium, edit);
    name(rolePremium, edit);
    createSelectPoints(edit);
    createButtonsOmpleEslForats(rolePremium, numQuestions, edit);
}

function randomId(){
    var id = Math.floor(Math.random() * 500000) + 1;
    return id;
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

function createInputNameQuestion(edit){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['class=form-group mt-3 ', 'id=divTextName']);
    var div = document.getElementById('divTextName');
    createElementDOM('label', "NEW QUESTION", div, ['for=inputTextQuestion']);
    if(edit){
        var inputTextQuestion = document.getElementById('textQuestion').value;
        var questionId = document.getElementById('questionId').value;
        createElementDOM('input', "", div, ['type=hidden', 'name=questionId', 'value='+questionId+'']);
        createElementDOM('input', "", div, ['type=text', 'class=form-control col-8', 'id=inputTextQuestion', 'name=text_question', 'placeholder=Enter your question', 'value='+inputTextQuestion+'']);
    }else{
        createElementDOM('input', "", div, ['type=text', 'class=form-control col-8', 'id=inputTextQuestion', 'name=text_question', 'placeholder=Enter your question']);
    }
    
}

function createInputsTrueFalse(edit){
    var trueClass = ['type=radio', 'name=correct?', 'id=radioButtonTrue', 'value=true', 'class=custom-control-input'];
    var falseClass = ['type=radio', 'name=correct?', 'id=radioButtonFalse', 'value=false', 'class=custom-control-input'];
    if(edit){
        var ids = document.getElementsByClassName('answer');
        var id1 = ids[0].value;
        var id2 = ids[1].value;

        var textAnswer1 = document.getElementsByClassName(id1)[0].value;
        var correctAnswer1 = document.getElementsByClassName(id1)[1].value;
        
        if(textAnswer1 == "True"){
            if(correctAnswer1 == 1){
                trueClass = ['type=radio', 'name=correct?', 'id=radioButtonTrue', 'value=true', 'class=custom-control-input', 'checked=checked'];
            }else if(correctAnswer1 == 0){
                falseClass = ['type=radio', 'name=correct?', 'id=radioButtonFalse', 'value=false', 'class=custom-control-input', 'checked=checked'];
            }

        }else if(textAnswer1 == "False"){
            if(correctAnswer1 == 1){
                falseClass = ['type=radio', 'name=correct?', 'id=radioButtonFalse', 'value=false', 'class=custom-control-input', 'checked=checked'];
            }else if(correctAnswer1 ==0){
                trueClass = ['type=radio', 'name=correct?', 'id=radioButtonTrue', 'value=true', 'class=custom-control-input', 'checked=checked'];
            }
        }
    }
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['class=custom-control custom-radio custom-control-inline', 'id=divCheckboxTrue']);
    var div = document.getElementById('divCheckboxTrue');
    createElementDOM('input', "", div, trueClass);
    createElementDOM('label', "TRUE", div, ['class=custom-control-label', 'for=radioButtonTrue']);

    createElementDOM('div', "", form, ['class=custom-control custom-radio custom-control-inline', 'id=divCheckboxFalse']);
    var div2 = document.getElementById('divCheckboxFalse');
    createElementDOM('input', "", div2, falseClass);
    createElementDOM('label', "FALSE", div2, ['class=custom-control-label', 'for=radioButtonFalse']);    
}   

function createTexAreaOmpleElsForats(edit){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['id=labelOmpleElsForats', 'class=mt-5 form-group']);
    var div = document.getElementById('labelOmpleElsForats');
    if(edit){
        var inputTextQuestion = document.getElementById('textQuestion').value;
        var questionId = document.getElementById('questionId').value;
        var textAreaClass = ['id=textAreaOmpleElsForats', 'rows=3', 'class=form-control col-10', 'name=textArea', 'value='+inputTextQuestion+''];
        createElementDOM('input', "", div, ['type=hidden', 'name=questionId', 'value='+questionId+'']);
    }else{
        var textAreaClass = ['id=textAreaOmpleElsForats', 'rows=3', 'class=form-control col-10', 'name=textArea'];
    }
    createElementDOM('label', "Omple Els Forats:" , div, ['for=textAreaOmpleElsForats']);
    createElementDOM('textarea', "" , div, textAreaClass);
}

function createButtonsTrueFalse(rolePremium, numQuestions, edit){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['id=buttonsTrueFalse', 'class=mt-5']);
    var div = document.getElementById('buttonsTrueFalse');
    if(!edit){
        if(numQuestions>=5 && rolePremium== false){
            createElementDOM('input', '', div, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion", 'class=btn btn-primary mr-1', 'disabled=disabled']);
        }else{
            createElementDOM('input', '', div, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion", 'class=btn btn-primary mr-1']);
        }
    }else if(edit){
        createElementDOM('input', '', div, ["id=saveQuestion","type=submit", "name=SaveQuestion", "value=SaveQuestion", 'class=btn btn-warning mr-1'])
        createElementDOM('input', '', div, ["id=newQuestion","type=submit", "name=newQuestion", "value=NewQuestion", 'class=btn btn-primary mr-1'])
    }    
    createElementDOM('input', '', div, ["id=doneQuestions","type=submit", "name=Done", "value=Done", 'class=btn btn-success']);
}

function createButtonsMultipleChoice(rolePremium, numQuestions, edit){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['id=buttonsMultipleChoice', 'class=mt-5']);
    var div = document.getElementById('buttonsMultipleChoice');
    if(!edit){
        if(numQuestions>=5 && rolePremium == false){
            createElementDOM('button', "Add Answer", div, ["id=addAnswer","type=button", "name=AddAnswer", 'onclick=addAnswerMultipleChoice()','class=btn btn-warning mr-1', 'disabled=disabled']);
            createElementDOM('input', '', div, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion", 'class=btn btn-primary mr-1', 'disabled=disabled']);
        }else{
            createElementDOM('button', "Add Answer", div, ["id=addAnswer","type=button", "name=AddAnswer", 'onclick=addAnswerMultipleChoice()','class=btn btn-warning mr-1']);
            createElementDOM('input', '', div, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion", 'class=btn btn-primary mr-1']);
            
        }
    }else if(edit){
        createElementDOM('input', '', div, ["id=saveQuestion","type=submit", "name=SaveQuestion", "value=SaveQuestion", 'class=btn btn-warning mr-1'])
        createElementDOM('input', '', div, ["id=newQuestion","type=submit", "name=newQuestion", "value=NewQuestion", 'class=btn btn-primary mr-1'])
    } 
    createElementDOM('input', '', div, ["id=doneQuestions","type=submit", "name=Done", "value=Done", 'class=btn btn-success']);
}

function createButtonsOmpleEslForats(rolePremium, numQuestions, edit){
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['id=buttonsMultipleChoice', 'class=mt-5']);
    var div = document.getElementById('buttonsMultipleChoice');
    if(!edit){
        if(numQuestions>=5 && rolePremium == false){
            createElementDOM('input', '', div, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion", 'class=btn btn-primary mr-1', 'disabled=disabled']);
        }else{
            createElementDOM('input', '', div, ["id=addQuestion","type=submit", "name=AddQuestion", "value=AddQuestion", 'class=btn btn-primary mr-1']);
        }
    }else if(edit){
        createElementDOM('input', '', div, ["id=saveQuestion","type=submit", "name=SaveQuestion", "value=SaveQuestion", 'class=btn btn-warning mr-1'])
        createElementDOM('input', '', div, ["id=newQuestion","type=submit", "name=newQuestion", "value=NewQuestion", 'class=btn btn-primary mr-1'])
    } 
    createElementDOM('input', '', div, ["id=doneQuestions","type=submit", "name=Done", "value=Done", 'class=btn btn-success']);
}

function createInputsAnswerMultipleChoice(edit, id, text, correct){
    if(edit){
        var classInput = ['type=text', 'name=answer[]', 'class=form-control col-8', 'value='+text+''];
        if (correct == 1) {
            var classCheckbox = ['type=checkbox', 'name=correctAnswer[]', 'value='+id+'', 'checked=checked'];
        }else{
            var classCheckbox = ['type=checkbox', 'name=correctAnswer[]', 'value='+id+''];
        }
    }else{
        var id = randomId();
        var classInput = ['type=text', 'name=answer[]', 'class=form-control col-8'];
        var classCheckbox = ['type=checkbox', 'name=correctAnswer[]', 'value='+id+''];
        
    } 
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['class=input-group mb-3 mt-3 divInputMultipleChoice1']);
    var div = document.getElementsByClassName('divInputMultipleChoice1')[document.getElementsByClassName('divInputMultipleChoice1').length-1];
    createElementDOM('div', "", div, ['class=input-group-prepend divInputMultipleChoice2']);
    var div2 = document.getElementsByClassName('divInputMultipleChoice2')[document.getElementsByClassName('divInputMultipleChoice2').length-1];
    createElementDOM('input', "", div, classInput);
    createElementDOM('div', "", div2, ['class=input-group-text divInputMultipleChoice3']);
    var div3 = document.getElementsByClassName('divInputMultipleChoice3')[document.getElementsByClassName('divInputMultipleChoice3').length-1];
    createElementDOM('input', "", div3, classCheckbox);
    createElementDOM('input', "", div3, ['type=hidden', 'name=idAnswer[]', 'value='+id+'']);
}

function createEditInputsAnswerMultipleChoice(id){
    var answer = document.getElementsByClassName(id);
    
    var text = answer[0].value;
    var correct = answer[1].value;
    createInputsAnswerMultipleChoice(true, id, text, correct);
}

function createSelectTime(rolePremium, edit){
    
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['id=divSelectTime']);
    var div = document.getElementById('divSelectTime');
    if(rolePremium){
        createElementDOM('select', "", div, ['class=custom-select mr-sm-2 col-8 mb-3', 'id=selectTime', 'name=time']);
    }else{
        createElementDOM('select', "", div, ['class=custom-select mr-sm-2 col-8 mb-3', 'id=selectTime', 'name=time', 'disabled=true']);
    }
    var select = document.getElementById('selectTime');
    createElementDOM('option', '10s', select, ["value=10"]);
    createElementDOM('option', '20s', select, ["value=20"]);
    createElementDOM('option', '30s', select, ["value=30"]);
    createElementDOM('option', '40s', select, ["value=40"]);
    createElementDOM('option', '50s', select, ["value=50"]);
    createElementDOM('option', '60s', select, ["value=60"]);
}

function name(rolePremium, edit) {
    console.log(rolePremium);
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['id=divSelectsTime', 'class=form-row mt-3 mb-3']);
    if(rolePremium){
        console.log("dentro if");
        var classWaitingTime = ['class=custom-select', 'id=selectwaitingTime', 'name=waitingtime'];
        var classTime = ['class=custom-select', 'id=selectTime', 'name=time'];
        var inputRadio = ['type=radio', 'name=time', 'value=time'];
    }else{
        console.log("dentro else");
        var classWaitingTime = ['class=custom-select', 'id=selectwaitingTime', 'name=waitingtime' , 'disabled=true'];
        var classTime = ['class=custom-select', 'id=selectTime', 'name=time', 'disabled=true'];
        var inputRadio = ['type=radio', 'name=time', 'value=time', 'disabled=true'];
    }
    var div = document.getElementById('divSelectsTime');
    createElementDOM('div', "", div, ['id=div1time', 'class=input-group col-4']);
    var div1time = document.getElementById('div1time');
    createElementDOM('div', "", div1time, ['id=div2time', 'class=input-group-prepend']);
    createElementDOM('select', "", div1time, classTime);
    var select = document.getElementById('selectTime');
    createElementDOM('option', 'Time to answer', select, []);
    createElementDOM('option', '10s', select, ["value=10"]);
    createElementDOM('option', '20s', select, ["value=20"]);
    createElementDOM('option', '30s', select, ["value=30"]);
    createElementDOM('option', '40s', select, ["value=40"]);
    createElementDOM('option', '50s', select, ["value=50"]);
    createElementDOM('option', '60s', select, ["value=60"]);
    var div2time = document.getElementById('div2time');
    createElementDOM('div', "", div2time, ['id=div3time', 'class=input-group-text']);
    var div3time = document.getElementById('div3time');
    createElementDOM('input', "", div3time, inputRadio);


    createElementDOM('div', "", div, ['id=div1waitingtime', 'class=input-group col-4']);
    var div1waitingtime = document.getElementById('div1waitingtime');
    createElementDOM('div', "", div1waitingtime, ['id=div2waitingtime', 'class=input-group-prepend']);
    createElementDOM('select', "", div1waitingtime, classWaitingTime);
    var select = document.getElementById('selectwaitingTime');
    createElementDOM('option', 'Waiting time', select, []);
    createElementDOM('option', '10s', select, ["value=10"]);
    createElementDOM('option', '20s', select, ["value=20"]);
    createElementDOM('option', '30s', select, ["value=30"]);
    createElementDOM('option', '40s', select, ["value=40"]);
    createElementDOM('option', '50s', select, ["value=50"]);
    createElementDOM('option', '60s', select, ["value=60"]);
    var div2waitingtime = document.getElementById('div2waitingtime');
    createElementDOM('div', "", div2waitingtime, ['id=div3waitingtime', 'class=input-group-text']);
    var div3waitingtime = document.getElementById('div3waitingtime');
    createElementDOM('input', "", div3waitingtime, inputRadio);

}

function createSelectPoints(edit){
    var class10 = ["value=10"];
    var class50 = ["value=50"];
    var class100 = ["value=100"];
    var class150 = ["value=150"];
    var class300 = ["value=300"];
    var class500 = ["value=500"];
    var class1000 = ["value=1000"];
    if(edit){
        var points= document.getElementById('pointsQuestion').value;
        switch (points) {
            case "10":
                class10 = ["value=10", 'selected=selected'];
                break;
            case "50":
                class50 = ["value=50", 'selected=selected'];
                break;
            case "100":
                class100 = ["value=100", 'selected=selected'];
                break;
            case "150":
                class150 = ["value=150", 'selected=selected'];
                break;
            case "300":
                class300 = ["value=300", 'selected=selected'];
                break;
            case "500":
                class500 = ["value=500", 'selected=selected'];
                break;
            case "1000":
                class1000 = ["value=1000", 'selected=selected'];
                break;
        }
    }
    var form = document.getElementById('formJs');
    createElementDOM('div', "", form, ['id=divSelectPoints']);
    var div = document.getElementById('divSelectPoints');
    createElementDOM('select', "", div, ['class=custom-select mr-sm-2 col-8', 'id=selectPoints', 'name=points']);
    var select = document.getElementById('selectPoints');
    createElementDOM('option', '10 points', select, class10);
    createElementDOM('option', '50 points', select, class50);
    createElementDOM('option', '100 points', select, class100);
    createElementDOM('option', '150 points', select, class150);
    createElementDOM('option', '300 points', select, class300);
    createElementDOM('option', '500 points', select, class500);
    createElementDOM('option', '1000 points', select, class1000);
}

function addAnswerMultipleChoice(){
    removeButtonsMultipleChoice();
    createInputsAnswerMultipleChoice();
    createButtonsMultipleChoice();
}
