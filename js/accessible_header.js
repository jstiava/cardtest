const parentMenus = document.querySelector('.nav-menu').children;
const parentLinks = [];

console.log(parentMenus);

const findParentLinks = () => {

     for (var i = 0; i < parentMenus.length; i++) {
          parentLinks.push(parentMenus[i].querySelector('a'));
     }

};
findParentLinks();

const handleTabs = () => {

     parentLinks.forEach((element) => {
          element.addEventListener("keyup", function (e) {
               tabNow(element);
          });
     });

};
handleTabs();

function tabNow(element) {
     console.log("Register tab");

     parentLinks.forEach((e) => {
          e.classList.remove('ariaSelected');
          e.setAttribute("aria-selected", "false");
     });

     element.setAttribute("aria-selected", "true");
     element.classList.add('ariaSelected');
};