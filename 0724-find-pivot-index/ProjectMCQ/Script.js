function GoToHome(){
    window.location.href = "HomePage.html";
}
function GoToHome(){
    window.location.href = "StartQuizPage.html";
}
const emailId=document.getElementById("email");
function validatEmail(emailId){
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(emailId);
}

