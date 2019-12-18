window.onload = updateClock;
 var totalTime =5;
function updateClock() {
    document.getElementById('countdown').innerHTML = totalTime;
    if(totalTime==0){
        window.location.href = ("../../views/layouts/showAnswers.php");
        }else{
            totalTime-=1;
            setTimeout("updateClock()",1000);
    }
}