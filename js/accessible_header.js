const tablist = document.getElementById('main_menu');
const tabs = tablist.querySelectorAll('.menu-item');

const makeLinksAccessibleReady = (link) => {
     const linkID = link.id;

     tabs.forEach((e) => {
          const id = e.getAttribute("id");
          if (id === linkID) {
               e.removeAttribute("tabindex");
               e.setAttribute("aria-selected", "true");
          }
          else {
               e.setAttribute("tabIndex", "-1");
               e.setAttribute("aria-selected", "false");
          }
     });
};

const handleTab = () => {
     tabs.forEach((link) => {
          link.addEventListener("click", function () {
               makeLinksAccessibleReady(link);
          });
     });

     tabs.forEach((link) => {
          link.addEventListener("keydown", function (e) {
               if ((e.keyCode || e.which === 32)) {
                    makeLinksAccessibleReady(link);
                    link.click();
               }
          });
     });
};

