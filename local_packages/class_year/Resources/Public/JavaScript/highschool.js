console.log("ARABIAN NIGHTS")

require(['TYPO3/CMS/Core/Ajax/AjaxRequest'], function (AjaxRequest) {
  document.querySelectorAll("select").forEach((element) => {
    element.addEventListener('change', (event) => {
      const select = event.target
      const userId = select.dataset.studentUid
      const selectedClassroom = select.querySelector("option:checked").value
  
      new AjaxRequest(TYPO3.settings.ajaxUrls.backendHighschool_updateStudentClassroom)
      .withQueryArguments({userId: userId, classroomId: selectedClassroom })
      .get()
      .then(async function (response) {
      const resolved = await response.resolve();
      console.log(resolved.result);
    });
  
    })
  })
})