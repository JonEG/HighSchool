
// initialize classroom vs subjects logic
const classroomSelectors = document.getElementsByName("tx_classyear_examscrud[newExam][classroom]")
const subjectSelectors = document.getElementsByName("tx_classyear_examscrud[newExam][subject]")

if(classroomSelectors.length > 0 && subjectSelectors.length > 0){

  classroomSelectors[0].addEventListener("change", () => {

    const subjectUidsString = classroomSelectors[0].querySelector('option:checked').dataset.subjectUids
    const subjectUids = subjectUidsString.split(',')
    //sets selected as default everytime classroom changes
    subjectSelectors[0].querySelector('option[value=""]').selected = true;
    //disables are subjects that are not taught on the selected classroom
    subjectSelectors[0].querySelectorAll('option:not([value=""])').forEach(element => {
      if(!subjectUids.includes(element.value)){
        element.disabled = true;
      } else {
        element.disabled = false;
      }
    });

  });
}


// initialize question creation login
const addQuestionButton = document.querySelector(".create-exam-form__questions__add")
const newQuestionTemplate = document.querySelector(".create-exam-form__question")
const questionsDiv = document.querySelector(".create-exam-form__questions")

addQuestionButton?.addEventListener("click", () => {
  const newQuestion = newQuestionTemplate.cloneNode(true)
  newQuestion.hidden = false

  const questionNumber = document.querySelectorAll(".create-exam-form__question").length - 1
  //rename title
  const titleElement = newQuestion.querySelector("input[type='text']")
  titleElement.name = titleElement.getAttribute("name") + `[${questionNumber}][title]`

  //rename radioButtons
  const radioElements = newQuestion.querySelectorAll("input[type='radio']")
  radioElements.forEach((element) => {
    element.name = element.getAttribute("name") + `[${questionNumber}][correctAnswer]`
  })

  //set deleting button
  newQuestion.querySelector("button").addEventListener("click", (event) => {
    const targetElement = event.target || event.srcElement
    targetElement.closest(".create-exam-form__question").remove()
  })

  questionsDiv.append(newQuestion);
})




