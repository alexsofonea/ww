function changeTab(tab) {
     var tabs = document.querySelectorAll(".content .tabGroup");

     if (typeof tab === 'string')
         tab = [...tabs].findIndex(t => t.id === tab);

     var activeTabIndex = [...tabs].findIndex(tab => tab.classList.contains("active"));
     var activeTab = tabs[activeTabIndex];

     if (activeTabIndex == tab) {
         var time = 100;
         activeTab.style.transform = `translateX(30px)`;
         setTimeout(function () {
             activeTab.style.transform = `translateX(0px)`;
             setTimeout(function () {
                 activeTab.style.transform = `translateX(15px)`;
                 setTimeout(function () {
                     activeTab.style.transform = `translateX(0px)`;
                 }, time);
             }, time);
         }, time);
     } else {
         var newTab = tabs[tab];
         for (var i = 0; i < tabs.length; i++)
             if (i < tab)
                 tabs[i].style.transform = "translateX(-200px)";
             else
                 tabs[i].style.transform = "translateX(200px)";

         if (activeTabIndex < tab) {
             activeTab.style.transform = "translateX(-200px)";
             activeTab.style.opacity = "0";
             newTab.style.transform = "translateX(0px)";
             newTab.style.opacity = "1";

             console.log("here");

             setTimeout(function () {
                 activeTab.classList.remove("active");
                 newTab.classList.add("active");
             }, 200);
         } else if (activeTabIndex > tab) {
             activeTab.style.transform = "translateX(200px)";
             activeTab.style.opacity = "0";
             newTab.style.transform = "translateX(0px)";
             newTab.style.opacity = "1";

             setTimeout(function () {
                 activeTab.classList.remove("active");
                 newTab.classList.add("active");
             }, 200);
         }
         var tabButtons = document.querySelectorAll(".tabs a");
         if (tab < tabButtons.length) {
             for (const e of tabButtons)
                 e.classList.remove("active");
             tabButtons[tab].classList.add("active");
         }
     }
 }

 function enable(el) {
     if (el.checked)
         el.closest(".card").classList.remove("disabled");
     else
         el.closest(".card").classList.add("disabled");
 }

 function loadProject() {
    for (const input of document.querySelectorAll(".switch input"))
        enable(input);
 }