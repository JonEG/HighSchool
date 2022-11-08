require(['TYPO3/CMS/Core/Ajax/AjaxRequest','TYPO3/CMS/Backend/Notification'], function (AjaxRequest, Notification) {
  document.querySelectorAll("select").forEach((element) => {
    element.addEventListener('change', (event) => {
      const select = event.target
      const userId = select.dataset.studentUid
      const selectedClassroom = select.querySelector("option:checked").value

      new AjaxRequest(TYPO3.settings.ajaxUrls.backendHighschool_updateStudentClassroom)
        .withQueryArguments({ userId: userId, classroomId: selectedClassroom })
        .get()
        .then(async function (data) {
          const resolved = await data.resolve();
          switch (data.response.status) {
            case 200:
              Notification.success('Success', resolved.message);
              break;
            case 400:
            case 500:
              Notification.error('Error', resolved.message);
              break;
            default:
              break;
          }
        });

    })
  })
})